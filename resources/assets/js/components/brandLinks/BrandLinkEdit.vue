<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li v-if="brand"><router-link tag="a" :to="'/brands/' + brand.id">{{ brand.title }}</router-link></li>
                            <li>Linkovi</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Kreiranje linka za brend: {{ brand.title }}</h5>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="card" v-if="link">
                        <form @submit.prevent="submit()">

                            <text-field :value="link.title" :label="'Naziv'" :required="true" :error="error? error.title : ''" @changeValue="link.title = $event"></text-field>

                            <text-field :value="link.link" :label="'Link'" :required="true" :error="error? error.link : ''" @changeValue="link.link = $event"></text-field>

                            <text-field :value="link.order" :label="'Redosled'" :required="false" :error="error? error.order : ''" @changeValue="link.order = $event"></text-field>

                            <checkbox-field :value="link.publish" :label="'Publikovano'" @changeValue="link.publish = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Izmeni</button>
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
              link: false,
              brand: {},
              error: null,
          }
        },
        computed: {
            user(){
                return this.$store.getters.getUser;
            },
        },
        mounted(){
            this.getLink();
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
        },
        methods: {
            getLink(){
                axios.get('api/brand-links/' + this.$route.params.id)
                    .then(res => {
                        this.link = res.data.link;
                        this.brand = this.link.brand;
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                axios.put('api/brand-links/' + this.link.id, this.link)
                    .then(res => {
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/brand-links/' + this.brand.id);
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
        }
    }
</script>