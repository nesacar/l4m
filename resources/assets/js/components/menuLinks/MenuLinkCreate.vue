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
                            @uploadImage="prepare($event)"
                            @removeRow="remove($event)"
                    ></upload-image-helper>

                </div>
                <div class="col-md-8">
                    <div class="card">
                        <form @submit.prevent="submit()">

                            <select2-field :lists="links" :label="'Nad link'" :error="error? error.parent : ''" @changeValue="link.parent = $event"></select2-field>

                            <text-field :value="link.title" :label="'Naziv'" :error="error? error.title : ''" :required="true" @changeValue="link.title = $event"></text-field>

                            <text-field :value="link.link" :label="'Link'" :error="error? error.link : ''" :required="true" @changeValue="link.link = $event"></text-field>

                            <text-field :value="link.desc" :label="'Opis'" :error="error? error.desc : ''" @changeValue="link.desc = $event"></text-field>

                            <text-field :value="link.order" :label="'Redosled'" :error="error? error.order : ''" @changeValue="link.order = $event"></text-field>

                            <text-field :value="link.sufix" :label="'Sufix'" :error="error? error.sufix : ''" @changeValue="link.sufix = $event"></text-field>

                            <checkbox-field :value="link.publish" :label="'Publikovano'" @changeValue="link.publish = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Kreiraj</button>
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
    import UploadImageHelper from '../helper/UploadImageHelper.vue';
    import swal from 'sweetalert2';

    export default {
        data(){
          return {
              image: {},
              link: {},
              links: {},
              error: null,
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
        },
        mounted(){
            this.getParentLinks();
        },
        methods: {
            getParentLinks(){
                axios.get('api/menu-links/lists')
                    .then(res => {
                        this.links = res.data.links;
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                axios.post('api/menu-links?menu_id=' + this.$route.params.id, this.link)
                    .then(res => {
                        this.link = res.data.link;
                        this.sendImage();
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Uspeh',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/menu-links/' + this.$route.params.id);
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            prepare(image){
                this.link.image = image.src;
                this.image = new FormData();
                this.image.append('file', image.file);
            },
            sendImage(){
                axios.post('api/menu-links/' + this.link.id + '/image', this.image)
                    .then(res => {
                        this.link.image = res.data.image;
                        this.error = null;
                    }).catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
        }
    }
</script>