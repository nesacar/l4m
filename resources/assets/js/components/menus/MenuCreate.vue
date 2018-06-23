<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/menus'">Meni</router-link></li>
                            <li>Kreiranje menija</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Kreiranje menija</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card">
                        <form @submit.prevent="submit()">

                            <text-field :value="menu.title" :label="'Naziv'" :error="error? error.title : ''" @changeValue="menu.title = $event"></text-field>

                            <text-field :value="menu.prefix" :label="'Prefix'" :error="error? error.prefix : ''" @changeValue="menu.prefix = $event"></text-field>

                            <text-field :value="menu.sufix" :label="'Sufix'" :error="error? error.sufix : ''" @changeValue="menu.sufix = $event"></text-field>

                            <text-field :value="menu.class" :label="'Class'" :error="error? error.class : ''" @changeValue="menu.class = $event"></text-field>

                            <checkbox-field :value="menu.publish" :label="'Publikovano'" @changeValue="menu.publish = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Kreiraj</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <!--
                    <upload-image-helper
                            :image="menu.image"
                            :defaultImage="null"
                            :titleImage="'menu'"
                            :error="error"
                            @uploadImage="upload($event)"
                            @removeRow="remove($event)"
                    ></upload-image-helper>
                    -->
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
              menu: {},
              error: null,
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
        },
        methods: {
            submit(){
                axios.post('api/menus', this.menu)
                    .then(res => {
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Uspeh',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/menus');
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            }
        }
    }
</script>