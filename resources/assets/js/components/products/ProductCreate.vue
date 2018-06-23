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

                            <select2-field v-if="admin" :lists="clients" :label="'Klijent'" @changeValue="product.client_id = $event"></select2-field>

                            <select2-field :lists="brands" :label="'Brend'" @changeValue="product.brand_id = $event; setBrand()"></select2-field>

                            <select2-field v-if="collections.length > 0" :lists="collections" :label="'Kolekcija'" @changeValue="product.collection_id = $event"></select2-field>


                            <div class="row">
                                <div class="col-sm-6">
                                    <date-field :value="product.date" :label="'Publikovano od:'" :error="error? error.publish_at : ''" @changeValue="product.date = $event"></date-field>
                                </div>
                                <div class="col-sm-6">
                                    <date-field :value="product.time" :label="''" :error="error? error.time : ''" @changeValue="product.time = $event"></date-field>
                                </div>
                            </div>

                            <text-field :value="product.title" :label="'Naslov'" :error="error? error.title : ''" :required="true" @changeValue="product.title = $event"></text-field>

                            <text-field :value="product.slug" :label="'Slug'" :error="error? error.slug : ''" @changeValue="product.slug = $event"></text-field>

                            <text-field :value="product.code" :label="'Šifra'" :error="error? error.code : ''" :required="true" @changeValue="product.code = $event"></text-field>

                            <text-field :value="product.code_addition" :label="'Dodatak šifri'" :error="error? error.code_addition : ''" @changeValue="product.code_addition = $event"></text-field>

                            <text-area-field :value="product.short" :label="'Kratak opis'" :error="error? error.short : ''" @changeValue="product.short = $event"></text-area-field>

                            <text-area-ckeditor-field :value="product.body" :label="'Opis'" :error="error? error.body : ''" @changeValue="product.body = $event"></text-area-ckeditor-field>

                            <text-area-ckeditor-field :value="product.body2" :label="'Isporuka i povraćaj'" :error="error? error.body2 : ''" @changeValue="product.body2 = $event"></text-area-ckeditor-field>

                            <text-field :value="product.price" :label="'Cena'" :error="error? error.price : ''" :required="true" @changeValue="product.price = $event"></text-field>

                            <text-field :value="product.discount" :label="'Popust (%)'" :error="error? error.discount : ''" @changeValue="product.discount = $event; discountPrice();"></text-field>

                            <text-field :value="product.price_outlet" :label="'Outlet cena'" :error="error? error.price_outlet : ''" @changeValue="product.price_outlet = $event"></text-field>

                            <text-field :value="product.amount" :label="'Količina'" :error="error? error.amount : ''" @changeValue="product.amount = $event"></text-field>

                            <select2-multiple-field :lists="tags" :label="'Tagovi'" @changeValue="product.tag_ids = $event"></select2-multiple-field>

                            <checkbox-field :value="product.publish" :label="'Publikovano'" @changeValue="product.publish = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Kreiraj</button>
                            </div>
                        </form>
                    </div>


                    <div class="row">
                        <div class="card col-md-12">
                            <h3>Osobine i atributi</h3>
                            <small class="form-text text-muted" v-if="error != null && error.att_ids">{{ error.att_ids[0] }}</small>
                        </div>
                    </div>
                    <div class="row">
                        <template v-if="properties.length > 0">
                            <div class="card col-sm-4" v-for="property in properties">
                                <div class="form-group">
                                    <label>{{ property.title }}</label>
                                    <ul class="list-group">
                                        <li class="list-group-item" v-for="attribute in property.attribute">
                                            <input type="checkbox" :value="attribute.id" v-model="product.att_ids">
                                            {{ attribute.title }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </template>
                    </div>

                </div>
                <div class="col-sm-6">
                    <div style="max-width: 400px;">
                        <upload-image-helper
                                :image="product.image"
                                :defaultImage="null"
                                :titleImage="'proizvoda'"
                                :error="error"
                                @uploadImage="prepare($event)"
                                @removeRow="remove($event)"
                        ></upload-image-helper>
                    </div>

                    <div class="card" v-if="categories.length > 0">
                        <div class="form-group">
                            <label>Kategorije</label>
                            <small class="form-text text-muted" v-if="error != null && error.cat_ids">{{ error.cat_ids[0] }}</small>
                            <ol style="margin-left: -15px;">
                                <li :id="`list_${cat.id}`" v-for="cat in categories">
                                    <div><input type="checkbox" v-model="product.cat_ids" :value="cat.id" @change="getProperties()"> {{ cat.title }}</div>
                                    <ol v-if="cat.children.length > 0">
                                        <li :id="`list_${cat2.id}`" v-for="cat2 in cat.children">
                                            <div><input type="checkbox" v-model="product.cat_ids" :value="cat2.id"> {{ cat2.title }}</div>
                                            <ol v-if="cat2.children.length > 0">
                                                <li :id="`list_${cat3.id}`" v-for="cat3 in cat2.children">
                                                    <div><input type="checkbox" v-model="product.cat_ids" :value="cat3.id"> {{ cat3.title }}</div>
                                                </li>
                                            </ol>
                                        </li>
                                    </ol>
                                </li>
                            </ol>
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
    import moment from 'moment';

    export default {
        data(){
            return {
                image: {},
                product: {
                    date: moment().format('YYYY-MM-DD'),
                    time: moment().format('HH:mm'),
                    cat_ids: [],
                    att_ids: [],
                    tag_ids: [],
                    price_outlet: 0,
                },
                brands: {},
                collections: {},
                categories: {},
                tags: {},
                clients: {},
                properties: {},
                error: null,
                domain : apiHost
            }
        },
        computed: {
            user(){
                return this.$store.getters.getUser;
            },
            publish_at(){
                return this.product.date + ' ' + this.product.time
            },
            admin(){
                return this.$store.getters.isAdmin;
            },
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
        },
        created(){
            this.getBrands();
            this.getCategories();
            this.getTags();
            this.getClients();
        },
        methods: {
            submit(){
                this.product.user_id = this.user.id;
                this.product.publish_at = this.publish_at;
                axios.post('api/products', this.product)
                    .then(res => {
                        this.product = res.data.product;
                        this.sendImage();
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
            getClients(){
                axios.get('api/clients/lists')
                    .then(res => {
                        this.clients = res.data.clients;
                        console.log(this.clients);
                    }).catch(e => {
                    console.log(e);
                    this.error = e.response.data.errors;
                });
            },
            prepare(image){
                this.product.image = image.src;
                this.image = new FormData();
                this.image.append('file', image.file);
            },
            sendImage(){
                axios.post('api/products/' + this.product.id + '/image', this.image)
                    .then(res => {
                        this.product.image = res.data.image;
                        this.error = null;
                    }).catch(e => {
                        console.log(e);
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
            setBrand(){
                console.log('ser brands');
                if(this.product.brand_id > 0){
                    this.getCollections(this.product.brand_id);
                }else{
                    this.collections = {};
                }
            },
            getProperties(){
                axios.post('api/properties/categories', {'ids': this.product.cat_ids})
                    .then(res => {
                        this.properties = res.data.properties;
                        let newIds = res.data.newIds;
                        this.product.att_ids = this.product.att_ids.filter((item) => {
                            return newIds.includes(item);
                        });
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
            discountPrice(){
                if(this.product.price > 0){
                    this.product.price_outlet = this.product.price - (this.product.discount / 100) * this.product.price;
                }
            },
        },
    }
</script>