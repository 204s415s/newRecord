<template>
    <div class="container">
        <div class="content">
        <div class="row justify-content-around">
            <div class="col-md-5 px-1">
                <td>
                    <router-link v-bind:to="{name: 'student.edit', params: {studentId: student.id}}">
                        <button v-if="loginUser == student.user_id" class="btn btn-orange">編集</button>
                        <button v-else type="button" class="btn btn-secondary" disabled>編集</button>
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
                        <p type="text" class="white-space col-sm-7 form-control-plaintext" id="description">{{student.description}}</p>
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
                <div class="com-8 pb-1">
                    <LineChart v-if="loaded" :chartData="chartdata" :options="options"></LineChart>
                    <button class="btn btn-orange" @click="getData()">更新</button>
                </div>
            </div>
        <br />
        <div class="row justify-content-around">
            <div class="col-10 py-5">
            <body>
                <p id="heading">面談記録</p>
                
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
                <li class="dropdown dropright">
                    <a href="#" class="btn dropdown-toggle btn-blue" data-toggle="dropdown" type="button">進捗記録</a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="dropdown-item"><router-link v-bind:to="{name: 'curriculum.record', params: {studentId: student.id}}">カリキュラム</router-link></li>
                        <li class="dropdown-item"><router-link v-bind:to="{name: 'project.record'}">成果物</router-link></li>
                    </ul>
                </li>
            </body>
            </div>
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
                student: {},
                description: [],
                records: [],
                loginUser: null,
                
                loaded: false,
                chartdata: null,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{                      //y軸設定
                            ticks: {                   //最大値最小値設定
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
                        this.student = res.data;
                    });
            },
            getLoginUser() {
                axios.get('/api/users/login')
                    .then((res) => {
                        this.loginUser = res.data;
                    })
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
            this.getLoginUser();
            this.loaded = true;
            this.getStudent();
            this.getRecord();
            this.getData()
            
        }
    }
</script>

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