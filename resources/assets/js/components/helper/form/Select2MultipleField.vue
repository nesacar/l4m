<template>
    <div class="form-group">
        <label>{{ label }} <span v-if="required">*</span></label>
        <select2 :options="lists" :value="value" :multiple="true" @input="input($event)">
            <option value="0" disabled>select one</option>
        </select2>
        <small class="form-text text-muted" v-if="error != null && error">{{ error[0] }}</small>
    </div>
</template>

<script>
    import Select2 from '../../helper/Select2Helper.vue';

    export default {
        props: ['label', 'value', 'lists', 'error', 'required'],
        components: { Select2 },
        methods: {
            input(value){
                this.$emit('changeValue', value)
            },
        },
    }
</script>

<style scoped>
    span { color: red; }
</style>