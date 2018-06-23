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
                    <div class="card"  v-if="client">

                        <checkbox-field :value="client.publish" :label="'Publikovano'" @changeValue="client.publish = $event"></checkbox-field>

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
                    <div class="card" v-if="brands">

                        <form @submit.prevent="submit()">

                            <text-field :value="client.title" :label="'Ime klijenta'" :required="true" :error="error? error.title : ''" @changeValue="client.title = $event"></text-field>

                            <text-field :value="client.slug" :label="'Slug'" :error="error? error.slug : ''" @changeValue="client.slug = $event"></text-field>

                            <text-field :value="client.fullName" :label="'Puno ime klijenta'" :error="error? error.fullName : ''" @changeValue="client.fullName = $event"></text-field>

                            <select2-multiple-field :lists="brands" :label="'Brendovi'" :value="client.brand_ids" @changeValue="client.brand_ids = $event"></select2-multiple-field>

                            <text-area-field :value="client.short" :label="'Kratak opis'" :error="error? error.short : ''" @changeValue="client.short = $event"></text-area-field>

                            <text-area-ckeditor-field v-if="client" :value="client.body" :label="'Opis'" :error="error? error.body : ''" @changeValue="client.body = $event"></text-area-ckeditor-field>

                            <text-field :value="client.order" :label="'Redosled'" :error="error? error.order : ''" @changeValue="client.order = $event"></text-field>

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

    export default {
        data(){
          return {
              client: false,
              brands: false,
              error: null,
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
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
        }
    }
</script>