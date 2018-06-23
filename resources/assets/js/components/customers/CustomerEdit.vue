<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/customers'">Kupci</router-link></li>
                            <li>Izmena kupca</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena kupca</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card" v-if="customer">
                        <form @submit.prevent="submit()">

                            <text-field :value="customer.name" :label="'Ime'" :error="error? error.name : ''" :required="true" @changeValue="customer.name = $event"></text-field>

                            <text-field :value="customer.user.email" :label="'Email adresa'" :error="error? error.email : ''" :required="true" @changeValue="customer.email = $event"></text-field>

                            <password-field :value="''" :label="'Lozinka'" :error="error? error.password : ''" :required="true" @changeValue="customer.password = $event"></password-field>

                            <password-field :value="''" :label="'Potvrda lozinke'" :error="error? error.password_confirmation : ''" :required="true" @changeValue="customer.password_confirmation = $event"></password-field>

                            <checkbox-field :value="customer.block" :label="'Blokiran'" @changeValue="customer.block = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary">Izmeni</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <h3>Mesto za korpe</h3>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import swal from 'sweetalert2';
    import Switches from 'vue-switches';

    export default {
        data(){
          return {
              customer: false,
              error: null
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'switches': Switches,
        },
        created(){
            this.getCustomer();
        },
        methods: {
            getCustomer(){
                axios.get('api/customers/' + this.$route.params.id)
                    .then(res => {
                        this.customer = res.data.customer;
                        this.customer.email = this.customer.user.email;
                        this.customer.name = this.customer.user.name;
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                axios.put('api/customers/' + this.customer.id + '/edit/' + this.customer.user.id, this.customer)
                    .then(res => {
                        this.customer = res.data.customer;
                        this.customer.email = this.customer.user.email;
                        this.customer.name = this.customer.user.name;
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