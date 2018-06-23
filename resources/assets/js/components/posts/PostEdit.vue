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

                                    <select2-field v-if="admin" :lists="clients" :value="post.client_id" :label="'Klijent'" @changeValue="post.client_id = $event"></select2-field>

                                    <select2-field :lists="lists" :label="'Kategorija'" :value="post.blog_id" :error="error? error.blog_id : ''" :required="true" @changeValue="post.blog_id = $event"></select2-field>

                                    <select2-field :lists="brands" :label="'Brend'" :value="post.brand_id" @changeValue="post.brand_id = $event"></select2-field>


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

                                    <text-area-ckeditor-field v-if="post.body" :value="post.body" :label="'Opis'" :error="error? error.body : ''" :required="true" @changeValue="post.body = $event"></text-area-ckeditor-field>

                                    <select2-multiple-field :lists="tags" :value="post.tag_ids" :label="'Tagovi'" @changeValue="post.tag_ids = $event"></select2-multiple-field>

                                    <checkbox-field :value="post.publish" :label="'Publikovano'" @changeValue="post.publish = $event"></checkbox-field>

                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Izmeni</button>
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
    import { apiHost } from '../../config';
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import UploadImageHelper from '../helper/UploadImageHelper.vue';
    import swal from 'sweetalert2';
    import vue2Dropzone from 'vue2-dropzone';
    import 'vue2-dropzone/dist/vue2Dropzone.css';
    import moment from 'moment';

    export default {
        data(){
          return {
              post: {
                  tag_ids: []
              },
              error: null,
              lists: false,
              gallery: {},
              clients: {},
              brands: {},
              tags: {},
              dropzoneOptions: {
                  url: 'api/posts/' + this.$route.params.id + '/gallery',
                  thumbnailWidth: 150,
                  maxFilesize: 0.5,
                  headers: { "Authorization": "Bearer " + this.$auth.getToken() }
              },
              domain : apiHost
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
            this.getList();
            this.getTags();
            this.getGallery();
            this.getBrands();
            this.getClients();
        },
        methods: {
            getPost(){
                axios.get('api/posts/' + this.$route.params.id)
                    .then(res => {
                        this.post = res.data.post;
                        this.post.tag_ids = res.data.tag_ids;
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                        if(e.response.status == 401){
                            this.$router.push('/posts');
                        }
                    });
            },
            getClients(){
                axios.get('api/clients/lists')
                    .then(res => {
                        this.clients = res.data.clients;
                        this.getPost();
                    }).catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                this.post.user_id = this.user.id;
                this.post.publish_at = this.publish_at;
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
            getList(){
                axios.get('api/blogs/lists')
                    .then(res => {
                        this.lists = res.data.blogs;
                        this.getClients();
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            getBrands(){
                axios.get('api/brands/lists')
                    .then(res => {
                        this.brands = res.data.brands;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            getGallery(){
                axios.get('api/posts/' + this.$route.params.id + '/gallery')
                    .then(res => {
                        this.gallery = res.data.photos;
                        console.log(this.gallery);
                    }).catch(e => {
                        console.log(e.response);
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
            getTags(){
                axios.get('api/tags/lists')
                    .then(res => {
                        this.tags = _.map(res.data.tags, (data) => {
                            var pick = _.pick(data, 'title', 'id');
                            var object = {id: pick.id, text: pick.title};
                            return object;
                        });
                    }).catch(e => {
                    console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
        }
    }
</script>