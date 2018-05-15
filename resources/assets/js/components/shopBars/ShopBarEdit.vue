<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/shop-bars'">ShopBars</router-link></li>
                            <li>Izmena ShopBara</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena ShopBara</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card">
                        <form @submit.prevent="submit()">
                            <div class="form-group">
                                <label>Strana</label>
                                <select class="form-control" v-model="shopBar.template">
                                    <option value="home">Početna</option>
                                    <option value="blog">Blog</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="category">Kategorija</label>
                                <select name="category" id="category" class="form-control" v-model="shopBar.category_id">
                                    <option :value="index" v-for="(set, index) in categories">{{ set }}</option>
                                </select>
                                <small class="form-text text-muted" v-if="error != null && error.category_id">{{ error.category_id[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="title">Naziv</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Naslov" v-model="shopBar.title">
                                <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="desc">Pomoćni opis</label>
                                <input type="text" name="desc" class="form-control" id="desc" placeholder="Pomoćni opis" v-model="shopBar.desc">
                                <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.desc[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="order">Redosled</label>
                                <input type="text" name="order" class="form-control" id="order" placeholder="Redosled" v-model="shopBar.order">
                                <small class="form-text text-muted" v-if="error != null && error.order">{{ error.order[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label>Proizvod 1</label>
                                <select2 :options="products" v-model="prod_id1">
                                    <option value="0" disabled>select one</option>
                                </select2>
                            </div>
                            <div class="form-group">
                                <label>Proizvod 2</label>
                                <select2 :options="products" v-model="prod_id2">
                                    <option value="0" disabled>select one</option>
                                </select2>
                            </div>
                            <div class="form-group">
                                <label>Proizvod 3</label>
                                <select2 :options="products" v-model="prod_id3">
                                    <option value="0" disabled>select one</option>
                                </select2>
                            </div>
                            <div class="form-group">
                                <label>Proizvod 4</label>
                                <select2 :options="products" v-model="prod_id4">
                                    <option value="0" disabled>select one</option>
                                </select2>
                            </div>
                            <div class="form-group">
                                <label>Publikovano</label><br>
                                <switches v-model="shopBar.publish" theme="bootstrap" color="primary"></switches>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Izmeni</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { apiHost } from '../../config';
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import swal from 'sweetalert2';
    import Switches from 'vue-switches';
    import Select2 from '../helper/Select2Helper.vue';

    export default {
        data(){
          return {
              shopBar: {
                  prod_ids: []
              },
              prod_id1: 0,
              prod_id2: 0,
              prod_id3: 0,
              prod_id4: 0,
              categories: {},
              products: {},
              error: null,
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
            'switches': Switches,
            'select2': Select2,
        },
        created(){
            this.getCategories();
            this.getProducts();
        },
        methods: {
            getCategories(){
                axios.get('api/categories/lists')
                    .then(res => {
                        this.categories = res.data.categories;
                        this.getShopBar();
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            getShopBar(){
                axios.get('api/shop-bars/' + this.$route.params.id)
                    .then(res => {
                        this.shopBar = res.data.shopBar;
                        let ids = res.data.prod_ids;
                        console.log(ids);
                        this.prod_id1 = ids[0];
                        this.prod_id2 = ids[1];
                        this.prod_id3 = ids[2];
                        this.prod_id4 = ids[3];
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            getProducts(){
                axios.get('api/products/lists')
                    .then(res => {
                        this.products = _.map(res.data.products, (data) => {
                            var pick = _.pick(data, 'code', 'id');
                            var object = {id: pick.id, text: pick.code};
                            return object;
                        });
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                this.doMagic();
                axios.put('api/shop-bars/' + this.shopBar.id, this.shopBar)
                    .then(res => {
                        this.shopBar = res.data.shopBar;
                        let ids = res.data.prod_ids;
                        this.prod_id1 = ids[0];
                        this.prod_id2 = ids[1];
                        this.prod_id3 = ids[2];
                        this.prod_id4 = ids[3];
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
            input(product){
                this.shopBar.prod_ids = product;
            },
            doMagic(){
                this.shopBar.prod_ids = [];
                this.shopBar.prod_ids.push(this.prod_id1);
                this.shopBar.prod_ids.push(this.prod_id2);
                this.shopBar.prod_ids.push(this.prod_id3);
                this.shopBar.prod_ids.push(this.prod_id4);
            },
        }
    }
</script>