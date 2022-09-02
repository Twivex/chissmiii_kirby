export default class Form {
  constructor(formSelector) {
    this.form = document.querySelector(formSelector);
    this.defaultSubmit = true;
    this.submitListeners = [];
    this.form.addEventListener("submit", (e) => this.formSubmitListener(e));
  }

  get(propertyName) {
    if (propertyName === "element") {
      return this.getElement();
    } else if (propertyName === "data") {
      return this.getData();
    } else if (propertyName === "method") {
      return this.getMethod();
    } else if (propertyName === "action") {
      return this.getAction();
    }

    return {
      element: this.getElement(),
      data: this.getData(),
      method: this.getMethod(),
      action: this.getAction(),
    };
  }

  getElement() {
    return this.form;
  }

  getData(urlEncoded = false) {
    let data = {};
    this.getElement()
      .querySelectorAll("input, textarea")
      .forEach((el) => {
        data[el.name] = el.value;
      });

    if (urlEncoded) {
      let urlEncodedData = "";
      let urlEncodedDataPairs = [];

      for (const [key, value] of Object.entries(data)) {
        urlEncodedDataPairs.push(
          encodeURIComponent(key) + "=" + encodeURIComponent(value)
        );
      }
      urlEncodedData = urlEncodedDataPairs.join("&").replace(/%20/g, "+");
      data = urlEncodedData;
    }

    return data;
  }

  getMethod() {
    return this.getElement().getAttribute("method");
  }

  getAction() {
    return this.getElement().getAttribute("action");
  }

  getDataset(name = "") {
    const elDataset = this.getElement().dataset;
    if (name.length > 0) {
      return elDataset[name];
    }
    return elDataset;
  }

  disable() {
    this.getElement().querySelector("fieldset").setAttribute("disabled", "");
  }

  enable() {
    this.getElement().querySelector("fieldset").removeAttribute("disabled");
  }

  reset() {
    this.getElement().reset();
  }

  addClass(classname) {
    this.getElement().classList.add(classname);
  }

  removeClass(classname) {
    this.getElement().classList.remove(classname);
  }

  preventDefaultSubmit() {
    this.defaultSubmit = false;
  }

  onSubmit(listener) {
    this.submitListeners.push(listener);
  }

  removeListener(listenerToRemove) {
    this.submitListeners = this.submitListeners.filter(
      (listener) => listener !== listenerToRemove
    );
  }

  emitSubmit(event) {
    const fireCallbacks = (callback) => {
      callback(event, this);
    };

    this.submitListeners.forEach(fireCallbacks);
  }

  validate() {
    const formIsValid = this.getElement().checkValidity();
    if (formIsValid) {
      this.removeClass("was-validated");
    } else {
      this.addClass("was-validated");
    }
    return formIsValid;
  }

  formSubmitListener(event) {
    const valid = this.validate();
    if (valid) {
      this.emitSubmit(event);
    } else {
      event.stopPropagation();
    }

    if (!this.defaultSubmit) {
      event.preventDefault();
    }
  }
}
