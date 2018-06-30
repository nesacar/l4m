<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/collections'">Kolekcije</router-link></li>
                            <li>Izmena brenda</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena brenda</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card" v-if="lists">
                        <form @submit.prevent="submit()">

                            <select-field v-if="lists" :labela="'Brend'" :options="lists" :error="error? error.brand_id : ''" :value="collection.brand" @changeValue="collection.brand_id = $event"></select-field>

                            <text-field :value="collection.title" :label="'Naziv'" :error="error? error.title : ''" :required="true" @changeValue="collection.title = $event"></text-field>

                            <text-field :value="collection.slug" :label="'Slug'" :error="error? error.slug : ''" @changeValue="collection.slug = $event"></text-field>

                            <text-field :value="collection.order" :label="'Redosled'" :error="error? error.order : ''" :required="true" @changeValue="collection.order = $event"></text-field>

                            <text-area-field :value="collection.short" :label="'Kratak opis'" :error="error? error.short : ''" @changeValue="collection.short = $event"></text-area-field>

                            <text-area-ckeditor-field v-if="collection.body" :value="collection.body" :label="'Opis'" :error="error? error.body : ''" @changeValue="collection.body = $event"></text-area-ckeditor-field>

                            <checkbox-field :value="collection.publish" :label="'Publikovano'" @changeValue="collection.publish = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Izmeni</button>
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
            this.getCollection();
        },
        methods: {
            getCollection(){
                axios.get('api/collections/' + this.$route.params.id)
                    .then(res => {
                        this.lists = res.data.brands;
                        this.collection = res.data.collection;
                        this.collection.brand = res.data.brand;
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                this.collection.user_id = this.user.id;
                axios.put('api/collections/' + this.collection.id, this.collection)
                    .then(res => {
                        this.collection = res.data.collection;
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Uspeh',
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
                this.collection.image = image.src;
                data.append('file', image.file);

                axios.post('api/collections/' + this.collection.id + '/image', data)
                    .then(res => {
                        this.collection.image = res.data.image;
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