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
                            <div class="form-group">
                                <label for="name">Ime <span>*</span></label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Ime" v-model="customer.name">
                                <small class="form-text text-muted" v-if="error != null && error.name">{{ error.name[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="lastname">Prezime <span>*</span></label>
                                <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Prezime" v-model="customer.lastname">
                                <small class="form-text text-muted" v-if="error != null && error.lastname">{{ error.lastname[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="email">Email adresa <span>*</span></label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email adresa" v-model="customer.email">
                                <small class="form-text text-muted" v-if="error != null && error.email">{{ error.email[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="password">Lozinka <span>*</span></label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Lozinka" v-model="customer.password">
                                <small class="form-text text-muted" v-if="error != null && error.password">{{ error.password[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Potvrda lozinke <span>*</span></label>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Potvrda lozinke" v-model="customer.password_confirmation">
                            </div>
                            <div class="form-group">
                                <label for="phone">Telefon <span>*</span></label>
                                <input type="text" name="phone" class="form-control" id="phone" placeholder="Telefon" v-model="customer.phone">
                                <small class="form-text text-muted" v-if="error != null && error.phone">{{ error.phone[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="address">Adresa <span>*</span></label>
                                <input type="text" name="address" class="form-control" id="address" placeholder="Adresa" v-model="customer.address">
                                <small class="form-text text-muted" v-if="error != null && error.address">{{ error.address[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="postcode">Poštanski broj <span>*</span></label>
                                <input type="text" name="country" class="form-control" id="postcode" placeholder="Poštanski broj" v-model="customer.postcode">
                                <small class="form-text text-muted" v-if="error != null && error.postcode">{{ error.postcode[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="company">Kompanija</label>
                                <input type="text" name="company" class="form-control" id="company" placeholder="Kompanija" v-model="customer.company">
                                <small class="form-text text-muted" v-if="error != null && error.company">{{ error.company[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="town">Grad <span>*</span></label>
                                <input type="text" name="town" class="form-control" id="town" placeholder="Grad" v-model="customer.town">
                                <small class="form-text text-muted" v-if="error != null && error.town">{{ error.town[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="country">Država</label>
                                <input type="text" name="country" class="form-control" id="country" placeholder="Država" v-model="customer.country">
                                <small class="form-text text-muted" v-if="error != null && error.country">{{ error.country[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label>Blokiran</label><br>
                                <switches v-model="customer.block" theme="bootstrap" color="primary"></switches>
                            </div>
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
    import Switches from 'vue-switches';

    export default {
        data(){
          return {
              customer: {},
              error: null
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'switches': Switches,
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

<style scored>
    span{
        color: red;
    }
</style>