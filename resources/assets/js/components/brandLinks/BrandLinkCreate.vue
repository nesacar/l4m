<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li v-if="brand"><router-link tag="a" :to="'/brands/' + brand.id">{{ brand.title }}</router-link></li>
                            <li>Linkovi</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Kreiranje linka za brend: {{ brand.title }}</h5>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="card">
                        <form @submit.prevent="submit()">
                            <div class="form-group">
                                <label for="title">Naziv <span>*</span></label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Naziv" v-model="link.title">
                                <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="slug">Link <span>*</span></label>
                                <input type="text" name="slug" class="form-control" id="slug" placeholder="Link" v-model="link.link">
                                <small class="form-text text-muted" v-if="error != null && error.link">{{ error.link[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="order">Redosled</label>
                                <input type="text" name="order" class="form-control" id="order" placeholder="Redosled" v-model="link.order">
                                <small class="form-text text-muted" v-if="error != null && error.order">{{ error.order[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label>Publikovano</label><br>
                                <switches v-model="link.publish" theme="bootstrap" color="primary"></switches>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Kreiraj</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { apiHost } from '../../config';
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import swal from 'sweetalert2';
    import Switches from 'vue-switches';

    export default {
        data(){
          return {
              link: {
                  publish: false
              },
              brand: {},
              error: null,
              domain : apiHost
          }
        },
        computed: {
            user(){
                return this.$store.getters.getUser;
            },
        },
        created(){
            this.getBrand();
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'switches': Switches,
        },
        methods: {
            getBrand(){
                axios.get('api/brands/' + this.$route.params.brand)
                    .then(res => {
                        this.brand = res.data.brand;
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                axios.post('api/brand-links/' + this.brand.id, this.link)
                    .then(res => {
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/brand-links/' + this.brand.id);
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
        }
    }
</script>

<style scope>
    span {
        color: red;
    }
</style>