<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/posts'">Članci</router-link></li>
                            <li>Izmena članka</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena članka</h5>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <h5>Gallery images</h5>
                        <hr>
                        <div id="gallery" v-if="gallery">
                            <div v-for="photo in gallery" class="photo">
                                <font-awesome-icon icon="times" @click="deletePhoto(photo)" />
                                <img :src="photo.tmb" class="img-thumbnail" alt="post.title">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">

                        <upload-image-helper
                                :image="post.image"
                                :defaultImage="null"
                                :titleImage="'članka'"
                                :error="error"
                                :dimensions="'800x600 px'"
                                @uploadImage="upload($event)"
                                @removeRow="remove($event)"
                        ></upload-image-helper>

                        <upload-image-helper
                                :image="post.slider"
                                :defaultImage="null"
                                :titleImage="'slajdera'"
                                :error="error"
                                :dimensions="'980x420 px'"
                                @uploadImage="uploadSlider($event)"
                                @removeRow="remove($event)"
                        ></upload-image-helper>

                    </div><!-- .card -->

                    <div class="card">
                        <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" @vdropzone-success="showSuccess()"></vue-dropzone>
                    </div>

                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="tab-content" id="myTabContent" v-if="lists">
                            <div class="tab-pane fade show active" id="srb" role="tabpanel" aria-labelledby="srb-tab">
                                <form @submit.prevent="submit()">

                                    <select-field v-if="admin && clients" :labela="'Klijent'" :options="clients" :value="post.client" :error="error? error.client_id : ''" @changeValue="post.client_id = $event"></select-field>

                                    <select-field v-if="lists" :labela="'Kategorija'" :options="lists" :value="post.blog" :error="error? error.blog_id : ''" @changeValue="post.blog_id = $event"></select-field>

                                    <select-field v-if="brands" :labela="'Brend'" :options="brands" :value="post.brand" :error="error? error.brand_id : ''" @changeValue="post.brand_id = $event"></select-field>

                                    <select-field v-if="categories" :labela="'Kategorija vezanog proizvoda'" :options="categories" :value="post.categories" :error="error? error.category_id : ''" @changeValue="post.category_id = $event"></select-field>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <date-field :value="post.date" :label="'Publikovano od:'" :error="error? error.publish_at : ''" @changeValue="post.date = $event"></date-field>
                                        </div>
                                        <div class="col-sm-6">
                                            <time-field :value="post.time" :label="''" @changeValue="post.time = $event"></time-field>
                                        </div>
                                    </div>

                                    <text-field :value="post.title" :label="'Naslov'" :error="error? error.title : ''" :required="true" @changeValue="post.title = $event"></text-field>

                                    <text-field :value="post.slug" :label="'Slug'" :error="error? error.slug : ''" @changeValue="post.slug = $event"></text-field>

                                    <text-area-field :value="post.short" :label="'Kratak opis'" :error="error? error.short : ''" :required="true" @changeValue="post.short = $event"></text-area-field>

                                    <text-field v-if="post.category_id == 3" :value="post.author" :label="'Autor'" :error="error? error.author : ''" @changeValue="post.author = $event"></text-field>

                                    <text-area-ckeditor-field :value="post.body" :label="'Opis'" :error="error? error.body : ''" :required="true" @changeValue="post.body = $event"></text-area-ckeditor-field>

                                    <select-multiple-field :options="tags" :error="error? error.tag_ids : ''" :value="post.tags" @changeValue="post.tag_ids = $event"></select-multiple-field>

                                    <checkbox-field :value="post.publish" :label="'Publikovano'" @changeValue="post.publish = $event"></checkbox-field>

                                    <checkbox-field :value="post.on_slider" :label="'Na slajderu'" @changeValue="post.on_slider = $event"></checkbox-field>

                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Izmeni</button>
                                        <button class="btn btn-secondary" type="button" @click="preview">Pregledaj</button>
                                    </div>
                                </form>
                            </div><!-- #srb -->
                        </div>
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
              selected: {},
              post: {},
              error: null,
              lists: false,
              gallery: {},
              clients: {},
              brands: {},
              categories: {},
              tags: false,
              dropzoneOptions: {
                  url: 'api/posts/' + this.$route.params.id + '/gallery',
                  thumbnailWidth: 150,
                  maxFilesize: 0.5,
                  headers: { "Authorization": "Bearer " + this.$auth.getToken() }
              },
          }
        },
        computed: {
            post_id(){
                return this.post.id;
            },
            user(){
                return this.$store.getters.getUser;
            },
            publish_at(){
                return this.post.date + ' ' + this.post.time;
            },
            admin(){
                return this.$store.getters.isAdmin;
            },
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
            'vue-dropzone': vue2Dropzone,
        },
        mounted(){
            this.getPost();
        },
        methods: {
            getPost(){
                axios.get('api/posts/' + this.$route.params.id)
                    .then(res => {
                        this.lists = res.data.blogs;
                        this.clients = res.data.clients;
                        this.brands = res.data.brands;
                        this.gallery = res.data.photos;
                        this.tags = res.data.tags;
                        this.post = res.data.post;
                        this.categories = res.data.categories;
                        this.post.client = res.data.client_id;
                        this.post.blog = res.data.blog_id;
                        this.post.brand = res.data.brand_id;
                        this.post.tags = res.data.tag_ids;
                        this.post.product_ids = res.data.product_ids;
                        this.post.categories = res.data.category_id;
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                        if(e.response.status == 401){
                            this.$router.push('/posts');
                        }
                    });
            },
            submit(){
                this.post.user_id = this.user.id;
                this.post.publish_at = this.publish_at;
                console.log('submit: ' + this.post.tag_ids);
                axios.put('api/posts/' + this.post.id, this.post)
                    .then(res => {
                        this.post = res.data.post;
                        this.post.tag_ids = res.data.tag_ids;
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
                let data = new FormData();
                this.post.image = image.src;
                data.append('file', image.file);

                axios.post('api/posts/' + this.post.id + '/image', data)
                    .then(res => {
                        this.post.image = res.data.image;
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
            uploadSlider(image){
                let data = new FormData();
                this.post.slider = image.src;
                data.append('file', image.file);

                axios.post('api/posts/' + this.post.id + '/image?cover_image=1', data)
                    .then(res => {
                        this.post.slider = res.data.image;
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
                axios.post('api/galleries/' + photo.id + '/destroy')
                    .then(res => {
                        this.gallery = this.gallery.filter(function (item) {
                            return photo.id != item.id;
                        });
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            showSuccess(){
                this.getGallery();
            },
            preview(){
                var link = "blog/" + this.post.blog.slug + '/' + this.post.slug + '/' +this.post.id;
                window.open(link);
            }
        },
    }
</script>