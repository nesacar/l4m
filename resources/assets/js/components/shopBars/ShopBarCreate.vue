<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/shop-bars'">ShopBars</router-link></li>
                            <li>Kreiranje ShopBara</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Kreiranje ShopBara</h5>
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

                            <select2-field :lists="parents" :label="'Nad kategorija'" @changeValue="shopBar.parent_category_id = $event; getCategories();"></select2-field>

                            <select2-field :lists="categories" :label="'Kategorija'" @changeValue="shopBar.category_id = $event"></select2-field>

                            <text-field :value="shopBar.title" :label="'Naziv'" :error="error? error.title : ''" @changeValue="shopBar.title = $event"></text-field>

                            <text-field :value="shopBar.desc" :label="'Pomoćni opis'" :error="error? error.desc : ''" @changeValue="shopBar.desc = $event"></text-field>

                            <text-field :value="shopBar.order" :label="'Redosled'" :error="error? error.order : ''" @changeValue="shopBar.order = $event"></text-field>


                            <div v-if="trigger">

                                <select2-field :lists="products" :label="'Proizvod 1'" @changeValue="prod_id1 = $event"></select2-field>
                                <select2-field :lists="products" :label="'Proizvod 2'" @changeValue="prod_id2 = $event"></select2-field>
                                <select2-field :lists="products" :label="'Proizvod 3'" @changeValue="prod_id3 = $event"></select2-field>
                                <select2-field :lists="products" :label="'Proizvod 4'" @changeValue="prod_id4 = $event"></select2-field>

                                <checkbox-field :value="shopBar.latest" :label="'Prikazuj najnovije proizvode'" @changeValue="shopBar.latest = $event"></checkbox-field>
                                <checkbox-field :value="shopBar.publish" :label="'Publikovano'" @changeValue="shopBar.publish = $event"></checkbox-field>

                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Kreiraj</button>
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
                shopBar: {
                    prod_ids: []
                },
                trigger: true,
                prod_id1: 0,
                prod_id2: 0,
                prod_id3: 0,
                prod_id4: 0,
                parents: {},
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
        },
        mounted(){
            this.getParents();
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
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                this.doMagic();
                axios.post('api/shop-bars', this.shopBar)
                    .then(res => {
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/shop-bars');
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