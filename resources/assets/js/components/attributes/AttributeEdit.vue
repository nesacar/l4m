<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/attributes'">Atributi</router-link></li>
                            <li>Izmena atributa</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena atributa</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card" v-if="attribute">
                        <form @submit.prevent="submit()">

                            <select-field v-if="lists" :labela="'Osobina'" :options="lists" :value="attribute.property" :error="error? error.property_id : ''" @changeValue="attribute.property_id = $event"></select-field>

                            <text-field :value="attribute.title" :label="'Naziv'" :error="error? error.title : ''" @changeValue="attribute.title = $event"></text-field>

                            <text-field :value="attribute.order" :label="'Redosled'" :error="error? error.order : ''" @changeValue="attribute.order = $event"></text-field>

                            <text-field :value="attribute.extra" :label="'Dodatak'" :error="error? error.extra : ''" @changeValue="attribute.extra = $event"></text-field>

                            <checkbox-field :value="attribute.publish" :label="'Publikovano'" @changeValue="attribute.publish = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Izmeni</button>
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
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import swal from 'sweetalert2';

    export default {
        data(){
          return {
              attribute: false,
              lists: {},
              error: null,
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
            this.getAttribute();
        },
        methods: {
            getAttribute(){
                axios.get('api/attributes/' + this.$route.params.id)
                    .then(res => {
                        this.lists = res.data.properties;
                        this.attribute = res.data.attribute;
                        this.attribute.property = res.data.property;
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                axios.put('api/attributes/' + this.attribute.id, this.attribute)
                    .then(res => {
                        this.attribute = res.data.attribute;
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