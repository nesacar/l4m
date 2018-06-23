<template>
    <div class="form-group">
        <label>{{ label }}</label>
        <select2 :options="lists" :value="value" :multiple="true" @input="input($event)">
            <option value="0" disabled>select one</option>
        </select2>
    </div>
</template>

<script>
    import Select2 from '../../helper/Select2Helper.vue';

    export default {
        props: ['label', 'value', 'lists'],
        components: { Select2 },
        methods: {
            input(value){
                this.$emit('changeValue', value)
            },
        },
    }
</script>