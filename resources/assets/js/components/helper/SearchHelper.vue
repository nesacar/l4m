<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form>
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Pretraga" :value="text" @keyup="changeText($event)">
                        </div>
                        <div class="col">
                            <select name="lists" id="lists" class="form-control" @change="changeList($event)">
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
        data(){
            return {
                myText: null,
                myList: 0
            }
        },
        props: ['lists', 'text'],
        methods: {
            changeText(value){
                this.myText = value.target.value;
            },
            changeList(value){
                this.myList = value.target.value;
            },
            submit(){
                let data = {
                    text: this.myText,
                    list: this.myList
                };
                this.$emit('updateSearch', data);
            }
        }
    }
</script>