<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li>Kupci</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Kupci</h5>
                        <font-awesome-icon icon="plus" @click="addRow()" class="new-link-add" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">ime</th>
                                <th scope="col">email</th>
                                <th scope="col">korpe</th>
                                <th scope="col">grad</th>
                                <th scope="col">kreiran</th>
                                <th>akcija</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="row in customers">
                                <td>{{ row.id }}</td>
                                <td>{{ row.user.name }}</td>
                                <td>{{ row.user.email }}</td>
                                <td>{{ row.shopping_cart_count }}</td>
                                <td>{{ row.shopping_cart[0].address.town }}</td>
                                <td>{{ row.created_at }}</td>
                                <td>
                                    <font-awesome-icon icon="pencil-alt" @click="editRow(row)"/>
                                    <font-awesome-icon icon="times" @click="deleteRow(row)" />
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <paginate-helper :paginate="paginate" @clickLink="clickToLink($event)"></paginate-helper>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import PaginateHelper from '../helper/PaginateHelper.vue';
    import swal from 'sweetalert2';
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';

    export default {
        data(){
            return {
                customers: {},
                paginate: {}
            }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon
        },
        created(){
            this.getCustomers();
        },
        methods: {
            getCustomers(){
                axios.get('api/customers')
                    .then(res => {
                        this.customers = res.data.customers.data;
                        console.log(this.customers);
                        this.paginate = res.data.customers;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            editRow(row){
                this.$router.push('customers/' + row.id + '/edit');
            },
            deleteRow(row){
                swal({
                    title: 'Da li ste sigurni?',
                    text: "Nećete moći da povratite radnju!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#51d2b7',
                    cancelButtonColor: '#fb9678',
                    confirmButtonText: 'Da, obriši ga!',
                    cancelButtonText: 'Odustani'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('api/customers/' + row.id)
                            .then(res => {
                                this.customers = this.customers.filter(function (item) {
                                    return row.id != item.id;
                                });
                                swal(
                                    'Obrisano!',
                                    'Kupac je uspešno obrisan.',
                                    'success'
                                );
                            })
                            .catch(e => {
                                console.log(e);
                            });
                    }
                });
            },
            clickToLink(index){
                axios.get('api/customers?page=' + index)
                    .then(res => {
                        this.customers = res.data.customers.data;
                        this.paginate = res.data.customers;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            addRow(){
                this.$router.push('/customers/create');
            },
        }
    }
</script>