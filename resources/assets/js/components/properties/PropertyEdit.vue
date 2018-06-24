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
                    <div class="card" v-if="property">
                        <form @submit.prevent="submit()">

                            <select2-multiple-field :lists="categories" :value="property.cat_ids" :label="'Kategorije'" :required="true" :error="error? error.cat_ids : ''" @changeValue="property.cat_ids = $event"></select2-multiple-field>

                            <text-field :value="property.title" :label="'Naziv'" :required="true" :error="error? error.title : ''" @changeValue="property.title = $event"></text-field>

                            <text-field :value="property.order" :label="'Redosled'" :required="true" :error="error? error.order : ''" @changeValue="property.order = $event"></text-field>

                            <text-field :value="property.extra" :label="'Dodatak'" :error="error? error.extra : ''" @changeValue="property.extra = $event"></text-field>

                            <checkbox-field :value="property.publish" :label="'Publikovano'" @changeValue="property.publish = $event"></checkbox-field>

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

    export default {
        data(){
          return {
              property: false,
              categories: {},
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
        },
        created(){
            this.getTopCategories();
        },
        methods: {
            getTopCategories(){
                axios.get('api/categories/top-lists')
                    .then(res => {
                        this.categories = _.map(res.data.categories, (data) => {
                            var pick = _.pick(data, 'title', 'id');
                            var object = {id: pick.id, text: pick.title};
                            return object;
                        });
                        this.getProperty();
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            getProperty(){
                axios.get('api/properties/' + this.$route.params.id)
                    .then(res => {
                        this.property = res.data.property;
                        this.property.cat_ids = res.data.cat_ids;
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
                        this.property.cat_ids = res.data.cat_ids;
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