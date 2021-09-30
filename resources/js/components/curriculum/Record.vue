<template>
    <div class="container">
        <div class="content">
        <div class="row justify-content-center">
            <div class="col-sm-10">
            
            <div v-for="record in records">
                <div class="box shadow-none">
                    <span class="box-title">{{ record.recorded_at | record }}</span>
                    <p>進捗： {{ record.progress }}</p>
                    <p v-if="record.topical != null">特筆事項： {{ record.topical }}</p>
                    <p v-else> </p>
                    <p class="white-space">質問： {{ record.question }}</p>
                    <p>目標： {{ record.aim }}</p>
                </div>
            </div>
            
                <form v-on:submit.prevent="submit">
                    <div class="form-group row">
                        <label for="recorded_at" class="col-sm-3 col-form-label">記録日<span class="require">必須</span></label>
                            <input type="date" class="col-sm-5 form-control" id="recorded_at" v-model="newCurriculum.recorded_at">
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
                        <select v-model="newCurriculum.student_id" class="col-sm-9 form-control">
                            <option disabled value="">選択してください</option>
                            <option v-for="student in students" v-bind:value="student.id" placeholder="student.student_name">
                                {{ student.student_name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="progress" class="col-sm-3 col-form-label">進捗<span class="require">必須</span></label>
                        <select v-model="newCurriculum.progress" class="col-sm-9 form-control">
                            <option disabled value="">選択してください</option>
                            <option v-for="section in sections" v-bind:value="section.value" >
                                {{ section.value }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="question" class="col-sm-3 col-form-label">質問</label>
                        <textarea-autosize v-model="newCurriculum.question" class="col-sm-9 form-control" id="question"></textarea-autosize>
                    </div>
                    <div class="form-group row">
                        <label for="aim" class="col-sm-3 col-form-label">目標<span class="require">必須</span></label>
                        <select v-model="newCurriculum.aim" class="col-sm-9 form-control">
                            <option disabled value="">選択してください</option>
                            <option v-for="section in sections" v-bind:value="section.value" >
                                {{ section.value }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group row" v-model="newCurriculum.next">
                        <label for="nextdate" class="col-sm-3 col-form-label">次回面談予定</label>
                            <input type="date" class="col-sm-5 form-control" id="date" v-model="date">
                            <input type="time" class="col-sm-4 form-control" id="time" v-model="time">
                    </div>
                    <div class="form-group row">
                        <label for="style" class="col-sm-3 col-form-label">形式</label>
                        <label v-for="style in optionStyles" class="col-sm-4 form-control">
                            <input type="radio" v-model="newCurriculum.style" :value="style.value" />
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

<style scoped>
.box {
    position: relative;
    margin: 2em 0;
    padding: 0.5em 1em;
    border: solid 2px #00afcc;
    border-radius: 8px;
    background-color: transparent;
}
.box-title {
    position: absolute;
    display: inline-block;
    top: -13px;
    left: 10px;
    padding: 0 5px;
    line-height: 1;
    font-size: 19px;
    background: #ffffff; /*containerの背景色*/
    color: #00afcc;
    font-weight: bold;
}
.box p {
    margin: 0; 
    padding: 0;
}
</style>

<script>
    import sections from '../../datas/section.json';
    export default{
        props: {
            studentId: {
                type: String
            }
        },
        data: function() {
            return {
                students: {},
                sentStudent: {},
                newCurriculum: {
                    student_id: '',
                    progress: '',
                    question: '',
                    aim: '',
                    next: '',
                    style: '',
                    recorded_at: '',
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
                height: "60px",
                records: []
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
            newCurriculum: {
                handler: function(newValue, oldValue) {
                    this.checkForm()
                },
                deep: true
            },
            'newCurriculum.student_id': function(newValue, oldValue) {
                this.showRecords();
            }
        },
        methods: {
            dateset() {
                this.newCurriculum.next = this.date + ' ' + this.time;
                return this.newCurriculum.next
            },
            // sentDatas() {
            //     axios.get('/api/students' + this.studentId)
            //         .then((res) => {
            //             this.sentStudent = res.data;
            //             console.log(res.data)
            //         })
            // },
            selectEnter() {
                axios.get('/api/students/enter')
                    .then((res) => {
                        this.enter = res.data;
                    })
            },
            selectStudents() {
                axios.get('/api/' + this.selectedEnter)
                    .then((res) => {
                        this.students = res.data;
                    });
            },
            showRecords() {
                axios.get('/api/students/' + this.newCurriculum.student_id + '/record')
                    .then((res) => {
                        this.records = res.data;
                    })
            },
            checkForm() {
                if (this.newCurriculum.student_id !== '' && this.newCurriculum.progress !== ''
                && this.newCurriculum.aim !== '' && this.newCurriculum.recorded_at !== '' ) {
                    return this.clear = true;
                } else {
                    return this.clear = false;
                }
            },
            submit() {
                axios.post('/api/record/curriculum', this.newCurriculum)
                    .then((res) => {
                        //this.newCurriculum.next = this.date + this.time  
                        console.log(this.newCurriculum);
                        this.$router.push({name: 'student.show', params: {studentId: this.newCurriculum.student_id}});
                 });
            }
        },
        mounted() {
            this.checkForm();
            this.selectEnter();
            this.selectStudents();
            //this.sentDatas();
            
        }
        
    };
</script>