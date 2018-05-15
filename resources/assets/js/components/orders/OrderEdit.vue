<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/orders'">Porudžbine</router-link></li>
                            <li>Izmena porudžbine</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena porudžbine</h5>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <h3>Podaci o kupcu</h3>
                        <ul class="list-item" v-if="order" style="padding-left: 0">
                            <li class="list-group-item">Kupac: {{ order.customer.name }} {{ order.customer.lastname }}</li>
                            <li class="list-group-item">Email: {{ order.customer.user.email }}</li>
                            <li class="list-group-item">Broj telefona: {{ order.customer.phone }}</li>
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
                            <tr v-for="(row, index) in order.product">
                                <td>{{ row.id }}</td>
                                <td>{{ row.title }}</td>
                                <td v-if="!row.edit" @click="row.edit = !row.edit" style="cursor: pointer;">{{ row.code }}</td>
                                <td v-else>
                                    <div class="form-group">
                                        <textarea class="form-control" v-model="row.code"></textarea>
                                        <small class="form-text text-muted text-center" v-if="error != null && error.code">{{ error.code[0] }}</small>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-primary btn-sm" @click="editCode(row)">Izmeni</button>
                                        <button class="btn btn-link btn-sm btn-small" @click="row.edit = !row.edit">Odustani</button>
                                    </div>
                                </td>
                                <td v-if="row.tmb"><img :src="row.tmb" :alt="row.title"></td> <td v-else><preview-image :product_id="row.id"></preview-image></td>
                                <td v-if="row.category.length > 0">{{ row.category[0].title }}</td><td v-else>/</td>
                                <td>{{ row.publish? 'Da' : 'Ne' }}</td>
                                <td>{{ row.publish_at }}</td>
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
              order: {},
              error: null,
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'switches': Switches,
        },
        created(){
            this.getOrder();
        },
        methods: {
            getOrder(){
                axios.get('api/orders/' + this.$route.params.id)
                    .then(res => {
                        this.order = res.data.order;
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
        }
    }
</script>