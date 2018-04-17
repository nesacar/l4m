<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/users'">Korisnici</router-link></li>
                            <li>Izmena lozinke</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena lozinke</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card">
                        <form @submit.prevent="submit()">
                            <div class="form-group">
                                <label for="old-password">Stara lozinka</label>
                                <input type="password" name="oldpassword" class="form-control" id="old-password" placeholder="Stara lozinka" v-model="user.oldpassword">
                                <small class="form-text text-muted" v-if="error != null && error.oldpassword">{{ error.oldpassword[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="password">Nova lozinka</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Nova lozinka" v-model="user.password">
                                <small class="form-text text-muted" v-if="error != null && error.password">{{ error.password[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Potvrda nove lozinke</label>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Potvrda nove lozinke" v-model="user.password_confirmation">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">Izmeni</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <upload-image-helper
                            :image="user.image"
                            :defaultImage="'img/user-image.png'"
                            :titleImage="'user'"
                            :error="error"
                            @uploadImage="upload($event)"
                            @removeRow="remove($event)"
                    ></upload-image-helper>
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
              error: null
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
        },
        methods: {
            submit(){
                axios.post('api/users/change-password', this.user)
                    .then(res => {
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.error = null;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            upload(image){
                this.user.image = image[0];
            },
        }
    }
</script>

<style>

</style>