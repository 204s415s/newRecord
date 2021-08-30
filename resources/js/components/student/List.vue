<template>
    <div id="app" class="container">
        <div class="content">
        <div class="mb-2">
            <router-link v-bind:to="{name: 'student.create'}">
                <button class="btn btn-orange">登録</button>
            </router-link>
            <router-link v-bind:to="{name: 'student.graph'}">
                <button class="btn btn-orange">グラフ</button>
            </router-link>
            <router-link v-bind:to="{name: 'student.table'}">
                <button class="btn btn-orange">表</button>
            </router-link>
        </div>
        
        <table class="table table-bordered">
            <thead class="thead" >
            <tr>
                <th scope="col">入学年月</th>
                <th scope="col">名前</th>
                <th scope="col">学年</th>
                <th scope="col">担当メンター</th>
                <th scope="col">詳細</th>
                <th scope="col">削除</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="student in students">
                    <td scope="row">{{ student.enter | enter}}</td>
                    <td>{{ student.student_name }}</td>
                    <td>{{ student.grade }}</td>
                    <td>{{ student.user.name}}</td>
                    <td>
                        <router-link v-bind:to="{name: 'student.show', params: {studentId: student.id}}">
                            <button class="btn btn-an">Show</button>
                        </router-link>
                    </td>
                    <td>
                        <button class="btn btn-tutuji" v-on:click="deleteStudent(student.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            studentId: {
                type: String
            }
        },
        data: function() {
            return {
                students: {
                    id: '',
                    student_name: '',
                    enter: '',
                    grade: '',
                    experience: '',
                    description: '',
                    sheet_id: '',
                    user_id: ''
                },
                records: [],
                loginUser: null,
                student: []
            }
        },
        methods: {
            getStudents() {
                axios.get('/api/students')
                    .then((res) => {
                        this.students = res.data;
                });
            },
            getLoginUser() {
                axios.get('/api/users/login')
                    .then((res) => {
                        this.loginUser = res.data
                    })
            },
            // getRecords() {
            //     axios.get('/api/students')
            //         .then((res) => {
            //             this.records = res.data[1];
            //     });
            // },
            deleteStudent(id) {
                axios.get('/api/students/' + id)
                    .then((res) => {
                        this.student = res.data
                        if (this.loginUser == this.student.user_id) {
                            if (confirm('本当に削除しますか？')) {
                                axios.delete('/api/students/' + id, {data: this.student})
                                    .then((res) => {
                                        this.getStudents().catch(err => {});
                                        //this.$router.push({name:'student.list'}).catch(err => {})
                                    })
                            }
                        } else {
                            alert("権限がありません")
                        }
                    })
            }
            
        },
        mounted() {
            this.getStudents();
            //this.getRecords();
            this.getLoginUser();
        }
        
    }
</script>