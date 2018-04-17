<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li>Podešavanja</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Podešavanja</h5>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <form @submit.prevent="submit()">
                            <div class="form-group">
                                <label for="Phone1">Telefon 1</label>
                                <input type="text" name="Phone1" class="form-control" id="Phone1" placeholder="Telefon 1" v-model="setting.phone1">
                                <small class="form-text text-muted" v-if="error != null && error.phone1">{{ error.phone1[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="Phone1">Telefon 2</label>
                                <input type="text" name="Phone2" class="form-control" id="Phone2" placeholder="Telefon 2" v-model="setting.phone2">
                                <small class="form-text text-muted" v-if="error != null && error.phone2">{{ error.phone2[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="Email1">Email 1</label>
                                <input type="email" name="Email1" class="form-control" id="Email1" placeholder="Enter email 1" v-model="setting.email1">
                                <small class="form-text text-muted" v-if="error != null && error.email1">{{ error.email1[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="Email2">Email 2</label>
                                <input type="email" name="Email2" class="form-control" id="Email2" placeholder="Enter email 2" v-model="setting.email2">
                                <small class="form-text text-muted" v-if="error != null && error.email2">{{ error.email2[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="facebook">Facebook</label>
                                <input type="text" name="Email2" class="form-control" id="facebook" placeholder="Enter facebook" v-model="setting.facebook">
                                <small class="form-text text-muted" v-if="error != null && error.facebook">{{ error.facebook[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="facebook">Twitter</label>
                                <input type="text" name="Twitter" class="form-control" id="twitter" placeholder="Enter twitter" v-model="setting.twitter">
                                <small class="form-text text-muted" v-if="error != null && error.twitter">{{ error.twitter[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="instagram">Instagram</label>
                                <input type="text" name="Instagram" class="form-control" id="instagram" placeholder="Enter instagram" v-model="setting.instagram">
                                <small class="form-text text-muted" v-if="error != null && error.instagram">{{ error.instagram[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="pinterest">Pinterest</label>
                                <input type="text" name="pinterest" class="form-control" id="pinterest" placeholder="Enter pinterest" v-model="setting.pinterest">
                                <small class="form-text text-muted" v-if="error != null && error.pinterest">{{ error.pinterest[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="google">Google +</label>
                                <input type="text" name="google" class="form-control" id="google" placeholder="Enter google plus" v-model="setting.google">
                                <small class="form-text text-muted" v-if="error != null && error.google">{{ error.google[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="youtube">Youtube</label>
                                <input type="text" name="youtube" class="form-control" id="youtube" placeholder="Enter youtube" v-model="setting.youtube">
                                <small class="form-text text-muted" v-if="error != null && error.youtube">{{ error.youtube[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="analytics">Google Analitika</label>
                                <textarea name="Analytics" id="analytics" cols="5" rows="5" v-model="setting.analytics" class="form-control">{{ setting.analytics}}</textarea>
                                <small class="form-text text-muted" v-if="error != null && error.analytics">{{ error.analytics[0] }}</small>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">

                            <form @submit.prevent="submit()">
                                <div class="form-group">
                                    <label for="address">Adresa</label>
                                    <input type="text" name="address" class="form-control" id="address" placeholder="Adresa" v-model="setting.address">
                                    <small class="form-text text-muted" v-if="error != null && error.address">{{ error.address[0] }}</small>
                                </div>
                                <div class="form-group">
                                    <label for="title">Naslov sajta</label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Naslov sajta" v-model="setting.title">
                                    <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                                </div>
                                <div class="form-group">
                                    <label for="keywords">Ključne reči</label>
                                    <input type="text" name="keywords" class="form-control" id="keywords" placeholder="Ključne reči" v-model="setting.keywords">
                                    <small class="form-text text-muted" v-if="error != null && error.keywords">{{ error.keywords[0] }}</small>
                                </div>
                                <div class="form-group">
                                    <label for="desc">Opis</label>
                                    <textarea name="desc" id="desc" class="form-control" v-model="setting.desc"></textarea>
                                    <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.desc[0] }}</small>
                                </div>
                                <div class="form-group">
                                    <label>Footer tekst</label>
                                    <ckeditor
                                            v-model="setting.footer"
                                            :config="config">
                                    </ckeditor>
                                    <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.footer[0] }}</small>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Izmeni</button>
                                </div>
                            </form>
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
    import Ckeditor from 'vue-ckeditor2';

    export default {
        data(){
          return {
              setting: {},
              error: null,
              config: {
                  toolbar: [
                      ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', 'Image']
                  ],
                  height: 300,
                  filebrowserBrowseUrl: 'media'
              }
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'switches': Switches,
            'ckeditor': Ckeditor
        },
        created(){
            this.getSetting();
        },
        methods: {
            getSetting(){
                axios.get('api/settings/1/edit')
                    .then(res => {
                        if(res.data.setting != null){
                            this.setting = res.data.setting;
                        }
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                axios.put('api/settings/1', this.setting)
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
        }
    }
</script>