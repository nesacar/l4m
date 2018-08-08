<template>
    <div>
        <div>
            <select v-model="selected" @change="onChange">
                <option :key="option.id"
                    :value="option.id"
                    v-for="(option) in options"
                >{{ option.title }}</option>
            </select>
            <button @click="onAddNewRow">add new row</button>
        </div>
        <form @submit.prevent="onSubmit">
            <div>
                <span v-for="field in formFields"
                    :key="field.name"
                >{{field.name}}</span>
            </div>
            <div class="demo-row"
                v-for="(field, i) in formFields"
                :key="i"
            >
                <demo-generic-input :key="fieldItem.name"
                    v-for="(fieldItem) in field"
                    :field="fieldItem"
                    :onChange="(evt) => onInputChange(i)(evt)"
                ></demo-generic-input>
            </div>
        </form>
    </div>
</template>

<script>
    import DemoGenericInput from './DemoGenericInput.vue';
    import {STATIC_FIELDS} from './static-fields';

    export default {
        components: {
            'demo-generic-input': DemoGenericInput,
        },

        data() {
            return {
                selected: [1],
                options: [
                    {id: 1, title: 'option1'},
                    {id: 2, title: 'option2'},
                ],
                fields: [
                    {...STATIC_FIELDS},
                    {...STATIC_FIELDS},
                ],
            };
        },

        computed: {
            formFields() {
                return this.fields.map((field) => {
                    return Object.keys(field).map((name) => ({
                        ...field[name],
                        name,
                    }));
                });
            },
        },

        methods: {
            onChange() {
                console.log('fetch data from server with id', this.selected);
            },

            onAddNewRow() {
                // last elements index.
                const index = this.fields.length - 1;
                const lastItemCopy = Object.assign({}, this.fields[index]);
                this.fields = this.fields.concat(lastItemCopy);
            },

            onInputChange(index) {
                return (evt) => {
                    const {name, value} = evt.target;

                    this.fields[index][name] = {
                        ...this.fields[index][name],
                        value,
                    };
                };
            },

            onSubmit() {
                console.log('submit data');
            },
        },
    };
</script>