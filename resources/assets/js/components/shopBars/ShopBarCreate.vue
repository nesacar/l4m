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

                            <select-field v-if="parents" :labela="'Nad kategorija'" :options="parents" :error="error? error.parent_category_id : ''" :value="null" @changeValue="shopBar.parent_category_id = $event; getCategories()"></select-field>

                            <select-field v-if="categories" :labela="'Kategorija'" :options="categories" :error="error? error.category_id : ''" :value="null" @changeValue="shopBar.category_id = $event"></select-field>

                            <text-field :value="shopBar.title" :label="'Naziv'" :error="error? error.title : ''" @changeValue="shopBar.title = $event"></text-field>

                            <text-field :value="shopBar.desc" :label="'Pomoćni opis'" :error="error? error.desc : ''" @changeValue="shopBar.desc = $event"></text-field>

                            <text-field :value="shopBar.order" :label="'Redosled'" :error="error? error.order : ''" @changeValue="shopBar.order = $event"></text-field>


                            <div v-if="!shopBar.latest">

                                <select-field v-if="products" :labela="'Proizvod 1'" :options="products" :value="null" @changeValue="prod_id1 = $event"></select-field>
                                <select-field v-if="products" :labela="'Proizvod 2'" :options="products" :value="null" @changeValue="prod_id2 = $event"></select-field>
                                <select-field v-if="products" :labela="'Proizvod 3'" :options="products" :value="null" @changeValue="prod_id3 = $event"></select-field>
                                <select-field v-if="products" :labela="'Proizvod 4'" :options="products" :value="null" @changeValue="prod_id4 = $event"></select-field>


                            </div>

                            <checkbox-field
                                    :value="shopBar.latest"
                                    label="Prikazuj najnovije proizvode"
                                    @changeValue="handleChange"
                            ></checkbox-field>
                            <checkbox-field :value="shopBar.publish" :label="'Publikovano'" @changeValue="shopBar.publish = $event"></checkbox-field>

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
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import swal from 'sweetalert2';

    export default {
        data(){
            return {
                shopBar: {},
                trigger: true,
                prod_id1: 0,
                prod_id2: 0,
                prod_id3: 0,
                prod_id4: 0,
                parents: false,
                categories: false,
                products: false,
                error: null,
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
                this.categories = false;
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
                console.log(this.shopBar);
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
          /**
           *
           * @param {Boolean} latest
           */
          handleChange(latest) {
              this.shopBar = {
                  ...this.shopBar,
                latest,
              };
          }
        }
    }
</script>