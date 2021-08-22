<template>
    <div class="container">
        <div class="content">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <form v-on:submit.prevent="editStudent">
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">名前</label>
                        <input type="text" class="col-sm-9 form-control" id="name" v-model="student.student_name">
                    </div>
                    <div class="form-group row">
                        <label for="enter" class="col-sm-3 col-form-label">入学年月日</label>
                        <input type="text" class="col-sm-9 form-control" id="enter" v-model="student.enter">
                    </div>
                    <div class="form-group row">
                        <label for="grade" class="col-sm-3 col-form-label">学年</label>
                        <select v-model="student.grade" class="col-sm-9 form-control">
                            <option v-for="grade in grades" v-bind:value="grade.value"  placeholder="student.grade">
                                {{ grade.value }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="experience" class="col-sm-3 col-form-label">プログラミング経験</label>
                        <select v-model="student.experience" class="col-sm-9 form-control">
                            <option v-for="experience in optionExperiences" v-bind:value="experience.name">
                                {{ experience.name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label">めも</label>
                        <textarea class="col-sm-9 form-control" id="description" v-model="student.description"></textarea>
                    </div>
                    <div class="form-group row">
                        <label for="sheet_id" class="col-sm-3 col-form-label">スプレッドシートID</label>
                        <input type="text" class="col-sm-9 form-control" id="sheet_id" v-model="student.sheet_id">
                    </div>
                    <div class="form-group row">
                        <label for="mentor" class="col-sm-3 col-form-label">担当</label>
                        <select v-model="student.user_id" class="col-sm-9 form-control">
                            <option disabled value="">選択してください</option>
                            <option v-for="user in users" v-bind:value="user.id" >
                                {{ user.name }}
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-an">更新</button>
                </form>
            </div>
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
                users: {},
                grades: grades,
                student: {},
                optionExperiences:[
                    {id: 1, name:'無'},
                    {id: 2, name:'有'}
                ]
            }
        },
        methods: {
            getStudent() {
                axios.get('/api/students/' + this.studentId)
                    .then((res) => {
                        this.student = res.data;
                    });
            },
            selectMentors() {
                axios.get('/api/users')
                    .then((res) => {
                        //データが取れてきてるかの確認が出来る
                        //console.log('body:', res.data);
                        this.users = res.data;
                    });
            },
            editStudent() {
                axios.put('/api/students/' + this.studentId, this.student)
                    .then((res) => {
                        this.$router.push({name: 'student.list'})
                            console.log("更新");
                    })
                    .catch(err => {
                        if(err.response) {
                            console.log("しっぱい");
                        }
                    });
            }
        },
        created() {
            this.getStudent();
            this.selectMentors();
        }
    }
</script>