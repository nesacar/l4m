<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/blogs'">Kategorije članaka</router-link></li>
                            <li>Kreiraj kategoriju</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Kreiraj kategoriju</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card">
                        <form @submit.prevent="submit()">

                            <select2-field :lists="lists" :value="blog.parent" :label="'Nad kategorija'" :error="error? error.parent : ''" @changeValue="blog.parent = $event"></select2-field>

                            <text-field :value="blog.title" :label="'Naziv'" :error="error? error.title : ''" @changeValue="blog.title = $event"></text-field>

                            <text-field :value="blog.slug" :label="'Slug'" :error="error? error.slug : ''" @changeValue="blog.slug = $event"></text-field>

                            <text-area-ckeditor-field :value="blog.short" :label="'Opis'" :error="error? error.short : ''" @changeValue="blog.short = $event"></text-area-ckeditor-field>

                            <checkbox-field :value="blog.publish" :label="'Publikovano'" @changeValue="blog.publish = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Kreiraj</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <upload-image-helper
                            :image="blog.image"
                            :defaultImage="null"
                            :titleImage="'kategorije'"
                            :error="error"
                            @uploadImage="prepare($event)"
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
              blog: {
                  short: null,
                  publish: false
              },
              lists: [],
              error: null,
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
        },
        created(){
            this.getList();
        },
        methods: {
            submit(){
                axios.post('api/blogs', this.blog)
                    .then(res => {
                        this.blog = res.data.blog;
                        this.sendImage();
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Uspeh',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/blogs');
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            prepare(image){
                this.blog.image = image.src;
                this.image = new FormData();
                this.image.append('file', image.file);
            },
            sendImage(){
                axios.post('api/blogs/' + this.blog.id + '/image', this.image)
                    .then(res => {
                        this.blog.image = res.data.image;
                        this.error = null;
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