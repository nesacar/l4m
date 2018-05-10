<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/menus'">Meni</router-link></li>
                            <li><router-link tag="a" :to="'/menus/' + this.$route.params.id + '/edit'">{{ menuName }}</router-link></li>
                            <li>Link</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Link</h5>
                        <font-awesome-icon icon="random" @click="sortRows()" class="new-link-add left-one-place" />
                        <font-awesome-icon icon="plus" @click="addRow()" class="new-link-add" />
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="card">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">naziv</th>
                                <th scope="col">nad link</th>
                                <th scope="col">publikovano</th>
                                <th scope="col">kreirano</th>
                                <th>action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="row in menuLinks">
                                <td>{{ row.id }}</td>
                                <td>{{ row.title }}</td>
                                <td v-if="row.parent_menu">{{ row.parent_menu.title }}</td><td v-else>/</td>
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
            </div>
        </div>
    </div>
</template>

<script>
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import swal from 'sweetalert2';
    import Switches from 'vue-switches';
    import draggable from 'vuedraggable';

    export default {
        data(){
          return {
              menuLinks: {},
              menu: {},
              links: [],
              links2: [],
              lastId: 1,
              error: null,
          }
        },
        computed: {
            menuName(){
                return this.menu.title;
            }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'switches': Switches,
            'draggable': draggable
        },
        created(){
            this.getMenuList();
        },
        methods: {
            submit(){
                axios.post('api/menu-links/' + this.menu.id + '/order', {links: this.links})
                    .then(res => {
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Uspeh',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.menu = res.data.menu;
                        this.links = res.data.links;
                        this.lastId = res.data.lastId;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            getMenuList(){
                axios.get('api/menu-links?id=' + this.$route.params.id)
                    .then(res => {
                        this.menu = res.data.menu;
                        this.menuLinks = res.data.menuLinks;
                        console.log(this.menuLinks);
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            addRow(){
                this.$router.push('/menu-links/' + this.$route.params.id + '/create');
            },
            sortRows(){
                this.$router.push('/menus/' + this.$route.params.id + '/sort');
            },
            editRow(id){
                this.$router.push('/menu-links/' + id + '/edit');
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
                        axios.delete('api/menu-links/' + row.id)
                            .then(res => {
                                this.menuLinks = this.menuLinks.filter(function (item) {
                                    return row.id != item.id;
                                });
                                swal(
                                    'Obrisano!',
                                    'Link je uspešno obrisan.',
                                    'success'
                                );
                            })
                            .catch(e => {
                                console.log(e);
                            });
                    }
                });
            },
            update(){
                this.links.map((link, index) => {
                    link.order = index + 1;
                });
            },
        }
    }
</script>