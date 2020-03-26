// Этот компонент отвечает за отображение любых всплываюзих окон
<template>
  <div>
    <loginModal v-show="showModalView === 'login'" @close="closeModalView" title="Вход"/>
  </div>
</template>

<script>
import loginModal from '~/components/UI/modals/Login.vue'
export default {
  components: { loginModal },
  computed: {
    showModalView () {
      return this.$store.getters.getModalView
    }
  },
  methods: {
    closeModalView (view) {
      this.$store.dispatch('setModalView', null)
    }
  }
}
</script>