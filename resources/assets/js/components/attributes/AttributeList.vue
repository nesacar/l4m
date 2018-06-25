<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li>Atributi</li>
                        </ul>
                    </div>
                </div>
            </div>

            <search-helper :lists="properties" :search="searchAttribute" :enableList="true" @updateSearch="search($event)"></search-helper>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Atributi</h5>
                        <font-awesome-icon icon="plus" @click="addRow()" class="new-link-add" />
                    </div>
                </div>

                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">naziv</th>
                            <th scope="col">osobina</th>
                            <th scope="col">publikovano</th>
                            <th>akcija</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="row in attributes">
                            <td>{{ row.id }}</td>
                            <td>{{ row.title }}</td>
                            <td>{{ row.property.title }}</td>
                            <td>{{ row.publish }}</td>
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
    import SearchHelper from '../helper/SearchHelper.vue';

    export default {
        data(){
            return {
                attributes: {},
                properties: {},
                paginate: {}
            }
        },
        components: {
            'paginate-helper': PaginateHelper,
            'font-awesome-icon': FontAwesomeIcon,
            'search-helper': SearchHelper,
        },
        computed: {
            searchAttribute(){
                return this.$store.getters.getSearchAttribute;
            },
        },
        mounted(){
            this.getAttributes();
            this.getProperties();
        },
        methods: {
            getAttributes(){
                this.$store.dispatch('changeSearchAttributePage', 1);
                axios.post('api/attributes/search', this.searchAttribute)
                    .then(res => {
                        this.attributes = res.data.attributes.data;
                        this.paginate = res.data.attributes;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            getProperties(){
                axios.get('api/properties/lists')
                    .then(res => {
                        this.properties = res.data.lists;
                        this.properties[0] = 'izaberi osobinu';
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            editRow(id){
                this.$router.push('attributes/' + id + '/edit');
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
                        axios.delete('api/attributes/' + row.id)
                            .then(res => {
                                this.attributes = this.attributes.filter(function (item) {
                                    return row.id != item.id;
                                });
                                swal(
                                    'Obrisano!',
                                    'Atribut je obrisan.',
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
                this.$store.dispatch('changeSearchAttributePage', index);
                axios.post('api/attributes/search', this.searchAttribute)
                    .then(res => {
                        this.attributes = res.data.attributes.data;
                        this.paginate = res.data.attributes;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            addRow(){
                this.$router.push('/attributes/create');
            },
            search(value){
                this.$store.dispatch('changeSearchAttributePage', 1);
                this.$store.dispatch('changeSearchAttribute', value);
                axios.post('api/attributes/search', this.searchAttribute)
                    .then(res => {
                        this.attributes = res.data.attributes.data;
                        this.paginate = res.data.attributes;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
        }
    }
</script>