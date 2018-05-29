<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/clients'">Klijenti</router-link></li>
                            <li>Povezane kategorije</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Povezane kategorije</h5>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div v-if="categories">
                            <div class="he-tree tree">
                                <div data-level="0" class="tree-node">
                                    <div class="tree-node-children">
                                        <div data-level="1" class="tree-node open" v-for="category in categories">
                                            <div class="tree-node-inner-back" style="margin-bottom: 10px;">
                                                <div class="tree-node-inner">
                                                    <div> <input type="checkbox" :value="category.id" name="cats[]" v-model="ids"> <span>{{ category.title }}</span></div>
                                                </div>
                                            </div>
                                            <div class="tree-node-children" v-if="category.children">
                                                <div id="tree_49_node_p0LA4" data-level="2" class="tree-node open" v-for="sub in category.children">
                                                    <div class="tree-node-inner-back"
                                                         style="margin-bottom: 10px; padding-left: 30px;">
                                                        <div class="tree-node-inner">
                                                            <div> <input type="checkbox" :value="sub.id" v-model="ids"> <span>{{ sub.title }}</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" @click="submit()">Sačuvaj</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import swal from 'sweetalert2';
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';

    export default {
        data(){
            return {
                categories: {},
                ids: [],
            }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
        },
        created(){
            this.getCategories();
        },
        methods: {
            getCategories(){
                axios.get('api/categories/tree')
                    .then(res => {
                        this.categories = res.data.categories;
                        console.log(this.categories);
                        this.getClientCategoryIds();
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            getClientCategoryIds(){
                axios.get('api/clients/' + this.$route.params.id + '/categories')
                    .then(res => {
                        this.ids = res.data.category_ids;
                        console.log(this.ids);
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            submit(){
                axios.post('api/clients/' +  + this.$route.params.id + '/categories', {'client_id': this.ids})
                    .then(res => {
                        this.ids = res.data.category_ids;
                        swal(
                            'Uspeh!',
                            'Klijentu su izmenjene kategorije.',
                            'success'
                        );
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
        }
    }
</script>

<style>
    .he-tree{
        border: 1px solid #ccc;
        padding: 20px;
        width: 100%;
    }
    .tree-node{
    }
    .tree-node-inner{
        padding: 5px;
        border: 1px solid #ccc;
        cursor: pointer;
    }
    .draggable-placeholder{
    }
    .draggable-placeholder-inner{
        border: 1px dashed #0088F8;
        box-sizing: border-box;
        background: rgba(0, 136, 249, 0.09);
        color: #0088f9;
        text-align: center;
        padding: 0;
        display: flex;
        align-items: center;
    }
</style>