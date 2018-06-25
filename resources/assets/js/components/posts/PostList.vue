<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li>Članci</li>
                        </ul>
                    </div>
                </div>
            </div>

            <search-helper :lists="blogs" :search="searchPost" :enableList="true" @updateSearch="search($event)"></search-helper>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Članci</h5>
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
                                <th scope="col">kategorija</th>
                                <th scope="col">proizvodi</th>
                                <th scope="col">vidljivo</th>
                                <th scope="col">vidljivo od</th>
                                <th>akcija</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="row in posts">
                                <td>{{ row.id }}</td>
                                <td>{{ row.title }}</td>
                                <td v-if="row.blog">{{ row.blog.title }}</td> <td v-else>/</td>
                                <td v-if="row.product.length > 0">[<span v-for="product in row.product">{{ product.title }},</span>]</td> <td v-else>/</td>
                                <td>{{ row.publish? 'Da' : 'Ne' }}</td>
                                <td>{{ row.publish_at }}</td>
                                <td>
                                    <font-awesome-icon icon="eye" @click="previewRow(row)" />
                                    <font-awesome-icon icon="shopping-cart" @click="productRow(row)" />
                                    <router-link tag="a" :to="'posts/' + row['id'] + '/edit'" class="edit-link"><font-awesome-icon icon="pencil-alt"/></router-link>
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
                posts: {},
                paginate: {},
                blogs: {}
            }
        },
        components: {
            'paginate-helper': PaginateHelper,
            'search-helper': SearchHelper,
            'font-awesome-icon': FontAwesomeIcon
        },
        computed: {
            searchPost(){
                return this.$store.getters.getSearchPost;
            },
        },
        mounted(){
            this.getPosts();
            this.getBlogs();
        },
        methods: {
            getPosts(){
                this.$store.dispatch('changeSearchPostPage', 1);
                axios.post('api/posts/search', this.searchPost)
                    .then(res => {
                        this.posts = res.data.posts.data;
                        this.paginate = res.data.posts;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            editRow(id){
                this.$router.push('posts/' + id + '/edit');
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
                        axios.delete('api/posts/' + row.id)
                            .then(res => {
                                this.posts = this.posts.filter(function (item) {
                                    return row.id != item.id;
                                });
                                swal(
                                    'Obrisano!',
                                    'Članak je uspešno obrisan.',
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
                this.$store.dispatch('changeSearchPostPage', index);
                axios.post('api/posts/search', this.searchPost)
                    .then(res => {
                        this.posts = res.data.posts.data;
                        this.paginate = res.data.posts;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            getBlogs(){
                axios.get('api/blogs/lists')
                    .then(res => {
                        this.blogs = res.data.lists;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            search(value){
                this.$store.dispatch('changeSearchPostPage', 1);
                this.$store.dispatch('changeSearchPost', value);
                axios.post('api/posts/search', this.searchPost)
                    .then(res => {
                        this.posts = res.data.posts.data;
                        this.paginate = res.data.posts;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            addRow(){
                this.$router.push('/posts/create');
            },
            previewRow(row){
                window.open(row.link, '_blank');
            },
            productRow(row){
                this.$router.push('/posts/' + row.id + '/products');
            },
        }
    }
</script>