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
                    <div class="card">
                        <form @submit.prevent="submit()">
                            <div class="form-group">
                                <label for="name">Naziv <span>*</span></label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Ime" v-model="currency.name">
                                <small class="form-text text-muted" v-if="error != null && error.name">{{ error.name[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="code">Kod <span>*</span></label>
                                <input type="text" name="code" class="form-control" id="code" placeholder="Kod" v-model="currency.code">
                                <small class="form-text text-muted" v-if="error != null && error.code">{{ error.code[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="symbol">Simbol</label>
                                <input type="text" name="email" class="form-control" id="symbol" placeholder="Simbol" v-model="currency.symbol">
                                <small class="form-text text-muted" v-if="error != null && error.symbol">{{ error.symbol[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="exchange_rate">Vrednost <span>*</span></label>
                                <input type="text" name="exchange_rate" class="form-control" id="exchange_rate" placeholder="Vrednost" v-model="currency.exchange_rate">
                                <small class="form-text text-muted" v-if="error != null && error.exchange_rate">{{ error.exchange_rate[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label>Primarna valute</label><br>
                                <switches v-model="currency.primary" theme="bootstrap" color="primary"></switches>
                            </div>
                            <div class="form-group">
                                <label>Aktivna</label><br>
                                <switches v-model="currency.publish" theme="bootstrap" color="primary"></switches>
                            </div>
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
              currency: {},
              error: null
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'switches': Switches,
        },
        created(){
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

<style scoped>
    span{
        color: red;
    }
</style>