import EntryCollector from "./modules/entry-collector";

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
