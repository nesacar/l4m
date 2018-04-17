<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/menus'">Meni</router-link></li>
                            <li>Izmena linka</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena linka</h5>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <h5>Generalne informacije</h5>
                        <hr>
                        <form @submit.prevent="submit()">
                            <div class="form-group">
                                <label for="parent">Nad link</label>
                                <select name="parent" id="parent" class="form-control" v-model="link.parent">
                                    <option :value="index" v-for="(link, index) in links">{{ link }}</option>
                                </select>
                                <small class="form-text text-muted" v-if="error != null && error.parent">{{ error.parent[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="order">Redosled</label>
                                <input type="text" name="order" class="form-control" id="order" placeholder="Redosled" v-model="link.order">
                                <small class="form-text text-muted" v-if="error != null && error.order">{{ error.order[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label>Publikovano</label><br>
                                <switches v-model="link.publish" theme="bootstrap" color="primary"></switches>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <h5>Jezičke informacije</h5>
                        <hr>
                            <form @submit.prevent="submit()">
                                <div class="form-group">
                                    <label for="title">Naziv</label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Naziv" v-model="link.title">
                                    <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                                </div>
                                <div class="form-group">
                                    <label for="link">Link</label>
                                    <input type="text" name="link" class="form-control" id="link" placeholder="Link" v-model="link.link">
                                    <small class="form-text text-muted" v-if="error != null && error.link">{{ error.link[0] }}</small>
                                </div>
                                <div class="form-group">
                                    <label for="desc">Opis</label>
                                    <input type="text" name="Description" class="form-control" id="desc" placeholder="Opis" v-model="link.desc">
                                    <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.desc[0] }}</small>
                                </div>
                                <div class="form-group">
                                    <label for="sufix">Sufix</label>
                                    <input type="text" name="sufix" class="form-control" id="sufix" placeholder="Sufix" v-model="link.sufix">
                                    <small class="form-text text-muted" v-if="error != null && error.sufix">{{ error.sufix[0] }}</small>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Izmeni</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import UploadImageHelper from '../helper/UploadImageHelper.vue';
    import swal from 'sweetalert2';
    import Switches from 'vue-switches';

    export default {
        data(){
          return {
              link: {},
              error: null,
              links: []
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
            'switches': Switches
        },
        created(){
            this.getLink();
            this.getParentLinks();
        },
        methods: {
            getLink(){
                axios.get('api/menu-links/' + this.$route.params.id)
                    .then(res => {
                        if(res.data.link != null){
                            this.link = res.data.link;
                        }
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            getParentLinks(){
                axios.get('api/menu-links/lists')
                    .then(res => {
                        if(res.data.links != null){
                            this.links = res.data.links;
                        }
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                axios.patch('api/menu-links/' + this.link.id, this.link)
                    .then(res => {
                        this.link = res.data.link;
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
            }
        }
    }
</script>