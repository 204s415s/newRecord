<template>
    <div id="app">
        <div id="overlay">
            <div id="modal">
                <p>これがモーダルウィンドウです</p>
                <p><button v-on:click="clickEvent">close</button></p>
            </div>
        </div>
    </div>
    
    
</template>

<script>
    export default {
        methods: {
            clickEvent() {
                this.$emit('from-child')
            }
        }
    }
</script>