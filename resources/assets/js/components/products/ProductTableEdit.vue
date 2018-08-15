<template>
    <div id="place">
        <div class="px-4" style="overflow: hidden;">
            <search-helper :search="searchProductTable" :enableList="false" @updateSearch="search($event)"></search-helper>
            <div class="d-flex py-3 justify-content-between">
                Set tabele za:
                <select class="select-set" v-model="selected" @change="onChangeSet">
                    <option :key="option.id"
                            :value="option.id"
                            v-for="(option) in sets"
                    >{{ option.title }}</option>
                </select>

                <select v-model="filter_brand" @change="onChangeBrand">
                    <option :key="option.id"
                            :value="option.id"
                            v-for="(option) in brands"
                    >{{ option.title }}</option>
                </select>

                <select v-model="filter_category" @change="onChangeCategory">
                    <option :key="option.id"
                            :value="option.id"
                            v-for="(option) in categories"
                    >{{ option.title }}</option>
                </select>

            </div>
            <form @submit.prevent="onSubmit" v-if="showTable">
                <div class="overflow" style="padding-bottom: 120px;">

                    <table class="table">
                        <thead>
                        <tr>
                            <th v-for="field in formFields[0]"
                                v-if="field.name !== 'id'"
                                :key="field.name"
                            >{{field.name}}</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr class="demo-row"
                            v-for="(field, i) in formFields"
                            :key="i"
                        >
                            <td v-for="(fieldItem) in field" v-if="fieldItem.name !== 'id'" :key="fieldItem.name">
                                <demo-generic-input
                                        :field="fieldItem"
                                        :onChange="(evt) => onInputChange(i)(evt)"
                                ></demo-generic-input>
                            </td>
                            <td>
                              <button @click.prevent="() => submitRow(i)">&plus;</button>
                            </td>
                        </tr>
                        </tbody>

                    </table>

                </div>
                <!--<div class="d-flex py-2 justify-content-end">
                    <button class="btn" type="submit">Sacuvaj</button>
                </div>-->
                <div class="col-md-12">
                    <paginate-helper :paginate="paginate" @clickLink="clickToLink($event)"></paginate-helper>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import PreviewImage from "../helper/PreviewImage.vue";
import DropdownSelect from "../helper/form/DropdownSelect.vue";
import moment from "moment";
import swal from "sweetalert2";
import DemoGenericInput from "../helper/form/DemoForm/DemoGenericInput.vue";
import { STATIC_FIELDS } from "../helper/form/DemoForm/static-fields";
import PaginateHelper from "../helper/PaginateHelper.vue";
import SearchHelper from "../helper/SearchHelper.vue";

let staticDataTemplate = Object.assign({}, STATIC_FIELDS);
let STATIC_TEMPLATE = Object.assign({}, STATIC_FIELDS);

/**
 * Maps over the given object.
 *
 * @param {Object} obj
 * @param {Function} fn
 * @return {Object}
 */
const mapObject = (obj, fn) => {
  return Object.keys(obj).reduce(
    (acc, key) => ({
      ...acc,
      [key]: fn(key, obj[key])
    }),
    {}
  );
};

export default {
  data() {
    return {
      showTable: false,
      categories: [],
      brands: [],
      sets: [],
      selected: -1,
      selected_brand: null,
      selected_category: null,
      filter_brand: null,
      filter_category: null,
      fields: [],
      filters: {},
      error: null,
      paginate: {}
    };
  },

  components: {
    "preview-image": PreviewImage,
    "dropdown-select": DropdownSelect,
    "demo-generic-input": DemoGenericInput,
    "paginate-helper": PaginateHelper,
    "search-helper": SearchHelper
  },

  computed: {
    formFields() {
      return this.fields.map(field => {
        return Object.keys(field).map(name => ({
          ...field[name],
          name
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
      return this.product.date + " " + this.product.time;
    },

    searchProductTable() {
      return this.$store.getters.getSearchProductTable;
    }
  },

  mounted() {
    this.getSets();
    this.getStaticData();
  },

  methods: {
    getProducts() {
      // Set paginator page to 1 in store.js
      // this.$store.dispatch('changeSearchProductPage', 1);
      // Get paginate page number
      this.filters = this.searchProductTable;
      /*this.filters.brand_id = this.filter_brand;
            this.filters.category_id = this.filter_category;*/
      return axios.post("api/products/tableList", this.filters);
    },

    clickToLink(index) {
      console.log(index);
      this.$store.dispatch("changeSearchProductTablePage", index);
      this.onChange();
    },

    submit() {
      this.product.user_id = this.user.id;
      this.product.publish_at = this.publish_at;
      axios
        .post("api/products/saveProduct", this.product)
        .then(res => {
          swal({
            position: "center",
            type: "success",
            title: "Success",
            showConfirmButton: false,
            timer: 1500
          });
          this.$router.push("/products/table");
        })
        .catch(e => {
          console.log(e.response);
          this.error = e.response.data.errors;
        });
    },

    submitRow(n) {
      const product = this.fields[n];
      axios
        .post(`api/products/${product.id.value}/tableUpdate`, product)
        .then(res => {
          swal({
            position: "center",
            type: "success",
            title: "Success",
            showConfirmButton: false,
            timer: 1000
          });
        })
        .catch(err => {
          const greska = Object.keys(err.response.data.errors).reduce(
            (acc, cur) => {
              return acc + err.response.data.errors[cur][0];
            },
            ""
          );
          swal({
            position: "center",
            type: "error",
            title: "Greška, ",
            text: greska,
            showConfirmButton: false,
            timer: 5000
          });
        });
    },

    getStaticData() {
      // runs only once. *on mounte*
      Promise.all([
        axios.get("api/clients/lists"),
        axios.get("api/brands/lists"),
        axios.get("api/categories/listsSelect")
      ])
        .then(p => p.map(p => p.data))
        .then(promises => {
          return promises.reduce((acc, cur) => {
            return {
              ...acc,
              ...cur
            };
          }, {});
        })
        .then(r => {
          this.hidrateFilters(r);
          return r;
        })
        .then(data => {
          STATIC_TEMPLATE = mapObject(staticDataTemplate, (key, value) => {
            if (data[key]) {
              return {
                ...value,
                options: (key !== "categories"
                  ? [{ id: -1, title: `Izaberi ${key}` }]
                  : []
                ).concat(data[key])
              };
            }

            return value;
          });
        })
        .catch(err => {
          this.error = err.response.data.errors;
          console.error(err);
        });
    },

    hidrateFilters(obj) {
      this.brands = obj.brands;
      this.categories = obj.categories;
    },

    renderData() {
      this.getProducts()
        .then(res => res.data)
        .then(data => {
          this.paginate = data;
          return data;
        })
        .then(({ data }) => {
          const fields = data.map(product => {
            return mapObject(staticDataTemplate, (key, value) => {
              return {
                ...staticDataTemplate[key],
                value: product[key] || staticDataTemplate[key].value
              };
            });
          });

          return fields;
        })
        .then(async fields => {
          const promises = await Promise.all(
            fields.map(field => {
              const id = field.brands.value;
              return axios.get(`api/collections/lists?brand_id=${id}`);
            })
          );

          let collections = promises.map(r => r.data.collections);

          this.fields = fields.map((filed, i) => {
            return {
              ...filed,
              collections: {
                ...filed.collections,
                options: collections[i]
              }
            };
          });
        })
        .catch(err => {
          console.error(err);
        });
    },

    setBrand(event) {
      let brand_id = event.target.value;
      this.getCollections(brand_id);
    },

    getCollections(id, index) {
      axios
        .get(`api/collections/lists?brand_id=${id}`)
        .then(r => r.data)
        .then(data => {
          const product = Object.assign({}, this.fields[index], {
            collections: {
              ...this.fields[index].collections,
              options: [{ id: -1, title: "Izaberi kolekciju" }].concat(
                data.collections.map(c => ({
                  id: c.id,
                  title: c.title
                }))
              )
            }
          });

          this.fields = [
            ...this.fields.slice(0, index),
            product,
            ...this.fields.slice(index + 1)
          ];
        })
        .catch(err => {
          console.error(err);
        });
    },

    getSets() {
      axios
        .get("api/sets")
        .then(res => {
          this.sets = res.data.lists;
        })
        .catch(err => {
          this.error = err.response.data.errors;
          console.log(err);
        });
    },

    /* Event handlers */
    onInputChange(index) {
      return evt => {
        const { name, value } = evt.target;

        this.fields[index][name] = {
          ...this.fields[index][name],
          value
        };

        if (name === "brands") {
          this.getCollections(value, index);
        }
      };
    },

    onChange() {
      const id = this.selected;
      // Clear previously generated fields
      this.fields = [];
      axios
        .get(`api/properties/${id}/set`)
        .then(res => {
          this.showTable = true;
          this.fields = [];

          const setProps = res.data.setProperties;
          console.log(setProps);

          const dynamicFields = setProps.reduce((acc, cur) => {
            return {
              ...acc,
              [`dynamic_${cur.slug}`]: {
                type: "select",
                value: -1,
                options: [{ id: -1, title: `Izaberi ${cur.title}` }].concat(
                  cur.attribute.map(attr => ({
                    id: attr.id,
                    title: attr.title
                  }))
                )
              }
            };
          }, {});

          staticDataTemplate = {
            ...STATIC_TEMPLATE,
            ...dynamicFields
          };

          this.renderData();
        })
        .catch(err => {
          this.error = err.response.data.errors;
          console.error(err);
        });
    },

    onChangeSet() {
      // Reset paginator
      this.$store.dispatch("changeSearchProductTablePage", 1);
      this.onChange();
    },

    onChangeBrand(event) {
      // Reset paginator
      this.$store.dispatch("changeSearchProductTablePage", 1);
      // Set brand filter
      this.$store.dispatch("changeSearchProductTableBrand", event.target.value);
      this.onChange();
    },

    onChangeCategory(event) {
      // Reset paginator
      this.$store.dispatch("changeSearchProductTablePage", 1);
      this.$store.dispatch(
        "changeSearchProductTableCategory",
        event.target.value
      );
      this.onChange();
    },

    onSubmit() {
      // Merge user info in fields
      const payload = {
        fields: this.fields,
        user_id: this.user.id
      };

      axios
        .post("api/products/tableCreate", payload)
        .then(res => {
          console.log(res.data);
          swal({
            position: "center",
            type: "success",
            title: "Uspeh, ",
            text: `Broj kreiranih proizvoda: ${
              res.data.new
            }, broj izmenjenih proizvoda: ${res.data.old}`,
            showConfirmButton: false,
            timer: 5000
          });
        })
        .catch(err => {
          console.log(err);
        });
    },

    search(event) {
      this.$store.dispatch("changeSearchProductTablePage", 1);
      this.$store.dispatch("changeSearchProductTable", event);
      this.onChange();
    }
  }
};
</script>

<style lang="scss" scoped>
.select-set {
  height: 36px;
  padding: 0 4px;
}

.overflow {
  overflow-x: auto;
  overflow-y: visible;
}

.table {
  table-layout: auto;

  thead {
    tr {
      background-color: #eee;
    }
  }

  tbody {
    tr:nth-child(even) {
      background-color: #eee;
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