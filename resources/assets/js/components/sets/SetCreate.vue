<template>
    <div id="place">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/sets'">Setovi</router-link></li>
                            <li>Kreiranje setova</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Kreiranje setova</h5>
                    </div>
                </div>

                <div class="col-md-4">

                    <div class="card">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="srb" role="tabpanel" aria-labelledby="srb-tab">
                                <form @submit.prevent="submit()">

                                    <text-field :value="set.title" :label="'Naslov'" :error="error? error.title : ''" @changeValue="set.title = $event"></text-field>
                                    <text-field :value="set.slug" :label="'Slug'" :error="error? error.slug : ''" @changeValue="set.slug = $event"></text-field>
                                    <text-area-field :value="set.short" :label="'Kratak opis'" :error="error? error.short : ''" @changeValue="set.short = $event"></text-area-field>
                                    <select-multiple-field
                                            :options="properties"
                                            :error="error? error.property_ids : ''"
                                            :value="property_ids"
                                    ></select-multiple-field>
                                    <checkbox-field :value="set.publish" :label="'Publikovano'" @changeValue="set.publish = $event"></checkbox-field>

                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Izmeni</button>
                                    </div>

                                </form>
                            </div><!-- #srb -->
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</template>
<script>
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import swal from 'sweetalert2';

    export default {
        data() {
            return {
                set: {},
                property_ids: [],
                properties: [],
                error: null
            }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
        },
        mounted() {
            this.getProperties();
            this.$root.$on('changeValue', this.handleChange);
        },

        destroyed() {
            this.$root.$off('changeValue', this.handleChange);
        },

        methods: {
            handleChange(data) {
                this.property_ids = data;
            },

            getProperties(){
                axios.get('api/properties/lists')
                    .then(res => {
                        this.properties = res.data.properties;
                    }).catch(e => {
                    this.error = e.response.data.errors;
                })
            },
            submit(){
                const payload = {
                    /**
                     * extend brand with user_id and category_ids. After this brand is
                     * completely new object, there's no mutating.
                     */
                    ...this.set,
                    property_ids: this.property_ids.map((e) => e.id),
                };

                axios.post('api/sets', payload)
                    .then(res => {
                        this.set = res.data.set;
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/sets/create');
                    }).catch(e => {
                    console.log(e.response);
                    this.error = e.response.data.errors;
                });
            }
        }
    }
</script>