<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/brands'">Brendovi</router-link></li>
                            <li>Kreiranje brenda</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Kreiranje brenda</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card">
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
                                    :error="error? error.category_ids : ''"
                                    :value="category_ids"
                            ></select-multiple-field>

                            <checkbox-field :value="brand.publish" :label="'Publikovano'" @changeValue="brand.publish = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Kreiraj</button>
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
                            @uploadImage="prepare($event)"
                            @removeRow="remove($event)"
                    ></upload-image-helper>

                    <upload-image-helper
                            :image="brand.logo"
                            :defaultImage="null"
                            :titleImage="'logoa'"
                            :error="error"
                            @uploadImage="prepareLogo($event)"
                            @removeRow="remove($event)"
                    ></upload-image-helper>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import UploadImageHelper from '../helper/UploadImageHelper.vue';
    import swal from 'sweetalert2';

    export default {
        data(){
          return {
              image: {},
              logo: {},
              brand: {},
              category_ids: [],
              categories: [],
              error: null,
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
        },
        mounted(){
            this.getCategories();
            this.$root.$on('changeValue', this.handleChange);
        },
        destroyed() {
            this.$root.$off('changeValue', this.handleChange);
        },
        methods: {
            handleChange(data) {
                this.category_ids = data;
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

                axios.post('api/brands', payload)
                    .then(res => {
                        this.brand = res.data.brand;
                        this.sendImage();
                        this.sendLogoImage();
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/brands');
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            getCategories(){
                axios.get('api/categories/top-lists')
                    .then(res => {
                        this.categories = res.data.categories;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            prepare(image){
                this.brand.image = image.src;
                this.image = new FormData();
                this.image.append('file', image.file);
            },
            prepareLogo(image){
                this.brand.logo = image.src;
                this.logo = new FormData();
                this.logo.append('file', image.file);
            },
            sendImage(){
                axios.post('api/brands/' + this.brand.id + '/image', this.image)
                    .then(res => {
                        this.brand.image = res.data.image;
                        this.error = null;
                    }).catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            sendLogoImage(){
                axios.post('api/brands/' + this.brand.id + '/logo-image', this.logo)
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
        }
    }
</script>