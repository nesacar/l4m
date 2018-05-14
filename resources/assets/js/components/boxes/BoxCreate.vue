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
                            <div class="form-group">
                                <label for="block">Šablon</label>
                                <select name="block" id="block" class="form-control" v-model="box.block_id">
                                    <option :value="index" v-for="(block, index) in lists">{{ block }}</option>
                                </select>
                                <small class="form-text text-muted" v-if="error != null && error.block_id">{{ error.block_id[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="category">Kategorija</label>
                                <select name="category" id="category" class="form-control" v-model="box.category_id">
                                    <option :value="index" v-for="(category, index) in categories">{{ category }}</option>
                                </select>
                                <small class="form-text text-muted" v-if="error != null && error.category_id">{{ error.category_id[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="title">Naslov</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Naslov" v-model="box.title">
                                <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="subtitle">Podnaslov</label>
                                <input type="text" name="subtitle" class="form-control" id="subtitle" placeholder="Opis" v-model="box.subtitle">
                                <small class="form-text text-muted" v-if="error != null && error.subtitle">{{ error.subtitle[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="button">Dugme</label>
                                <input type="text" name="button" class="form-control" id="button" placeholder="Dugme" v-model="box.button">
                                <small class="form-text text-muted" v-if="error != null && error.button">{{ error.button[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="link">Link</label>
                                <input type="text" name="link" class="form-control" id="link" placeholder="Dugme" v-model="box.link">
                                <small class="form-text text-muted" v-if="error != null && error.link">{{ error.link[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="order">Redosled</label>
                                <input type="text" name="link" class="form-control" id="order" placeholder="Redosled" v-model="box.order">
                                <small class="form-text text-muted" v-if="error != null && error.order">{{ error.order[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label>Publikovano</label><br>
                                <switches v-model="box.publish" theme="bootstrap" color="primary"></switches>
                            </div>
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
    import Switches from 'vue-switches';
    import UploadImageHelper from '../helper/UploadImageHelper.vue';

    export default {
        data(){
          return {
              image: {},
              box: {},
              lists: {},
              categories: {},
              error: null,
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'switches': Switches,
            'upload-image-helper': UploadImageHelper,
        },
        created(){
            this.getBlocks();
            this.getCategories();
        },
        methods: {
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
            getBlocks(){
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
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
        }
    }
</script>