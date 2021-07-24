import VueRouter from 'vue-router';
import Vue from 'vue';

import Index from '../components/Index';
import StudentList from '../components/student/List';
import StudentShow from '../components/student/Show';
import StudentCreate from '../components/student/Create';
import StudentEdit from '../components/student/Edit';
import StudentGraph from '../components/student/Graph';
import CurriculumRecord from '../components/curriculum/Record';
import ProjectRecord from '../components/project/Record';
import Mypage from '../components/user/Mypage';
import Calendar from '../components/user/Calendar';
//import Today from '../components/user/Today';

Vue.use(VueRouter);

//ルーティング
export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/index',
            name: 'index',
            component: Index
        },
        
        {
            path: '/students',
            name: 'student.list',
            component: StudentList
        },
        
        {
            path: '/students/create',
            name: 'student.create',
            component: StudentCreate
        },
        
        {
            path: '/students/graph',
            name: 'student.graph',
            component: StudentGraph
        },
        
        {
            path: '/students/:studentId',
            name: 'student.show',
            component: StudentShow,
            props: true
        },
        
        {
            path: '/students/:studentId/edit',
            name: 'student.edit',
            component: StudentEdit,
            props: true
        },
        
        {
            path: '/record/curriculum',
            name: 'curriculum.record',
            component: CurriculumRecord,
        },
        
        {
            path: '/record/project',
            name: 'project.record',
            component: ProjectRecord,
        },
        
        {
            path: '/mypage',
            name: 'mypage',
            component: Mypage
        },
        
        {
            path: '/calendar',
            name: 'calendar',
            component: Calendar
        },
        
        
        
    ]
 });
 