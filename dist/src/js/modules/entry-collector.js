import Form from "./form";
import { Alert } from "bootstrap";

export default class EntryCollector {
  constructor(entryCollectorTarget) {
    const form = new Form(
      `[data-entry-collector-for="${entryCollectorTarget}"]`
    );
    form.preventDefaultSubmit();
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
              if (alertContent != null) {
                alertEl.getElementsByTagName("div")[0].innerHTML = alertContent;
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
            const updateTargetContent = () => {
              const mode = form.getDataset("entryCollectorMode");
              switch (mode) {
                case "append":
                  console.warn("Not implemented yet.");
                  break;

                case "prepend":
                  document
                    .getElementById(formDataset.entryCollectorFor)
                    .insertAdjacentHTML("afterbegin", html);
                  break;

                case "replace":
                  document.getElementById(
                    formDataset.entryCollectorFor
                  ).innerHTML = html;
                  break;

                default:
              }
            };

            triggerAlert(form.getDataset("entryCollectorAlertSuccess"));
            updateTargetContent();
          } else {
            const errorAlertTriggered = triggerAlert(
              form.getDataset("entryCollectorAlertError"),
              error
            );
            if (!errorAlertTriggered) {
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
