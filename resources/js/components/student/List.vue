<template>
    <div id="app" class="container">
        <div class="content">
        <div class="mb-2">
            <router-link v-bind:to="{name: 'student.create'}">
                <button class="btn btn-orange">登録</button>
            </router-link>
            <router-link v-bind:to="{name: 'student.graph'}">
                <button class="btn btn-orange">グラフ</button>
            </router-link>
            <router-link v-bind:to="{name: 'student.table'}">
                <button class="btn btn-orange">表</button>
            </router-link>
        </div>
        
        <div class="row">
        <table class="table table-bordered">
            <thead class="thead">
            <tr>
                <th class="col-2" @click="sortBy('enter')" :class="addClass('enter')">入学年月</th>
                <th class="col-2" @click="sortBy('student_name')" :class="addClass('student_name')">名前</th>
                <th class="col-2" @click="sortBy('grade')" :class="addClass('grade')">学年</th>
                <th class="col-2" @click="sortBy('user_id')"  :class="addClass('user_id')">担当メンター</th>
                <th class="col-2">詳細</th>
                <th class="col-2">削除</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="student in sortStudents">
                    <td>{{ student.enter | enter}}</td>
                    <td>{{ student.student_name }}</td>
                    <td>{{ student.grade }}</td>
                    <td>{{ student.user.name}}</td>
                    <td>
                        <router-link v-bind:to="{name: 'student.show', params: {studentId: student.id}}">
                            <button class="btn btn-an">Show</button>
                        </router-link>
                    </td>
                    <td>
                        <button class="btn btn-tutuji" v-on:click="deleteStudent(student.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
        </div>
        
        </div>
    </div>
</template>

<style>
    .asc::after {
        content: " ↑昇順";
    }
    .desc::after {
        content: " ↓降順";
    }
</style>

<script>
    export default {
        props: {
            studentId: {
                type: String
            }
        },
        data: function() {
            return {
                students: {
                    id: '',
                    student_name: '',
                    enter: '',
                    grade: '',
                    experience: '',
                    description: '',
                    sheet_id: '',
                    user_id: ''
                },
                records: [],
                loginUser: null,
                student: [],
                sort_key: "",
                sort_asc: true,
                options: {
                    position: 'top-center',
                    duration: 2000,
                    className: ['toasting']
                }
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
            getStudents() {
                axios.get('/api/students')
                    .then((res) => {
                        this.students = res.data
                //         .sort((a, b) => {
                //         if (a[enter] < b[enter]) return -1;
                //         if (a[enter] > b[enter]) return 1;
                //         return 0;
                //     });
                //     return this.students;
                
                });
            },
            
            getLoginUser() {
                axios.get('/api/users/login')
                    .then((res) => {
                        this.loginUser = res.data
                    })
            },
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
            // getRecords() {
            //     axios.get('/api/students')
            //         .then((res) => {
            //             this.records = res.data[1];
            //     });
            // },
            deleteStudent(id) {
                axios.get('/api/students/' + id)
                    .then((res) => {
                        this.student = res.data
                        if (this.loginUser == this.student.user_id) {
                            if (confirm('本当に削除しますか？')) {
                                axios.delete('/api/students/' + id, {data: this.student})
                                    .then((res) => {
                                        this.$toasted.show('削除しました', this.options);
                                        this.getStudents().catch(err => {});
                                        //this.$router.push({name:'student.list'}).catch(err => {})
                                    })
                            }
                        } else {
                            alert("権限がありません")
                        }
                    })
            },
            message(){
                this.$toasted.show('更新しました', this.options);
            },
            
        },
        mounted() {
            this.getStudents();
            //this.getRecords();
            this.getLoginUser();
        }
        
    }
</script>