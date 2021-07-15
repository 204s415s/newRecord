<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="content">
                    <p>進捗記録</p>
                    <router-link v-bind:to="{name: 'curriculum.record'}">
                        <button class="btn btn-info btn-lg">カリキュラム</button>
                    </router-link>
                    <router-link v-bind:to="{name: 'project.record'}">
                        <button class="btn btn-warning btn-lg">成果物</button>
                    </router-link>
                    <br>
                    <router-link v-bind:to="{name: 'student.list'}">
                        生徒一覧
                    </router-link> / 
                    <router-link v-bind:to="{name: 'student.create'}">
                        生徒登録
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {}
</script>

<style scoped>
    .container {
        posision: relative;
        height:500px;
    }
    
</style>
