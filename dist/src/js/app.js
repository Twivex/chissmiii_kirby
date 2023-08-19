import Form from "./modules/form";
import EntryCollector from "./modules/entry-collector";
import CookieConsent from "./modules/cookie-consent";
import Countdown from "./modules/countdown";
import MasonryGallery from "./modules/masonry-gallery";
import Slider from "./modules/slider";
import { Alert } from "bootstrap";

CookieConsent.init();
EntryCollector.init();

document.querySelectorAll("[data-hide]").forEach((el) => {
  el.addEventListener("click", (e) => {
    const targetEl = el.closest(`.${el.dataset.hide}`);
    targetEl.classList.remove("show");
  });
});

document.querySelectorAll("[data-visually-hide]").forEach((el) => {
  el.addEventListener("click", (e) => {
    const targetEl = el.closest(`.${el.dataset.visuallyHide}`);
    targetEl.classList.remove("show");
    setTimeout(() => {
      targetEl.classList.add("visually-hidden");
    }, 150);
  });
});

document.querySelectorAll("[data-form]").forEach((form) => {
  new Form(`#${form.id}`);
});

// click listener for clickable cards
document.querySelectorAll(".card--clickable").forEach((node) => {
  node.addEventListener("click", (e) => {
    if (
      e.target.tagName !== "A" &&
      !e.target.classList.contains("btn") &&
      e.target.parentNode.tagName !== "A" &&
      !e.target.parentNode.classList.contains("btn")
    ) {
      node.querySelector(".btn-primary").click();
    }
  });
});

document.querySelectorAll("[data-upload-form]").forEach((form) => {
  let fileInput = form.querySelector("input[type=file]");
  let uploadForm = new Form(`#${form.id}`);
  // uploadForm.addInputChangeListener("uploadFile");
  uploadForm.preventDefaultSubmit();
  uploadForm.onSubmit((e, form) => {
    form.disable();

    const xhr = new XMLHttpRequest();
    xhr.onloadend = function () {
      if (this.status === 200) {
        if (xhr.getResponseHeader("content-type").indexOf("json") > -1) {
          const { error, success } = JSON.parse(xhr.response);
          // const formDataset = form.getDataset();

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
            triggerAlert(form.getDataset("uploadFormAlertSuccess"), success);
          } else {
            const errorAlertTriggered = triggerAlert(
              form.getDataset("uploadFormAlertError"),
              error
            );
            if (!errorAlertTriggered) {
              console.warn(error);
            }
          }
          form.reset();
        }
      }
      form.enable();
    };
    xhr.open(form.getMethod(), form.getAction(), true);
    xhr.setRequestHeader("Accept", "application/json");
    xhr.send(form.getFormData());
  });
});

document.querySelectorAll("[data-countdown]").forEach((node) => {
  new Countdown(node);
});

document.querySelectorAll('[data-bs-toggle="modal"]').forEach((node) => {
  if (node.dataset.bsTarget === "#modal-upload-form") {
    node.addEventListener("click", (e) => {
      document
        .getElementById("modal-upload-form")
        .querySelector("form")
        .setAttribute("action", node.getAttribute("href"));
    });
  }
});

document.querySelectorAll("[data-download]").forEach((node) => {
  node.addEventListener("click", (e) => {
    if (!node.getAttribute("download")) {
      e.preventDefault();
    }
    if (!node.classList.contains("disabled")) {
      const xhr = new XMLHttpRequest();
      let blob;
      let iconNode = node.querySelector("i");
      let iconName = iconNode.innerText;
      xhr.responseType = "arraybuffer";
      xhr.onload = function () {
        blob = new Blob([this.response]);
      };
      xhr.onloadstart = function () {
        node.classList.add("disabled");
        node.dataset.download = true;
        iconNode.innerText = "downloading";
      };
      xhr.onloadend = function () {
        if (
          this.getResponseHeader("Content-type") ===
            "application/octet-stream" &&
          this.status === 200
        ) {
          let tempEl = document.createElement("a");
          let contentDispostion = xhr.getResponseHeader("Content-Disposition");
          let filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
          let matches = filenameRegex.exec(contentDispostion);
          let filename = "";

          if (matches !== null && matches.length > 1) {
            filename = matches[1].replace(/['"]/g, "");
          }
          document.body.appendChild(tempEl);
          tempEl.style = "display: none";
          tempEl.href = window.URL.createObjectURL(blob);
          tempEl.download = filename;
          tempEl.click();
        }

        iconNode.innerText = iconName;
        node.classList.remove("disabled");
        node.dataset.download = false;
      };

      xhr.open("GET", node.getAttribute("href"), true);
      xhr.send();
    }
  });
});

document
  .querySelectorAll(".mm-masonry")
  .forEach((container) => new MasonryGallery(container));

document
  .querySelectorAll(".carousel:not([data-slider-init='true'])")
  .forEach((node) => new Slider(node));
