import Form from "./form";

export default class Guestbook {
  constructor() {
    const form = new Form('[data-guestbook="form"]');
    form.onSubmit((e, form) => {
      this.submitEntry(form);
    });
  }

  static init() {
    this.guestbook = new Guestbook();
  }

  submitEntry(form) {
    form.disable();

    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        if (xhr.getResponseHeader("content-type").indexOf("json") > -1) {
          const { error, html } = JSON.parse(xhr.response);
          if (!error) {
            document
              .querySelector('[data-guestbook="entries"]')
              .insertAdjacentHTML("afterbegin", html);
            form.getElement().reset();
            form.enable();
          } else {
            console.warn(error);
          }
        }
      }
    };
    xhr.open(form.getMethod(), form.getAction() + ".json", true);
    xhr.setRequestHeader("Accept", "application/json");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(form.getData(true));
  }
}
