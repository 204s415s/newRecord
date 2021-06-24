<template>
    <div class="container-fluid bg-dark mb-3">
        <div class="container">
            <nav class="navbar navbar-dark">
                <span class="navbar-brand mb-0 h1">Vue Laravel SPA</span>
                <div>
                    <router-link v-bind:to="{name: 'index'}">
                        <button class="btn btn-success">進捗記録</button>
                    </router-link>
                    
                    <router-link v-bind:to="{name: 'student.list'}">
                        <button class="btn btn-success">生徒一覧</button>
                    </router-link>
                    <button class="btn btn-success">マイページ</button>
                </div>
            </nav>
        </div>
    </div>
</template>
 
<script>
    export default {}
</script>