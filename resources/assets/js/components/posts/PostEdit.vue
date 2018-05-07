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

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="date">Publikovano od:</label>
                                    <input type="date" name="title" class="form-control" id="date" placeholder="Published at" v-model="post.date">
                                    <small class="form-text text-muted" v-if="error != null && error.publish_at">{{ error.publish_at[0] }}</small>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="time">&nbsp;</label>
                                    <input type="time" name="title" class="form-control" id="time" placeholder="Published at" v-model="post.time">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category">Kategorija</label>
                            <select name="category" id="category" class="form-control" v-model="post.blog_id">
                                <option :value="index" v-for="(category, index) in lists">{{ category }}</option>
                            </select>
                            <small class="form-text text-muted" v-if="error != null && error.blog_id">{{ error.blog_id[0] }}</small>
                        </div>
                        <div class="form-group">
                            <label>Publikovano</label><br>
                            <switches v-model="post.publish" theme="bootstrap" color="primary"></switches>
                        </div>

                        <upload-image-helper
                                :image="post.image"
                                :defaultImage="null"
                                :titleImage="'članka'"
                                :error="error"
                                @uploadImage="upload($event)"
                                @removeRow="remove($event)"
                        ></upload-image-helper>

                        <upload-image-helper
                                :image="post.slider"
                                :defaultImage="null"
                                :titleImage="'slajdera'"
                                :error="error"
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
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="srb" role="tabpanel" aria-labelledby="srb-tab">
                                <form @submit.prevent="submit()">
                                    <div class="form-group">
                                        <label for="title">Naslov</label>
                                        <input type="text" name="title" class="form-control" id="title" placeholder="Naslov" v-model="post.title">
                                        <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" v-model="post.slug">
                                        <small class="form-text text-muted" v-if="error != null && error.slug">{{ error.slug[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="short">Kratak opis</label>
                                        <textarea name="short" id="short" cols="3" rows="4" class="form-control" placeholder="Kratak opis" v-model="post.short"></textarea>
                                        <small class="form-text text-muted" v-if="error != null && error.short">{{ error.short[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Opis</label>
                                        <ckeditor
                                                v-model="post.body"
                                                :config="config">
                                        </ckeditor>
                                        <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.body[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Tagovi</label>
                                        <select2 :options="tags" :multiple="true" :value="post.tag_ids" @input="input($event)">
                                            <option value="0" disabled>select one</option>
                                        </select2>
                                    </div>
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
    import Switches from 'vue-switches';
    import Ckeditor from 'vue-ckeditor2';
    import vue2Dropzone from 'vue2-dropzone';
    import 'vue2-dropzone/dist/vue2Dropzone.css';
    import moment from 'moment';
    import Select2 from '../helper/Select2Helper.vue';

    export default {
        data(){
          return {
              post: {
                  tag_ids: []
              },
              error: null,
              lists: {},
              gallery: {},
              tags: {},
              config: {
                  toolbar: [
                      [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', 'Image', 'Link', 'Unlink', 'Source' ],
                      { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
                      '/',
                      { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
                  ],
                  height: 300,
                  filebrowserBrowseUrl: 'filemanager/show'
              },
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
            }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
            'switches': Switches,
            'ckeditor': Ckeditor,
            'vue-dropzone': vue2Dropzone,
            'select2': Select2,
        },
        created(){
            this.getList();
            this.getTags();
            this.getGallery();
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
                axios.post('api/posts/' + this.post.id + '/image', { file: image[0] })
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
                axios.post('api/posts/' + this.post.id + '/image?slider=1', { file: image[0] })
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
                        this.getPost();
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
            input(tag){
                this.post.tag_ids = tag;
            },
        }
    }
</script>