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

                            <select-field v-if="lists" :labela="'Osobina'" :options="lists" :error="error? error.property_id : ''" :value="null" @changeValue="attribute.property_id = $event"></select-field>

                            <text-field :value="attribute.title" :label="'Naziv'" :error="error? error.title : ''" @changeValue="attribute.title = $event"></text-field>

                            <text-field :value="attribute.order" :label="'Redosled'" :error="error? error.order : ''" @changeValue="attribute.order = $event"></text-field>

                            <text-field :value="attribute.extra" :label="'Dodatak'" :error="error? error.extra : ''" @changeValue="attribute.extra = $event"></text-field>

                            <checkbox-field :value="attribute.publish" :label="'Publikovano'" @changeValue="attribute.publish = $event"></checkbox-field>

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
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import swal from 'sweetalert2';

    export default {
        data(){
          return {
              attribute: {},
              lists: false,
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
                            title: 'Uspeh',
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