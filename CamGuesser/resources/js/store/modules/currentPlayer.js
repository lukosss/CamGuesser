const state = {
    game: {
        score: localStorage.getItem("score"),
        level: localStorage.getItem("level")
    }
};
const getters = {};
const actions = {
    getProgress() {
        return localStorage.getItem("score");
    }
};
const mutations = {};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
