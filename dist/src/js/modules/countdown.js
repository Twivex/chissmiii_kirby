import Translator from "./translator";

export default class Countdown {
  constructor(countdownNode) {
    // preload translator to fetch translations already in the background
    // before they are actually needed
    Translator.load();

    // create date object from data attribute
    this.targetDate = new Date(countdownNode.dataset.countdownTarget);

    // collect all nodes that need to be updated
    this.yearsNode = countdownNode.querySelector(
      '[data-countdown-unit="years"]'
    );
    this.monthsNode = countdownNode.querySelector(
      '[data-countdown-unit="months"]'
    );
    this.daysNode = countdownNode.querySelector('[data-countdown-unit="days"]');
    this.hoursNode = countdownNode.querySelector(
      '[data-countdown-unit="hours"]'
    );
    this.minutesNode = countdownNode.querySelector(
      '[data-countdown-unit="minutes"]'
    );
    this.secondsNode = countdownNode.querySelector(
      '[data-countdown-unit="seconds"]'
    );

    // initialize values
    if (this.monthsNode !== null) {
      this.months = this.monthsNode.dataset.countdownValue;
    }
    if (this.daysNode !== null) {
      this.days = this.daysNode.dataset.countdownValue;
    }
    if (this.hoursNode !== null) {
      this.hours = this.hoursNode.dataset.countdownValue;
    }
    if (this.minutesNode !== null) {
      this.minutes = this.minutesNode.dataset.countdownValue;
    }
    if (this.secondsNode !== null) {
      this.seconds = this.secondsNode.dataset.countdownValue;
    }

    // start updating the countdown
    this.setupUpdater();
  }

  updateMonths(months) {
    this.updateElement(this.monthsNode, this.months, months);
    this.months = months;
  }

  updateDays(days) {
    this.updateElement(this.daysNode, this.days, days);
    this.days = days;
  }

  updateHours(hours) {
    this.updateElement(this.hoursNode, this.hours, hours);
    this.hours = hours;
  }

  updateMinutes(minutes) {
    this.updateElement(this.minutesNode, this.minutes, minutes);
    this.minutes = minutes;
  }

  updateSeconds(seconds) {
    this.updateElement(this.secondsNode, this.seconds, seconds);
    this.seconds = seconds;
  }

  updateElement(node, currentValue, newValue) {
    if (node !== null && currentValue !== newValue) {
      this.updateValue(node, newValue);
      this.updateLabel(node, currentValue, newValue);
    }
  }

  updateValue(node, value) {
    node.dataset.countdownValue = value;
    node.querySelector(".countdown-value").innerText = value;
  }

  updateLabel(node, currentValue, newValue) {
    // solely situations to update the unit label: changing from plural to single and vice versa
    if (currentValue === 1 || newValue === 1) {
      const labelNode = node.querySelector(".countdown-label");
      const unitKey = node.dataset.countdownUnit;
      const labelKey = unitKey.slice(0, newValue === 1 ? -1 : unitKey.length);
      labelNode.innerText = Translator.get(labelKey, labelNode.innerText);
    }
  }

  setupUpdater() {
    const countdown = setInterval(() => {
      const now = new Date();
      const isPastTarget = now >= this.targetDate; // Check if current time is past the target time

      let timeDifference;
      if (isPastTarget) {
        timeDifference = now - this.targetDate; // Calculate time difference when current time is past target
      } else {
        timeDifference = this.targetDate - now; // Calculate time difference when target is in the future
      }

      // Calculate individual units
      const secondsLeft = Math.floor((timeDifference / 1000) % 60);
      const minutesLeft = Math.floor((timeDifference / 1000 / 60) % 60);
      const hoursLeft = Math.floor((timeDifference / 1000 / 3600) % 24);
      const daysLeft = Math.floor(timeDifference / 1000 / 3600 / 24);
      const monthsLeft = Math.floor(daysLeft / 30);

      // Update values and nodes
      this.updateMonths(monthsLeft);
      this.updateDays(daysLeft % 30);
      this.updateHours(hoursLeft);
      this.updateMinutes(minutesLeft);
      this.updateSeconds(secondsLeft);

      // Stop countdown if the time difference is negative
      if (timeDifference <= 0) {
        clearInterval(countdown);
      }
    }, 1000);
  }
}
