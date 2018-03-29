<template>
    <nav aria-label="Page navigation example" v-if="paginate.last_page > 1">
        <ul class="pagination justify-content-center">
            <li class="page-item" :class="{ 'disabled': paginate.current_page == 1 }"  @click.prevent="firstLink(paginate.current_page)">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <template v-if="paginate.last_page > 10">
                <!-- start -->
                <template v-if="paginate.current_page < first">
                    <li class="page-item" v-for="index in first" :class="{ 'active': paginate.current_page == index }" @click.prevent="clickLink(index)"><a class="page-link" href="#">{{ index }}</a></li>
                    <li class="page-item"><a class="page-link disabled">...</a></li>
                    <li class="page-item" @click.prevent="clickLink(paginate.last_page)"><a class="page-link" href="#">{{ paginate.last_page }}</a></li>
                </template>
                <!-- end -->
                <template v-if="paginate.current_page > paginate.last_page - 6">
                    <li class="page-item" @click.prevent="clickLink(1)"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link disabled">...</a></li>
                    <li class="page-item" v-for="index in first" :class="{ 'active': paginate.current_page == (index + last) }" @click.prevent="clickLink(index + last)"><a class="page-link" href="#">{{ index + last }}</a></li>
                </template>
                <!-- middle -->
                <template v-if="paginate.current_page >= 6 && paginate.current_page <= paginate.last_page - 6">
                    <li class="page-item" @click.prevent="clickLink(1)"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link disabled">...</a></li>
                    <li class="page-item" v-for="index in first" :class="{ 'active': paginate.current_page == (index + medStart) }" @click.prevent="clickLink(index + medStart)"><a class="page-link" href="#">{{ index + medStart }}</a></li>
                    <li class="page-item"><a class="page-link disabled">...</a></li>
                    <li class="page-item" @click.prevent="clickLink(paginate.last_page)"><a class="page-link" href="#">{{ paginate.last_page }}</a></li>
                </template>
            </template>
            <template v-if="paginate.last_page <= 10">
                <li class="page-item" v-for="index in paginate.last_page" :class="{ 'active': paginate.current_page == index }" @click.prevent="clickLink(index)"><a class="page-link" href="#">{{ index }}</a></li>
            </template>
            <li class="page-item" :class="{ 'disabled': paginate.current_page == paginate.last_page }" @click.prevent="lastLink(paginate.current_page)">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        data(){
            return {
                first: 6
            }
        },
        computed: {
            last(){
                return this.paginate.last_page - this.first;
            },
            medStart(){
                return this.paginate.current_page - this.first/2;
            },
            medEnd(){
                return this.paginate.current_page + this.first/2;
            }
        },
        props: ['paginate'],
        methods: {
            clickLink(index){
                if(this.paginate.current_page != index){
                    this.$emit('clickLink', index);
                }
            },
            lastLink(index){
                let newindex = index + 1;
                if(newindex <= this.paginate.last_page){
                    this.$emit('clickLink', newindex);
                }
            },
            firstLink(index){
                let newindex = index - 1;
                if(newindex >= 1){
                    this.$emit('clickLink', newindex);
                }
            }
        }
    }
</script>

<style scoped>
    a:focus{
        outline: none !important;
        box-shadow: none;
        background-color: white;
    }
</style>