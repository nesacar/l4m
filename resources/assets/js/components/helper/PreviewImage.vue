<template>
    <div>
        <img :src="image" style="width: 63px; height: 84px;" v-if="showImage">

        <label class="labela2" v-if="!showImage">
            <input type="file" @change="setUpFileUploader" v-if="!showImage">
            <small class="form-text text-muted" v-if="error != null && error.file">{{ error.file[0] }}</small>
        </label>
    </div>
</template>

<script>
    export default {
        props: ['product_id'],
        data(){
            return {
                image: '',
                showImage: false,
                error: null,
            }
        },
        methods:{
            setUpFileUploader(e){
                this.loader = true;
                let reader = new FileReader();
                let files = e.target.files;
                if(!files.length){
                    return
                }
                reader.readAsDataURL(files[0]);
                reader.onload = (e) => {
                    axios.post('api/products/' + this.product_id + '/image', { file: e.target.result })
                        .then(res => {
                            this.image = e.target.result;
                            this.showImage = true;
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
                }
            }
        }
    }
</script>

<style scoped>
    input[type="file"]{
        display: none;
    }
</style>