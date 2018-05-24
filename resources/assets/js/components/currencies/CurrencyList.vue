<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li>Valute</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Valute</h5>
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
                                <th scope="col">naziv</th>
                                <th scope="col">kod</th>
                                <th scope="col">simbol</th>
                                <th scope="col">broj decimala</th>
                                <th scope="col">vrednost</th>
                                <th scope="col">primarna valute</th>
                                <th scope="col">kreiran</th>
                                <th>akcija</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="row in currencies">
                                <td>{{ row.id }}</td>
                                <td>{{ row.name }}</td>
                                <td>{{ row.code }}</td>
                                <td>{{ row.symbol }}</td>
                                <td>{{ row.decimals }}</td>
                                <td>{{ row.exchange_rate }}</td>
                                <td>{{ row.primary? 'Da' : 'Ne' }}</td>
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
                currencies: {},
                paginate: {}
            }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon
        },
        created(){
            this.getCurrencies();
        },
        methods: {
            getCurrencies(){
                axios.get('api/currencies')
                    .then(res => {
                        this.currencies = res.data.currencies.data;
                        this.paginate = res.data.currencies;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            editRow(row){
                this.$router.push('currencies/' + row.id + '/edit');
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
                        axios.delete('api/currencies/' + row.id)
                            .then(res => {
                                this.currencies = this.currencies.filter(function (item) {
                                    return row.id != item.id;
                                });
                                swal(
                                    'Obrisano!',
                                    'Valuta je uspešno obrisana.',
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
                axios.get('api/currencies?page=' + index)
                    .then(res => {
                        this.currencies = res.data.currencies.data;
                        this.paginate = res.data.currencies;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            addRow(){
                this.$router.push('/currencies/create');
            },
        }
    }
</script>