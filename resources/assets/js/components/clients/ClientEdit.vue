<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/blogs'">Kategorije članaka</router-link></li>
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

                <div class="col-md-4">
                    <div class="card">
                        <div class="form-group">
                            <label>Publikovano</label><br>
                            <switches v-model="blog.publish" theme="bootstrap" color="primary"></switches>
                        </div>

                        <upload-image-helper
                                :image="blog.image"
                                :defaultImage="null"
                                :titleImage="'kategorije'"
                                :error="error"
                                @uploadImage="upload($event)"
                                @removeRow="remove($event)"
                        ></upload-image-helper>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <form @submit.prevent="submit()">
                            <div class="form-group">
                                <label for="category">Nad kategorija</label>
                                <select name="category" id="category" class="form-control" v-model="blog.parent">
                                    <option :value="index" v-for="(parent, index) in lists">{{ parent }}</option>
                                </select>
                                <small class="form-text text-muted" v-if="error != null && error.parent">{{ error.parent[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="title">Naslov</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Naslov" v-model="blog.title">
                                <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" v-model="blog.slug">
                                <small class="form-text text-muted" v-if="error != null && error.slug">{{ error.slug[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label>Opis</label>
                                <ckeditor
                                        v-model="blog.short"
                                        :config="config">
                                </ckeditor>
                                <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.desc[0] }}</small>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Izmeni</button>
                            </div>
                        </form>
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
    import Switches from 'vue-switches';
    import Ckeditor from 'vue-ckeditor2';

    export default {
        data(){
          return {
              blog: {},
              error: null,
              lists: [],
              config: {
                  toolbar: [
                      [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', 'Image', 'Link', 'Unlink', 'Source' ],
                      { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
                      '/',
                      { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
                  ],
                  height: 300,
                  filebrowserBrowseUrl: 'media'
              }
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
            'switches': Switches,
            'ckeditor': Ckeditor
        },
        created(){
            this.getCategory();
            this.getList();
        },
        methods: {
            getCategory(){
                axios.get('api/blogs/' + this.$route.params.id)
                    .then(res => {
                        this.blog = res.data.blog;
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                axios.put('api/blogs/' + this.blog.id, this.blog)
                    .then(res => {
                        this.blog = res.data.blog;
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
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

                axios.post('api/blogs/' + this.blog.id + '/image', data)
                    .then(res => {
                        this.blog.image = res.data.image;
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
                axios.get('api/blogs/lists?parent=1')
                    .then(res => {
                        this.lists = res.data.blogs;
                    }).catch(e => {
                    console.log(e.response);
                    this.error = e.response.data.errors;
                });
            },
        }
    }
</script>