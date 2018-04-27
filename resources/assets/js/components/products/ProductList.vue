<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li>Proizvodi</li>
                        </ul>
                    </div>
                </div>
            </div>

            <search-helper :lists="categories" :text="''" @updateSearch="search($event)"></search-helper>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Proizvodi</h5>
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
                                <th scope="col">šifra</th>
                                <th scope="col">slika</th>
                                <th scope="col">kategorija</th>
                                <th scope="col">vidljivo</th>
                                <th scope="col">vidljivo od</th>
                                <th>akcija</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="row in products">
                                <td>{{ row.id }}</td>
                                <td>{{ row.title }}</td>
                                <td>{{ row.code }}</td>
                                <td><img :src="row.tmb" :alt="row.title"></td>
                                <td v-if="row.category.length > 0">{{ row.category[0].title }}</td><td v-else>/</td>
                                <td>{{ row.publish? 'Da' : 'Ne' }}</td>
                                <td>{{ row.publish_at }}</td>
                                <td>
                                    <router-link tag="a" :to="'products/' + row['id'] + '/edit'" class="edit-link" target="_blank"><font-awesome-icon icon="pencil-alt"/></router-link>
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
    import SearchHelper from '../helper/SearchHelper.vue';
    import swal from 'sweetalert2';
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';

    export default {
        data(){
            return {
                products: {},
                paginate: {},
                categories: {}
            }
        },
        components: {
            'paginate-helper': PaginateHelper,
            'search-helper': SearchHelper,
            'font-awesome-icon': FontAwesomeIcon
        },
        created(){
            this.getProducts();
            this.getCategories();
        },
        methods: {
            getProducts(){
                axios.get('api/products')
                    .then(res => {
                        this.products = res.data.products.data;
                        this.paginate = res.data.products;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            editRow(id){
                this.$router.push('products/' + id + '/edit');
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
                        axios.delete('api/products/' + row.id)
                            .then(res => {
                                this.products = this.products.filter(function (item) {
                                    return row.id != item.id;
                                });
                                swal(
                                    'Obrisano!',
                                    'Proizvod je uspešno obrisan.',
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
                axios.get('api/products?page=' + index)
                    .then(res => {
                        this.products = res.data.products.data;
                        this.paginate = res.data.products;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            getCategories(){
                axios.get('api/categories/lists')
                    .then(res => {
                        this.categories = res.data.categories;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            search(value){
                console.log(value);
                axios.post('api/products/search', value)
                    .then(res => {
                        console.log(res.data.products);
                        this.products = res.data.products.data;
                        this.paginate = res.data.products;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            addRow(){
                this.$router.push('/products/create');
            }
        }
    }
</script>