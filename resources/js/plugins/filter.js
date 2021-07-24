import moment from "moment";

const record = value => {
  if (value === "") {
    return "";
  }
  return moment(value).format('M月D日');
}

const enter = value => {
    if (value === "") {
        return "";
    }
    return moment(value).format('YY年M月');
}

const today = value => {
    if (value === "") {
        return "";
    }
    return moment(value).format('HH時mm分');
}

export default {
  install(vue) {
    vue.filter("record", record);
    vue.filter("enter", enter);
    vue.filter("today", today);

    vue.prototype.$customFilter = {
      record,enter,today
    };
  }
};