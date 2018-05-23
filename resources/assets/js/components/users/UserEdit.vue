<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/users'">Korisnici</router-link></li>
                            <li>Izmena korisnika</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena korisnika</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card">
                        <form @submit.prevent="submit()">
                            <div class="form-group">
                                <label for="name">Ime</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Name" v-model="user.name">
                                <small class="form-text text-muted" v-if="error != null && error.name">{{ error.name[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="email">Email adresa</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email adresa" v-model="user.email">
                                <small class="form-text text-muted" v-if="error != null && error.email">{{ error.email[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="password">Lozinka</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Lozinka" v-model="user.password">
                                <small class="form-text text-muted" v-if="error != null && error.password">{{ error.password[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Potvrda lozinke</label>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Potvrda lozinke" v-model="user.password_confirmation">
                            </div>
                            <div class="form-group">
                                <label for="role">Pravo pristupa</label>
                                <select name="role" class="form-control" id="role" v-model="user.role_id">
                                    <option value="0" :selected="user.role_id == 0">Kupac</option>
                                    <option value="1" :selected="user.role_id == 1">Klijent</option>
                                    <option value="2" :selected="user.role_id == 2">Admin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Klijenti</label>
                                <select2 :options="clients" :multiple="true" :value="user.client_ids" @input="input($event)">
                                    <option value="0" disabled>select one</option>
                                </select2>
                            </div>
                            <div class="form-group">
                                <label>Publikovano</label><br>
                                <switches v-model="user.block" theme="bootstrap" color="primary"></switches>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">Izmeni</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <upload-image-helper :image="user.image" :defaultImage="'img/user-image.png'" :titleImage="'korisnika'" :error="error" @uploadImage="upload($event)"></upload-image-helper>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import UploadImageHelper from '../helper/UploadImageHelper.vue';
    import swal from 'sweetalert2';
    import Switches from 'vue-switches';
    import Select2 from '../helper/Select2Helper.vue';

    export default {
        data(){
          return {
              user: {},
              clients: {},
              error: null
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
            'switches': Switches,
            'select2': Select2,
        },
        created(){
            this.getClients();
        },
        methods: {
            getClients(){
                axios.get('api/clients')
                    .then(res => {
                        this.clients = _.map(res.data.clients.data, (data) => {
                            var pick = _.pick(data, 'name', 'id');
                            var object = {id: pick.id, text: pick.name};
                            return object;
                        });
                        this.getUser();
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                axios.patch('api/users/' + this.user.id, this.user)
                    .then(res => {
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Izmenjeno',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.error = null;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            getUser(){
                axios.get('api/users/' + this.$route.params.id)
                    .then(res => {
                        this.user = res.data.user;
                        this.user.client_ids = res.data.client_ids;
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            upload(image){
                let data = new FormData();
                data.append('image', image.file);
                axios.post('api/users/' + this.user.id + '/image', data)
                    .then(res => {
                        console.log(res);
                        this.user.image = res.data.image;
                        this.error = null;
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }).catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            input(client){
                this.user.client_ids = client;
                console.log(client);
            },
        }
    }
</script>