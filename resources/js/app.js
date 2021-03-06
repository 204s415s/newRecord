/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their 'basename'.
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
import Vue from 'vue';
import Header from './components/Header';
import router from './plugins/router';
import filter from './plugins/filter';
import grades from './datas/grade.json';
import VueTextareaAutosize from 'vue-textarea-autosize'
import Toasted from 'vue-toasted';
 
Vue.use(Toasted);
Vue.use(filter);
//Vue.use(grades)
Vue.use(VueTextareaAutosize);

Vue.component('header-component', Header);

//Vue.use(VueTheMask);
//Vue.use(VueTables.ClientTable);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

export default {
  data: () => {
     grades: grades
  }
}

const app = new Vue({
    el: '#app',
    router,
    filter,
    //grades: grades
});
