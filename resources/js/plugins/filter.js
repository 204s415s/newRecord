import moment from "moment";

const record = value => {
  if (value === "") {
    return "";
  }
  return moment(value).format('M月D日');
}

const enter = value => {
    if (value === "") {
        return ";"
    }
    return moment(value).format('YY年M月');
}

export default {
  install(vue) {
    vue.filter("record", record);
    vue.filter("enter", enter);

    vue.prototype.$customFilter = {
      record,enter
    };
  }
};