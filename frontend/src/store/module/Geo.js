const SET_LOC = 'SET_LOC'
const PRESS_CENTER = 'PRESS_CENTER'
const FINISH_CENTER = 'FINISH_CENTER'

// initial state
// shape: [{ id, quantity }]
const state = {
  geoLocEnable: true,
  centerPress: false
}

// getters
const getters = {
  geoLocEnable: (state) => state.geoLocEnable,
  centerPress: (state) => state.centerPress
}

// actions
const actions = {
  setLoc ({commit}, loc) {
    commit(SET_LOC, {loc})
  },
  centerPress ({commit}) {
    commit(PRESS_CENTER)
  },
  finishCenter ({commit}) {
    commit(FINISH_CENTER)
  }
}

// mutations
const mutations = {
  SET_LOC: (state, { loc }) => {
    state.geoLocEnable = loc
  },
  PRESS_CENTER: (state) => {
    state.centerPress = true
  },
  FINISH_CENTER: (state) => {
    state.centerPress = false
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
