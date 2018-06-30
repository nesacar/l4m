<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/products'">Proizvodi</router-link></li>
                            <li>Izmena proizvoda</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena proizvoda</h5>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <h5>Galerija slika</h5>
                        <hr>
                        <div id="gallery" v-if="photos">
                            <div v-for="photo in photos" class="photo">
                                <font-awesome-icon icon="times" @click="deletePhoto(photo)" />
                                <img :src="photo.tmb" class="img-thumbnail" alt="product.title">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="card" v-if="tags">
                        <form @submit.prevent="submit()">

                            <select-field v-if="admin && clients" :labela="'Klijent'" :options="clients" :error="error? error.client_id : ''" :value="product.clients" @changeValue="product.client_id = $event"></select-field>

                            <select-field v-if="brands" :labela="'Brend'" :options="brands" :error="error? error.brand_id : ''" :value="product.brands" @changeValue="product.brand_id = $event"></select-field>

                            <select-field v-if="collections" :labela="'Kolekcija'" :options="collections" :error="error? error.collection_id : ''" :value="product.collections" @changeValue="product.collection_id = $event"></select-field>


                            <div class="row">
                                <div class="col-sm-6">
                                    <date-field :value="product.date" :label="'Publikovano od:'" :error="error? error.publish_at : ''" @changeValue="product.date = $event"></date-field>
                                </div>
                                <div class="col-sm-6">
                                    <time-field :value="product.time" :label="''" :error="error? error.time : ''" @changeValue="product.time = $event"></time-field>
                                </div>
                            </div>

                            <text-field :value="product.title" :label="'Naslov'" :error="error? error.title : ''" :required="true" @changeValue="product.title = $event"></text-field>

                            <text-field :value="product.slug" :label="'Slug'" :error="error? error.slug : ''" @changeValue="product.slug = $event"></text-field>

                            <text-field :value="product.code" :label="'Šifra'" :error="error? error.code : ''" :required="true" @changeValue="product.code = $event"></text-field>

                            <text-field :value="product.code_addition" :label="'Dodatak šifri'" :error="error? error.code_addition : ''" @changeValue="product.code_addition = $event"></text-field>

                            <text-area-field :value="product.short" :label="'Kratak opis'" :error="error? error.short : ''" @changeValue="product.short = $event"></text-area-field>

                            <text-area-ckeditor-field v-if="product" :value="product.body" :label="'Opis'" :error="error? error.body : ''" @changeValue="product.body = $event"></text-area-ckeditor-field>

                            <text-area-ckeditor-field v-if="product" :value="product.body2" :label="'Isporuka i povraćaj'" :error="error? error.body2 : ''" @changeValue="product.body2 = $event"></text-area-ckeditor-field>

                            <text-field :value="product.price" :label="'Cena'" :error="error? error.price : ''" :required="true" @changeValue="product.price = $event"></text-field>

                            <text-field :value="product.discount" :label="'Popust (%)'" :error="error? error.discount : ''" @changeValue="product.discount = $event; discountPrice();"></text-field>

                            <text-field :value="product.price_outlet" :label="'Outlet cena'" :error="error? error.price_outlet : ''" @changeValue="product.price_outlet = $event"></text-field>

                            <text-field :value="product.amount" :label="'Količina'" :error="error? error.amount : ''" @changeValue="product.amount = $event"></text-field>

                            <select-multiple-field v-if="tags" :labela="'Tagovi'" :options="tags" :error="error? error.tag_ids : ''" :value="product.tags" @changeValue="product.tag_ids = $event"></select-multiple-field>

                            <checkbox-field v-if="product" :value="product.publish" :label="'Publikovano'" @changeValue="product.publish = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Izmeni</button>
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
                            <div class="card col-sm-4" v-if="product.cat_ids.includes(2)">
                                <div class="form-group">
                                    <label>Vodootpornost</label>
                                    <input type="text" class="form-control" name="water" v-model="product.water">
                                </div>
                                <div class="form-group">
                                    <label>Prečnik sata</label>
                                    <input type="text" class="form-control" name="diameter" v-model="product.diameter">
                                </div>
                            </div>
                            <div class="card col-sm-4" v-for="property in properties">
                                <div class="form-group">
                                    <label>{{ property.title }} / {{ property.extra }}</label>
                                    <ul class="list-group">
                                        <li class="list-group-item" v-for="attribute in property.attribute">
                                            <input type="checkbox" v-model="product.att_ids" :value="attribute.id">
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
                                @uploadImage="upload($event)"
                                @removeRow="remove($event)"
                        ></upload-image-helper>
                    </div>

                    <div class="card">
                        <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" @vdropzone-success="showSuccess()"></vue-dropzone>
                    </div>

                    <div class="card" v-if="categories.length > 0">
                        <div class="form-group">
                            <label>Kategorije</label>
                            <small class="form-text text-muted" v-if="error != null && error.cat_ids">{{ error.cat_ids[0] }}</small>
                            <ol class="sortable" style="margin-left: -15px;">
                                <li :id="`list_${cat.id}`" v-for="cat in categories">
                                    <div><input type="checkbox" v-model="product.cat_ids" :value="cat.id" @change="getProperties()"> {{ cat.title }}</div>
                                    <ol class="sortable" v-if="cat.children.length > 0">
                                        <li :id="`list_${cat2.id}`" v-for="cat2 in cat.children">
                                            <div><input type="checkbox" v-model="product.cat_ids" :value="cat2.id"> {{ cat2.title }}</div>
                                            <ol class="sortable" v-if="cat2.children.length > 0">
                                                <li :id="`list_${cat3.id}`" v-for="cat3 in cat2.children">
                                                    <div><input type="checkbox" v-model="product.cat_ids" :value="cat3.id"> {{ cat3.title }}</div>
                                                    <ol class="sortable" v-if="cat3.children.length > 0">
                                                        <li :id="`list_${cat4.id}`" v-for="cat4 in cat3.children">
                                                            <div><input type="checkbox" v-model="product.cat_ids" :value="cat4.id"> {{ cat4.title }}</div>
                                                        </li>
                                                    </ol>
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
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import UploadImageHelper from '../helper/UploadImageHelper.vue';
    import swal from 'sweetalert2';
    import vue2Dropzone from 'vue2-dropzone';
    import 'vue2-dropzone/dist/vue2Dropzone.css';

    export default {
        data(){
          return {
              product: false,
              brands: false,
              collections: false,
              categories: {},
              properties: {},
              photos: {},
              clients: false,
              tags: false,
              error: null,
              dropzoneOptions: {
                  url: 'api/products/' + this.$route.params.id + '/gallery',
                  thumbnailWidth: 150,
                  maxFilesize: 0.5,
                  headers: { "Authorization": "Bearer " + this.$auth.getToken() }
              },
          }
        },
        computed: {
            user(){
                return this.$store.getters.getUser;
            },
            publish_at(){
                return this.product.date + ' ' + this.product.time;
            },
            admin(){
                return this.$store.getters.isAdmin;
            },
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
            'vue-dropzone': vue2Dropzone,
        },
        mounted(){
            this.getBrands();
            this.getTags();
            this.getCategories();
            this.getPhotos();
            this.getClients();
        },
        methods: {
            getProduct(){
                axios.get('api/products/' + this.$route.params.id)
                    .then(res => {
                        this.product = res.data.product;
                        this.properties = res.data.properties;
                        this.product.cat_ids = res.data.cat_ids;
                        this.product.att_ids = res.data.att_ids;
                        this.product.tag_ids = res.data.tag_ids;
                        this.product.brands = res.data.brands;
                        this.product.clients = res.data.clients;
                        this.product.collections = res.data.collection_ids;
                        this.product.tags = res.data.tags;
                        this.collections = res.data.collections;
                        this.getProperties();
                        this.authorized();
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                        if(e.response.status == 401){
                            this.$router.push('/products');
                        }
                    });
            },
            submit(){
                this.product.user_id = this.user.id;
                this.product.publish_at = this.publish_at;
                console.log(this.product);
                axios.put('api/products/' + this.product.id, this.product)
                    .then(res => {
                        this.product = res.data.product;
                        this.properties = res.data.properties;
                        this.product.cat_ids = res.data.cat_ids;
                        this.product.att_ids = res.data.att_ids;
                        this.product.tags = res.data.tags;
                        this.getCollections(this.product.brand_id);
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Uspeh',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.error = null;
                    }).catch(e => {
                        console.log(e.response.data);
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
            upload(image){
                let data = new FormData();
                this.product.image = image.src;
                data.append('file', image.file);

                axios.post('api/products/' + this.product.id + '/image', data)
                    .then(res => {
                        this.product.image = res.data.image;
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
            getPhotos(){
                axios.get('api/products/' + this.$route.params.id + '/gallery')
                    .then(res => {
                        this.photos = res.data.photos;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            deletePhoto(photo){
                axios.post('api/photos/' + photo.id + '/destroy')
                    .then(res => {
                        console.log(res);
                        this.photos = this.photos.filter(function (item) {
                            return photo.id != item.id;
                        });
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            showSuccess(){
                this.getPhotos();
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
                console.log('get properties');
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
            getPhotos(){
                axios.get('api/products/' + this.$route.params.id + '/gallery')
                    .then(res => {
                        this.photos = res.data.photos;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            deletePhoto(photo){
                axios.post('api/photos/' + photo.id + '/destroy')
                    .then(res => {
                        this.photos = this.photos.filter(function (item) {
                            return photo.id != item.id;
                        });
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            showSuccess(){
                this.getPhotos();
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
                        this.getProduct();
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
            authorized(){
                if(!this.admin && !in_array(this.product.client_id, this.user.client_ids)){
                    this.$router.push('/products')
                }
            },
        },
    }
</script>