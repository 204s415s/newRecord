<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <form v-on:submit.prevent="submit">
                    <div class="form-group row">
                        <label for="enter" class="col-sm-3 col-form-label">入学年月：</label>
                        <input type="text" class="col-sm-9 form-control" id="enter" >
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">名前：</label>
                        <select v-model="newProject.student_id" class="col-sm-9 form-control">
                            <option disabled value="">選択してください</option>
                            <option v-for="student in students" v-bind:value="student.id" >
                                {{ student.student_name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="progress" class="col-sm-3 col-form-label">進捗：</label>
                        <textarea v-model="newProject.progress" class="col-sm-9 form-control" id="progress"></textarea>
                    </div>
                    <div class="form-group row">
                        <label for="topical" class="col-sm-3 col-form-label">特筆事項：</label>
                        <textarea v-model="newProject.topical" class="col-sm-9 form-control" id="topical"></textarea>
                    </div>
                    <div class="form-group row">
                        <label for="question" class="col-sm-3 col-form-label">質問：</label>
                        <textarea v-model="newProject.question" class="col-sm-9 form-control" id="question"></textarea>
                    </div>
                    <div class="form-group row">
                        <label for="aim" class="col-sm-3 col-form-label">目標：</label>
                        <textarea v-model="newProject.aim" class="col-sm-9 form-control" id="aim"></textarea>
                    </div>
                    <div class="form-group row">
                        <label for="nextdate" class="col-sm-3 col-form-label">次回面談予定：</label>
                        <input type="date" class="col-sm-9 form-control" id="nextdate" v-model="newProject.nextdate" >
                    </div>
                     <button type="submit" class="btn btn-an">保存</button>
                 </form>   
                   
            </div>
        </div>
    </div>
</template>

<script>
    import sections from '../../datas/section.json';
    export default{
        data: function() {
            return {
                students: {},
                newProject: {
                    student_id: '',
                    progress: '',
                    topical: '',
                    question: '',
                    aim: '',
                    nextdate: ''
                },
                sections: sections
            }
        },
        methods: {
            selectStudents() {
                axios.get('/api/students')
                    .then((res) => {
                        this.students = res.data;
                    });
            },
            submit() {
                axios.post('/api/record/project', this.newProject)
                 .then((res) => {
                     this.$router.push({name: 'student.list'});
                 });
            }
        },
        mounted() {
            this.selectStudents();
        }
        
    };
</script>