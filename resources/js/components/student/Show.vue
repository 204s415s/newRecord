<template>
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-md-5">
                <td>
                    <router-link v-bind:to="{name: 'student.edit', params: {studentId: student.id}}">
                        <button class="btn btn-orange">編集</button>
                    </router-link>
                    <router-link v-bind:to="{name: 'student.list'}">
                        <button class="btn btn-orange">戻る</button>
                    </router-link>
                </td>
                <form>
                    <div class="form-group row border-bottom">
                        <label for="enter" class="col-sm-5 col-form-label">入学年月日</label>
                        <p class="col-sm-3 form-control-plaintext" readonly id="enter">{{student.enter | enter}}</p>
                    </div>
                    <div class="form-group row border-bottom">
                        <label for="name" class="col-sm-5 col-form-label">名前</label>
                        <p class="col-sm-3 form-control-plaintext" readonly id="name">{{student.student_name}}</p>
                    </div>
                    <div class="form-group row border-bottom">
                        <label for="grade" class="col-sm-5 col-form-label">学年</label>
                        <p class="col-sm-3 form-control-plaintext" readonly id="grade">{{student.grade}}</p>
                    </div>
                    <div class="form-group row border-bottom">
                        <label for="experience" class="col-sm-5 col-form-label">プログラミング経験</label>
                            <p type="text" class="col-sm-3 form-control-plaintext" readonly id="experience">{{student.experience}}</p>
                    </div>
                    <div class="form-group row border-bottom">
                        <label for="description" class="col-sm-5 col-form-label">その他</label>
                        <p type="text" class="col-sm-7 form-control-plaintext" id="description">{{description}}</p>
                    </div>
                    <div class="form-group row">
                        <label for="sheet_id" class="col-sm-5 col-form-label">スプレッドシートID</label>
                        <div type="text" class="col-sm-3 form-control-plaintext" readonly id="sheet_id">
                            <p v-if="student.sheet_id !== null">登録済</p>
                            <p v-else>未登録</p>
                        </div>
                    </div>
                </form>
                </div>
                <div class="com-8">
                    <LineChart v-if="loaded" :chartData="chartdata" :options="options"></LineChart>
                    <button class="btn btn-orange" @click="getData()">更新</button>
                </div>
            
        </div>
        <br />
        <div class="row justify-content-around">
            <div class="col-10 py-5">
            <body>
                <div>面談記録</div>
                <div v-for="record in records"　class="border rounded" style="padding:10px;">
                    <p>{{ record.created_at | record }}</p>
                    <p>進捗： {{ record.progress }}</p>
                    <p v-if="record.topical != null">特筆事項： {{ record.topical }}</p>
                    <p v-else> </p>
                    <p>質問： {{ record.question }}</p>
                    <p>目標： {{ record.aim }}</p>
                </div>
            </body>
            </div>
        </div>   
            
        
    </div>
</template>
 
 <script>
    
    import LineChart from '../graph/Line.js';
    export default {
        props: {
            studentId: String
        },
        components: { LineChart },
        
        data: function() {
            return {
                student: [],
                description: [],
                records: [],
                
                loaded: false,
                chartdata: null,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{                      //y軸設定
                            ticks: {                      //最大値最小値設定
                                beginAtZero: true,
                                max: 100
                            },
                        }]
                    },
                }
            }
        },
        methods: {
            getStudent() {
                axios.get('/api/students/' + this.studentId)
                    .then((res) => {
                        
                        this.student = res.data[0];
                    });
            },
            getDescription() {
                axios.get('/api/students/' + this.studentId)
                    .then((res) => {
                        //this.description.replace(/\n/g, '\\n')
                        this.description = res.data[1];
                    })
                    // newLine(description) {
                    //     return description.replace(/\\n/g, '\n');
                    // })
            },
            getRecord() {
                axios.get('/api/students/' + this.studentId + '/record')
                    .then((res) => {
                        this.records = res.data;
                    })
            },
            getData() {
                axios.get('/api/students/' + this.studentId + '/level')
                    .then((res) => {
                        this.chartdata = {
                            labels: res.data.map(data => data.section),
                            datasets: [
                                {
                                    label: ['理解度'],
                                    backgroundColor: '#e95285',
                                    tension: 0,
                                    data: res.data.map(data => data.understanding)
                                }
                            ]
                        }
                    })
            },
        },
        mounted() {
            this.loaded = true;
            this.getStudent();
            this.getDescription();
            this.getRecord();
            this.getData()
        }
    }
</script>

<style scoped>
/* これを設定 */
#description {
  white-space: pre-wrap;
}
</style>