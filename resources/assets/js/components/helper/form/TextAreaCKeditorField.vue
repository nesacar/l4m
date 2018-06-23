<template>
    <div class="form-group">
        <label>{{ label }}</label>
        <ckeditor v-model="model" :config="config" @input="$emit('changeValue', model)"></ckeditor>
        <small class="form-text text-muted" v-if="error != null && error">{{ error[0] }}</small>
    </div>
</template>

<script>
    import Ckeditor from 'vue-ckeditor2';

    export default {
        data(){
            return {
                model: this.value,
                config: {
                    toolbar: [
                        [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', 'Image', 'Link', 'Unlink', 'Source' ],
                        { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
                        '/',
                        { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
                    ],
                    height: 300,
                    filebrowserBrowseUrl: 'filemanager/show'
                },
            }
        },
        props: ['label', 'value', 'error'],
        components: { Ckeditor },
    }
</script>