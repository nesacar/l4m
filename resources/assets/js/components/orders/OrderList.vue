<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li>Porudžbine</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Porudžbine</h5>
                        <font-awesome-icon icon="plus" @click="addRow()" class="new-link-add" />
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">ime</th>
                                <th scope="col">cena</th>
                                <th scope="col">status</th>
                                <th scope="col">kreirano</th>
                                <th>akcija</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="row in orders">
                                <td>{{ row.id }}</td>
                                <td>{{ row.customer.name }}</td>
                                <td>{{ row.total }}</td>
                                <td>{{ row.publish }}</td>
                                <td>{{ row.created_at }}</td>
                                <td>
                                    <router-link tag="a" :to="'blogs/' + row['id'] + '/edit'" class="edit-link" target="_blank"><font-awesome-icon icon="pencil-alt"/></router-link>
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
                blogs: {},
                paginate: {}
            }
        },
        components: {
            'paginate-helper': PaginateHelper,
            'font-awesome-icon': FontAwesomeIcon
        },
        created(){
            this.getBlogs();
        },
        methods: {
            getBlogs(){
                axios.get('api/blogs')
                    .then(res => {
                        this.blogs = res.data.blogs.data;
                        this.paginate = res.data.blogs;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            editRow(id){
                this.$router.push('blogs/' + id + '/edit');
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
                        axios.delete('api/blogs/' + row.id)
                            .then(res => {
                                this.blogs = this.blogs.filter(function (item) {
                                    return row.id != item.id;
                                });
                                swal(
                                    'Obrisano!',
                                    'Kategorija je uspešno obrisana.',
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
                axios.get('api/blogs?page=' + index)
                    .then(res => {
                        this.blogs = res.data.blogs.data;
                        this.paginate = res.data.blogs;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            addRow(){
                this.$router.push('/blogs/create');
            }
        }
    }
</script>