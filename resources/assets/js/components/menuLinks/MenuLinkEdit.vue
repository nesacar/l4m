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

                    <upload-image-helper
                            :image="link.image"
                            :defaultImage="null"
                            :titleImage="'linka'"
                            :error="error"
                            @uploadImage="upload($event)"
                            @removeRow="remove($event)"
                    ></upload-image-helper>


                </div>
                <div class="col-md-8">
                    <div class="card" v-if="link">
                            <form @submit.prevent="submit()">

                                <select-field v-if="links" :labela="'Nad link'" :options="links" :error="error? error.parent : ''" :value="link.parent_link" @changeValue="link.parent = $event"></select-field>

                                <text-field :value="link.title" :label="'Naziv'" :error="error? error.title : ''" :required="true" @changeValue="link.title = $event"></text-field>

                                <text-field :value="link.link" :label="'Link'" :error="error? error.link : ''" :required="true" @changeValue="link.link = $event"></text-field>

                                <text-field :value="link.desc" :label="'Opis'" :error="error? error.desc : ''" @changeValue="link.desc = $event"></text-field>

                                <text-field :value="link.order" :label="'Redosled'" :error="error? error.order : ''" @changeValue="link.order = $event"></text-field>

                                <text-field :value="link.sufix" :label="'Sufix'" :error="error? error.sufix : ''" @changeValue="link.sufix = $event"></text-field>

                                <checkbox-field :value="link.publish" :label="'Publikovano'" @changeValue="link.publish = $event"></checkbox-field>

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Izmeni</button>
                                </div>
                            </form>
                        </div><!-- .card -->

                        <div class="row" v-if="properties.length">
                            <div class="card col-md-4" v-for="property in properties">
                                <div class="form-group">
                                    <label>{{ property.title}}</strong></label>
                                    <ul class="list-group">
                                        <li class="list-group-item" v-for="attribute in property.attribute">
                                            <input type="checkbox" v-model="link.att_ids" :value="attribute.id">
                                            {{ attribute.title }}
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .row -->
                        <div class="row">
                            <div class="card">
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Izmeni</button>
                                </div>
                            </div><!-- .card -->
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
              properties: {},
              error: null,
              links: false,
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
            'switches': Switches
        },
        mounted(){
            this.getLink();
        },
        methods: {
            getLink(){
                axios.get('api/menu-links/' + this.$route.params.id)
                    .then(res => {
                        this.link = res.data.link;
                        this.link.att_ids = res.data.att_ids;
                        this.link.parent_link = res.data.parent;
                        this.properties = res.data.properties;
                        this.links = res.data.links;
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                console.log(this.link);
                axios.patch('api/menu-links/' + this.link.id, this.link)
                    .then(res => {
                        this.link = res.data.link;
                        this.link.att_ids = res.data.att_ids;
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
            upload(image){
                let data = new FormData();
                this.link.image = image.src;
                data.append('file', image.file);

                axios.post('api/menu-links/' + this.link.id + '/image', data)
                    .then(res => {
                        this.link.image = res.data.image;
                        this.error = null;
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }).catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
        }
    }
</script>