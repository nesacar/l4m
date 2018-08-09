<template>
  <div id="place">
    <div class="px-4" style="overflow: hidden;">
      <div>
        <select v-model="selected" @change="onChange">
          <option :key="option.id"
            :value="option.id"
            v-for="(option) in sets"
          >{{ option.title }}</option>
        </select>
        <button @click="onAddNewRow">add new row</button>
      </div>
      <form @submit.prevent="onSubmit" v-if="showTable">
        <div class="overflow" style="padding-bottom: 120px;">

          <table class="table">
            <thead>
              <tr>
                <th v-for="field in formFields[0]"
                  :key="field.name"
                >{{field.name}}</th>
              </tr>
            </thead>

            <tbody>
              <tr class="demo-row"
                v-for="(field, i) in formFields"
                :key="i"
              >
                <td v-for="(fieldItem) in field" :key="fieldItem.name">
                  <demo-generic-input
                    :field="fieldItem"
                    :onChange="(evt) => onInputChange(i)(evt)"
                  ></demo-generic-input>
                </td>
              </tr>
            </tbody>

          </table>

        </div>
        <button type="submit">Sacuvaj</button>
      </form>
    </div>
  </div>
</template>

<script>
  import PreviewImage from '../helper/PreviewImage.vue';
  import DropdownSelect from '../helper/form/DropdownSelect.vue';
  import moment from 'moment';
  import swal from 'sweetalert2';
  import DemoGenericInput from '../helper/form/DemoForm/DemoGenericInput.vue';
  import {STATIC_FIELDS} from '../helper/form/DemoForm/static-fields';

  let staticDataTemplate = Object.assign({}, STATIC_FIELDS);

  /**
   * Maps over the given object.
   *
   * @param {Object} obj
   * @param {Function} fn
   * @return {Object}
   */
  const mapObject = (obj, fn) => {
    return Object.keys(obj).reduce((acc, key) => ({
      ...acc,
      [key]: fn(key, obj[key]),
    }), {});
  };

  export default {
    data() {
      return {
        showTable: false,
        sets: [],
        selected: -1,
        fields: [],
        error: null,
      };
    },

    components: {
      'preview-image': PreviewImage,
      'dropdown-select': DropdownSelect,
      'demo-generic-input': DemoGenericInput,
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

      admin() {
        return this.$store.getters.isAdmin;
      },

      user() {
        return this.$store.getters.getUser;
      },

      publish_at() {
        return this.product.date + ' ' + this.product.time
      },
    },

    mounted() {
      this.getSets();
      this.getStaticData();
    },

    methods: {
      submit() {
        this.product.user_id = this.user.id;
        this.product.publish_at = this.publish_at;

        axios.post('api/products/saveProduct', this.product)
          .then((res) => {
            swal({
              position: 'center',
              type: 'success',
              title: 'Success',
              showConfirmButton: false,
              timer: 1500,
            });
            
            this.$router.push('/products/table');
          })
          .catch((rr) => {
            console.error(err);
            this.error = err.response.data.errors;
          });
      },

      getStaticData() {
        Promise.all([
          axios.get('api/clients/lists'),
          axios.get('api/brands/lists'),
          axios.get('api/categories/listsSelect'),
        ])
          .then((p) => p.map((p) => p.data))
          .then((promises) => {
            return promises.reduce((acc, cur) => {
              return {
                ...acc,
                ...cur,
              };
            }, {});
          })
          .then((data) => {
            staticDataTemplate = mapObject(staticDataTemplate, (key, value) => {
              if (data[key]) {
                return {
                  ...value,
                  options: ((key !== 'categories') ? [{id: -1, title: `Izaberi ${key}`}] : [])
                    .concat(data[key]),
                };
              }

              return value;
            });
          })
          .catch((err) => {
            this.error = err.response.data.errors;
            console.error(err);
          });
      },

      setBrand(event) {
        let brand_id = event.target.value;
        this.getCollections(brand_id);
      },

      getCollections(id, index) {
        axios.get(`api/collections/lists?brand_id=${id}`)
          .then((r) => r.data)
          .then((data) => {
            const product = Object.assign({}, this.fields[index], {
              collections: {
                ...this.fields[index].collections,
                options: [{id: -1, title: 'Izaberi kolekciju'}]
                  .concat(data.collections.map((c) => ({
                    id: c.id,
                    title: c.title,
                  }))),
              },
            });

            this.fields = [
              ...this.fields.slice(0, index),
              product,
              ...this.fields.slice(index + 1),
            ];
          })
          .catch((err) => {
            console.error(err);
          });
      },

      getSets() {
        axios.get('api/sets')
          .then((res) => {
            this.sets = res.data.lists;
          })
          .catch((err) => {
            this.error = err.response.data.errors;
            console.error(err);
          });
      },

      /* Event handlers */
      onInputChange(index) {
        return (evt) => {
          const {name, value} = evt.target;

          this.fields[index][name] = {
            ...this.fields[index][name],
            value,
          };

          if (name === 'brands') {
            this.getCollections(value, index);
          }
        };
      },

      onChange() {
        const id = this.selected;
        // Clear previously generated fields
        this.fields = [];

        axios.get(`api/products/${id}/table`)
          .then((res) => {
            this.showTable = true;

            const setProps = res.data.setProperties;

            const dynamicFields = setProps.reduce((acc, cur) => {
              return {
                ...acc,
                [`dynamic_${cur.slug}`]: {
                  type: 'select',
                  value: -1,
                  options: [{id: -1, title: `Izaberi ${cur.title}`}]
                    .concat(cur.attribute.map((attr) => ({
                      id: attr.id,
                      title: attr.title,
                    }))),
                },
              };
            }, {});

            this.fields = this.fields.concat({
              ...staticDataTemplate,
              ...dynamicFields,
            });
          })
          .catch((err) => {
            this.error = err.response.data.errors;
            console.error(err);
          });
      },

      onAddNewRow() {
        // last elements index.
        const index = this.fields.length - 1;
        const lastItemCopy = Object.assign({}, this.fields[index]);
        this.fields = this.fields.concat(lastItemCopy);
      },

      onSubmit() {
        // Merge user info in fields
        const payload = {
          fields: this.fields,
          user_id: this.user.id,
        };

        axios.post('api/products/tableCreate', payload)
          .then(res => {
            swal({
              position: 'center',
              type: 'success',
              title: 'Uspeh, ',
              text: `Broj kreiranih proizvoda: ${res.data.new}, broj izmenjenih proizvoda: ${res.data.old}`,
              showConfirmButton: false,
              timer: 5000
            });
          })
          .catch(err => {
            console.error(err);
          });
      },
    }
  }
</script>

<style lang="scss" scoped>
  .overflow {
    overflow-x: auto;
    overflow-y: visible;
  }

  .table {
    table-layout: auto;

    thead {
      tr {
        background-color: #EEE;
      }
    }

    tbody {
      tr:nth-child(even) {
        background-color: #EEE;
      }
    }

    td {
      padding: 0;
      border: 0;
    }

    th {
      font-size: 12px;
      font-weight: bold;
      padding: 8px;
      white-space: nowrap;
      border: 0;
    }
  }
</style>
