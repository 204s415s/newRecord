<template>
    <div id="app" class="container">
        <table class="table table-hover">
            <thead class="thead-light">
            <router-link v-bind:to="{name: 'student.create'}">
                <button class="btn btn-primary">登録</button>
            </router-link>
            <tr>
                <th scope="col">入学年月</th>
                <th scope="col">名前</th>
                <th scope="col">学年</th>
                <th scope="col">最新進捗</th>
                <th scope="col">担当メンター</th>
                <th scope="col">詳細</th>
                <th scope="col">編集</th>
                <th scope="col">削除</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="student in students">
                    <td scope="row">{{ student.enter }}</td>
                    <td>{{ student.student_name }}</td>
                    <td>{{ student.grade.value }}</td>
                    <td></td>
                    <td>{{ student.user.name}}</td>
                    <td>
                        <router-link v-bind:to="{name: 'student.show', params: {studentId: student.id.toString()}}">
                            <button class="btn btn-primary">Show</button>
                        </router-link>
                    </td>
                    <td>
                        <router-link v-bind:to="{name: 'student.edit', params: {studentId: student.id.toString()}}">
                            <button class="btn btn-success">Edit</button>
                        </router-link>
                    </td>
                    <td>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                students: {
                    student_name: '',
                    enter: '',
                    grade_id: '',
                    experience: '',
                    description: '',
                    sheet_id: '',
                    user_id: ''
                },
            }
        },
        methods: {
            getStudents() {
                axios.get('/api/students')
                    .then((res) => {
                        this.students = res.data;
                });
            },
            
        },
        mounted() {
            
            this.getStudents();
        }
        
    }
</script>