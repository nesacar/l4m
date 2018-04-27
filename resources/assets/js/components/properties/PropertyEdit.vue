<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/properties'">Osobine</router-link></li>
                            <li>Izmena osobine</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena osobine</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card">
                        <form @submit.prevent="submit()">
                            <div class="form-group" v-if="seen">
                                <label>Set</label>
                                <select2 :options="sets" :value="property.sets" :multiple="true" @input="input($event)">
                                    <option value="0" disabled>select one</option>
                                </select2>
                                <small class="form-text text-muted" v-if="error != null && error.sets">{{ error.sets[0] }}</small>
                            </div>
                            <div class="form-group" v-else>
                                <label>Set</label>
                                <select class="form-control">
                                    <option value="0" disabled>select one</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Naziv</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Naslov" v-model="property.title">
                                <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="order">Redosled</label>
                                <input type="text" name="slug" class="form-control" id="order" placeholder="Redosled" v-model="property.order">
                                <small class="form-text text-muted" v-if="error != null && error.order">{{ error.order[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="extra">Dodatak</label>
                                <input type="text" name="extra" class="form-control" id="extra" placeholder="Dodatak" v-model="property.extra">
                                <small class="form-text text-muted" v-if="error != null && error.extra">{{ error.extra[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label>Publikovano</label><br>
                                <switches v-model="property.publish" theme="bootstrap" color="primary"></switches>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Izmeni</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <ul class="list-group">
                            <li class="list-group-item" v-for="attribute in property.attribute">
                                <span>{{ attribute.title }}</span>
                                <router-link tag="a" :to="'/attributes/' + attribute.id + '/edit'" class="btn btn-primary">Izmeni</router-link>
                            </li>
                        </ul>
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
    import Select2 from '../helper/Select2Helper.vue';

    export default {
        data(){
          return {
              property: {
                  sets: []
              },
              seen: false,
              sets: {},
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
            'select2': Select2,
        },
        created(){
            this.getProperty();
            this.getSets();
            setTimeout(() => {
                this.seen = true;
            }, 1000);
        },
        methods: {
            getSets(){
                axios.get('api/sets/lists')
                    .then(res => {
                        this.sets = _.map(res.data.sets, (data) => {
                            var pick = _.pick(data, 'title', 'id');
                            var object = {id: pick.id, text: pick.title};
                            return object;
                        });
                    }).catch(e => {
                    console.log(e.response);
                    this.error = e.response.data.errors;
                });
            },
            getProperty(){
                axios.get('api/properties/' + this.$route.params.id)
                    .then(res => {
                        this.property = res.data.property;
                        this.property.sets = res.data.sets;
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                axios.put('api/properties/' + this.property.id, this.property)
                    .then(res => {
                        this.property = res.data.property;
                        this.property.sets = res.data.sets;
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
            input(set){
                this.property.sets = set;
            },
        }
    }
</script>

<style lang="scss" scoped>
    .list-group-item{
        display: flex;

        span{
            flex: 1;
        }
    }
</style>