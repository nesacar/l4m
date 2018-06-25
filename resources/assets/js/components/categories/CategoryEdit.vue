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
                    <div class="card" v-if="category">

                        <select2-field v-if="false" :lists="lists" :label="'Nad kategorija'" :error="error? error.parent : ''" @changeValue="category.parent = $event"></select2-field>

                        <checkbox-field :value="category.featured" :label="'Istaknuto'" @changeValue="category.featured = $event"></checkbox-field>

                        <checkbox-field :value="category.publish" :label="'Publikovano'" @changeValue="category.publish = $event"></checkbox-field>

                        <upload-image-helper
                                :image="category.image"
                                :defaultImage="null"
                                :titleImage="'kategorije'"
                                :error="error"
                                @uploadImage="upload($event)"
                                @removeRow="remove($event)"
                        ></upload-image-helper>

                        <upload-image-helper
                                :image="category.box_image"
                                :defaultImage="null"
                                :titleImage="'box kategorije'"
                                :error="error"
                                @uploadImage="uploadBox($event)"
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
                    <div class="card" v-if="category">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="srb" role="tabpanel" aria-labelledby="srb-tab">
                                <form @submit.prevent="submit()">

                                    <text-field :value="category.title" :label="'Naslov'" :error="error? error.title : ''" @changeValue="category.title = $event"></text-field>

                                    <text-field :value="category.slug" :label="'Slug'" :error="error? error.slug : ''" @changeValue="category.slug = $event"></text-field>

                                    <text-field :value="category.order" :label="'Redosled'" :error="error? error.order : ''" @changeValue="category.order = $event"></text-field>

                                    <text-field :value="category.seoTitle" :label="'Seo naslov'" :error="error? error.seoTitle : ''" @changeValue="category.seoTitle = $event"></text-field>

                                    <text-field :value="category.seoKeywords" :label="'Seo ključne reči'" :error="error? error.seoKeywords : ''" @changeValue="category.seoKeywords = $event"></text-field>

                                    <text-field :value="category.seoShort" :label="'Seo opis'" :error="error? error.seoShort : ''" @changeValue="category.seoShort = $event"></text-field>

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
              category: false,
              error: null,
              lists: {},
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
            'vue-dropzone': vue2Dropzone,
        },
        mounted(){
            this.getCategory();
        },
        methods: {
            getCategory(){
                axios.get('api/categories/' + this.$route.params.id)
                    .then(res => {
                        this.lists = res.data.categories;
                        this.category = res.data.category;
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
                data.append('file', image.file);

                axios.post('api/categories/' + this.category.id + '/image', data)
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
            uploadBox(image){
                let data = new FormData();
                data.append('file', image.file);

                axios.post('api/categories/' + this.category.id + '/boxImage', data)
                    .then(res => {
                        this.category.box_image = res.data.image;
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