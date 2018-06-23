<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/boxes'">Slajdovi</router-link></li>
                            <li>Izmena slajda</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena slajda</h5>
                    </div>
                </div>

                <div class="col-md-4">

                    <upload-image-helper
                            :image="box.image"
                            :defaultImage="null"
                            :titleImage="'slajda'"
                            :dimensions="'996x300'"
                            :error="error"
                            @uploadImage="upload($event)"
                            @removeRow="remove($event)"
                    ></upload-image-helper>

                    <upload-image-helper
                            :image="box.small_image"
                            :defaultImage="null"
                            :titleImage="'slajda (mala)'"
                            :error="error"
                            @uploadImage="uploadSmall($event)"
                            @removeRow="remove($event)"
                    ></upload-image-helper>
                </div>
                <div class="col-md-8">
                    <div class="card" v-if="box">

                        <form @submit.prevent="submit()">

                            <select2-field :lists="lists" :value="box.block_id" :label="'Šablon'" :error="error? error.block_id : ''" @changeValue="box.block_id = $event"></select2-field>

                            <select2-field :lists="categories" :value="box.category_id" :label="'Kategorija'" :error="error? error.category_id : ''" @changeValue="box.category_id = $event"></select2-field>

                            <text-field :value="box.title" :label="'Naslov'" :error="error? error.title : ''" @changeValue="box.title = $event"></text-field>

                            <text-field :value="box.subtitle" :label="'Podnaslov'" :error="error? error.subtitle : ''" @changeValue="box.subtitle = $event"></text-field>

                            <text-field :value="box.button" :label="'Dugme'" :error="error? error.button : ''" @changeValue="box.button = $event"></text-field>

                            <text-field :value="box.link" :label="'Link'" :error="error? error.link : ''" @changeValue="box.link = $event"></text-field>

                            <text-field :value="box.order" :label="'Redosled'" :error="error? error.order : ''" @changeValue="box.order = $event"></text-field>

                            <checkbox-field :value="box.publish" :label="'Publikovano'" @changeValue="box.publish = $event"></checkbox-field>

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
    import UploadImageHelper from '../helper/UploadImageHelper.vue';

    export default {
        data(){
          return {
              box: false,
              lists: {},
              categories: {},
              error: null
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
        },
        created(){
            this.getBlocks();
            this.getCategories();
        },
        methods: {
            getBox(){
                axios.get('api/boxes/' + this.$route.params.id)
                    .then(res => {
                        this.box = res.data.box;
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                axios.put('api/boxes/' + this.box.id, this.box)
                    .then(res => {
                        this.box = res.data.box;
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
            getBlocks(){
                axios.get('api/blocks/lists')
                    .then(res => {
                        this.lists = res.data.blocks;
                        this.getBox();
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            upload(image){
                let data = new FormData();
                data.append('file', image.file);

                axios.post('api/boxes/' + this.box.id + '/image', data)
                    .then(res => {
                        this.box.image = res.data.image;
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
            uploadSmall(image){
                this.box.image = image.src;
                let data = new FormData();
                data.append('file', image.file);

                axios.post('api/boxes/' + this.box.id + '/smallImage', data)
                    .then(res => {
                        this.box.small_image = res.data.image;
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
            getCategories(){
                axios.get('api/categories/lists')
                    .then(res => {
                        this.categories = res.data.categories;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            }
        }
    }
</script>