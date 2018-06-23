<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/customers'">Kupci</router-link></li>
                            <li>Kreiranje kupca</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Kreiranje kupca</h5>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="card">
                        <form @submit.prevent="submit()">

                            <text-field :value="customer.name" :label="'Ime'" :error="error? error.name : ''" :required="true" @changeValue="customer.name = $event"></text-field>

                            <text-field :value="customer.email" :label="'Email adresa'" :error="error? error.email : ''" :required="true" @changeValue="customer.email = $event"></text-field>

                            <password-field :value="customer.password" :label="'Lozinka'" :error="error? error.password : ''" :required="true" @changeValue="customer.password = $event"></password-field>

                            <password-field :value="customer.password_confirmation" :label="'Potvrda lozinke'" :error="error? error.password_confirmation : ''" :required="true" @changeValue="customer.password_confirmation = $event"></password-field>

                            <checkbox-field :value="customer.block" :label="'Blokiran'" @changeValue="customer.block = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary">Kreiraj</button>
                            </div>
                        </form>
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
        data(){
          return {
              customer: {},
              error: null
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
        },
        methods: {
            submit(){
                axios.post('api/customers', this.customer)
                    .then(res => {
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/customers');
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
        }
    }
</script>