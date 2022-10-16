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
      // get needed parts of current time
      const now = new Date();
      const nowYear = now.getFullYear();
      const nowMonths = now.getMonth();
      const nowDays = now.getDate();
      const nowHours = now.getHours();
      const nowMinutes = now.getMinutes();
      const nowSeconds = now.getSeconds();

      // get needed parts of target time
      const targetYear = this.targetDate.getFullYear();
      const targetMonths = this.targetDate.getMonth();
      const targetDays = this.targetDate.getDate();
      const targetHours = this.targetDate.getHours();
      const targetMinutes = this.targetDate.getMinutes();
      const targetSeconds = this.targetDate.getSeconds();

      // calculate remaining time:
      // - start with smallest unit
      // - if substraction is smaller than 0, borrow 1 from the next greater unit
      // - proceed untill largest unit

      let secondsLeft = targetSeconds - nowSeconds;
      let minutesLeftBorrow = 0;
      if (secondsLeft < 0) {
        secondsLeft = targetSeconds + 60 - nowSeconds;
        minutesLeftBorrow = 1;
      }

      let minutesLeft = targetMinutes - nowMinutes - minutesLeftBorrow;
      let hoursLeftBorrow = 0;
      if (minutesLeft < 0) {
        minutesLeft = targetMinutes + 60 - nowMinutes - minutesLeftBorrow;
        hoursLeftBorrow = 1;
      }

      let hoursLeft = targetHours - nowHours - hoursLeftBorrow;
      let daysLeftBorrow = 0;
      if (hoursLeft < 0) {
        hoursLeft = targetHours + 24 - nowHours - hoursLeftBorrow;
        daysLeftBorrow = 1;
      }

      let daysLeft = targetDays - nowDays - daysLeftBorrow;
      let monthsLeftBorrow = 0;
      if (daysLeft < 0) {
        daysLeft = targetDays + 30 - nowDays - daysLeftBorrow;
        monthsLeftBorrow = 1;
      }

      const targetMonthsTotal = targetMonths + 12 * targetYear;
      const nowMonthsTotal = nowMonths + 12 * nowYear;
      const monthsLeft = targetMonthsTotal - nowMonthsTotal - monthsLeftBorrow;

      // update values (and nodes, if necessary)
      this.updateMonths(monthsLeft);
      this.updateDays(daysLeft);
      this.updateHours(hoursLeft);
      this.updateMinutes(minutesLeft);
      this.updateSeconds(secondsLeft);

      // stop countdown, if remaining time is 0
      if (
        monthsLeft === 0 &&
        daysLeft === 0 &&
        hoursLeft === 0 &&
        minutesLeft === 0 &&
        secondsLeft === 0
      ) {
        clearInterval(countdown);
      }
    }, 1000);
  }
}
