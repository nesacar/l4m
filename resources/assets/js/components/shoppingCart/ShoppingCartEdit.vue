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
                            <li class="list-group-item">Kupac: {{ shoppingCart.customer.user.name }}</li>
                            <li class="list-group-item">Email: {{ shoppingCart.customer.user.email }}</li>
                            <li class="list-group-item" v-if="shoppingCart.address">Broj telefona: {{ shoppingCart.address.phone }}</li>
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
                                <th scope="col">kategorija</th>
                                <th scope="col">slika</th>
                                <th scope="col">veličina</th>
                                <th scope="col">boja</th>
                                <th scope="col">dostava</th>
                                <th scope="col">vidljivo</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="row in shoppingCart.order">
                                <td>{{ row.id }}</td>
                                <td>{{ row.product.title }}</td>
                                <td>{{ row.product.code }}</td>
                                <td v-if="row.product.category">{{ row.product.category[0].title }}</td><td v-else>/</td>
                                <td v-if="row.product.tmb"><a :href="row.product.link" target="_blank"><img :src="row.product.tmb" :alt="row.product.title"></a></td>
                                <td>{{ row.size? row.size : '/' }}</td>
                                <td>{{ row.color? row.color : '/' }}</td>
                                <td v-if="row.shipping">{{ row.shipping.title }}</td><td v-else></td>
                                <td>{{ row.product.publish? 'Da' : 'Ne' }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-8">
                        <div class="card">
                            <checkbox-field v-if="shoppingCart" :value="shoppingCart.paid" :label="'Plaćeno'" @changeValue="shoppingCart.paid = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" @click="changePaidStatus()">Izmeni</button>
                            </div>
                        </div>
                    </div>

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
              shoppingCart: false,
              error: null,
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
        },
        mounted(){
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
            changePaidStatus(){
                axios.post('api/shopping-carts/' + this.$route.params.id + '/change-paid-status', {paid: this.shoppingCart.paid})
                    .then(res => {
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Uspeh',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
        }
    }
</script>