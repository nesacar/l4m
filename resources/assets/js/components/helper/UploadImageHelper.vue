<template>
    <div class="card">
        <img :src="image" class="card-img-top" v-if="image">
        <img :src="defaultImage" alt="avatar" class="card-img-top" v-if="image != null && !image">
        <div class="card-body">
            <h5 class="card-title">Slika {{ titleImage }}</h5>
            <p class="card-text" style="color: red" v-if="error && error.image">{{ error.image[0] }}</p>
            <p class="card-text">Ovde možete uploudovati sliku {{ titleImage }}.</p>
            <label class="labela">
                <input type="file" @change="setUpFileUploader">
            </label>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['image', 'defaultImage', 'titleImage', 'error'],
        methods:{
            setUpFileUploader(e){
                let reader = new FileReader();
                let files = e.target.files;
                if(!files.length){
                    return
                }
                reader.readAsDataURL(files[0]);
                reader.onload = (e) => {
                    let newImage = e.target.result;
                    this.$emit('uploadImage', [newImage]);
                }
            }
        }
    }
</script>