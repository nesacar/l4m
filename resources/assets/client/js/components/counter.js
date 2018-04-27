class Counter {
  static isValidInput(n) {
    // Positive numbers or empty string
    const reg = /^\d*\.?\d*$/;
    return reg.test(n);
  }

  set value(newValue) {
    // Ignore non numeric values
    this._value = Counter.isValidInput(newValue)
      ? newValue
      : this._value || 0;
    this._update();
  }

  get value() {
    return this._value;
  }

  constructor(root) {
    this.root = root;
    this._input = this.root.querySelector('input.counter_value');
    this._buttons = this.root.querySelectorAll('button.counter_control');

    this._onBlur = this._onBlur.bind(this);
    this._onClick = this._onClick.bind(this);
    this._onInput = this._onInput.bind(this);

    this._buttons.forEach(button => {
      button.addEventListener('click', this._onClick);
    });

    this._input.addEventListener('blur', this._onBlur);
    this._input.addEventListener('input', this._onInput);

    this.value = this._input.value;
  }

  _onBlur(evt) {
    const input = this._input.value;

    if (input === '') {
      this.value = 0;
    }
  }

  _onInput(evt) {
    this.value = this._input.value;
  }

  _onClick(evt) {
    const action = evt.target.dataset.action;

    switch(action) {
      case 'increment':
        this.increment();
        break;
      case 'decrement':
        this.decrement();
        break;
      default:
        console.error(`Unknown action: ${action}. Check buttons data-action attributes.`);
        break;
    }
  }

  increment() {
    this.value = parseInt(this._value) + 1;
  }

  decrement() {
    this.value = parseInt(this._value) - 1;
  }

  _update() {
    this._input.value = this._value;
  }
}

export default Counter;