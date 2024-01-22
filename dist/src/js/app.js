import Form from "./modules/form";
import EntryCollector from "./modules/entry-collector";
import CookieConsent from "./modules/cookie-consent";
import Countdown from "./modules/countdown";
import MasonryGallery from "./modules/masonry-gallery";
import Slider from "./modules/slider";
import { Alert } from "bootstrap";

const LoadingScreen = {
  show: () => {
    document.body.style.overflow = "hidden";
    document.getElementById("loading-screen").classList.remove("d-none");
  },
  hide: () => {
    document.getElementById("loading-screen").classList.add("d-none");
    document.body.style.overflow = "";
  },
};

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
      !e.target.classList.contains("btn-secondary") &&
      !e.target.parentNode.classList.contains("btn-secondary")
    ) {
      LoadingScreen.show();
    }
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
  let uploadForm = new Form(`#${form.id}`);
  uploadForm.preventDefaultSubmit();

  const CHUNK_SIZE = 100 * 1024 * 1024; // 100 MB in Bytes

  uploadForm.onSubmit((e, form) => {
    let xhr = new XMLHttpRequest();
    const fileInput = form.getElement().querySelector("input[type=file]");
    const files = fileInput.files;
    const progressWrapper = document.querySelector(".progress-wrapper");
    const progressBar = document.querySelector(".progress-bar");
    xhr.timeout = 10 * 60 * 1000;
    form.disable();
    progressBar.style.width = "0%";
    progressBar.innerText = "0%";
    fileInput.classList.add("d-none");
    progressWrapper.classList.remove("d-none");

    xhr.upload.addEventListener("progress", (event) => {
      if (event.lengthComputable) {
        const percentComplete = Math.round((event.loaded / event.total) * 100);
        progressBar.style.width = percentComplete + "%";
        progressBar.setAttribute("aria-valuenow", percentComplete);
        progressBar.innerText = percentComplete + "%";
      }
    });

    xhr.onloadend = function () {
      console.log(xhr.response);
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

      progressBar.style.width = "0%";
      progressBar.innerText = "0%";
      progressWrapper.classList.add("d-none");
      fileInput.classList.remove("d-none");

      form.enable();
    };

    let currentFileNo;
    let currentChunkNo;
    let file;
    let chunksTotal;
    let formData = form.getFormData();

    const setNextFile = () => {
      file = files[currentFileNo];
      chunksTotal = Math.ceil(file.size / CHUNK_SIZE);
      formData.set("filename", file.name);
      formData.set("chunks", chunksTotal);
    };

    const setNextChunk = () => {
      const start = currentChunkNo * CHUNK_SIZE;
      const chunkEnd = Math.min(start + CHUNK_SIZE, file.size);
      const chunk = file.slice(start, chunkEnd);
      const blobEnd = chunkEnd - 1;
      const contentRange = "bytes " + start + "-" + chunkEnd + "/" + file.size;

      formData.set(fileInput.name, chunk);
      formData.set("chunk", currentChunkNo);
      xhr.setRequestHeader("Content-Range", contentRange);
    };

    xhr.onreadystatechange = () => {
      xhr.open(form.getMethod(), form.getAction(), true);
      xhr.setRequestHeader("Accept", "application/json");
      console.log(xhr.response);

      if (xhr.readyState === 4) {
        if (currentChunkNo < chunksTotal - 1) {
          // file not ready yet, send next chunk
          currentChunkNo++;
        } else if (currentFileNo < files.length - 1) {
          // all chunks send, reset chunk counter and send next file
          currentChunkNo = 0;
          currentFileNo++;
          setNextFile(files, currentFileNo);
        }
        setNextChunk(file, formData, currentChunkNo);

        xhr.send(formData);
      }
    };

    // initial request with currentFileNo = 0 and currentChunkNo = 0
    xhr.open(form.getMethod(), form.getAction(), true);
    xhr.setRequestHeader("Accept", "application/json");
    currentFileNo = 0;
    currentChunkNo = 0;
    setNextFile();
    setNextChunk();
    xhr.send(formData);

    // for (let i = 0; i < files.length; i++) {
    //   const file = files[i];
    //   let start = 0;
    //   const chunksTotal = Math.ceil(file.size / CHUNK_SIZE);
    //   let currentChunkNo = 0;

    //   while (start < file.size) {
    //     const chunkEnd = Math.min(start + CHUNK_SIZE, file.size);
    //     const chunk = file.slice(start, chunkEnd);
    //     const blobEnd = chunkEnd - 1;
    //     const contentRange =
    //       "bytes " + start + "-" + chunkEnd + "/" + file.size;
    //     const formData = form.getFormData();

    //     formData.set(fileInput.name, chunk);
    //     formData.append("filename", file.name);
    //     formData.append("chunks", chunksTotal);
    //     formData.append("chunk", currentChunkNo);
    //     console.log(fileInput.name, chunk);

    //     xhr.open(form.getMethod(), form.getAction(), true);
    //     xhr.setRequestHeader("Accept", "application/json");
    //     xhr.setRequestHeader("Content-Range", contentRange);
    //     xhr.send(formData);

    //     start += CHUNK_SIZE;
    //     currentChunkNo++;
    //   }
    // }

    progressBar.style.width = "0%";
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
    e.preventDefault();
    if (!node.classList.contains("disabled")) {
      const iconNode = node.querySelector("i");
      const iconName = iconNode.innerText;
      const downloadUrl = node.getAttribute("href");
      node.classList.add("disabled");
      node.dataset.loading = true;
      iconNode.innerText = "downloading";
      fetch(downloadUrl)
        .then((response) => response.blob())
        .then((blob) => {
          const tempEl = document.createElement("a");
          tempEl.href = window.URL.createObjectURL(blob);
          tempEl.download =
            node.getAttribute("download") || downloadUrl.split("/").pop();
          tempEl.click();
        })
        .then(() => {
          iconNode.innerText = iconName;
          node.classList.remove("disabled");
          node.dataset.loading = false;
          LoadingScreen.hide();
        });
    }
  });

  // ensure to prevent default behaviour
  return false;
});

document
  .querySelectorAll("[data-loading]:not([data-download])")
  .forEach((node) => {
    node.addEventListener("click", (e) => {
      node.dataset.loading = true;
    });
  });

document
  .querySelectorAll(".mm-masonry")
  .forEach((container) => new MasonryGallery(container));

document
  .querySelectorAll(".carousel:not([data-slider-init='true'])")
  .forEach((node) => new Slider(node));

LoadingScreen.show();

document.querySelectorAll("[data-loading-screen]").forEach((node) => {
  node.addEventListener("click", (e) => {
    LoadingScreen.show();
  });
});

document.querySelectorAll("[data-history-back]").forEach((node) => {
  node.addEventListener("click", (e) => {
    e.preventDefault();
    window.history.back();
    return false;
  });
});

document.addEventListener("readystatechange", (event) => {
  if (event.target.readyState === "complete") {
    LoadingScreen.hide();
  }
});

window.addEventListener("pageshow", (event) => {
  if (event.persisted) {
    LoadingScreen.hide();
  }
});
