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
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="srb" role="tabpanel" aria-labelledby="srb-tab">
                                <form @submit.prevent="submit()">
                                    <div class="form-group">
                                        <label>Proizvodi</label>
                                        <select2 :options="products" :multiple="true" :value="post.product_ids" @input="input($event)">
                                            <option value="0" disabled>select one</option>
                                        </select2>
                                    </div>
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
    import Select2 from '../helper/Select2Helper.vue';

    export default {
        data(){
          return {
              post: {
                  product_ids: []
              },
              error: null,
              products: {},
              domain : apiHost
          }
        },
        computed: {
            post_id(){
                return this.post.id;
            },
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'select2': Select2,
        },
        created(){
            this.getProducts();
        },
        methods: {
            getPost(){
                axios.get('api/posts/' + this.$route.params.id)
                    .then(res => {
                        this.post = res.data.post;
                        this.post.product_ids = res.data.product_ids;
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                axios.post('api/posts/' + this.$route.params.id + '/products', this.post)
                    .then(res => {
                        console.log(res.data.post);
                        this.post = res.data.post;
                        //this.post.product_ids = res.post.product_ids;
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
                            var object = {id: pick.id, text: pick.code};
                            return object;
                        });
                        this.getPost();
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            input(product){
                this.post.product_ids = product;
            },
        }
    }
</script>