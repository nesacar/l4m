<template>
  <div class="wrap"
    tabindex="0"
    @focus.capture="_onFocus"
    @blur.capture="_onBlur"
  >
    <textarea class="input-control"
      :value="value"
      :name="name"
      @change="onChange"
      v-if="focus"
    ></textarea>
    <input class="preview"
      :value="preview"
      readonly
      tabindex="-1"
      v-else
    />
  </div>
</template>

<script>
export default {
  props: {
    name: {
      type: String,
    },
    value: {
      type: String,
      value: '',
    },
    onChange: {
      type: Function,
      required: true,
    },
  },

  data() {
    return {
      focus: false,
    };
  },

  computed: {
    preview() {
      return this.value.slice(0, 12) + '...';
    },
  },

  methods: {
    _onFocus() {
      this.focus = true;
    },

    _onBlur() {
      this.focus = false;
    },
  },
};
</script>

<style lang="scss" scoped>
  .wrap {
    position: relative;
    display: inline-block;
    vertical-align: middle;
    width: 100%;
    min-width: 120px;
    height: 32px;
    border: 1px solid #E0E0E0;
    outline: none !important;

    &:hover {
      background-color: #E0E0E0;
    }
  }

  .input-control {
    position: absolute;
    top: 0;
    left: 0;
    width: 360px;
    height: 96px;
    border: 1px solid #131b24;
    outline: none !important;
    z-index: 10;
  }

  .preview {
    width: 100%;
    height: 100%;
    padding: 0 8px;
    margin: 0;
    border: 0;
    outline: none;
    pointer-events: none;
    background: none;
    font-size: 12px;
  }
</style>
