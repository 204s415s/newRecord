<template>
    
    <div id="overlay">
            <div id="modal">
                <p>{{ info.event.title }}さん</p>
                <p>{{ info.event.start | today }}</p>
                <p><button v-on:click="clickEvent">close</button></p>
            </div>
        </div>
    
</template>

<script>
    export default {
        props: {
            info: {
                type: Object,
                require: false,
                
            }
        },
        methods: {
            clickEvent() {
                this.$emit('from-child')
            }
        }
    }
</script>