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
                    <div class="card" v-if="categories">
                        <form @submit.prevent="submit()">
                            <div class="form-group">
                                <label>Strana</label>
                                <select class="form-control" v-model="shopBar.template">
                                    <option value="home">Početna</option>
                                    <option value="blog">Blog</option>
                                </select>
                            </div>

                            <select2-field :lists="parents" :value="shopBar.parent_category_id" :label="'Nad kategorija'" @changeValue="shopBar.parent_category_id = $event; getCategories();"></select2-field>

                            <select2-field :lists="categories" :value="shopBar.category_id" :label="'Kategorija'" @changeValue="shopBar.category_id = $event"></select2-field>

                            <text-field :value="shopBar.title" :label="'Naziv'" :error="error? error.title : ''" @changeValue="shopBar.title = $event"></text-field>

                            <text-field :value="shopBar.desc" :label="'Pomoćni opis'" :error="error? error.desc : ''" @changeValue="shopBar.desc = $event"></text-field>

                            <text-field :value="shopBar.order" :label="'Redosled'" :error="error? error.order : ''" @changeValue="shopBar.order = $event"></text-field>

                            <div v-if="trigger">

                                <select2-field :lists="products" :value="prod_id1" :label="'Proizvod 1'" @changeValue="prod_id1 = $event"></select2-field>
                                <select2-field :lists="products" :value="prod_id2" :label="'Proizvod 2'" @changeValue="prod_id2 = $event"></select2-field>
                                <select2-field :lists="products" :value="prod_id3" :label="'Proizvod 3'" @changeValue="prod_id3 = $event"></select2-field>
                                <select2-field :lists="products" :value="prod_id4" :label="'Proizvod 4'" @changeValue="prod_id4 = $event"></select2-field>

                                <checkbox-field :value="shopBar.latest" :label="'Prikazuj najnovije proizvode'" @changeValue="shopBar.latest = $event"></checkbox-field>
                                <checkbox-field :value="shopBar.publish" :label="'Publikovano'" @changeValue="shopBar.publish = $event"></checkbox-field>

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

    export default {
        data(){
          return {
              shopBar: false,
              trigger: true,
              prod_id1: 0,
              prod_id2: 0,
              prod_id3: 0,
              prod_id4: 0,
              parents: {},
              categories: false,
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
        },
        mounted(){
            this.getShopBar();
            this.getProducts();
        },
        methods: {
            getParents(){
                axios.get('api/categories/top-lists')
                    .then(res => {
                        this.parents = res.data.categories;
                        this.getCategories();
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            getCategories(){
                axios.get('api/categories/children-lists?category=' + this.shopBar.parent_category_id)
                    .then(res => {
                        this.categories = res.data.categories;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            getShopBar(){
                axios.get('api/shop-bars/' + this.$route.params.id)
                    .then(res => {
                        this.shopBar = res.data.shopBar;
                        this.getParents();
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            getShopBarIds(){
                axios.get('api/shop-bars/' + this.$route.params.id)
                    .then(res => {
                        let ids = res.data.prod_ids;
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
                let url = this.shopBar.category_id != null && this.shopBar.category_id != 0? '?category=' + this.shopBar.category_id : '?category=0';
                this.trigger = false;
                axios.get('api/products/lists' + url)
                    .then(res => {
                        this.trigger = true;
                        this.products = _.map(res.data.products, (data) => {
                            var pick = _.pick(data, 'code', 'id');
                            var object = {id: pick.id, title: pick.code};
                            return object;
                        });
                        this.getShopBarIds();
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