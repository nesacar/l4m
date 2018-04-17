<template>
    <select class="input-sm form-control">
        <slot></slot>
    </select>
</template>

<script>
    import Select2 from 'select2';

    export default{
        props: ['options', 'value', 'multiple'],
        mounted(){
            var vm = this;
            $(this.$el).select2({theme: 'bootstrap', data: this.options, multiple: this.multiple}).val(this.value).trigger('change')
                .on('change', (value) => {
                    if(this.multiple){
                        let val = [];
                        $(".input-sm :selected").map(function(i, el) {
                            //console.log($(el).val());
                            val[i] = $(el).val();
                        });
                        vm.$emit('input', val);
                    }else{
                        vm.$emit('input', value.currentTarget.value);
                    }
                })
        },
        watch: {
            value: function (value) {
                $(this.$el).val(value).trigger('change');
            },
            options: function (options) {
                $(this.$el).select2({data: options});
            }
        },
//        destroyed: function () {
//            $(this.$el).off().select2('destroy');
//        }
    }

</script>

<style src="select2/dist/css/select2.min.css"></style>
<style src="select2-bootstrap-theme/dist/select2-bootstrap.min.css"></style>