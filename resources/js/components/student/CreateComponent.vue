<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <form v-on:submit.prevent="submit">
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">名前</label>
                        <input type="text" class="col-sm-9 form-control" id="name" v-model="newStudent.student_name">
                    </div>
                    <div class="form-group row">
                        <label for="enter" class="col-sm-3 col-form-label">入学年月日</label>
                        <input type="text" class="col-sm-9 form-control" id="enter" placeholder="19900401" v-model="newStudent.enter">
                    </div>
                    <div class="form-group row">
                        <label for="grade_id" class="col-sm-3 col-form-label">学年</label>
                        <select v-model="newStudent.grade_id">
                            <option disabled value="">選択してください</option>
                            <option v-for="grade in grades" v-bind:value="grade.id" >
                                {{ grade.value }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="experience" class="col-sm-3 col-form-label">プログラミング経験</label>
                        <select v-model="newStudent.experience">
                            <option v-for="experience in optionExperiences" v-bind:value="experience.name">
                                {{ experience.name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label">めも</label>
                        <input type="textarea" class="col-sm-9 form-control" id="description" v-model="newStudent.description">
                    </div>
                    <div class="form-group row">
                        <label for="mentor" class="col-sm-3 col-form-label">担当</label>
                        <select v-model="newStudent.user_id">
                            <option disabled value="">選択してください</option>
                            <option v-for="user in users" v-bind:value="user.id" >
                                {{ user.name }}
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data: function() {
            return {
                users: {},
                grades: {},
                newStudent: {
                    student_name: '',
                    enter: '',
                    grade_id: '',
                    experience: '',
                    description: '',
                    user_id: '',
                },
                optionExperiences:[
                    {id: 1, name:'無'},
                    {id: 2, name:'有'}
                ]
            }
        },
        methods: {
            selectMentors() {
                axios.get('/api/users')
                    .then((res) => {
                        //データが取れてきてるかの確認が出来る
                        //console.log('body:', res.data);
                        this.users = res.data;
                    });
            },
            selectGrades() {
                axios.get('/api/grades')
                    .then((res) => {
                        this.grades = res.data;
                    });
            },
            submit() {
                axios.post('/api/students', this.newStudent)
                    .then((res) => {
                        this.$router.push({name: 'student.list'});
                    });
            }
        },
        created() {
            this.selectMentors(),
            this.selectGrades();
        }    
    }
</script>