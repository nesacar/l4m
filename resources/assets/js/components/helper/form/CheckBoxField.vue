<template>
    <div class="form-group">
        <label>{{ label }}</label><br>
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
        props: ['label', 'value', 'error'],
        components: { Switches },
    }
</script>