<template>
    <div class="form-group">
        <label>{{ label }} <span v-if="required">*</span></label><br>
        <switches v-model="model" theme="bootstrap" color="primary" @input="$emit('changeValue', model)"></switches>
    </div>
</template>

<script>
    import Switches from 'vue-switches';

    export default {
        data(){
            return {
                model: this.value,
            }
        },
        props: ['label', 'value', 'error', 'required'],
        components: { Switches },
    }
</script>

<style scoped>
    span { color: red; }
</style>