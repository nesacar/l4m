<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/clients'">Klijenti</router-link></li>
                            <li>Izmena klijenta</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena klijenta</h5>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="form-group">
                            <label>Publikovano</label><br>
                            <switches v-model="client.publish" theme="bootstrap" color="primary"></switches>
                        </div>

                        <upload-image-helper
                                :image="client.image"
                                :defaultImage="null"
                                :titleImage="'klijenta'"
                                :error="error"
                                @uploadImage="upload($event)"
                                @removeRow="remove($event)"
                        ></upload-image-helper>

                        <upload-image-helper
                                :image="client.cover"
                                :defaultImage="null"
                                :titleImage="'klijenta'"
                                :error="error"
                                @uploadImage="uploadCover($event)"
                                @removeRow="remove($event)"
                        ></upload-image-helper>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <form @submit.prevent="submit()">
                            <div class="form-group">
                                <label for="name">Ime klijenta <span>*</span></label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Ime klijenta" v-model="client.name">
                                <small class="form-text text-muted" v-if="error != null && error.name">{{ error.name[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="fullName">Puno ime klijenta</label>
                                <input type="text" name="name" class="form-control" id="fullName" placeholder="Puno ime klijenta" v-model="client.fullName">
                                <small class="form-text text-muted" v-if="error != null && error.fullName">{{ error.fullName[0] }}</small>
                            </div>
                            <div class="form-group" v-if="brands">
                                <label>Brendovi</label>
                                <select2 :options="brands" :value="client.brand_ids" :multiple="true" @input="input($event)">
                                    <option value="0" disabled>select one</option>
                                </select2>
                            </div>
                            <div class="form-group">
                                <label for="short">Kratak opis</label>
                                <textarea name="short" id="short" cols="3" rows="4" class="form-control" placeholder="Kratak opis" v-model="client.short"></textarea>
                                <small class="form-text text-muted" v-if="error != null && error.short">{{ error.short[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label>Opis</label>
                                <ckeditor
                                        v-model="client.body"
                                        :config="config">
                                </ckeditor>
                                <small class="form-text text-muted" v-if="error != null && error.body">{{ error.body[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="order">Redosled</label>
                                <input type="text" name="order" class="form-control" id="order" placeholder="Redosled" v-model="client.order">
                                <small class="form-text text-muted" v-if="error != null && error.order">{{ error.order[0] }}</small>
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
    import UploadImageHelper from '../helper/UploadImageHelper.vue';
    import swal from 'sweetalert2';
    import Switches from 'vue-switches';
    import Ckeditor from 'vue-ckeditor2';
    import Select2 from '../helper/Select2Helper.vue';

    export default {
        data(){
          return {
              client: {},
              brands: {},
              error: null,
              config: {
                  toolbar: [
                      [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', 'Image', 'Link', 'Unlink', 'Source' ],
                      { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
                      '/',
                      { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
                  ],
                  height: 300,
                  filebrowserBrowseUrl: 'media'
              }
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
            'switches': Switches,
            'ckeditor': Ckeditor,
            'select2': Select2,
        },
        mounted(){
            this.getBrands();
        },
        methods: {
            getBrands(){
                axios.get('api/brands/lists')
                    .then(res => {
                        this.brands = _.map(res.data.brands, (data) => {
                            var pick = _.pick(data, 'title', 'id');
                            var object = {id: pick.id, text: pick.title};
                            return object;
                        });
                        this.getClient();
                        this.error = null;
                    }).catch(e => {
                    console.log(e);
                    this.error = e.response.data.errors;
                });
            },
            getClient(){
                axios.get('api/clients/' + this.$route.params.id)
                    .then(res => {
                        this.client = res.data.client;
                        this.client.brand_ids = res.data.brand_ids;
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                axios.put('api/clients/' + this.client.id, this.client)
                    .then(res => {
                        this.client = res.data.client;
                        this.client.brand_ids = res.data.brand_ids;
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
                let data = new FormData();
                data.append('image', image.file);

                axios.post('api/clients/' + this.client.id + '/image', data)
                    .then(res => {
                        this.client.image = res.data.image;
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
            uploadCover(image){
                let data = new FormData();
                data.append('cover', image.file);

                axios.post('api/clients/' + this.client.id + '/image', data)
                    .then(res => {
                        this.client.cover = res.data.image;
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
            input(brand){
                this.client.brand_ids = brand;
            },
        }
    }
</script>