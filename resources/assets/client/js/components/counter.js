class Counter {
  set value(newValue) {
    // Ignore non numeric values
    if (isNaN(newValue)) {
      return;
    }

    this._value = newValue;
    this._update();
  }

  get value() {
    return this._value;
  }

  constructor(root) {
    this.root = root;
    this._input = this.root.querySelector('input.counter_value');
    this._buttons = this.root.querySelectorAll('button.counter_control');

    this._onClick = this._onClick.bind(this);

    this._buttons.forEach(button => {
      button.addEventListener('click', this._onClick);
    });

    const initialValue = this._input.value;

    this._value = isNaN(initialValue) ? 0 : parseInt(this._input.value);
    this._update();
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
    this.value = this._value + 1;
  }

  decrement() {
    this.value = this._value - 1;
  }

  _update() {
    this._input.value = this._value;
  }
}

export default Counter;