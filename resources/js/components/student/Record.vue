<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <td>
                    <router-link v-bind:to="{name: 'student.edit', params: {studentId: student.id.toString()}}">
                        <button class="btn btn-success">Edit</button>
                    </router-link>
                </td>
                <form>
                    <div class="form-group row border-bottom">
                        <label for="enter" class="col-sm-3 col-form-label">入学年月日</label>
                        <p class="col-sm-9 form-control-plaintext" readonly id="enter">{{student.enter}}</p>
                    </div>
                    <div class="form-group row border-bottom">
                        <label for="name" class="col-sm-3 col-form-label">名前</label>
                        <p class="col-sm-9 form-control-plaintext" readonly id="name">{{student.student_name}}</p>
                    </div>
                    <div class="form-group row border-bottom">
                        <label for="grade" class="col-sm-3 col-form-label">学年</label>
                        <p class="col-sm-9 form-control-plaintext" readonly id="grade">{{student.grade}}</p>
                    </div>
                    <div class="form-group row border-bottom">
                        <label for="experience" class="col-sm-3 col-form-label">プログラミング経験</label>
                        <p type="text" class="col-sm-9 form-control-plaintext" readonly id="experience">{{student.experience}}</p>
                    </div>
                    <div class="form-group row border-bottom">
                        <label for="description" class="col-sm-3 col-form-label">その他</label>
                        <p type="text" class="col-sm-9 form-control-plaintext" readonly id="description">{{student.description}}</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
 
 <script>
    import grades from '../../datas/grade.json';
    export default {
        props: {
            studentId: String
        },
        data: function() {
            return {
                student: [],
                grades: grades
            }
        },
        methods: {
            getStudent() {
                axios.get('/api/students/' + this.studentId)
                    .then((res) => {
                        this.student = res.data[0];
                    });
            }
        },
        mounted() {
            this.getStudent();
        }
    }
</script>