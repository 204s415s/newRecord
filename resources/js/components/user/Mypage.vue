<template>
    <div id="app" class="container">
        <div class="content">
        <div class="row">
            <div class="col-md-5 col-md-push-7">
                <p id="heading">担当生徒</p>
                <students></students>
            </div>
            <div class="col-md-7 col-md-pull-5">
                <today></today>
                <br />
                <calendar></calendar>
            </div>
            
            <button v-on:click="openModal()">click</button>
            <modal v-show="showContent" v-on:from-child="closeModal()"></modal>
        </div>
        </div>
        
        
        
    </div>
</template>

<script>
    import students from './Student'
    import calendar from './Calendar'
    import today from './Today'
    import modal from './Modal'
    export default {
        components: {
            students,
            calendar,
            today,
            modal
        },
        data: function() {
            return {
                showContent: false,
                modal: false
            }
        },
        methods: {
            openModal() {
                this.showContent = true
            },
            closeModal() {
                this.showContent = false
            }
        }
    }
    
    
</script>