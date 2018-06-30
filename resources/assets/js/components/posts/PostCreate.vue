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

                            <select-field v-if="admin && clients" :labela="'Klijent'" :options="clients" :value="null" :error="error? error.client_id : ''" @changeValue="post.client_id = $event"></select-field>

                            <select-field v-if="lists" :labela="'Kategorija'" :options="lists" :value="null" :error="error? error.blog_id : ''" @changeValue="post.blog_id = $event"></select-field>

                            <select-field v-if="brands" :labela="'Brend'" :options="brands" :value="null" :error="error? error.brand_id : ''" @changeValue="post.brand_id = $event"></select-field>

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

                            <select-multiple-field v-if="tags" :error="error? error.tag_ids : ''" :options="tags" :labela="'Tagovi'" @changeValue="post.tag_ids = $event"></select-multiple-field>

                            <checkbox-field :value="post.publish" :label="'Publikovano'" @changeValue="post.publish = $event"></checkbox-field>

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
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import UploadImageHelper from '../helper/UploadImageHelper.vue';
    import swal from 'sweetalert2';
    import moment from 'moment';

    export default {
        data(){
          return {
              image: {},
              slider: {},
              clients: false,
              post: {
                  date: moment().format('YYYY-MM-DD'),
                  time: moment().format('HH:00'),
                  desc: null,
                  publish: false,
                  blog_id: 0,
                  tag_ids: [],
                  product_ids: [],
              },
              lists: false,
              tags: false,
              brands: false,
              error: null,
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
                        this.clients = res.data.lists;
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
                axios.post('api/posts/' + this.post.id + '/image?cover_image=1', this.slider)
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
                        this.tags = res.data.tags;
//                        this.tags = _.map(res.data.tags, (data) => {
//                            var pick = _.pick(data, 'title', 'id');
//                            var object = {id: pick.id, text: pick.title};
//                            return object;
//                        });
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
        }
    }
</script>