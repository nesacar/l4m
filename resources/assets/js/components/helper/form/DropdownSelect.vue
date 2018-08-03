<template>
    <select :name="name" @change="onChange">
        <option value="0" :selected=true>{{value}}</option>
        <option
                :value="option.id"
                v-for="(option, index) in options"
        >{{ option.title }}</option>
    </select>
</template>

<script>
    export default {
        props: {
            name: {
                type: String,
                required: false,
                default: 'name-id',
            },
            onChange: {
                type: Function,
                required: true,
            },
            value: {
                type: String,
                default: '',
            },
            /**
             * {Object[]} options
             * {string|number} options.id
             * {string|number} options.title
             */
            options: {
                type: Array,
                required: true,
            },
        },
    };
</script>