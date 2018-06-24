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

                            <text-field :value="setting.phone1" :label="'Telefon 1'" :error="error? error.phone1 : ''" @changeValue="setting.phone1 = $event"></text-field>

                            <text-field :value="setting.phone2" :label="'Telefon 2'" :error="error? error.phone2 : ''" @changeValue="setting.phone2 = $event"></text-field>

                            <email-field :value="setting.email1" :label="'Email 1'" :error="error? error.email1 : ''" @changeValue="setting.email1 = $event"></email-field>

                            <email-field :value="setting.email2" :label="'Email 2'" :error="error? error.email2 : ''" @changeValue="setting.email2 = $event"></email-field>

                            <text-field :value="setting.facebook" :label="'Facebook'" :error="error? error.facebook : ''" @changeValue="setting.facebook = $event"></text-field>

                            <text-field :value="setting.twitter" :label="'Twitter'" :error="error? error.twitter : ''" @changeValue="setting.twitter = $event"></text-field>

                            <text-field :value="setting.instagram" :label="'Instagram'" :error="error? error.instagram : ''" @changeValue="setting.instagram = $event"></text-field>

                            <text-field :value="setting.pinterest" :label="'Pinterest'" :error="error? error.pinterest : ''" @changeValue="setting.pinterest = $event"></text-field>

                            <text-field :value="setting.google" :label="'Google +'" :error="error? error.google : ''" @changeValue="setting.google = $event"></text-field>

                            <text-field :value="setting.youtube" :label="'Youtube'" :error="error? error.youtube : ''" @changeValue="setting.youtube = $event"></text-field>

                            <text-area-field :value="setting.analytics" :label="'Google Analitika'" :error="error? error.analytics : ''" @changeValue="setting.analytics = $event"></text-area-field>

                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card" v-if="setting">

                            <form @submit.prevent="submit()">

                                <text-field :value="setting.address" :label="'Adresa'" :error="error? error.address : ''" @changeValue="setting.address = $event"></text-field>

                                <text-field :value="setting.title" :label="'Naslov sajta'" :error="error? error.title : ''" @changeValue="setting.title = $event"></text-field>

                                <text-field :value="setting.keywords" :label="'Ključne reči'" :error="error? error.keywords : ''" @changeValue="setting.keywords = $event"></text-field>

                                <text-area-field :value="setting.desc" :label="'Opis'" :error="error? error.desc : ''" @changeValue="setting.desc = $event"></text-area-field>

                                <text-area-ckeditor-field v-if="setting.footer" :value="setting.footer" :label="'Opis'" :error="error? error.footer : ''" @changeValue="setting.footer = $event"></text-area-ckeditor-field>

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

    export default {
        data(){
          return {
              setting: false,
              error: null,
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
        },
        mounted(){
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