<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li>ShopBars</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h5>ShopBars</h5>
                        <font-awesome-icon icon="plus" @click="addRow()" class="new-link-add" />
                    </div>
                </div>

                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">naziv</th>
                            <th scope="col">opis</th>
                            <th scope="col">nad kategorija</th>
                            <th scope="col">kategorija</th>
                            <th scope="col">publikovano</th>
                            <th scope="col">strana</th>
                            <th>akcija</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="row in shopBars">
                            <td>{{ row.id }}</td>
                            <td>{{ row.title }}</td>
                            <td>{{ row.desc }}</td>
                            <td v-if="row.parent_category">{{ row.parent_category.title }}</td><td v-else>/</td>
                            <td v-if="row.category">{{ row.category.title }}</td><td v-else>/</td>
                            <td>{{ row.publish }}</td>
                            <td>{{ row.template }}</td>
                            <td>
                                <font-awesome-icon icon="pencil-alt" @click="editRow(row['id'])"/>
                                <font-awesome-icon icon="times" @click="deleteRow(row)" />
                            </td>
                        </tr>
                        </tbody>
                    </table>
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
                shopBars: {},
                paginate: {}
            }
        },
        components: {
            'paginate-helper': PaginateHelper,
            'font-awesome-icon': FontAwesomeIcon,
        },
        created(){
            this.getShopBars();
        },
        methods: {
            getShopBars(){
                axios.get('api/shop-bars')
                    .then(res => {
                        console.log(res);
                        this.shopBars = res.data.shopBars.data;
                        this.paginate = res.data.shopBars;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            editRow(id){
                this.$router.push('shop-bars/' + id + '/edit');
            },
            deleteRow(row){
                swal({
                    title: 'Da li ste sigurni?',
                    text: "Nećete moći da povratite radnju!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#51d2b7',
                    cancelButtonColor: '#fb9678',
                    confirmButtonText: 'Da, obriši!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('api/shop-bars/' + row.id)
                            .then(res => {
                                this.shopBars = this.shopBars.filter(function (item) {
                                    return row.id != item.id;
                                });
                                swal(
                                    'Obrisano!',
                                    'ShopBar je obrisan.',
                                    'success'
                                );
                            })
                            .catch(e => {
                                console.log(e);
                            });
                    }
                })
            },
            clickToLink(index){
                axios.get('api/shop-bars?page=' + index)
                    .then(res => {
                        this.shopBars = res.data.shopBars.data;
                        this.paginate = res.data.shopBars;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            addRow(){
                this.$router.push('/shop-bars/create');
            }
        }
    }
</script>