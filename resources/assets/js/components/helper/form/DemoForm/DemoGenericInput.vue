<template>
    <div class="generic-input" v-if="field.type === 'select'">
        <select class="generic-input_control"
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

    <div class="generic-input" v-else-if="field.type === 'multiselect'">
        <dropdown-select class="generic-input_control"
            :name="field.name"
            :onChange="onChange"
            :options="field.options"
            :value="field.value"
        ></dropdown-select>
    </div>

    <div class="generic-input" v-else>
        <input key="text" class="generic-input_control"
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

<style lang="scss" scoped>
    .generic-input {
      display: inline-block;
      vertical-align: middle;
    }

    .generic-input_control {
      font-size: 12px;
      height: 24px;
      padding: 0;
      margin: 0;
      outline: none !important;
      border: 2px solid #E0E0E0;
      background-color: #FFF;

      &:hover {
        background-color: #E0E0E0;
      }

      &:focus {
        border-color: #131b24;
      }
    }
</style>

