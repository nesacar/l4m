<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/themes'">Teme</router-link></li>
                            <li>Kreiranje teme</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Kreiranje teme</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card">
                        <form @submit.prevent="submit()">

                            <text-field :value="theme.title" :label="'Naziv'" :error="error? error.title : ''" :required="true" @changeValue="theme.title = $event"></text-field>

                            <text-field :value="theme.version" :label="'Verzija'" :error="error? error.version : ''" @changeValue="theme.version = $event"></text-field>

                            <text-field :value="theme.author" :label="'Autor'" :error="error? error.author : ''" @changeValue="theme.author = $event"></text-field>

                            <text-field :value="theme.author_address" :label="'Adresa autora'" :required="true" :error="error? error.author_address : ''" @changeValue="theme.author_address = $event"></text-field>

                            <text-field :value="theme.author_email" :label="'Email autora'" :error="error? error.author_email : ''" @changeValue="theme.author_email = $event"></text-field>

                            <text-field :value="theme.developer" :label="'Programer'" :error="error? error.developer : ''" @changeValue="theme.developer = $event"></text-field>

                            <checkbox-field :value="theme.publish" :label="'Publikovano'" @changeValue="theme.publish = $event"></checkbox-field>

                            <checkbox-field :value="theme.active" :label="'Aktivna'" @changeValue="theme.active = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Kreiraj</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <upload-image-helper
                            :image="theme.image"
                            :defaultImage="null"
                            :titleImage="'theme'"
                            :error="error"
                            @uploadImage="prepare($event)"
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
              image: {},
              theme: {},
              error: null
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
        },
        methods: {
            submit(){
                axios.post('api/themes', this.theme)
                    .then(res => {
                        this.theme = res.data.theme;
                        this.sendImage();
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/themes');
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            prepare(image){
                this.theme.image = image.src;
                this.image = new FormData();
                this.image.append('file', image.file);
            },
            sendImage(){
                axios.post('api/themes/' + this.theme.id + '/image', this.image)
                    .then(res => {
                        this.theme.image = res.data.image;
                        this.error = null;
                    }).catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
        }
    }
</script>