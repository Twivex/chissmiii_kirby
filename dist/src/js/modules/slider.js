import { Carousel } from "bootstrap";

export default class Slider {
  constructor(container) {
    this.container = container;
    this.items = [...container.querySelectorAll(".carousel-item")];
    this.carousel = Carousel.getOrCreateInstance(container);

    this.initPauseVideos();

    if (container.dataset.lazyLoad && container.dataset.lazyLoad !== "false") {
      this.initLazyLoad();
    }
  }

  goToSlide(index) {
    this.carousel.to(index);
  }

  getActiveItem() {
    return this.container.querySelector(".carousel-item.active");
  }

  initPauseVideos() {
    this.container.addEventListener("slide.bs.carousel", (e) => {
      const activeItem = this.getActiveItem();
      const video = activeItem.querySelector("video");

      if (video) {
        video.pause();
      }
    });
  }

  initLazyLoad() {
    const loadSuroundingItems = (index) => {
      let lowerBorder = index - 3;
      let upperBorder = index + 4;
      if (lowerBorder < 0) {
        lowerBorder = this.items.length + lowerBorder;
      }
      if (upperBorder > this.items.length) {
        upperBorder = upperBorder - this.items.length;
      }

      let surroundingItems = [];
      if (lowerBorder < upperBorder) {
        surroundingItems = [
          ...this.items.slice(lowerBorder, index),
          ...this.items.slice(index, upperBorder),
        ];
      } else {
        surroundingItems = [
          ...this.items.slice(lowerBorder, this.items.length),
          ...this.items.slice(0, upperBorder),
        ];
      }
      surroundingItems
        .filter(
          (item) => !item.querySelector("img, video source").getAttribute("src")
        )
        .forEach((item) => {
          const mediaSrc = item.querySelector("img, video source").dataset.src;
          document
            .querySelectorAll('[data-src="' + mediaSrc + '"]')
            .forEach((media) => {
              media.setAttribute("src", mediaSrc);
            });
        });
    };

    const activeItem = this.getActiveItem();
    if (activeItem) {
      loadSuroundingItems(activeItem.dataset.carouselIndex);
    }

    this.container.addEventListener("slide.bs.carousel", (e) => {
      const { to } = e;
      loadSuroundingItems(to);
    });
  }
}
