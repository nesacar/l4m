<template>
    <div class="form-group">
        <label :for="label">{{ label }} <span v-if="required">*</span></label>
        <select2 :id="label" :value="value" class="form-control"  @input="input($event)">
            <option value="0">Izaberi</option>
            <option :value="item.id" v-for="item in lists">{{ item.title }}</option>
        </select2>
        <small class="form-text text-muted" v-if="error != null">{{ error[0] }}</small>
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