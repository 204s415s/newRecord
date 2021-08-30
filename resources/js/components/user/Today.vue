<template>
    <div id="app">
        <div class="todaybox">
            <p class="todaybox-title">本日の予定</p>
            <div v-if="todays.length != 0">
                <div v-for="today in todays">
                    <p class="mt-2 ml-1">{{ today.next | today }}　{{ today.student.student_name }}さん ({{ today.style }})</p>
                </div>
            </div>
            <div v-else>
                <p class="mt-2 ml-1">本日の予定はありません</p>
            </div>
        </div>
    </div>
</template>

<style>
    .todaybox {
        min-height: 100px;
        position: relative;
        margin: 1em 0;
        padding: 0.5em 1em;
        border: solid 2px #e98035;
        border-radius: 8px;
        background-color: transparent;
    }
    
    .todaybox-title {
        position: absolute;
        display: inline-block;
        top: -13px;
        left: 10px;
        padding: 0 7px;
        line-height: 1;
        font-size: 19px;
        background: #ffffff; /*containerの背景色*/
        color: #e98035;
        font-weight: bold;
    }
    
</style>

<script>
    export default {
        data: function() {
            return {
                todays: []
            }
        },
        filters: {
            
        },
        methods: {
            getTodays() {
                axios.get('/api/mypage/today')
                    .then((res) => {
                        this.todays = res.data
                        console.log(res.data)
                    })
            },
        },
        computed: {
            sortTodays() {
                return this.todays.sort(function(a, b) {
                    if(a.next < b.next) {
                        return -1;
                    } else {
                        return 1;
                    }
                });
            }
        },
        mounted() {
            this.getTodays();
        }
    }
</script>