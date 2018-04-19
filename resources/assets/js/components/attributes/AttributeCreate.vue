<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/attributes'">Atributi</router-link></li>
                            <li>Kreiranje atributa</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Kreiranje atributa</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card">
                        <form @submit.prevent="submit()">
                            <div class="form-group">
                                <label for="property">Osobina</label>
                                <select name="property" id="property" class="form-control" v-model="attribute.property_id">
                                    <option :value="index" v-for="(set, index) in lists">{{ set }}</option>
                                </select>
                                <small class="form-text text-muted" v-if="error != null && error.property_id">{{ error.property_id[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="title">Naziv</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Naslov" v-model="attribute.title">
                                <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="order">Redosled</label>
                                <input type="text" name="slug" class="form-control" id="order" placeholder="Redosled" v-model="attribute.order">
                                <small class="form-text text-muted" v-if="error != null && error.order">{{ error.order[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="extra">Dodatak</label>
                                <input type="text" name="extra" class="form-control" id="extra" placeholder="Dodatak" v-model="attribute.extra">
                                <small class="form-text text-muted" v-if="error != null && error.extra">{{ error.extra[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label>Publikovano</label><br>
                                <switches v-model="attribute.publish" theme="bootstrap" color="primary"></switches>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Kreiraj</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">

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
              attribute: {},
              lists: {},
              error: null,
              domain : apiHost
          }
        },
        computed: {
            user(){
                return this.$store.getters.getUser;
            },
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'switches': Switches,
        },
        created(){
            this.getProperties();
        },
        methods: {
            getProperties(){
                axios.get('api/properties/lists')
                    .then(res => {
                        this.lists = res.data.properties;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                axios.post('api/attributes', this.attribute)
                    .then(res => {
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/attributes');
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
        }
    }
</script>