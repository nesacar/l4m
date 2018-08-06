<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li>Setovi</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Setovi</h5>
                        <font-awesome-icon icon="plus" @click="addRow()" class="new-link-add" />
                    </div>
                </div>

                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">naziv</th>
                            <th scope="col">publikovano</th>
                            <th scope="col">kreirano</th>
                            <th>action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="row in sets">
                            <td>{{ row.id }}</td>
                            <td>{{ row.title }}</td>
                            <td>{{ row.publish }}</td>
                            <td>{{ row.created_at }}</td>
                            <td>
                                <!--
                                <font-awesome-icon icon="sort-amount-up" @click="sortRow(row['id'])"/>
                                -->
                                <!--<font-awesome-icon icon="link" @click="links(row['id'])"/>-->
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
                sets: {},
                paginate: {}
            }
        },
        components: {
            'paginate-helper': PaginateHelper,
            'font-awesome-icon': FontAwesomeIcon
        },
        mounted(){
            this.getSets();
        },
        methods: {
            getSets(){
                axios.get('api/sets')
                    .then(res => {
                        this.sets = res.data.sets.data;
                        this.paginate = res.data.sets;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            editRow(id){
                this.$router.push('sets/' + id + '/edit');
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
                        axios.delete('api/sets/' + row.id)
                            .then(res => {
                                this.sets = this.sets.filter(function (item) {
                                    return row.id != item.id;
                                });
                                swal(
                                    'Obrisano!',
                                    'Meni je uspešno obrisan.',
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
                axios.get('api/sets?page=' + index)
                    .then(res => {
                        this.sets = res.data.sets.data;
                        this.paginate = res.data.sets;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            /*links(id){
                this.$router.push('/menu-links/' + id);
            },*/
            /*sortRow(id){
                this.$router.push('/sets/' + id + '/sort');
            },*/
            addRow(){
                this.$router.push('/sets/create');
            }
        }
    }

</script>