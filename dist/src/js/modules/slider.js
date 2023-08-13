import { Carousel } from "bootstrap";

export default class Slider {
  constructor(container) {
    this.container = container;
    this.items = [...container.querySelectorAll(".carousel-item")];
    this.indicatorContainer = this.container.querySelector(
      ".carousel-indicators"
    );
    this.indicatorItems = [
      ...container.querySelectorAll(".carousel-indicators button"),
    ];
    this.hasIndicators = this.indicatorItems.length > 0;
    this.carousel = Carousel.getOrCreateInstance(container);
    this.slideListeners = [];
    this.filterByNotLoaded = (item) => !item.dataset?.loaded;
    this.filterByIsNotLoading = (item) => !item.dataset?.loading;

    if (container.dataset?.lazyLoad) {
      this.initLazyLoad();
    } else if (this.hasIndicators) {
      this.slideListeners.push(this.scrollIndicators.bind(this));
    }

    this.slideListeners.push(this.pauseVideo.bind(this));

    this.container.addEventListener("slide.bs.carousel", (e) => {
      this.emitSlideEvent(e);
    });
  }

  emitSlideEvent(event) {
    const fireCallback = (callback) => {
      callback(event);
    };
    this.slideListeners.forEach(fireCallback);
  }

  hasUnloadedItems(items) {
    return items.filter(this.filterByNotLoaded).length > 0;
  }

  goToSlide(index) {
    this.carousel.to(index);
  }

  getActiveItem() {
    return this.container.querySelector(".carousel-item.active");
  }

  getActiveIndicator() {
    return this.container.querySelector(".carousel-indicators .active");
  }

  pauseVideo() {
    const activeItem = this.getActiveItem();

    if (activeItem) {
      const video = activeItem.querySelector("video");

      if (video) {
        video.pause();
      }
    }
  }

  getSurroundingItemBorders(items, index, range, mode = "center", limits = {}) {
    let lowerBorder;
    let upperBorder;

    switch (mode) {
      case "left":
        lowerBorder = index - range;
        upperBorder = index + 1;
        break;

      case "right":
        lowerBorder = index;
        upperBorder = index + range + 1;
        break;

      case "center":
      default:
        lowerBorder = index - range / 2;
        upperBorder = index + range / 2 + 1;
    }

    if (lowerBorder < 0) {
      lowerBorder = items.length + lowerBorder;
    }

    if (upperBorder > items.length) {
      upperBorder = upperBorder - items.length;
    }

    if (limits.lower) {
      lowerBorder = Math.max(lowerBorder, limits.lower);
    }

    if (limits.upper) {
      upperBorder = Math.min(upperBorder, limits.upper);
    }

    return { lowerBorder, upperBorder };
  }

  getSurroundingItems(items, index, range, mode = "center", limits = {}) {
    index = parseInt(index);

    const { lowerBorder, upperBorder } = this.getSurroundingItemBorders(
      items,
      index,
      range,
      mode,
      limits
    );

    let surroundingItems = [];
    if (lowerBorder < upperBorder) {
      surroundingItems = [
        ...items.slice(lowerBorder, index),
        ...items.slice(index, upperBorder),
      ];
    } else {
      surroundingItems = [
        ...items.slice(lowerBorder, items.length),
        ...items.slice(0, upperBorder),
      ];
    }
    return surroundingItems;
  }

  loadSurroundingItems(items, index, range, mode = "center") {
    const surroundingItems = this.getSurroundingItems(
      items,
      index,
      range,
      mode
    );

    surroundingItems
      .filter(this.filterByNotLoaded)
      .filter(this.filterByIsNotLoading)
      .forEach((item) => {
        const itemImage = item.querySelector("img");
        if (itemImage) {
          // get src of image
          const imageSrc = item.querySelector("img").dataset.src;
          // get all elements with same src (to load them in parallel)
          const images = [
            ...document.querySelectorAll('[data-src="' + imageSrc + '"]'),
          ];

          images.forEach((image) => {
            this.lazyLoadImage(image, item);
          });
        }
      });
  }

  lazyLoadImage(image, ctxElement) {
    ctxElement.dataset.loading = true;
    image.src = image.dataset.src;
    image.addEventListener("load", () => {
      ctxElement.querySelectorAll("[data-show-on-loaded]").forEach((el) => {
        el.classList.remove("d-none");
      });
      delete image.dataset.src;
      ctxElement.dataset.loaded = true;
      delete ctxElement.dataset.loading;
    });
  }

  initLazyLoad() {
    const activeItem = this.getActiveItem();
    if (activeItem) {
      const { carouselIndex } = activeItem.dataset;
      this.loadItems({ to: carouselIndex });

      if (this.hasIndicators) {
        this.loadIndicators({ to: carouselIndex, init: true });
      }
    }

    this.slideListeners.push(this.loadItems.bind(this));

    if (this.hasIndicators) {
      this.slideListeners.push(this.loadIndicators.bind(this));
      this.slideListeners.push(this.scrollIndicators.bind(this));
      this.initLazyLoadIndicatorsScrollObserver(this.indicatorItems);
    }
  }

  loadItems(e) {
    this.loadSurroundingItems(this.items, e.to, 8);
  }

  loadIndicators(e) {
    let mode = "center";
    if (e.init) {
      mode = "right";
    }
    this.loadSurroundingItems(this.indicatorItems, e.to, 36, mode);
  }

  initLazyLoadIndicatorsScrollObserver(items) {
    const observerOptions = {
      root: this.indicatorContainer,
      rootMargin: "0px",
      threshold: 0,
    };
    const observation = (entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          this.loadSurroundingItems(
            items,
            entry.target.dataset.bsSlideTo,
            8,
            "right"
          );
          observer.unobserve(entry.target);
        }
      });
    };
    const observer = new IntersectionObserver(observation, observerOptions);
    items.forEach((item) => {
      observer.observe(item);
    });
  }

  scrollIndicators(e) {
    const performAutoScroll = (index) => {
      const targetIndicator = this.indicatorItems[index];

      const containerWidth = this.indicatorContainer.offsetWidth;
      const targetIndicatorOffset = targetIndicator.offsetLeft;
      const targetIndicatorWidth = targetIndicator.offsetWidth;

      const targetScrollLeft =
        targetIndicatorOffset - containerWidth / 2 + targetIndicatorWidth / 2;

      this.container.querySelector(".carousel-indicators").scrollTo({
        left: targetScrollLeft,
        behavior: "smooth",
      });
    };

    const waitForLoad = () => {
      const numberOfFittingItems = this.getNumberOfFittingItems(
        this.indicatorItems,
        e.to
      );

      const relevantIndicatorItems = this.getSurroundingItems(
        this.indicatorItems,
        e.to,
        numberOfFittingItems,
        "right",
        { upper: this.indicatorItems.length }
      );
      if (this.hasUnloadedItems(relevantIndicatorItems)) {
        setTimeout(waitForLoad, 100);
      } else {
        performAutoScroll(e.to);
      }
    };

    waitForLoad();
  }

  getNumberOfFittingItems(items, index) {
    const screenWidth = window.innerWidth;

    let range = 2;
    let totalWidth = 0;

    while (totalWidth < screenWidth && range < items.length) {
      let { lowerBorder, upperBorder } = this.getSurroundingItemBorders(
        items,
        index,
        range
      );
      const limits = {};
      // check if lower border switched sides regarding the index
      // -> reset border to outer most left index
      if (lowerBorder > index) {
        limits.lower = 0;
      }
      // check if upper border switched sides regarding the index
      // -> reset border to outer most right index
      if (upperBorder < index) {
        limits.upper = items.length;
      }

      const relevantElements = this.getSurroundingItems(
        items,
        index,
        range,
        limits
      );

      totalWidth = relevantElements.reduce((width, element) => {
        return width + element.offsetWidth + 6; // 3px padding on each side
      }, 0);

      range += 2;
    }
    return range;
  }
}
