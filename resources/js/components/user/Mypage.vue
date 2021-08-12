<template>
    <div id="app" class="container">
        <div class="row">
            <div class="col-md-7">
                本日の予定
                <today></today>
                <br />
                <calendar></calendar>
            </div>
            <div class="col-md-5">
                担当生徒
                <students></students>
            </div>
            
        </div>
    </div>
</template>

<script>
    import students from './Student'
    import calendar from './Calendar'
    import today from './Today'
    export default {
        components: {
            students,
            calendar,
            today
        }
        
    }
    
</script>