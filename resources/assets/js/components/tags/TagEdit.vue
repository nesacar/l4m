<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/tags'">Tagovi</router-link></li>
                            <li>Izmena taga</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena taga</h5>
                    </div>
                </div>

                <div class="col-md-4">

                </div>
                <div class="col-md-8">
                    <div class="card" v-if="tag">
                        <form @submit.prevent="submit()">

                            <text-field :value="tag.title" :label="'Naslov'" :error="error? error.title : ''" :required="true" @changeValue="tag.title = $event"></text-field>

                            <text-field :value="tag.slug" :label="'Slug'" :error="error? error.slug : ''" @changeValue="tag.slug = $event"></text-field>

                            <checkbox-field :value="tag.publish" :label="'Publikovano'" @changeValue="tag.publish = $event"></checkbox-field>

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
              tag: false,
              error: null,
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
        },
        mounted(){
            this.getTag();
        },
        methods: {
            getTag(){
                axios.get('api/tags/' + this.$route.params.id)
                    .then(res => {
                        this.tag = res.data.tag;
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                axios.put('api/tags/' + this.tag.id, this.tag)
                    .then(res => {
                        this.tag = res.data.tag;
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
            },
        }
    }
</script>