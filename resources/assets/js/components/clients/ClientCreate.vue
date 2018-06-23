<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/clients'">Klijenti</router-link></li>
                            <li>Kreiraj klijenta</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Kreiraj klijenta</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card" v-if="brands">
                        <form @submit.prevent="submit()">

                            <text-field :value="client.title" :label="'Ime klijenta'" :required="true" :error="error? error.title : ''" @changeValue="client.title = $event"></text-field>

                            <text-field :value="client.slug" :label="'Slug'" :error="error? error.slug : ''" @changeValue="client.slug = $event"></text-field>

                            <text-field :value="client.fullName" :label="'Puno ime klijenta'" :error="error? error.fullName : ''" @changeValue="client.fullName = $event"></text-field>

                            <select2-multiple-field :lists="brands" :label="'Brendovi'" @changeValue="client.brand_ids = $event"></select2-multiple-field>

                            <text-area-field :value="client.short" :label="'Kratak opis'" :error="error? error.short : ''" @changeValue="client.short = $event"></text-area-field>

                            <text-area-ckeditor-field :value="client.body" :label="'Opis'" :error="error? error.body : ''" @changeValue="client.body = $event"></text-area-ckeditor-field>

                            <text-field :value="client.order" :label="'Redosled'" :error="error? error.order : ''" @changeValue="client.order = $event"></text-field>

                            <checkbox-field :value="client.publish" :label="'Publikovano'" @changeValue="client.publish = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Kreiraj</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <upload-image-helper
                            :image="client.image"
                            :defaultImage="null"
                            :titleImage="'klijenta'"
                            :error="error"
                            @uploadImage="prepare($event)"
                            @removeRow="remove($event)"
                    ></upload-image-helper>

                    <upload-image-helper
                            :image="client.cover"
                            :defaultImage="null"
                            :titleImage="'klijenta'"
                            :error="error"
                            @uploadImage="prepareCover($event)"
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
    import Select2 from '../helper/Select2Helper.vue';

    export default {
        data(){
          return {
              image: {},
              cover: {},
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
            submit(){
                axios.post('api/clients', this.client)
                    .then(res => {
                        this.client = res.data.client;
                        this.sendImage();
                        this.sendCover();
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Uspeh',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/clients');
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            getBrands(){
                axios.get('api/brands/lists')
                    .then(res => {
                        this.brands = res.data.brands;
//                        this.brands = _.map(res.data.brands, (data) => {
//                            var pick = _.pick(data, 'title', 'id');
//                            var object = {id: pick.id, text: pick.title};
//                            return object;
//                        });
                        this.error = null;
                    }).catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            prepare(image){
                this.client.imageTemp = image.src;
                this.image = new FormData();
                this.image.append('image', image.file);
            },
            prepareCover(image){
                this.client.coverTemp = image.src;
                this.cover = new FormData();
                this.cover.append('cover', image.file);
            },
            sendImage(){
                axios.post('api/clients/' + this.client.id + '/image', this.image)
                    .then(res => {
                        this.client.image = res.data.image;
                        this.error = null;
                    }).catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            sendCover(){
                axios.post('api/clients/' + this.client.id + '/image', this.cover)
                    .then(res => {
                        this.cover.image = res.data.image;
                        this.error = null;
                    }).catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
        }
    }
</script>