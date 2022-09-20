import CookieManager from "./cookie-manager";
import { Toast } from "bootstrap";

export default class CookieConsent {
  static init() {
    const COOKIE_PREFIX = "cookie-consent";

    const wrapperEl = document.getElementById("cookieConsent");

    const disclaimerBannerEl = document.getElementById("cookieConsentBanner");
    const disclaimerBanner = new Toast(disclaimerBannerEl, {
      autohide: false,
    });

    const settingsBannerEl = document.getElementById("cookieConsentSettings");
    const settingsBanner = new Toast(settingsBannerEl, {
      autohide: false,
    });

    const requiredCookiesStatus =
      CookieManager.getCookie(`${COOKIE_PREFIX}-required`) == 1;
    const statisticCookiesStatus =
      CookieManager.getCookie(`${COOKIE_PREFIX}-statistic`) == 1;
    const applicationCookiesStatus =
      CookieManager.getCookie(`${COOKIE_PREFIX}-application`) == 1;

    const showWrapper = () => {
      wrapperEl.classList.remove("d-none");
    };

    const hideWrapper = () => {
      wrapperEl.classList.add("d-none");
    };

    const acceptRequiredCookies = () => {
      CookieManager.setCookie(`${COOKIE_PREFIX}-required`, "1", 365);
    };

    const acceptApplicationCookies = () => {
      CookieManager.setCookie(`${COOKIE_PREFIX}-application`, "1", 365);
    };

    const denyApplicationCookies = () => {
      CookieManager.setCookie(`${COOKIE_PREFIX}-application`, "0", 365);
    };

    const acceptStatisticCookies = () => {
      CookieManager.setCookie(`${COOKIE_PREFIX}-statistic`, "1", 365);
    };

    const denyStatisticCookies = () => {
      CookieManager.setCookie(`${COOKIE_PREFIX}-statistic`, "0", 365);
    };

    const saveSettings = () => {
      const requiredCookiesAccepted =
        document.getElementById("requiredCookies").checked;
      const applicationCookiesAccepted =
        document.getElementById("applicationCookies").checked;

      // const statisticCookiesAccepted =
      //   document.getElementById("statisticCookies").checked;

      if (requiredCookiesAccepted != requiredCookiesStatus) {
        acceptRequiredCookies();
      }

      if (applicationCookiesAccepted != applicationCookiesStatus) {
        if (applicationCookiesAccepted) {
          acceptApplicationCookies();
        } else {
          denyApplicationCookies();
        }
        location.reload();
      }

      // if (statisticCookiesAccepted != statisticCookiesStatus) {
      //   if (statisticCookiesAccepted) {
      //     acceptStatisticCookies();
      //   } else {
      //     denyStatisticCookies();
      //   }
      //   location.reload();
      // }
    };

    // add event listeners to automatically show wrapper
    disclaimerBannerEl.addEventListener("show.bs.toast", showWrapper);
    settingsBannerEl.addEventListener("show.bs.toast", showWrapper);

    // set up click listeners
    document
      .getElementById("cookieConsentDeny")
      .addEventListener("click", (e) => {
        disclaimerBanner.hide();
        hideWrapper();
      });

    document
      .getElementById("cookieConsentAccept")
      .addEventListener("click", (e) => {
        acceptRequiredCookies();
        acceptApplicationCookies();
        // acceptStatisticCookies();
        disclaimerBanner.hide();
        hideWrapper();
      });

    document
      .getElementById("cookieConsentOpenSettings")
      .addEventListener("click", (e) => {
        disclaimerBannerEl.addEventListener("hidden.bs.toast", () => {
          settingsBanner.show();
        });
        disclaimerBanner.hide();
      });

    document
      .getElementById("cookieConsentSaveSettings")
      .addEventListener("click", (e) => {
        saveSettings();
        settingsBanner.hide();
        hideWrapper();
      });

    document
      .querySelectorAll("[data-cookie-consent='openSettings']")
      .forEach((openerEl) => {
        openerEl.addEventListener("click", (e) => {
          settingsBanner.show();
          e.preventDefault();
        });
      });

    // show disclaimerBanner if necessary

    setTimeout(() => {
      if (!requiredCookiesStatus) {
        disclaimerBanner.show();
      }
    }, 1000);
  }
}
