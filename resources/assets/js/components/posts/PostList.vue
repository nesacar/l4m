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

            <search-helper :lists="blogs" :text="''" @updateSearch="search($event)"></search-helper>

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
                                <th scope="col">vidljivo</th>
                                <th scope="col">vidljivo od</th>
                                <th>akcija</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="row in posts">
                                <td>{{ row.id }}</td>
                                <td>{{ row.title }}</td>
                                <td>{{ row.blog }}</td>
                                <td>{{ row.publish? 'Da' : 'Ne' }}</td>
                                <td>{{ row.publish_at }}</td>
                                <td>
                                    <router-link tag="a" :to="'posts/' + row['id'] + '/edit'" class="edit-link" target="_blank"><font-awesome-icon icon="pencil-alt"/></router-link>
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
        created(){
            this.getPosts();
            this.getBlogs();
        },
        methods: {
            getPosts(){
                axios.get('api/posts')
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
                                    'Čkanak je uspešno obrisan.',
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
                axios.get('api/posts?page=' + index)
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
                        this.blogs = res.data.blogs;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            search(value){
                axios.post('api/posts/search', value)
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
            }
        }
    }
</script>