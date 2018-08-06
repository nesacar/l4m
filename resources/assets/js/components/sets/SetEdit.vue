<template>
    <div id="place">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/sets'" >Setovi</router-link></li>
                            <li>Izmena setova</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena setova</h5>
                    </div>
                </div>

                <div class="col-md-4">

                    <div class="card" v-if="setData">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="srb" role="tabpanel" aria-labelledby="srb-tab">
                                <form @submit.prevent="submit()">

                                    <text-field :value="setData.title" :label="'Naslov'" :error="error? error.title : ''" @changeValue="setData.title = $event"></text-field>
                                    <text-field :value="setData.slug" :label="'Slug'" :error="error? error.slug : ''" @changeValue="setData.slug = $event"></text-field>
                                    <text-area-field :value="setData.short" :label="'Kratak opis'" :error="error? error.short : ''" @changeValue="setData.short = $event"></text-area-field>
                                    <select-multiple-field
                                            :options="properties"
                                            :error="error ? error.property_ids : ''"
                                            :value="property_ids"
                                    ></select-multiple-field>
                                    <checkbox-field
                                            :value="setData.publish"
                                            :label="'Publikovano'"
                                            @changeValue="setData.publish = $event"
                                    ></checkbox-field>

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
                setData: {},
                property_ids: [{id: 1,title: 'kurac'}, {id: 3, title: 'rcma'}],
                properties: [{id: 1, title: 'kurac'}, {id: 2, title: 'picka'}, {id: 3, title: 'rcma'}],
                error: null,
            }
        },

        components: {
            'font-awesome-icon': FontAwesomeIcon,
        },

        mounted() {
            this.$root.$on('changeValue', this.handleChange);
            /* Ovde je vladan nesto zakomplikovao :D */
            Promise.all([this.getSet(), this.getProperties()])
                .then((promises) => {
                    const [res0, res1] = promises;

                    const setData = res0.data.set;
                    const property_ids = res0.data.property_ids;
                    const properties = res1.data.properties;
                    this.setData = setData;
                    this.property_ids = property_ids;
                    this.properties = properties;
                })
                .catch((err) => {
                    console.error(err);
                    this.error = err.response.data.errors;
                });
        },

        destroyed() {
            this.$root.$off('changeValue', this.handleChange);
        },

        methods: {
            handleChange(ids) {
                this.property_ids = ids;
            },

            getSet(){
                return axios.get('api/sets/' + this.$route.params.id);
            },

            getProperties(){
                return axios.get('api/properties/lists');
            },

            submit(){
                const payload = {
                    ...this.setData,
                    property_ids: this.property_ids.map((p) => p.id),
                };
                axios.put('api/sets/' + this.$route.params.id, payload)
                    .then(res => {
                        this.setData = {
                            ...this.setData,
                            ...res.data.set
                        };
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Uspeh',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.error = null;
                    }).catch(e => {
                    console.error(e.response);
                    this.error = e.response.data.errors;
                });
            }

        }
    }
</script>