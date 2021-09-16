const state = {
    game: {
        score: localStorage.getItem("score"),
        level: localStorage.getItem("level")
    }
};
const getters = {};
const actions = {
    updateScore({commit}) {
        let newScore = localStorage.getItem("score");
        commit('SAVE_SCORE', newScore);
    }
};
const mutations = {
    SAVE_SCORE(state, newScore) {
        state.game.score = newScore;
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
