<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/brands'">Brendovi</router-link></li>
                            <li>Izmena brenda</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena brenda</h5>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <h5>Gallery images</h5>
                        <hr>
                        <div id="gallery" v-if="gallery">
                            <div v-for="photo in gallery" class="photo">
                                <font-awesome-icon icon="times" @click="deletePhoto(photo)" />
                                <img :src="photo.tmb" class="img-thumbnail" alt="brand.title">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card" v-if="brand">
                        <form @submit.prevent="submit()">

                            <text-field :value="brand.title" :label="'Naziv'" :error="error? error.title : ''" @changeValue="brand.title = $event"></text-field>

                            <text-field :value="brand.slug" :label="'Slug'" :error="error? error.slug : ''" @changeValue="brand.slug = $event"></text-field>

                            <text-field :value="brand.order" :label="'Redosled'" :error="error? error.order : ''" @changeValue="brand.order = $event"></text-field>

                            <text-area-field :value="brand.short" :label="'Kratak opis'" :error="error? error.short : ''" @changeValue="brand.short = $event"></text-area-field>

                            <text-area-ckeditor-field :value="brand.body" :label="'Opis'" :error="error? error.body : ''" @changeValue="brand.body = $event"></text-area-ckeditor-field>

                            <text-area-ckeditor-field :value="brand.delivery" :label="'Isporuka i povraćaj'" :error="error? error.delivery : ''" @changeValue="brand.delivery = $event"></text-area-ckeditor-field>

                            <select-multiple-field
                                    v-if="categories"
                                    :labela="'Kategorije'"
                                    :options="categories"
                                    :value="category_ids"
                                    :error="error? error.category_ids : ''"
                            ></select-multiple-field>

                            <checkbox-field :value="brand.publish" :label="'Publikovano'" @changeValue="brand.publish = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Izmeni</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">

                    <upload-image-helper
                            :image="brand.image"
                            :defaultImage="null"
                            :titleImage="'brenda'"
                            :error="error"
                            @uploadImage="upload($event)"
                            @removeRow="remove($event)"
                    ></upload-image-helper>

                    <upload-image-helper
                            :image="brand.logo"
                            :defaultImage="null"
                            :titleImage="'logoa'"
                            :error="error"
                            @uploadImage="uploadLogo($event)"
                            @removeRow="remove($event)"
                    ></upload-image-helper>

                    <div class="card">
                        <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" @vdropzone-success="showSuccess()"></vue-dropzone>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import UploadImageHelper from '../helper/UploadImageHelper.vue';
    import swal from 'sweetalert2';
    import vue2Dropzone from 'vue2-dropzone';
    import 'vue2-dropzone/dist/vue2Dropzone.css';

    export default {
        data(){
          return {
              brand: {},
              gallery: {},
              category_ids: [],
              categories: [],
              error: null,
              dropzoneOptions: {
                  url: 'api/brands/' + this.$route.params.id + '/gallery',
                  thumbnailWidth: 150,
                  maxFilesize: 0.5,
                  headers: { "Authorization": "Bearer " + this.$auth.getToken() }
              },
          }
        },
        computed: {
            user(){
                return this.$store.getters.getUser;
            },
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
            'vue-dropzone': vue2Dropzone,
        },
        mounted(){
            this.$root.$on('changeValue', this.handleChange);
            this.getBrand();
        },
        destroyed() {
            this.$root.$off('changeValue', this.handleChange);
        },
        methods: {
            handleChange(data) {
                this.category_ids = data;
            },

            getBrand(){
                axios.get('api/brands/' + this.$route.params.id)
                    .then((res) => {
                        this.categories = res.data.categories;
                        this.gallery = res.data.images;
                        this.brand = res.data.brand;
                        this.category_ids = res.data.category_ids;
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },

            showSuccess(){
                this.getGallery();
            },

            submit(){
                const payload = {
                    /**
                     * extend brand with user_id and category_ids. After this brand is
                     * completely new object, there's no mutating.
                     */
                    ...this.brand,
                    user_id: this.user.id,
                    category_ids: this.category_ids.map((e) => e.id),
                };

                axios.put('api/brands/' + this.brand.id, payload)
                    .then((_) => {
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Uspeh',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.error = null;
                    }).catch(e => {
                    console.log(e.response);
                    this.error = e.response.data.errors;
                });
            },

            upload(image){
                this.brand.image = image.src;
                let data = new FormData();
                data.append('file', image.file);

                axios.post('api/brands/' + this.brand.id + '/image', data)
                    .then(res => {
                        this.brand.image = res.data.image;
                        this.error = null;
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }).catch(e => {
                    console.log(e);
                    this.error = e.response.data.errors;
                });
            },

            uploadLogo(image){
                this.brand.logo = image.src;
                let data = new FormData();
                data.append('file', image.file);

                axios.post('api/brands/' + this.brand.id + '/logo-image', data)
                    .then(res => {
                        this.brand.logo = res.data.image;
                        this.error = null;
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }).catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },

            deletePhoto(photo){
                axios.post('api/brands/' + photo.id + '/remove-gallery')
                    .then(res => {
                        this.gallery = this.gallery.filter(function (item) {
                            return photo.id != item.id;
                        });
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
        }
    }
</script>