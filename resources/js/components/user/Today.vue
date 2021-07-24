<template>
    <div id="app" class="container">
        本日の予定
        <div v-for="today in todays">
            <p>{{ today.next | today }}　{{ today.student.student_name }}さん ({{ today.style }})</p>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            
            return {
                todays: []
            }
        },
        methods: {
            getTodays() {
                axios.get('/api/mypage/today')
                    .then((res) => {
                        this.todays = res.data
                    })
            }
        },
        mounted() {
            this.getTodays();
        }
    }
</script>