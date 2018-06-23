<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li>
                                <router-link tag="a" :to="'/home'">Početna</router-link>
                            </li>
                            <li>
                                <router-link tag="a" :to="'/categories'">Kategorije proizvoda</router-link>
                            </li>
                            <li>Kreiranje kategorije</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Kreiranje kategorije</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card">
                        <form @submit.prevent="submit()">

                            <select2-field :lists="lists" :label="'Nad kategorija'" :error="error? error.parent : ''" @changeValue="category.parent = $event"></select2-field>

                            <text-field :value="category.title" :label="'Naslov'" :error="error? error.title : ''" @changeValue="category.title = $event"></text-field>

                            <text-field :value="category.slug" :label="'Slug'" :error="error? error.slug : ''" @changeValue="category.slug = $event"></text-field>

                            <text-field :value="category.order" :label="'Redosled'" :error="error? error.order : ''" @changeValue="category.order = $event"></text-field>

                            <text-field :value="category.seoTitle" :label="'Seo naslov'" :error="error? error.seoTitle : ''" @changeValue="category.seoTitle = $event"></text-field>

                            <text-field :value="category.seoKeywords" :label="'Seo ključne reči'" :error="error? error.seoKeywords : ''" @changeValue="category.seoKeywords = $event"></text-field>

                            <text-field :value="category.seoShort" :label="'Seo opis'" :error="error? error.seoShort : ''" @changeValue="category.seoShort = $event"></text-field>

                            <checkbox-field :value="category.featured" :label="'Istaknuto'" @changeValue="category.featured = $event"></checkbox-field>

                            <checkbox-field :value="category.publish" :label="'Publikovano'" @changeValue="category.publish = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Kreiraj</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <upload-image-helper
                            :image="category.image"
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
    import {apiHost} from '../../config';
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import UploadImageHelper from '../helper/UploadImageHelper.vue';
    import swal from 'sweetalert2';

    export default {
        data(){
            return {
                image: {},
                category: {},
                lists: {},
                error: null,
                domain: apiHost
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
        },
        created(){
            this.getList();
        },
        methods: {
            submit(){
                axios.post('api/categories', this.category)
                    .then(res => {
                        this.category = res.data.category;
                        this.sendImage();
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/categories');
                    }).catch(e => {
                    console.log(e.response);
                    this.error = e.response.data.errors;
                });
            },
            prepare(image){
                this.category.image = image.src;
                this.image = new FormData();
                this.image.append('file', image.file);
            },
            sendImage(){
                axios.post('api/categories/' + this.category.id + '/image', this.image)
                    .then(res => {
                        this.category.image = res.data.image;
                        this.error = null;
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
        }
    }
</script>