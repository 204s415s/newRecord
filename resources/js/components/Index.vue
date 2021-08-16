<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="content">
                <div>進捗記録</div>
                <div class="mb-2">
                    <router-link v-bind:to="{name: 'curriculum.record'}">
                        <button class="btn btn-orange btn-lg mxy-1">カリキュラム</button>
                    </router-link>
                    <router-link v-bind:to="{name: 'project.record'}">
                        <button class="btn btn-blue btn-lg mxy-1">成果物</button>
                    </router-link>
                </div>
                <div>
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
        background: #fff;
    }
    
</style>
