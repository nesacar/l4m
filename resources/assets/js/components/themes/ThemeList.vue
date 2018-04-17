<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Home</router-link></li>
                            <li>Teme</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">naziv</th>
                            <th scope="col">publikovano</th>
                            <th scope="col">kreirano</th>
                            <th>akcija</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="row in themes">
                            <td>{{ row.id }}</td>
                            <td>{{ row.title }}</td>
                            <td>{{ row.publish }}</td>
                            <td>{{ row.created_at }}</td>
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
                themes: {},
                paginate: {}
            }
        },
        components: {
            'paginate-helper': PaginateHelper,
            'font-awesome-icon': FontAwesomeIcon
        },
        created(){
            this.getThemes();
        },
        methods: {
            getThemes(){
                axios.get('api/themes')
                    .then(res => {
                        this.themes = res.data.themes.data;
                        this.paginate = res.data.themes;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            editRow(id){
                this.$router.push('themes/' + id + '/edit');
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
                        axios.delete('api/themes/' + row.id)
                            .then(res => {
                                this.themes = this.themes.filter(function (item) {
                                    return row.id != item.id;
                                });
                                swal(
                                    'Obrisano!',
                                    'Tema je obrisana.',
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
                axios.get('api/themes?page=' + index)
                    .then(res => {
                        this.themes = res.data.themes.data;
                        this.paginate = res.data.themes;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            }
        }
    }
</script>