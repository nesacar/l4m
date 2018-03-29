<template>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Pdf {{ titlePdf }}</h5>
            <p class="card-text" style="color: red" v-if="error && error.pdf">{{ error.pdf[0] }}</p>
            <p class="card-text">Ovde možete uploudovati pdf {{ titlePdf }}.</p>
            <label class="labela">
                <input type="file" @change="setUpFileUploader">
            </label>
            <img :src="domain + defaultPdf" class="card-img-bottom pdfIcon" v-if="pdf" @click="openPdf()">
        </div>
    </div>
</template>

<script>
    export default {
        props: ['pdf', 'domain', 'defaultPdf', 'titlePdf', 'error'],
        methods:{
            setUpFileUploader(e){
                let reader = new FileReader();
                let files = e.target.files;
                if(!files.length){
                    return
                }
                reader.readAsDataURL(files[0]);
                reader.onload = (e) => {
                    let newPdf = e.target.result;
                    this.$emit('uploadPdf', [newPdf]);
                }
            },
            openPdf(){
                window.open(this.domain + this.pdf, '_blank');
            }
        }
    }
</script>

<style>
    .pdfIcon{
        display: block;
        width: 50px;
        height: auto;
        margin: 0 auto;
        cursor: pointer;
    }
</style>