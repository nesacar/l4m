<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/currencies'">Valute</router-link></li>
                            <li>Izmena valute</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena valute</h5>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="card" v-if="currency">
                        <form @submit.prevent="submit()">

                            <text-field :value="currency.name" :label="'Naziv'" :required="true" :error="error? error.name : ''" @changeValue="currency.name = $event"></text-field>

                            <text-field :value="currency.code" :label="'Kod'" :required="true" :error="error? error.code : ''" @changeValue="currency.code = $event"></text-field>

                            <text-field :value="currency.symbol" :label="'Simbol'" :error="error? error.symbol : ''" @changeValue="currency.symbol = $event"></text-field>

                            <text-field :value="currency.decimals" :label="'Broj decimala'" :error="error? error.decimals : ''" @changeValue="currency.decimals = $event"></text-field>

                            <text-field :value="currency.exchange_rate" :label="'Vrednost'" :required="true" :error="error? error.exchange_rate : ''" @changeValue="currency.exchange_rate = $event"></text-field>

                            <checkbox-field :value="currency.primary" :label="'Primarna valute'" @changeValue="currency.primary = $event"></checkbox-field>

                            <checkbox-field :value="currency.publish" :label="'Aktivna'" @changeValue="currency.publish = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary">Izmeni</button>
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
    import Switches from 'vue-switches';

    export default {
        data(){
          return {
              currency: false,
              error: null
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'switches': Switches,
        },
        mounted(){
            this.getCurrency();
        },
        methods: {
            getCurrency(){
                axios.get('api/currencies/' + this.$route.params.id)
                    .then(res => {
                        this.currency = res.data.currency;
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                axios.put('api/currencies/' + this.currency.id, this.currency)
                    .then(res => {
                        this.currency = res.data.currency;
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