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

                            <text-field :value="user.name" :label="'Ime'" :error="error? error.name : ''" :required="true" @changeValue="user.name = $event"></text-field>

                            <email-field :value="user.email" :label="'Email adresa'" :error="error? error.email : ''" :required="true" @changeValue="user.email = $event"></email-field>

                            <password-field :value="user.password" :label="'Lozinka'" :error="error? error.password : ''" :required="true" @changeValue="user.password = $event"></password-field>

                            <password-field :value="user.password_confirmation" :label="'Potvrda lozinke'" :required="true" @changeValue="user.password_confirmation = $event"></password-field>

                            <div class="form-group">
                                <label for="role">Pravo pristupa</label>
                                <select name="role" class="form-control" id="role" v-model="user.role_id">
                                    <option value="0" :selected="user.role_id == 0">Kupac</option>
                                    <option value="1" :selected="user.role_id == 1">Klijent</option>
                                    <option value="2" :selected="user.role_id == 2">Admin</option>
                                </select>
                            </div>

                            <select-multiple-field v-if="clients" :labela="'Klijenti'" :options="clients" :error="error? error.client_ids : ''" :value="user.client_lists" @changeValue="user.client_ids = $event"></select-multiple-field>

                            <checkbox-field :value="user.publish" :label="'Publikovano'" @changeValue="user.publish = $event"></checkbox-field>

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

    export default {
        data(){
          return {
              user: {},
              clients: false,
              error: null
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
        },
        mounted(){
            this.getUser();
        },
        methods: {
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
                        this.clients = res.data.clients;
                        this.user = res.data.user;
                        this.user.client_lists = res.data.client_ids;
                        this.user.client_ids = res.data.client_ids.map(({id}) => {
                            return id;
                        });
                        console.log(this.user.client_ids);
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
        }
    }
</script>