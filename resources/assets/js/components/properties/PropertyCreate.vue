<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/properties'">Osobine</router-link></li>
                            <li>Kreiranje osobine</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Kreiranje osobine</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card">
                        <form @submit.prevent="submit()">

                            <select2-multiple-field :lists="categories" :label="'Kategorije'" :required="true" :error="error? error.cat_ids : ''" @changeValue="property.cat_ids = $event"></select2-multiple-field>

                            <text-field :value="property.title" :label="'Naziv'" :required="true" :error="error? error.title : ''" @changeValue="property.title = $event"></text-field>

                            <text-field :value="property.order" :label="'Redosled'" :required="true" :error="error? error.order : ''" @changeValue="property.order = $event"></text-field>

                            <text-field :value="property.extra" :label="'Dodatak'" :error="error? error.extra : ''" @changeValue="property.extra = $event"></text-field>

                            <checkbox-field :value="property.publish" :label="'Publikovano'" @changeValue="property.publish = $event"></checkbox-field>

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

    export default {
        data(){
          return {
              property: {},
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
        mounted(){
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
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                axios.post('api/properties', this.property)
                    .then(res => {
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/properties');
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
        }
    }
</script>