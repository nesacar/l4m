<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/products'">Proizvodi</router-link></li>
                            <li>Kreiranje proizvoda</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Kreiranje proizvoda</h5>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="card">
                        <form @submit.prevent="submit()">
                            <div class="form-group">
                                <label for="set">Set</label>
                                <select name="set" id="set" class="form-control" v-model="product.set_id" @change="getProperties()">
                                    <option :value="set.id" v-for="set in sets">{{ set.title }}</option>
                                </select>
                                <small class="form-text text-muted" v-if="error != null && error.set_id">{{ error.set_id[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="brand">Brend</label>
                                <select name="brand" id="brand" class="form-control" v-model="product.brand_id" @change="setBrand()">
                                    <option :value="brand.id" v-for="brand in brands">{{ brand.title }}</option>
                                </select>
                                <small class="form-text text-muted" v-if="error != null && error.brand_id">{{ error.brand_id[0] }}</small>
                            </div>
                            <div class="form-group" v-if="collections.length > 0">
                                <label for="collection">Kolekcija</label>
                                <select name="collection" id="collection" class="form-control" v-model="product.collection_id">
                                    <option :value="collection.id" v-for="collection in collections">{{ collection.title }}</option>
                                </select>
                                <small class="form-text text-muted" v-if="error != null && error.collection_id">{{ error.collection_id[0] }}</small>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="date">Publikovano od:</label>
                                        <input type="date" name="title" class="form-control" id="date" placeholder="Published at" v-model="product.date">
                                        <small class="form-text text-muted" v-if="error != null && error.publish_at">{{ error.publish_at[0] }}</small>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="time">&nbsp;</label>
                                        <input type="time" name="title" class="form-control" id="time" placeholder="Published at" v-model="product.time">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="title">Naslov</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Naslov" v-model="product.title">
                                <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" v-model="product.slug">
                                <small class="form-text text-muted" v-if="error != null && error.slug">{{ error.slug[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="code">Šifra</label>
                                <input type="text" name="code" class="form-control" id="code" placeholder="Šifra" v-model="product.code">
                                <small class="form-text text-muted" v-if="error != null && error.code">{{ error.code[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="short">Kratak opis</label>
                                <textarea name="short" id="short" cols="3" rows="4" class="form-control" placeholder="Kratak opis" v-model="product.short"></textarea>
                                <small class="form-text text-muted" v-if="error != null && error.short">{{ error.short[0] }}</small>
                            </div>
                            <div class="form-group">
                                    <label>Opis</label>
                                <ckeditor
                                        v-model="product.body"
                                        :config="config">
                                </ckeditor>
                                <small class="form-text text-muted" v-if="error != null && error.body">{{ error.body[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label>Dodatak</label>
                                <ckeditor
                                        v-model="product.body2"
                                        :config="config">
                                </ckeditor>
                                <small class="form-text text-muted" v-if="error != null && error.body2">{{ error.body2[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="price">Cena</label>
                                <input type="text" name="price" class="form-control" id="price" placeholder="Cena" v-model="product.price">
                                <small class="form-text text-muted" v-if="error != null && error.price">{{ error.price[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="price_outlet">Outlet cena</label>
                                <input type="text" name="price_outlet" class="form-control" id="price_outlet" placeholder="Outlet cena" v-model="product.price_outlet">
                                <small class="form-text text-muted" v-if="error != null && error.price_outlet">{{ error.price_outlet[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="amount">Količina</label>
                                <input type="text" name="amount" class="form-control" id="amount" placeholder="Količina" v-model="product.amount">
                                <small class="form-text text-muted" v-if="error != null && error.amount">{{ error.amount[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label>Publikovano</label><br>
                                <switches v-model="product.publish" theme="bootstrap" color="primary"></switches>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Kreiraj</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div style="max-width: 400px;">
                        <upload-image-helper
                                :image="product.image"
                                :defaultImage="null"
                                :titleImage="'proizvoda'"
                                :error="error"
                                @uploadImage="upload($event)"
                                @removeRow="remove($event)"
                        ></upload-image-helper>
                    </div>

                    <div class="card" v-if="categories.length > 0">
                        <div class="form-group">
                            <label>Kategorije</label>
                            <small class="form-text text-muted" v-if="error != null && error.category_id">{{ error.category_id[0] }}</small>
                            <ol class="sortable" style="margin-left: -15px;">
                                <li :id="`list_${cat.id}`" v-for="cat in categories">
                                    <div><input type="checkbox" v-model="product.category_id" :value="cat.id"> {{ cat.title }}</div>
                                    <ol class="sortable" v-if="cat.children.length > 0">
                                        <li :id="`list_${cat2.id}`" v-for="cat2 in cat.children">
                                            <div><input type="checkbox" v-model="product.category_id" :value="cat2.id"> {{ cat2.title }}</div>
                                        </li>
                                    </ol>
                                </li>
                            </ol>
                        </div>
                    </div>

                    <div class="row">
                        <div class="card col-md-12">
                            <h3>Osobine i atributi</h3>
                        </div>
                    </div>
                    <div class="row">
                        <template v-if="properties.length > 0">
                            <div class="card col-sm-4" v-for="property in properties">
                                <div class="form-group">
                                    <label>{{ property.title }}</label>
                                    <ul class="list-group">
                                        <li class="list-group-item" v-for="attribute in property.attribute">
                                            <input type="checkbox" :value="attribute.id" v-model="product.attribute_id">
                                            {{ attribute.title }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </template>
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
    import moment from 'moment';

    export default {
        data(){
          return {
              product: {
                  date: moment().format('YYYY-MM-DD'),
                  time: moment().format('HH:mm'),
                  category_id: [],
                  attribute_id: []
              },
              brands: {},
              collections: {},
              categories: {},
              sets: {},
              properties: {},
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
                return this.product.date + ' ' + this.product.time + ':00'
            }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
            'switches': Switches,
            'ckeditor': Ckeditor
        },
        created(){
            this.getBrands();
            this.getSets();
            this.getCategories();
        },
        methods: {
            submit(){
                this.product.user_id = this.user.id;
                this.product.publish_at = this.publish_at;
                axios.post('api/products', this.product)
                    .then(res => {
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/products');
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            upload(image){
                this.product.image = image[0];
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
            getCollections(brand_id){
                axios.get('api/collections/lists?brand_id=' + brand_id)
                    .then(res => {
                        this.collections = res.data.collections;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            getCategories(){
                axios.get('api/categories/tree')
                    .then(res => {
                        this.categories = res.data.categories;
                        console.log(this.categories);
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            getSets(){
                axios.get('api/sets/lists')
                    .then(res => {
                        this.sets = res.data.sets;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            setBrand(){
                if(this.product.brand_id > 0){
                    this.getCollections(this.product.brand_id);
                }else{
                    this.collections = {};
                }
            },
            getProperties(){
                if(this.product.set_id > 0){
                    axios.get('api/properties/' + this.product.set_id + '/set')
                        .then(res => {
                            this.properties = res.data.properties;
                        }).catch(e => {
                            console.log(e.response);
                            this.error = e.response.data.errors;
                        });
                }else{
                    this.properties = {};
                }
            }
        }
    }
</script>