<template>
    <div id="app" class="container">
        <div class="content">
        <!-- 二つのテーブルをくっ付ける -->
        <div class="flex">
            <div class="left">
            <table class="table table-bordered">
                <thead class="font-weight-normal">
                <tr class="small" scope="col">
                    <th @click="sortBy('enter')" :class="addClass('enter')">入学年月</th>
                    <th @click="sortBy('student_name')" :class="addClass('student_name')">氏名</th>
                    <th @click="sortBy('user_id')" :class="addClass('user_id')">担当</th>
                </tr>
                </thead>
                <tbody>
                    <tr class="cell" v-for="student in sortStudents">
                        <td>{{ student.enter | enter }}</td>
                        <td>{{ student.student_name }}</td>
                        <td>{{ student.user.name }}</td>
                    </tr>
                </tbody>
            </table>
            </div>
            
            <div class="table-responsive">
            <div class="table-bordered">
                <thead class="font-weight-normal">
                <tr class="small" scope="col">
                    <th v-for="section in sections" style="padding: 0.5em;" >{{ section }}</th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="clear in clears" class="cell">
                        <td v-for="tf in clear" :class="tf">
                        </td>
                    </tr>
                </tbody>
            </div>
            </div>
        </div>
        
        <button class="btn btn-orange" @click="getClear()">更新</button>
        <router-link v-bind:to="{name: 'student.list'}">
            <button class="btn btn-orange">戻る</button>
        </router-link>
        </div>
        
    </div>
</template>
    
<style>
    
    .small {
        height: 33.28px;
    }
    .left {
        weight: 300px;
    }
    .flex {
        display: flex;
        white-space: nowrap;
    }
    .cell {
        height: 41.89px;
    }
</style>

<script>
    export default {
        data: function() {
            return {
                sections: {},
                students: {},
                clears: {},
                datas: {
                    student:{},
                    clear:{}
                },
                sort_key: "",
                sort_asc: true,
            }
        },
        computed: {
            sortStudents() {
                if (this.sort_key != "") {
                    let set = 1;
                    this.sort_asc ? (set = 1) : (set = -1);
                    this.students.sort((a, b) => {
                        if (a[this.sort_key] < b[this.sort_key]) return -1 * set;
                        if (a[this.sort_key] > b[this.sort_key]) return 1 * set;
                        return 0;
                    });
                    return this.students;
                    } else {
                        return this.students;
                    }
            },
        },
        methods: {
            getSection() {
                axios.get('/api/students/label')
                    .then((res) => {
                        this.sections = res.data
                    })
            },
            getStudents() {
                axios.get('/api/students')
                    .then((res) => {
                        this.students = res.data
                })
            },
            getClear() {
                axios.get('/api/students/table')
                    .then((res) => {
                        this.clears = res.data[1]
                    })
            },
            // getClear() {
            //     axios.get('/api/students/table')
            //         .then((res) => {
            //             this.datas = {
            //                 student: res.data[0],
            //                 clear: res.data[1]
            //             }
            //             console.log()
            //         })
            // },
            sortBy(key) {
                this.sort_key === key
                ? (this.sort_asc =! this.sort_asc)
                : (this.sort_asc = true);
                this.sort_key = key;
            },
            addClass(key) {
                return {
                asc: this.sort_key === key && this.sort_asc,
                desc: this.sort_key === key && !this.sort_asc,
                };
            },
        },
        created() {
            this.getSection(),
            this.getStudents()
            this.getClear()
        }
    }
</script>