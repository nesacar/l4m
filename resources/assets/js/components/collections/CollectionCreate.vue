<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/collections'">Kolekcije</router-link></li>
                            <li>Kreiranje kolekcije</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Kreiranje kolekcije</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card">
                        <form @submit.prevent="submit()">

                            <select-field v-if="lists" :labela="'Brend'" :options="lists" :error="error? error.brand_id : ''" :value="null" @changeValue="collection.brand_id = $event"></select-field>

                            <text-field :value="collection.title" :label="'Naziv'" :error="error? error.title : ''" :required="true" @changeValue="collection.title = $event"></text-field>

                            <text-field :value="collection.slug" :label="'Slug'" :error="error? error.slug : ''" @changeValue="collection.slug = $event"></text-field>

                            <text-field :value="collection.order" :label="'Redosled'" :error="error? error.order : ''" :required="true" @changeValue="collection.order = $event"></text-field>

                            <text-area-field :value="collection.short" :label="'Kratak opis'" :error="error? error.short : ''" @changeValue="collection.short = $event"></text-area-field>

                            <text-area-ckeditor-field :value="collection.body" :label="'Opis'" :error="error? error.body : ''" @changeValue="collection.body = $event"></text-area-ckeditor-field>

                            <checkbox-field :value="collection.publish" :label="'Publikovano'" @changeValue="collection.publish = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Kreiraj</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <upload-image-helper
                            :image="collection.image"
                            :defaultImage="null"
                            :titleImage="'kolekcije'"
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
              collection: {},
              lists: false,
              error: null,
          }
        },
        computed: {
            user(){
                return this.$store.getters.getUser;
            },
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
        },
        mounted(){
            this.getList();
        },
        methods: {
            submit(){
                this.collection.user_id = this.user.id;
                axios.post('api/collections', this.collection)
                    .then(res => {
                        this.collection = res.data.collection;
                        this.sendImage();
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/collections');
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            prepare(image){
                this.collection.image = image.src;
                this.image = new FormData();
                this.image.append('file', image.file);
            },
            sendImage(){
                axios.post('api/collections/' + this.collection.id + '/image', this.image)
                    .then(res => {
                        this.collection.image = res.data.image;
                        this.error = null;
                    }).catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            getList(){
                axios.get('api/brands/lists')
                    .then(res => {
                        this.lists = res.data.brands;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
        }
    }
</script>