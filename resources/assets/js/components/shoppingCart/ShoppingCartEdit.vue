<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/shopping-carts'">Porudžbine</router-link></li>
                            <li>Pregled porudžbine</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">

                <div class="col-md-4">
                    <div class="card">
                        <h3>Podaci o kupcu</h3>
                        <ul class="list-item" v-if="shoppingCart" style="padding-left: 0">
                            <li class="list-group-item">Kupac: {{ shoppingCart.customer.name }} {{ shoppingCart.customer.lastname }}</li>
                            <li class="list-group-item">Email: {{ shoppingCart.customer.user.email }}</li>
                            <li class="list-group-item">Broj telefona: {{ shoppingCart.customer.phone }}</li>
                            <li class="list-group-item"></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <h3>Lista proizvoda</h3>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">naziv</th>
                                <th scope="col">šifra</th>
                                <th scope="col">slika</th>
                                <th scope="col">kategorija</th>
                                <th scope="col">vidljivo</th>
                                <th scope="col">vidljivo od</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="row in shoppingCart.order">
                                <td>{{ row.id }}</td>
                                <td>{{ row.product.title }}</td>
                                <td v-if="!row.edit" @click="row.edit = !row.edit" style="cursor: pointer;">{{ row.product.code }}</td>
                                <td v-else>
                                    <div class="form-group">
                                        <textarea class="form-control" v-model="row.product.code"></textarea>
                                        <small class="form-text text-muted text-center" v-if="error != null && error.code">{{ error.code[0] }}</small>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-primary btn-sm" @click="editCode(row)">Izmeni</button>
                                        <button class="btn btn-link btn-sm btn-small" @click="row.edit = !row.edit">Odustani</button>
                                    </div>
                                </td>
                                <td v-if="row.product.tmb"><img :src="row.product.tmb" :alt="row.product.title"></td> <td v-else><preview-image :product_id="row.product.id"></preview-image></td>
                                <td v-if="row.product.category.length > 0">{{ row.product.category[0].title }}</td><td v-else>/</td>
                                <td>{{ row.product.publish? 'Da' : 'Ne' }}</td>
                                <td>{{ row.product.publish_at }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import swal from 'sweetalert2';
    import Switches from 'vue-switches';

    export default {
        data(){
          return {
              shoppingCart: false,
              error: null,
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'switches': Switches,
        },
        created(){
            this.getCart();
        },
        methods: {
            getCart(){
                axios.get('api/shopping-carts/' + this.$route.params.id)
                    .then(res => {
                        this.shoppingCart = res.data.shoppingCart;
                        console.log(this.shoppingCart);
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
        }
    }
</script>