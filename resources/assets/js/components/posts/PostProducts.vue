<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/posts'">Članci</router-link></li>
                            <li><router-link tag="a" :to="'/posts/' + this.$route.params.id + '/products'">{{ post.title }}</router-link></li>
                            <li>Povezivanje proizvoda</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Povezivanje proizvoda</h5>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="srb" role="tabpanel" aria-labelledby="srb-tab">
                                <form @submit.prevent="submit()" v-if="trigger">

                                    <select-multiple-field v-if="products" :error="error? error.product_ids : ''" :value="post.products" :options="products" :labela="'Proizvodi'" @changeValue="post.product_ids = $event"></select-multiple-field>

                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Izmeni</button>
                                    </div>
                                </form>
                            </div><!-- #srb -->
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
    import swal from 'sweetalert2';

    export default {
        data(){
          return {
              post: {},
              error: null,
              products: false,
              domain : apiHost,
              trigger: false,
          }
        },
        computed: {
            post_id(){
                return this.post.id;
            },
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
        },
        mounted(){
            this.getProducts();
        },
        methods: {
            getPost(){
                axios.get('api/posts/' + this.$route.params.id)
                    .then(res => {
                        this.post = res.data.post;
                        this.post.products = res.data.product_ids;
                        this.trigger = true;
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                axios.post('api/posts/' + this.$route.params.id + '/products', {'product_ids': this.post.product_ids})
                    .then(res => {
                        this.post = res.data.post;
                        this.post.product_ids = res.data.product_ids;
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
            getProducts(){
                axios.get('api/products/lists')
                    .then(res => {
                        this.products = _.map(res.data.products, (data) => {
                            var pick = _.pick(data, 'code', 'id');
                            var object = {id: pick.id, title: pick.code};
                            return object;
                        });
                        this.getPost();
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            input(product){
                this.ids = product;
            },
        }
    }
</script>