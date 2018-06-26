<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/boxes'">Slajdovi</router-link></li>
                            <li>Kreiraj slajd</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Kreiraj slajd</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card">
                        <form @submit.prevent="submit()">

                            <select-field v-if="lists" :labela="'Šablon'" :options="lists" :value="null" :error="error? error.block_id : ''" @changeValue="box.block_id = $event"></select-field>

                            <select-field v-if="categories" :labela="'Kategorija'" :options="categories" :value="null" :error="error? error.category_id : ''" @changeValue="box.category_id = $event"></select-field>

                            <text-field :value="box.title" :label="'Naslov'" :error="error? error.title : ''" @changeValue="box.title = $event"></text-field>

                            <text-field :value="box.subtitle" :label="'Podnaslov'" :error="error? error.subtitle : ''" @changeValue="box.subtitle = $event"></text-field>

                            <text-field :value="box.button" :label="'Dugme'" :error="error? error.button : ''" @changeValue="box.button = $event"></text-field>

                            <text-field :value="box.link" :label="'Link'" :error="error? error.link : ''" @changeValue="box.link = $event"></text-field>

                            <text-field :value="box.order" :label="'Redosled'" :error="error? error.order : ''" @changeValue="box.order = $event"></text-field>

                            <checkbox-field :value="box.publish" :label="'Publikovano'" @changeValue="box.publish = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Kreiraj</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <upload-image-helper
                            :image="box.image"
                            :defaultImage="null"
                            :titleImage="'slajda'"
                            :dimensions="'996x300'"
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
    import swal from 'sweetalert2';
    import UploadImageHelper from '../helper/UploadImageHelper.vue';

    export default {
        data(){
          return {
              image: {},
              box: {},
              lists: false,
              categories: false,
              error: null,
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
        },
        mounted(){
            this.getCategories();
        },
        methods: {
            getBlock(){
                axios.get('api/blocks/lists')
                    .then(res => {
                        this.lists = res.data.blocks;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            getCategories(){
                axios.get('api/categories/lists')
                    .then(res => {
                        this.categories = res.data.categories;
                        this.getBlock();
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                axios.post('api/boxes', this.box)
                    .then(res => {
                        this.box = res.data.box;
                        this.sendImage();
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Uspeh',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/boxes');
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            prepare(image){
                this.box.image = image.src;
                this.image = new FormData();
                this.image.append('file', image.file);
            },
            sendImage(){
                axios.post('api/boxes/' + this.box.id + '/image', this.image)
                    .then(res => {
                        this.box.image = res.data.image;
                        this.error = null;
                    }).catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
        }
    }
</script>