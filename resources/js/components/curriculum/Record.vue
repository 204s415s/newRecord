<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <form v-on:submit.prevent="submit">
                    <div class="form-group row">
                        <label for="enter" class="col-sm-3 col-form-label">入学年月：</label>
                        <select class="col-sm-9 form-control" v-model="selectedEnter">
                            <option disabled value="">選択してください</option>
                            <option v-for="value in enter" v-bind:value="value.enter" >
                                {{ value.enter | enter }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">名前：</label>
                        <select v-model="newCurriculum.student_id" class="col-sm-9 form-control">
                            <option disabled value="">選択してください</option>
                            <option v-for="student in students" v-bind:value="student.id" >
                                {{ student.student_name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="progress" class="col-sm-3 col-form-label">進捗：</label>
                        <select v-model="newCurriculum.progress" class="col-sm-9 form-control">
                            <option disabled value="">選択してください</option>
                            <option v-for="section in sections" v-bind:value="section.value" >
                                {{ section.value }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="question" class="col-sm-3 col-form-label">質問：</label>
                        <textarea v-model="newCurriculum.question" class="col-sm-9 form-control" id="question"></textarea>
                    </div>
                    <div class="form-group row">
                        <label for="aim" class="col-sm-3 col-form-label">目標：</label>
                        <select v-model="newCurriculum.aim" class="col-sm-9 form-control">
                            <option disabled value="">選択してください</option>
                            <option v-for="section in sections" v-bind:value="section.value" >
                                {{ section.value }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group row" v-model="newCurriculum.next">
                        <label for="nextdate" class="col-sm-3 col-form-label">次回面談予定：</label>
                        
                            <input type="date" class="col-sm-5 form-control" id="date" v-model="date">
                            <input type="time" class="col-sm-4 form-control" id="time" v-model="time">
                        
                    </div>
                    <div class="form-group row">
                        <label for="style" class="col-sm-3 col-form-label">形式：</label>
                        <lavel  v-for="style in optionStyles" class="col-sm-3 form-control">
                            <input type="radio" v-model="newCurriculum.style" v-bind:value="style.value">
                            {{ style.value }}
                        </lavel>
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
                newCurriculum: {
                    student_id: '',
                    progress: '',
                    question: '',
                    aim: '',
                    next: '',
                    style: ''
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
            }
        },
        computed: {
            
            
        },
        methods: {
            dateset() {
                this.newCurriculum.next = this.date + ' ' + this.time;
                return this.newCurriculum.next
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
                        console.log(res.data)
                    });
            },
            submit() {
                axios.post('/api/record/curriculum', this.newCurriculum)
                    .then((res) => {
                        //this.newCurriculum.next = this.date + this.time    
                        this.$router.push({name: 'student.list'});
                 });
            }
        },
        mounted() {
            this.selectEnter();
            this.selectStudents();
        }
        
    };
</script>