<template>
    <select :name="name" @change="_handleChange">
        <option value="-1" :selected=true>{{_value}}</option>
        <option :key="option.id"
            :value="option.id"
            v-for="option in options"
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

            /**
             * {Object[]} options
             * {string|number} options.id
             * {string|number} options.title
             */
            value: {
                type: Array,
                default: [],
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

        computed: {
            _value() {
                const values = this.options
                    .filter((option) => this.value.includes(option.id))
                    .map((option) => option.title);

                return values.length
                    ? values.join(', ')
                    : `Izaberite ${this.name}`;
            },
        },

        methods: {
            _handleChange(evt) {
                const id = parseInt(evt.target.value);
                const index = this.value.indexOf(id);
                let value = [];

                if (index < 0) {
                    // add to `value`,
                    value = this.value.concat(id);
                } else {
                    // remove from `value`
                    value = [
                        ...this.value.slice(0, index),
                        ...this.value.slice(index + 1),
                    ];
                }

                // props handler
                this.onChange({
                    target: {
                        name: this.name,
                        value,
                    },
                });
            },
        },
    };
</script>