<template>
    <div id="app">
    <table class="table table-bordered">
        <thead class="thead">
            <tr>
                <th scope="col">入学年月</th>
                <th scope="col">名前</th>
                <th scope="col">学年</th>
                <th scope="col">詳細</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="student in students">
                <td scope="row">{{ student.enter | enter}}</td>
                    <td>{{ student.student_name }}</td>
                    <td>{{ student.grade}}</td>
                    <td>
                        <router-link v-bind:to="{name: 'student.show', params: {studentId: student.id.toString()}}">
                            <button class="btn btn-an">Show</button>
                        </router-link>
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
                students: []
            }
        },
        methods: {
            getStudents() {
                axios.get('/api/mypage/student')
                    .then((res) => {
                        this.students = res.data;
                    })
            }
        },
        mounted() {
            this.getStudents();
        }
    }
    
</script>