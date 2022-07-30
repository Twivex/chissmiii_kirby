import Form from "./form";

export default class EntryCollector {
  constructor(entryCollectorTarget) {
    const form = new Form(
      `[data-entry-collector-for="${entryCollectorTarget}"]`
    );
    form.onSubmit((e, form) => {
      this.submitEntry(form);
    });
  }

  static init() {
    document.querySelectorAll("[data-entry-collector]").forEach((form) => {
      new EntryCollector(form.dataset.entryCollectorFor);
    });
  }

  submitEntry(form) {
    form.disable();

    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        if (xhr.getResponseHeader("content-type").indexOf("json") > -1) {
          const { error, html } = JSON.parse(xhr.response);
          const formDataset = form.getDataset();

          if (!error) {
            const alertSuccessTarget = formDataset.entryCollectorAlertSuccess;
            if (alertSuccessTarget.length > 0) {
              const alertEl = document.getElementById(alertSuccessTarget);
              alertEl.parentElement.classList.remove("visually-hidden");
              alertEl.parentElement.classList.add("show");
              setTimeout(() => {
                alertEl.parentElement.classList.remove("show");
                setTimeout(() => {
                  alertEl.parentElement.classList.add("visually-hidden");
                }, 150);
              }, 2000);
            }

            if (formDataset.entryCollectorMode === "append") {
              document
                .getElementById(formDataset.entryCollectorFor)
                .insertAdjacentHTML("afterbegin", html);
            } else if (formDataset.entryCollectorMode === "replace") {
              document.getElementById(formDataset.entryCollectorFor).innerHTML =
                html;
            }
          } else {
            const alertErrorTarget = formDataset.entryCollectorAlertError;
            if (alertErrorTarget.length > 0) {
              const alertEl = document.getElementById(alertErrorTarget);
              alertEl.innerHTML = error;
              alertEl.parentElement.classList.remove("visually-hidden");
              alertEl.parentElement.classList.add("show");
              setTimeout(() => {
                alertEl.parentElement.classList.remove("show");
                setTimeout(() => {
                  alertEl.parentElement.classList.add("visually-hidden");
                }, 150);
              }, 2000);
            } else {
              console.warn(error);
            }
          }
          form.reset();
          form.enable();
        }
      }
    };
    xhr.open(form.getMethod(), form.getAction() + ".json", true);
    xhr.setRequestHeader("Accept", "application/json");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(form.getData(true));
  }
}
