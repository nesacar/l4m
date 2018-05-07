class Emitter {
  /**
   * Creates new event emitter.
   */
  constructor() {
    this._events = {};
  }

  /**
   * Adds listener to the passed event.
   * @param {String} event - Event name.
   * @param {Function} listener - Callback function.
   */
  on(event, listener) {
    this._events[event] = this._events[event] || [];
    this._events[event].push(listener);
  }

  /**
   * Removes event listener.
   * @param {String} event - Event name.
   * @param {Function} listener - Listener to remove.
   */
  off(event, listener) {
    const index = (this._events[event] || []).indexOf(listener);
    if (index < 0) {
      return;
    }
    
    this._events[event].splice(index, 1);
  }

  /**
   * Dispatches the event.
   * @param {String} event - Event name.
   * @param {any} data - Data passed to the callback.
   */
  emit(event, data) {
    (this._events[event] || []).forEach((listener) => {
      listener(data);
    });
  }
}

export default Emitter;
