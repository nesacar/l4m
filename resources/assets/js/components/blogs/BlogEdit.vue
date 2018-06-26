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

            <div class="row bela" v-if="blog">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena kategorije</h5>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">

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

                            <select-field v-if="lists" :labela="'Nad kategorija'" :options="lists" :value="blog.parent_category" :error="error? error.parent : ''" @changeValue="blog.parent = $event"></select-field>

                            <text-field :value="blog.title" :label="'Naziv'" :error="error? error.title : ''" @changeValue="blog.title = $event"></text-field>

                            <text-field :value="blog.slug" :label="'Slug'" :error="error? error.slug : ''" @changeValue="blog.slug = $event"></text-field>

                            <text-area-ckeditor-field :value="blog.short" :label="'Opis'" :error="error? error.short : ''" @changeValue="blog.short = $event"></text-area-ckeditor-field>

                            <checkbox-field :value="blog.publish" :label="'Publikovano'" @changeValue="blog.publish = $event"></checkbox-field>

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

    export default {
        data(){
          return {
              blog: false,
              error: null,
              lists: false,
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
        },
        mounted(){
            this.getCategory();
        },
        methods: {
            getCategory(){
                axios.get('api/blogs/' + this.$route.params.id)
                    .then(res => {
                        this.lists = res.data.blogs;
                        this.blog = res.data.blog;
                        this.blog.parent_category = res.data.parent;
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
        }
    }
</script>