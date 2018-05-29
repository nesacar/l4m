<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li>Kateogrije proizvoda</li>
                        </ul>
                    </div>
                </div>
            </div>

            <search-helper :lists="parents" :text="''" @updateSearch="search($event)"></search-helper>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Kategorije proizvoda</h5>
                        <font-awesome-icon icon="random" @click="sortRows()" class="new-link-add left-one-place" />
                        <font-awesome-icon icon="plus" @click="addRow()" class="new-link-add" />
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">naslov</th>
                                <th scope="col">nad kategorija</th>
                                <th scope="col">publikovano</th>
                                <th>akcija</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="row in categories">
                                <td>{{ row.id }}</td>
                                <td>{{ row.title }}</td>
                                <td v-if="row.parent_category">{{ row.parent_category.title }}</td><td v-else>Bez</td>
                                <td>{{ row.publish? 'Da' : 'Ne' }}</td>
                                <td>
                                    <router-link tag="a" :to="'categories/' + row['id'] + '/edit'" class="edit-link"><font-awesome-icon icon="pencil-alt"/></router-link>
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
                categories: {},
                parents: {},
                paginate: {},
            }
        },
        components: {
            'paginate-helper': PaginateHelper,
            'search-helper': SearchHelper,
            'font-awesome-icon': FontAwesomeIcon
        },
        created(){
            this.getCategories();
            this.getParents();
        },
        methods: {
            getCategories(){
                axios.get('api/categories')
                    .then(res => {
                        this.categories = res.data.categories.data;
                        this.paginate = res.data.categories;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            getParents(){
                axios.get('api/categories/lists?parent=1')
                    .then(res => {
                        this.parents = res.data.categories;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            editRow(id){
                this.$router.push('categories/' + id + '/edit');
            },
            sortRows(){
                this.$router.push('/categories/sort');
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
                        axios.delete('api/categories/' + row.id)
                            .then(res => {
                                this.categories = this.categories.filter(function (item) {
                                    return row.id != item.id;
                                });
                                swal(
                                    'Obrisano!',
                                    'Kategorija je uspešno obrisan.',
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
                axios.get('api/categories?page=' + index)
                    .then(res => {
                        this.categories = res.data.categories.data;
                        this.paginate = res.data.categories;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            search(value){
                console.log(value);
                axios.post('api/categories/search', value)
                    .then(res => {
                        this.categories = res.data.categories.data;
                        this.paginate = res.data.categories;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            addRow(){
                this.$router.push('/categories/create');
            }
        }
    }
</script>