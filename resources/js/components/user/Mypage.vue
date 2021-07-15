<template>
    <div id="app" class="container h-100">
        <div class="row">
            <div class="col-md-6">
                担当生徒
                <students></students>
            </div>
            
            <div class="col-md-6">
                    <>
                    <div style="height=100%">
                        <calendar></calendar>
                    </div>
            </div>
        </div>
    </div>
</template>

<script>
    import students from './Student'
    import calendar from './Calendar'
    export default {
        components: {
            students,
            calendar
        }
        
    }
    
</script>