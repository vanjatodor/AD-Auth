<template>
  <div>
    
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import { authComputed } from '../vuex/helpers.js'

  export default {
    computed: {
      ...authComputed
    },
  };
</script>