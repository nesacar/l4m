<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li>Klijenti</li>
                        </ul>
                    </div>
                </div>
            </div>

            <search-helper :lists="[]" :search="searchClient" :enableList="false" @updateSearch="search($event)"></search-helper>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Klijenti</h5>
                        <font-awesome-icon icon="plus" @click="addRow()" class="new-link-add" />
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">naziv</th>
                                <th scope="col">kreirano</th>
                                <th>akcija</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="row in clients">
                                <td>{{ row.id }}</td>
                                <td>{{ row.name }}</td>
                                <td>{{ row.created_at }}</td>
                                <td>
                                    <router-link tag="a" :to="'client-bars/' + row['id']" class="edit-link"><font-awesome-icon icon="th-large"/></router-link>
                                    <router-link tag="a" :to="'clients/' + row['id'] + '/category'" class="edit-link"><font-awesome-icon icon="stream"/></router-link>
                                    <router-link tag="a" :to="'clients/' + row['id'] + '/edit'" class="edit-link"><font-awesome-icon icon="pencil-alt"/></router-link>
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
                clients: {},
                paginate: {}
            }
        },
        components: {
            'paginate-helper': PaginateHelper,
            'font-awesome-icon': FontAwesomeIcon
        },
        computed: {
            searchClient(){
                return this.$store.getters.getSearchClient;
            },
        },
        mounted(){
            this.getClients();
        },
        methods: {
            getClients(){
                this.$store.dispatch('changeSearchClientPage', 1);
                axios.post('api/clients/search', this.searchClient)
                    .then(res => {
                        this.clients = res.data.clients.data;
                        this.paginate = res.data.clients;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            editRow(id){
                this.$router.push('clients/' + id + '/edit');
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
                        axios.delete('api/clients/' + row.id)
                            .then(res => {
                                this.clients = this.clients.filter(function (item) {
                                    return row.id != item.id;
                                });
                                swal(
                                    'Obrisano!',
                                    'Klijent je uspešno obrisan.',
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
                this.$store.dispatch('changeSearchClientPage', index);
                axios.post('api/clients/search', this.searchClient)
                    .then(res => {
                        this.clients = res.data.clients.data;
                        this.paginate = res.data.clients;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            addRow(){
                this.$router.push('/clients/create');
            },
            search(value){
                this.$store.dispatch('changeSearchClient', value);
                axios.post('api/clients/search', this.searchClient)
                    .then(res => {
                        this.clients = res.data.clients.data;
                        this.paginate = res.data.clients;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
        }
    }
</script>