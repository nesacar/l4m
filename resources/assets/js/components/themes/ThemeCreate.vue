<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Home</router-link></li>
                            <li><router-link tag="a" :to="'/themes'">Themes</router-link></li>
                            <li>Theme create</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Theme create</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card">
                        <form @submit.prevent="submit()">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Title" v-model="theme.title">
                                <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="version">Version</label>
                                <input type="text" name="Version" class="form-control" id="version" placeholder="version" v-model="theme.version">
                                <small class="form-text text-muted" v-if="error != null && error.version">{{ error.version[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="author">Author</label>
                                <input type="text" name="Author" class="form-control" id="author" placeholder="version" v-model="theme.author">
                                <small class="form-text text-muted" v-if="error != null && error.author">{{ error.author[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="author_address">Author address</label>
                                <input type="text" name="author_address" class="form-control" id="author_address" placeholder="Author address" v-model="theme.author_address">
                                <small class="form-text text-muted" v-if="error != null && error.author_address">{{ error.author_address[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="author_email">Author email</label>
                                <input type="text" name="author_email" class="form-control" id="author_email" placeholder="Author email" v-model="theme.author_email">
                                <small class="form-text text-muted" v-if="error != null && error.author_email">{{ error.author_email[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="developer">Developer</label>
                                <input type="text" name="developer" class="form-control" id="developer" placeholder="developer" v-model="theme.developer">
                                <small class="form-text text-muted" v-if="error != null && error.developer">{{ error.developer[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label>Published</label><br>
                                <switches v-model="theme.publish" theme="bootstrap" color="primary"></switches>
                            </div>
                            <div class="form-group">
                                <label>Active</label><br>
                                <switches v-model="theme.active" theme="bootstrap" color="primary"></switches>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <upload-image-helper
                            :image="theme.image"
                            :defaultImage="null"
                            :titleImage="'theme'"
                            :error="error"
                            @uploadImage="upload($event)"
                            @removeRow="remove($event)"
                    ></upload-image-helper>
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
              theme: {},
              error: null
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
            'switches': Switches
        },
        methods: {
            submit(){
                axios.post('api/themes', this.theme)
                    .then(res => {
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/themes');
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            upload(image){
                this.theme.image = image[0];
            }
        }
    }
</script>