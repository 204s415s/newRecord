<template>
    <div class="container-fluid">
        <div class="content">
        <div class="row justify-content-center">
            <div class="col-sm-10">
                <form v-on:submit.prevent="submit">
                    <div class="form-group row" v-model="newStudent.enter">
                        <label for="enter" class="col-md-3 col-form-label">入学年月<span class="require">必須</span></label>
                        <select class="col-md-4 form-control" id="year" v-model="year">
                            <option v-for="year in optionYear" v-bind:value="year.value">
                                {{ year.value }}
                            </option>
                        </select><p class="col-md-1">年</p>
                        <select class="col-md-3 form-control" id="month" v-model="month">
                            <option v-for="month in optionMonth" v-bind:value="month.value">
                                {{ month.value }}
                            </option>
                        </select><p class="col-md-1">月</p>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label">名前<span class="require">必須</span></label>
                        <input type="text" class="col-md-9 form-control" id="name" v-model="newStudent.student_name">
                    </div>
                    <div class="form-group row">
                        <label for="grade_id" class="col-md-3 col-form-label">学年<span class="require">必須</span></label>
                        <select v-model="newStudent.grade" class="col-md-9 form-control">
                            <option disabled value="">選択してください</option>
                            <option v-for="grade in grades" v-bind:value="grade.value" >
                                {{ grade.value }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="experience" class="col-md-3 col-form-label">プログラミング経験<span class="require">必須</span></label>
                        <select v-model="newStudent.experience" class="col-md-9 form-control">
                            <option v-for="experience in optionExperiences" v-bind:value="experience.name">
                                {{ experience.name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-md-3 col-form-label">めも</label>
                        <textarea class="col-md-9 form-control" id="description" v-model="newStudent.description"></textarea>
                    </div>
                    <div class="form-group row">
                        <label for="sheet_id" class="col-md-3 col-form-label">スプレッドシートID</label>
                        <input type="text" class="col-md-9 form-control" id="sheet_id" v-model="newStudent.sheet_id">
                    </div>
                    <div class="form-group row">
                        <label for="mentor" class="col-md-3 col-form-label">担当<span class="require">必須</span></label>
                        <select v-model="newStudent.user_id" class="col-md-9 form-control">
                            <option disabled value="">選択してください</option>
                            <option v-for="user in users" v-bind:value="user.id" >
                                {{ user.name }}
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-orange mb-5" v-if="clear">登録</button>
                    <button v-else type="button" class="btn btn-secondary mb-5" disabled>記入漏れがあります</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</template>

<style>
    .require {
    display : inline-block;
    padding: 3.5px;
    margin-left: 5px;
    vertical-align: 10%;
    font-size: 10px;
    background: #e98035;
    color: #fff;
    border-radius: 3px 3px 3px 3px;
}
</style>
 
<script>
    import grades from '../../datas/grade.json';
    export default {
        data: function() {
            return {
                errors: [],
                users: {},
                grades: grades,
                newStudent: {
                    student_name: '',
                    enter: '',
                    grade: '',
                    experience: '',
                    description: '',
                    sheet_id: '',
                    user_id: '',
                },
                year: null,
                month: null,
                optionExperiences:[
                    {id: 1, name:'無'},
                    {id: 2, name:'有'}
                ],
                optionYear:[
                    {id: 1, value:'2021'},
                    {id: 2, value:'2022'}
                ],
                optionMonth:[
                    {id: 1, value:'01'},
                    {id: 2, value:'02'},
                    {id: 3, value:'03'},
                    {id: 4, value:'04'},
                    {id: 5, value:'05'},
                    {id: 6, value:'06'},
                    {id: 7, value:'07'},
                    {id: 8, value:'08'},
                    {id: 9, value:'09'},
                    {id: 10, value:'10'},
                    {id: 11, value:'11'},
                    {id: 12, value:'12'}
                ],
                clear: false
            }
        },
        watch: {
            newStudent: {
                handler: function(newValue, oldValue) {
                    this.checkForm()
                },
                deep: true
            },
            year() {
                this.enterSet()
            },
            month() {
                this.enterSet()
            }
        },
        methods: {
            checkForm() {
                if (this.newStudent.student_name !== '' && this.newStudent.enter !== '' && this.newStudent.grade !== '' 
                && this.newStudent.experience !== '' && this.newStudent.user_id !== '' ) {
                    return this.clear = true;
                } else {
                    return this.clear = false;
                }
            },
            enterSet() {
                this.newStudent.enter = this.year + '-' + this.month + '-01';
                return this.newStudent.enter;
            },
            selectMentors() {
                axios.get('/api/users')
                    .then((res) => {
                        //データが取れてきてるかの確認が出来る
                        //console.log('body:', res.data);
                        this.users = res.data;
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
            this.selectMentors()
            this.checkForm()
        }    
    };
</script>