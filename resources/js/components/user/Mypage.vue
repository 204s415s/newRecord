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
            
            
            
            
        </div>
        </div>
        
    <div>
    <a class="btn btn-light" @close="modal=false" tabindex="">open</a>
  </div>
  <testmodal v-if="modal" @close="modal=false"/>
        
    </div>
</template>

<script>
    import students from './Student'
    import calendar from './Calendar'
    import today from './Today'
    import modal from './Modal'
    import testmodal from './Testmodal'
    export default {
        components: {
            students,
            calendar,
            today,
            modal,
            testmodal
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