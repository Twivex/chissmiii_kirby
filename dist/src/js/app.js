import Form from "./modules/form";
import EntryCollector from "./modules/entry-collector";
import CookieConsent from "./modules/cookie-consent";
import Countdown from "./modules/countdown";

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

document.querySelectorAll("[data-countdown]").forEach((node) => {
  new Countdown(node);
});
