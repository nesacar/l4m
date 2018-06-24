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

            <search-helper :lists="categories" :search="searchProduct" :enableList="true" @updateSearch="search($event)"></search-helper>

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
                            <tr v-for="(row, index) in products">
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
                                <td>
                                    <font-awesome-icon icon="eye" @click="previewRow(row)" title="preview" />
                                    <router-link tag="a" :to="'products/' + row['id'] + '/edit'" class="edit-link"><font-awesome-icon icon="pencil-alt"/></router-link>
                                    <font-awesome-icon icon="copy" @click="cloneRow(row)" title="clone" />
                                    <font-awesome-icon icon="times" @click="deleteRow(row)" title="remove" />
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
    import PreviewImage from '../helper/PreviewImage.vue';

    export default {
        data(){
            return {
                products: {},
                paginate: {},
                categories: {},
                error: {},
            }
        },
        components: {
            'paginate-helper': PaginateHelper,
            'search-helper': SearchHelper,
            'font-awesome-icon': FontAwesomeIcon,
            'preview-image': PreviewImage,
        },
        computed: {
            searchProduct(){
                return this.$store.getters.getSearchProduct;
            },
        },
        mounted(){
            this.getProducts();
            this.getCategories();
        },
        methods: {
            getProducts(){
                this.$store.dispatch('changeSearchProductPage', 1);
                axios.post('api/products/search', this.searchProduct)
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
                this.$store.dispatch('changeSearchProductPage', index);
                axios.post('api/products/search', this.searchProduct)
                    .then(res => {
                        this.products = res.data.products.data;
                        this.paginate = res.data.products;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            getCategories(){
                axios.get('api/categories/top-lists')
                    .then(res => {
                        this.categories = res.data.lists;
                        this.categories[0] = 'Odaberi kategoriju';
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            search(value){
                this.$store.dispatch('changeSearchProduct', value);
                axios.post('api/products/search', this.searchProduct)
                    .then(res => {
                        this.products = res.data.products.data;
                        this.paginate = res.data.products;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            addRow(){
                this.$router.push('/products/create');
            },
            cloneRow(row){
                axios.post('api/products/' + row.id + '/clone')
                    .then(res => {
                        let index = this.products.indexOf(row);
                        this.products.splice(index, 0, res.data.product);
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            editCode(row){
                axios.post('api/products/' + row.id + '/code', {'code': row.code})
                    .then(res => {
                        swal(
                            'Izmenjeno!',
                            'Šifra je uspešno izmenjena.',
                            'success'
                        );
                        row.edit = false;
                    })
                    .catch(e => {
                        console.log(e.response.data.errors);
                        this.error = e.response.data.errors;
                    });
            },
            previewRow(row){
                window.open(row.link, '_blank');
            },
        },
    }
</script>