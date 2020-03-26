<template>
  <button class="btn " @click="setModalView('login')">Стать партнёром</button>
</template>
<script>
export default {
  methods: {
    setModalView (view) {
      this.$store.dispatch('setModalView', view)
    }
  }
}
</script>