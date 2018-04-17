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
                            <div class="form-group">
                                <label for="title">Naziv</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Naziv" v-model="menu.title">
                                <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="prefix">Prefix</label>
                                <input type="text" name="prefix" class="form-control" id="prefix" placeholder="Prefix" v-model="menu.prefix">
                                <small class="form-text text-muted" v-if="error != null && error.prefix">{{ error.prefix[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="sufix">Sufix</label>
                                <input type="text" name="sufix" class="form-control" id="sufix" placeholder="Sufix" v-model="menu.sufix">
                                <small class="form-text text-muted" v-if="error != null && error.sufix">{{ error.sufix[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="class">Class</label>
                                <input type="text" name="class" class="form-control" id="class" placeholder="Class" v-model="menu.class">
                                <small class="form-text text-muted" v-if="error != null && error.class">{{ error.class[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label>Publikovano</label><br>
                                <switches v-model="menu.publish" theme="bootstrap" color="primary"></switches>
                            </div>
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
    import Switches from 'vue-switches';

    export default {
        data(){
          return {
              menu: {},
              error: null,
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'switches': Switches
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