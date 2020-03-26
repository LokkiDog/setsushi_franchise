export default {
  state: {
    modalView: null,
  },
  mutations: {
    setModalView (state, view) {
      state.modalView = view
    }
  },
  actions: {
    setModalView ({commit}, view) {
      commit('setModalView', view)
    }
  },
  getters: {
    getModalView (state) {
      return state.modalView
    }
  }
}