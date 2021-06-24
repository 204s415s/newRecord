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

import VueRouter from 'vue-router';
//import VueTheMask from 'vue-the-mask';
//import VueTables from 'vue-tables-2';
//import moment from 'moment';

import HeaderComponent from './components/HeaderComponent';
import IndexComponent from './components/IndexComponent';
import StudentListComponent from './components/student/ListComponent';
import StudentShowComponent from './components/student/ShowComponent';
import StudentCreateComponent from './components/student/CreateComponent';
import StudentEditComponent from './components/student/EditComponent';
import StudentSheetComponent from './components/student/SheetComponent';
import CurriculumRecordComponent from './components/curriculum/RecordComponent';

Vue.component('header-component', HeaderComponent);
Vue.use(VueRouter);
//Vue.use(VueTheMask);
//Vue.use(VueTables.ClientTable);

//ルーティング
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/index',
            name: 'index',
            component: IndexComponent
        },
        
        {
            path: '/students',
            name: 'student.list',
            component: StudentListComponent
        },
        
        {
            path: '/students/create',
            name: 'student.create',
            component: StudentCreateComponent
        },
        
        {
            path: '/students/:studentId',
            name: 'student.show',
            component: StudentShowComponent,
            props: true
        },
        
        {
            path: '/students/:studentId/edit',
            name: 'student.edit',
            component: StudentEditComponent,
            props: true
        },
        
        {
            path: '/record/curriculum',
            name: 'curriculum.record',
            component: CurriculumRecordComponent,
        }
    ]
 });

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
