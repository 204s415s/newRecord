<template>
  <input 
    class="form-input" 
    :value="val" 
    @input="updateValue('input', $event.target.value)"
  >
</template>

<script>
  export default {
    props: {
        val: {
            type: Object
        }
    }
  }
</script>