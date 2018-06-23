<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li>
                                <router-link tag="a" :to="'/home'">Početna</router-link>
                            </li>
                            <li>
                                <router-link tag="a" :to="'/blocks'">Šabloni</router-link>
                            </li>
                            <li>Kreiraj šablon</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Kreiraj šablon</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card">
                        <form @submit.prevent="submit()">

                            <select2-field :lists="categories" :value="block.category_id" :label="'Kategorija'" :error="error? error.category_id : ''" @changeValue="block.category_id = $event"></select2-field>

                            <text-field :value="block.title" :label="'Naziv'" :error="error? error.title : ''" @changeValue="block.title = $event"></text-field>

                            <text-field :value="block.desc" :label="'Opis'" :error="error? error.desc : ''" @changeValue="block.desc = $event"></text-field>

                            <checkbox-field :value="block.publish" :label="'Publikovano'" @changeValue="block.publish = $event"></checkbox-field>

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
                block: {},
                categories: {},
                error: null,
            }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
        },
        mounted(){
            this.getCategories();
        },
        methods: {
            getCategories(){
                axios.get('api/categories/top-lists')
                    .then(res => {
                        this.categories = res.data.categories;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                axios.post('api/blocks', this.block)
                    .then(res => {
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Uspeh',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/blocks');
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
        }
    }
</script>