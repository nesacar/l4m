<template>
    <div class="form-group">
        <label :for="label">{{ label }} <span v-if="required">*</span></label>
        <input type="password" class="form-control" :id="label" @input="$emit('changeValue', $event.target.value)" ref="input">
        <small class="form-text text-muted" v-if="error != null && error">{{ error[0] }}</small>
    </div>
</template>

<script>
    export default {
        props: ['label', 'error', 'required'],
    }
</script>

<style scoped>
    span { color: red; }
</style>