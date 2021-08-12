<template>
    <div class="container-fluid" style="background-color: #2e4790;">
        <div class="fixed-top">
            <nav class="navbar navbar-dark ptb-2 plr-4" style="background-color: #2e4790;">
                <a href="#" class="navbar-text" style="color: #fff;">　きろく</a>
                <div>
                    <li class="dropdown">
                        <a href="#" class="btn dropdown-toggle btn-orange" data-toggle="dropdown" type="button">進捗記録</a>
                        <ul class="dropdown-menu" role="menu">
                            <li><router-link v-bind:to="{name: 'curriculum.record'}">カリキュラム</router-link></li>
                            <li><router-link v-bind:to="{name: 'project.record'}">成果物</router-link></li>
                        </ul>
                    </li>
                    <router-link v-bind:to="{name: 'student.list'}">
                        <button class="btn btn-orange">生徒一覧</button>
                    </router-link>
                    <router-link v-bind:to="{name: 'mypage'}">
                        <button class="btn btn-orange">マイページ</button>
                    </router-link>
                </div>
            </nav>
        </div>
    </div>
</template>
 
<script>
    export default {}
</script>

<style>
    
</style>