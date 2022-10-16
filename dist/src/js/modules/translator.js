export default class Translator {
  translations = null;
  loaded = false;

  constructor() {
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
      if (xhr.readyState === 4 && xhr.status == "200") {
        this.translations = JSON.parse(xhr.responseText);
        this.loaded = true;
      }
    };
    xhr.open("GET", `/resources/languages/${LANGUAGE_CODE}.json`, true);
    xhr.setRequestHeader("Accept", "application/json");
    xhr.overrideMimeType("application/json");
    xhr.send();
  }

  static getInstance() {
    if (!this.instance) {
      this.instance = new Translator();
    }
    return this.instance;
  }

  static load() {
    this.getInstance();
  }

  static get(key, fallback = "") {
    const { translations, loaded } = this.getInstance();
    if (!loaded) {
      setTimeout(() => {
        return this.get(key);
      }, 200);
    } else if (translations[key]) {
      return translations[key];
    }
    return fallback;
  }
}
