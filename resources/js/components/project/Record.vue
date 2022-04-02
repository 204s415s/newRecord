<template>
    <div class="container">
        <div class="content">
        <div class="row justify-content-center">
            <div class="col-sm-10">
                <form v-on:submit.prevent="submit">
                    <div class="form-group row">
                        <label for="recorded_at" class="col-sm-3 col-form-label">記録日<span class="require">必須</span></label>
                            <input type="date" class="col-sm-5 form-control" id="recorded_at" v-model="newProject.recorded_at">
                    </div>
                    <div class="form-group row">
                        <label for="enter" class="col-sm-3 col-form-label">入学年月<span class="require">必須</span></label>
                        <select class="col-sm-9 form-control" v-model="selectedEnter">
                            <option disabled value="">選択してください</option>
                            <option v-for="value in enter" v-bind:value="value.enter" >
                                {{ value.enter | enter }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group row" v-if="selectedEnter !== ''" >
                        <label for="name" class="col-sm-3 col-form-label">名前<span class="require">必須</span></label>
                        <select v-model="newProject.student_id" class="col-sm-9 form-control">
                            <option disabled value="">選択してください</option>
                            <option v-for="student in students" v-bind:value="student.id" >
                                {{ student.student_name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="progress" class="col-sm-3 col-form-label">進捗<span class="require">必須</span></label>
                        <textarea-autosize v-model="newProject.progress" class="col-sm-9 form-control" id="progress"></textarea-autosize>
                    </div>
                    <div class="form-group row">
                        <label for="topical" class="col-sm-3 col-form-label">特筆事項</label>
                        <textarea-autosize v-model="newProject.topical" class="col-sm-9 form-control" id="topical"></textarea-autosize>
                    </div>
                    <div class="form-group row">
                        <label for="question" class="col-sm-3 col-form-label">質問</label>
                        <textarea-autosize v-model="newProject.question" class="col-sm-9 form-control" id="question"></textarea-autosize>
                    </div>
                    <div class="form-group row">
                        <label for="aim" class="col-sm-3 col-form-label">目標<span class="require">必須</span></label>
                        <textarea-autosize v-model="newProject.aim" class="col-sm-9 form-control" id="aim"></textarea-autosize>
                    </div>
                    <div class="form-group row" v-model="newProject.next">
                        <label for="nextdate" class="col-sm-3 col-form-label">次回面談予定</label>
                            <input type="date" class="col-sm-5 form-control" id="date" v-model="date">
                            <input type="time" class="col-sm-4 form-control" id="time" v-model="time">
                    </div>
                    <div class="form-group row">
                        <label for="style" class="col-sm-3 col-form-label">形式</label>
                        <label v-for="style in optionStyles" class="col-sm-4 form-control">
                            <input type="radio" v-model="newProject.style" :value="style.value" />
                            {{ style.value }}
                        </label>
                    </div>
                    <button type="submit" class="btn btn-orange mb-5" v-if="clear">記録</button>
                    <button v-else type="button" class="btn btn-secondary mb-5" disabled>記入漏れがあります</button>
                 </form>   
            </div>       
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
                    next: '',
                    style:'',
                    recorded_at:''
                },
                date: null,
                time: null,
                sections: sections,
                enter: [],
                selectedEnter: '',
                optionStyles: [
                    { id: 1, value: '対面' },
                    { id: 2, value: 'オンライン' }
                ],
                clear: false,
                height: "60px"
            }
        },
        watch: {
            selectedEnter() {
                this.students = '',
                this.selectStudents()
            },
            date() {
                this.dateset()  
            },
            time() {
                this.dateset()
            },
            newProject: {
                handler: function(newValue, oldValue) {
                    this.checkForm()
                },
                deep: true
            },
        },
        methods: {
            dateset() {
                this.newProject.next = this.date + ' ' + this.time;
                return this.newProject.next
            },
            selectEnter() {
                axios.get('/api/students/enter')
                    .then((res) => {
                        this.enter = res.data;
                        
                    })
            },
            selectStudents: function() {
                axios.get('/api/' + this.selectedEnter)
                    .then((res) => {
                        this.students = res.data;
                    });
            },
            checkForm() {
                if (this.newProject.student_id !== '' && this.newProject.progress !== ''
                && this.newProject.recorded_at !== '' && this.newProject.aim !== '') {
                    return this.clear = true;
                } else {
                    return this.clear = false;
                }
            },
            submit() {
                axios.post('/api/record/project', this.newProject)
                 .then((res) => {
                        this.$router.push({name: 'student.show', params: {studentId: this.newProject.student_id}});
                 });
            }
        },
        mounted() {
            this.checkForm();
            this.selectEnter();
            this.selectStudents();
        }
        
    };
</script>