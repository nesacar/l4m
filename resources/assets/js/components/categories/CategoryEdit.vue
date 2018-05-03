<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/categories'">Kategorije proizvoda</router-link></li>
                            <li>Izmena kategorije</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena kategorije</h5>
                    </div>
                </div>

                <!--
                <div class="col-md-12">
                    <div class="card">
                        <h5>Gallery images</h5>
                        <hr>
                        <div id="gallery" v-if="photos">
                            <div v-for="photo in photos" class="photo">
                                <font-awesome-icon icon="times" @click="deletePhoto(photo)" />
                                <img :src="photo.file_path_small" class="img-thumbnail" alt="post.title">
                            </div>
                        </div>
                    </div>
                </div>
                -->

                <div class="col-md-4">
                    <div class="card">
                        <div class="form-group">
                            <label for="category">Nad kategorija</label>
                            <select name="category" id="category" class="form-control" v-model="category.parent">
                                <option :value="index" v-for="(parent, index) in lists">{{ parent }}</option>
                            </select>
                            <small class="form-text text-muted" v-if="error != null && error.parent">{{ error.parent[0] }}</small>
                        </div>
                        <div class="form-group">
                            <label>Publikovano</label><br>
                            <switches v-model="category.publish" theme="bootstrap" color="primary"></switches>
                        </div>

                        <upload-image-helper
                                :image="category.image"
                                :defaultImage="null"
                                :titleImage="'kategorije'"
                                :error="error"
                                @uploadImage="upload($event)"
                                @removeRow="remove($event)"
                        ></upload-image-helper>

                    </div><!-- .card -->
                    <!--
                    <div class="card">
                        <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" @vdropzone-success="showSuccess()"></vue-dropzone>
                    </div>
                    -->
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="srb" role="tabpanel" aria-labelledby="srb-tab">
                                <form @submit.prevent="submit()">
                                    <div class="form-group">
                                        <label>Setovi</label>
                                        <select2 :options="sets" :multiple="true" :value="category.set_ids" @input="input($event)">
                                            <option value="0" disabled>izaberi</option>
                                        </select2>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Naslov</label>
                                        <input type="text" name="title" class="form-control" id="title" placeholder="Naslov" v-model="category.title">
                                        <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" v-model="category.slug">
                                        <small class="form-text text-muted" v-if="error != null && error.slug">{{ error.slug[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="seoTitle">Seo naslov</label>
                                        <input type="text" name="short" id="seoTitle" class="form-control" placeholder="Seo naslov" v-model="category.seoTitle">
                                        <small class="form-text text-muted" v-if="error != null && error.seoTitle">{{ error.seoTitle[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="seoKeywords">Seo ključne reči</label>
                                        <input type="text" name="seoKeywords" id="seoKeywords" class="form-control" placeholder="Seo ključne reči" v-model="category.seoKeywords">
                                        <small class="form-text text-muted" v-if="error != null && error.seoKeywords">{{ error.seoKeywords[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="short">Seo opis</label>
                                        <textarea name="short" id="short" cols="3" rows="4" class="form-control" placeholder="Seo opis" v-model="category.seoShort"></textarea>
                                        <small class="form-text text-muted" v-if="error != null && error.seoShort">{{ error.seoShort[0] }}</small>
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
    import Select2 from '../helper/Select2Helper.vue';

    export default {
        data(){
          return {
              category: {},
              error: null,
              lists: {},
              sets: {},
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
              domain : apiHost
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
            'switches': Switches,
            'ckeditor': Ckeditor,
            'vue-dropzone': vue2Dropzone,
            'select2': Select2,
        },
        created(){
            this.getList();
            this.getSets();
        },
        methods: {
            getCategory(){
                axios.get('api/categories/' + this.$route.params.id)
                    .then(res => {
                        this.category = res.data.category;
                        this.category.set_ids = res.data.set_ids;
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                axios.put('api/categories/' + this.category.id, this.category)
                    .then(res => {
                        this.category = res.data.category;
                        this.category.set_ids = res.data.set_ids;
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
                axios.post('api/categories/' + this.category.id + '/image', { file: image[0] })
                    .then(res => {
                        this.category.image = res.data.image;
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
                axios.get('api/categories/lists?parent=1')
                    .then(res => {
                        this.lists = res.data.categories;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            getSets(){
                axios.get('api/sets/lists')
                    .then(res => {
                        this.sets = _.map(res.data.sets, (data) => {
                            var pick = _.pick(data, 'title', 'id');
                            var object = {id: pick.id, text: pick.title};
                            return object;
                        });
                        this.getCategory();
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            input(set){
                this.category.set_ids = set;
            },
        }
    }
</script>