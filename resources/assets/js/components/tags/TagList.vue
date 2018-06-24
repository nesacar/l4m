<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li>Tagovi</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!--<search-helper :lists="[]" :text="''" @updateSearch="search($event)"></search-helper>-->

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Tagovi</h5>
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
                                <th scope="col">povezano sa člancima</th>
                                <th scope="col">povezano sa proizvodima</th>
                                <th scope="col">publikovano</th>
                                <th scope="col">kreirano</th>
                                <th>akcija</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="row in tags">
                                <td>{{ row.id }}</td>
                                <td>{{ row.title }}</td>
                                <td>{{ row.post_count }}</td>
                                <td>{{ row.product_count }}</td>
                                <td>{{ row.publish }}</td>
                                <td>{{ row.created_at }}</td>
                                <td>
                                    <router-link tag="a" :to="'tags/' + row['id'] + '/edit'" class="edit-link"><font-awesome-icon icon="pencil-alt"/></router-link>
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
                tags: {},
                paginate: {}
            }
        },
        components: {
            'paginate-helper': PaginateHelper,
            'font-awesome-icon': FontAwesomeIcon
        },
        created(){
            this.getTags();
        },
        methods: {
            getTags(){
                axios.get('api/tags')
                    .then(res => {
                        this.tags = res.data.tags.data;
                        this.paginate = res.data.tags;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            editRow(id){
                this.$router.push('tags/' + id + '/edit');
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
                        axios.delete('api/tags/' + row.id)
                            .then(res => {
                                this.tags = this.tags.filter(function (item) {
                                    return row.id != item.id;
                                });
                                swal(
                                    'Obrisano!',
                                    'Tag je uspešno obrisan.',
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
                axios.get('api/tags?page=' + index)
                    .then(res => {
                        this.tags = res.data.tags.data;
                        this.paginate = res.data.tags;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            addRow(){
                this.$router.push('/tags/create');
            },
            search(value){
                axios.post('api/tags/search', value)
                    .then(res => {
                        this.tags = res.data.tags.data;
                        this.paginate = res.data.tags;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
        }
    }
</script>