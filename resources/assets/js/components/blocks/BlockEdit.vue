<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/blocks'">Šabloni</router-link></li>
                            <li>Izmena šablona</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena šablona</h5>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <checkbox-field :value="block.publish" :label="'Publikovano'" @changeValue="block.publish = $event"></checkbox-field>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <form @submit.prevent="submit()">

                            <select-field v-if="categories" :labela="'Kategorija'" :options="categories" :value="block.category" :error="error? error.category_id : ''" @changeValue="block.category_id = $event"></select-field>

                            <text-field :value="block.title" :label="'Naziv'" :error="error? error.title : ''" @changeValue="block.title = $event"></text-field>

                            <text-field :value="block.desc" :label="'Opis'" :error="error? error.desc : ''" @changeValue="block.desc = $event"></text-field>

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
              block: {},
              categories: false,
              error: null
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
        },
        mounted(){
            this.getBlock();
        },
        methods: {
            getBlock(){
                axios.get('api/blocks/' + this.$route.params.id)
                    .then(res => {
                        this.categories = res.data.categories;
                        this.block = res.data.block;
                        this.block.category = res.data.category;
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                axios.put('api/blocks/' + this.block.id, this.block)
                    .then(res => {
                        this.block = res.data.block;
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.error = null;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            }
        }
    }
</script>