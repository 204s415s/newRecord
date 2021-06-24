<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
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
                        <p class="col-sm-9 form-control-plaintext" readonly id="grade">{{grade[0].value}}</p>
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
    export default {
        props: {
            studentId: String
        },
        data: function() {
            return {
                student: [],
                grade: []
            }
        },
        methods: {
            getStudent() {
                axios.get('/api/students/' + this.studentId)
                    .then((res) => {
                        this.student = res.data[0];
                    });
            },
            getGrade() {
                axios.get('/api/students/' + this.studentId)
                    .then((res) => {
                        this.grade = res.data[1];
                    });
            }
            
        },
        mounted() {
            this.getStudent();
            this.getGrade();
        }
    }
</script>