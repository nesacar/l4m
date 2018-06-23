<template>
    <div class="form-group">
        <label :for="label">{{ label }}</label>
        <textarea class="form-control" :value="value" :id="label" cols="3" rows="4" @input="$emit('changeValue', $event.target.value)" ref="input"></textarea>
        <small class="form-text text-muted" v-if="error != null && error">{{ error[0] }}</small>
    </div>
</template>

<script>
    export default {
        props: ['label', 'value', 'error'],
    }
</script>