<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form>
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Pretraga" v-model="search.text">
                        </div>
                        <div class="col">
                            <select name="lists" id="lists" class="form-control" v-model="search.list">
                                <option :value="index" v-for="(list, index) in lists">{{ list }}</option>
                            </select>
                        </div>
                        <div class="col">
                            <button class="btn btn-success pull-right" @click.prevent="submit()">Pretraga</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['lists', 'search'],
        methods: {
            submit(){
                this.$emit('updateSearch', this.search);
            }
        },
    }
</script>