import { Alert } from "bootstrap";

export default class Form {
  constructor(formSelector) {
    this.form = document.querySelector(formSelector);

    this.submitListeners = [];
    this.form.addEventListener("submit", (e) => this.formSubmitListener(e));
    let isAjaxForm = "formAjax" in this.form.dataset;
    this.defaultSubmit = !isAjaxForm;
    if (isAjaxForm) {
      this.submitListeners.push(this.ajaxSubmit);
    }
  }

  get(propertyName) {
    if (propertyName === "element") {
      return this.getElement();
    } else if (propertyName === "data") {
      return this.getData();
    } else if (propertyName === "formData") {
      return this.getFormData();
    } else if (propertyName === "method") {
      return this.getMethod();
    } else if (propertyName === "action") {
      return this.getAction();
    } else if (propertyName === "enctype") {
      return this.getEnctype();
    }

    return {
      element: this.getElement(),
      data: this.getData(),
      formData: this.getFormData(),
      method: this.getMethod(),
      action: this.getAction(),
      enctype: this.getEnctype(),
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

  getFormData() {
    let data = new FormData();

    this.getElement()
      .querySelectorAll("input, textarea")
      .forEach((el) => {
        if (el.type === "file") {
          Array.from(el.files).forEach((file) => {
            data.append(el.name, file);
          });
        } else {
          data.append(el.name, el.value);
        }
      });

    return data;
  }

  getMethod() {
    return this.getElement().getAttribute("method");
  }

  getAction() {
    return this.getElement().getAttribute("action");
  }

  getEnctype() {
    return this.getElement().getAttribute("enctype");
  }

  getDataset(name = "") {
    const elDataset = this.getElement().dataset;
    if (name.length > 0) {
      return elDataset[name];
    }
    return elDataset;
  }

  hasAlert() {
    return this.getDataset("formAlert") !== undefined;
  }

  disable() {
    this.getElement()
      .querySelectorAll("fieldset")
      .forEach((fieldset) => {
        fieldset.setAttribute("disabled", "");
        fieldset.classList.add("disabled");
      });
  }

  enable() {
    this.getElement()
      .querySelectorAll("fieldset")
      .forEach((fieldset) => {
        fieldset.removeAttribute("disabled");
        fieldset.classList.remove("disabled");
      });
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

  addInputChangeListener(name) {
    const input = this.form.querySelector(`input[name="${name}"]`);
    const updateFormData = (e) => {
      if (input.type === "file") {
        this.formData.append(name, input.files[0]);
      }
    };
    input.addEventListener("change", updateFormData);
  }

  ajaxSubmit(event, form) {
    form.disable();

    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (this.readyState === 4) {
        form.enable();
        if (this.status === 200) {
          if (xhr.getResponseHeader("content-type").indexOf("json") > -1) {
            const { error, success } = JSON.parse(xhr.response);

            const triggerAlert = (
              alertId,
              alertContent = null,
              alertFunction = null
            ) => {
              const alertTargetEl = document.getElementById(alertId);

              if (alertTargetEl) {
                const alertEl = alertTargetEl.cloneNode(true);
                alertEl.id = "";
                alertTargetEl.parentNode.append(alertEl);
                // update content, if necessary
                if (alertContent !== null) {
                  alertEl.getElementsByTagName("div")[0].innerHTML =
                    alertContent;
                }

                // show alert
                const bsAlert = new Alert(alertEl);
                alertEl.classList.remove("visually-hidden");
                setTimeout(() => {
                  alertEl.classList.add("show");
                }, 100);

                // setup autohide, if given
                const alertAutoclose = alertEl.dataset?.alertAutoclose;
                if (alertAutoclose) {
                  setTimeout(() => {
                    bsAlert.close();
                  }, alertAutoclose);
                }

                // trigger additional function, if given
                if (alertFunction !== null) {
                  alertFunction();
                }

                // return true, if alert was triggered
                return true;
              }

              return false;
            };

            if (error === false) {
              if (success) {
                triggerAlert(form.getDataset("formAlertSuccess"), success);
              }

              let ajaxSuccessFunction = form.getDataset("formAjaxSuccess");
              if (ajaxSuccessFunction === "reload") {
                window.location.reload();
              } else if (ajaxSuccessFunction.startsWith("redirect:")) {
                window.loclation.replace(ajaxSuccessFunction.substr(9));
              }
            } else {
              const errorAlertTriggered = triggerAlert(
                form.getDataset("formAlertError"),
                error
              );
              if (!errorAlertTriggered) {
                console.warn(error);
              }
            }
            form.reset();
          }
        }
      }
    };

    xhr.onloadend = function () {
      form.enable();
    };

    xhr.open(form.getMethod(), form.getAction(), true);
    xhr.setRequestHeader("Accept", "application/json");
    xhr.send(form.getFormData());
  }
}
