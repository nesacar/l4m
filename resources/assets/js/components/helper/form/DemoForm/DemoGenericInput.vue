<template>
    <div class="demo-generic-input" v-if="field.type === 'select'">
        <select
            :name="field.name"
            @change="onChange"
        >
            <option v-for="option in field.options"
                :key="option.id"
                :value="option.id"
                :selected="option.id == field.value"
            >{{option.title}}</option>
        </select>
    </div>

    <div class="demo-generic-input" v-else-if="field.type === 'multiselect'">
        <dropdown-select
            :name="field.name"
            :onChange="onChange"
            :options="field.options"
            :value="field.value"
        ></dropdown-select>
    </div>

    <div class="demo-generic-input" v-else>
        <input key="text"
            :type="field.type"
            :value="field.value"
            :name="field.name"
            :placeholder="field.name"
            @change="onChange"
        />
    </div>

</template>

<script>
    import DropdownSelect from '../DropdownSelect.vue';

    export default {
        components: {
            'dropdown-select': DropdownSelect,
        },

        props: {
            field: {
                type: Object,
                default: {
                    type: 'text',
                    value: '',
                    name: 'name',
                },
            },
            onChange: {
                type: Function,
                required: true,
            },
        }
    }
</script>

<style scoped>
    .demo-generic-input {
        display: inline-block;
    }
</style>

