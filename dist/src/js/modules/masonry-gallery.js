import { Modal } from "bootstrap";
import Slider from "./slider";

export default class MasonryGallery {
  constructor(container) {
    this.container = container;
    this.items = [...this.container.querySelectorAll(".mm-masonry__item")];
    this.columnGap = this.container.dataset.masonryColumnGap || 16;

    this.initColumnWidth();
    this.initImages();
    this.initModal();
  }

  getUnloadedItems() {
    return this.items.filter((item) => !item.dataset?.loaded);
  }

  initImages() {
    this.getUnloadedItems().forEach((item) => {
      const image = item.querySelector(".mm-masonry__img");
      image.addEventListener("load", () => {
        item.style.setProperty("--w", image.naturalWidth);
        item.style.setProperty("--h", image.naturalHeight);
        item.querySelectorAll("[data-show-on-loaded]").forEach((el) => {
          el.classList.remove("d-none");
        });
      });
    });

    // initially load first 12 images
    this.getUnloadedItems()
      .slice(0, 24)
      .forEach((item) => this.loadImage(item));

    window.addEventListener("scroll", () => {
      this.getUnloadedItems().forEach((item) => {
        const itemDimensions = item.getBoundingClientRect();
        const limit = window.innerHeight + 6000;
        if (itemDimensions.top < limit && itemDimensions.bottom > 0) {
          this.loadImage(item);
        }
      });
    });
  }

  loadImage(item) {
    const image = item.querySelector(".mm-masonry__img");
    document
      .querySelectorAll('[data-src="' + image.dataset.src + '"]')
      .forEach((image) => {
        image.setAttribute("src", image.dataset.src);
        item.dataset.loaded = true;
      });
  }

  initColumnWidth() {
    const setColumnWidth = () => {
      const containerWidth = this.container.getBoundingClientRect().width;
      const screenWidth = window.innerWidth;
      const isMobile = screenWidth < 768;
      if (!isMobile) {
        const isDesktop = screenWidth >= 992;
        const columnCount = isDesktop ? 3 : 2;
        const columnWidth =
          (containerWidth - this.columnGap * (columnCount - 1)) / columnCount;

        this.container.style.setProperty("--col-width", columnWidth);
        this.container.style.setProperty("--gap", this.columnGap);
      }
    };

    setColumnWidth();
    window.addEventListener("resize", setColumnWidth);
  }

  initModal() {
    const modalEl = document.querySelector(this.container.dataset.targetModal);
    const modal = new Modal(modalEl);
    const slider = new Slider(
      document.querySelector(this.container.dataset.targetCarousel)
    );

    this.items.forEach((item) => {
      const { galleryIndex } = item.dataset;
      item.addEventListener("click", () => {
        slider.goToSlide(galleryIndex);
        modal.show();
        slider.scrollIndicators({ to: galleryIndex });
      });
    });

    modalEl.addEventListener("hide.bs.modal", (e) => {
      slider.pauseVideo();
    });
  }
}
