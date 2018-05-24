<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/posts'">Članci</router-link></li>
                            <li>Kreiranje članka</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Kreiranje članka</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card">
                        <form @submit.prevent="submit()">
                            <div class="form-group" v-if="admin">
                                <label for="client">Klijent</label>
                                <select name="client" id="client" class="form-control" v-model="post.client_id">
                                    <option :value="client.id" v-for="client in clients">{{ client.name }}</option>
                                </select>
                                <small class="form-text text-muted" v-if="error != null && error.client_id">{{ error.client_id[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="category">Kategorija</label>
                                <select name="category" id="category" class="form-control" v-model="post.blog_id">
                                    <option :value="index" v-for="(blog, index) in lists">{{ blog }}</option>
                                </select>
                                <small class="form-text text-muted" v-if="error != null && error.blog_id">{{ error.blog_id[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="brand">Brend</label>
                                <select name="brand" id="brand" class="form-control" v-model="post.brand_id">
                                    <option :value="brand.id" v-for="brand in brands">{{ brand.title }}</option>
                                </select>
                                <small class="form-text text-muted" v-if="error != null && error.brand_id">{{ error.brand_id[0] }}</small>
                            </div>
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
                            <div class="form-group" v-if="post.category_id == 3">
                                <label for="author">Autor</label>
                                <input type="text" name="author" class="form-control" id="author" placeholder="Autor" v-model="post.author">
                                <small class="form-text text-muted" v-if="error != null && error.author">{{ error.author[0] }}</small>
                            </div>
                            <div class="form-group">
                                    <label>Opis</label>
                                <ckeditor
                                        v-model="post.body"
                                        :config="config">
                                </ckeditor>
                                <small class="form-text text-muted" v-if="error != null && error.body">{{ error.body[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label>Tagovi</label>
                                <select2 :options="tags" :multiple="true" @input="input($event)">
                                    <option value="0" disabled>select one</option>
                                </select2>
                            </div>
                            <div class="form-group">
                                <label>Publikovano</label><br>
                                <switches v-model="post.publish" theme="bootstrap" color="primary"></switches>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Kreiraj</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <upload-image-helper
                            :image="post.image"
                            :defaultImage="null"
                            :titleImage="'članka'"
                            :error="error"
                            :dimensions="'800x600 px'"
                            @uploadImage="prepare($event)"
                            @removeRow="remove($event)"
                    ></upload-image-helper>

                    <upload-image-helper
                            :image="post.slider"
                            :defaultImage="null"
                            :titleImage="'slajdera'"
                            :error="error"
                            :dimensions="'980x420 px'"
                            @uploadImage="prepareSlider($event)"
                            @removeRow="remove($event)"
                    ></upload-image-helper>

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
    import moment from 'moment';
    import Select2 from '../helper/Select2Helper.vue';

    export default {
        data(){
          return {
              image: {},
              slider: {},
              clients: {},
              post: {
                  date: moment().format('YYYY-MM-DD'),
                  time: moment().format('HH:mm'),
                  desc: null,
                  publish: false,
                  blog_id: 0,
                  tag_ids: [],
                  product_ids: [],
              },
              lists: {},
              tags: {},
              brands: {},
              error: null,
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
            publish_at(){
                return this.post.date + ' ' + this.post.time + ':00'
            },
            admin(){
                return this.$store.getters.isAdmin;
            },
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
            'switches': Switches,
            'ckeditor': Ckeditor,
            'select2': Select2,
        },
        mounted(){
            this.getList();
            this.getTags();
            this.getBrands();
            this.getClients();
        },
        methods: {
            submit(){
                this.post.user_id = this.user.id;
                this.post.publish_at = this.publish_at;
                axios.post('api/posts', this.post)
                    .then(res => {
                        this.post = res.data.post;
                        this.sendImage();
                        this.sendSliderImage();
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/posts');
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            getClients(){
                axios.get('api/clients/lists')
                    .then(res => {
                        this.clients = res.data.clients;
                    }).catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            prepare(image){
                this.post.image = image.src;
                this.image = new FormData();
                this.image.append('file', image.file);
            },
            sendImage(){
                axios.post('api/posts/' + this.post.id + '/image', this.image)
                    .then(res => {
                        this.post.image = res.data.image;
                        this.error = null;
                    }).catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            prepareSlider(slider){
                this.post.slider = slider.src;
                this.slider = new FormData();
                this.slider.append('file', slider.file);
            },
            sendSliderImage(){
                axios.post('api/posts/' + this.post.id + '/image?slider=1', this.slider)
                    .then(res => {
                        this.post.slider = res.data.image;
                        this.error = null;
                    }).catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            getList(){
                axios.get('api/blogs/lists')
                    .then(res => {
                        this.lists = res.data.blogs;
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