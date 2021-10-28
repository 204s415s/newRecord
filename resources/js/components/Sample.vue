<template>
  <div class="content">
    <div class="flash" v-if="show">
      this is flash message!
    </div>

   
    <button @click="showFlash">>show flash message</button>
  
  </div>
</template>

<script>
  export default {
    data() {
      return {
        show: false,
      }
    },

    // Vueインスタンスに変化があったら発動する
    updated() {

      // setTimeoutで3000ms後にshowをfalseにする
      setTimeout(() => {
        this.show = false}
        ,3000
      )
    },
    methods: {
      showFlash(){
        this.show = true;
      }
    }
  }
</script>

<style>
.flash {
  width: 200px;
  height: auto;
}

</style>