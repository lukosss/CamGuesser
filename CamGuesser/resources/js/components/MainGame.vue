<template>
    <div>
        <div>
            <b-modal ref="my-modal" hide-footer hide-backdrop no-close-on-backdrop hide-header-close no-close-on-esc>
                <div class="d-block text-center">
                    <h3>Final Score: {{totalScore + score}}</h3>
                </div>
                <div class="d-flex flex-column">
                    <form action="" class="form" @submit.prevent="createPost()">
                        <div class="d-flex flex-column align-items-center">
                            <div>
                                <label for="player_name">Your Name</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    v-model="post.player_name"
                                    name="player_name"
                                    id="player_name"
                                />
                            </div>
                        </div>
                    </form>
                    <b-button class="mt-3" variant="outline-primary" block  @click="createPost()">Upload Score</b-button>
                    <b-button class="mt-2" variant="outline-warning" block @click="reset()">Return to menu</b-button>
                </div>
            </b-modal>
        </div>

        <div class="d-flex flex-row justify-content-center">
            <h5>Level: {{game.level ? Number(game.level)+1 : 1}}/5 | Score: {{game.score ? game.score : 0}} <span class="text-success h6" v-if="levelStatus==='passed'">
                (+{{ score }} points for this round)</span></h5>
        </div>
        <button v-for="answer in answers" :class="{
            disabled: selectedWrongAnswers.includes(answer),
             disabled: levelStatus === 'passed',
             'btn-danger': selectedWrongAnswers.includes(answer),
              'btn-success': selectedCorrectAnswer.includes(answer)
        }" class="btn btn-lg btn-outline-info ml-2" :id="answer"
                @click="checkAnswer(answer)">
            {{answer}}
        </button>
        <div class="mt-3">
            <b-button variant="success" size="lg" v-if="levelStatus==='passed'" @click="nextLevel()">Next Level >>></b-button>
        </div>
        <hr>
        <div>
            <b-navbar type="dark" variant="faded" fixed="top">
                <b-navbar-nav>
                    <b-nav-item>
                        <b-button variant="outline-warning" @click="reset()">Return to menu</b-button>
                    </b-nav-item>
                </b-navbar-nav>
            </b-navbar>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Game',
        props: ['answers','correct'],
        data: function() {
            return {
                url: window.location.pathname,
                post: {
                    player_name: "",
                    game_mode: "Classic",
                },
                selectedWrongAnswers: [],
                selectedCorrectAnswer: [],
                levelStatus : null,
                level: Number(localStorage.getItem("level")) + 1,
                score: 100,
                totalScore: Number(localStorage.getItem("score"))
            }
        },
        methods: {
            disableWrongAnswer(item) {
                this.selectedWrongAnswers.push(item)
            },
            disableCorrectAnswer(item) {
                this.selectedCorrectAnswer.push(item)
            },
            checkAnswer(answer) {
                if(answer === this.correct)
                {
                    localStorage.setItem("score", (this.totalScore + this.score));
                    this.levelStatus = 'passed';
                    this.disableCorrectAnswer(answer);
                    this.$store.dispatch('currentPlayer/updateScore')
                }
                else
                {
                    this.score -= 33;
                    this.disableWrongAnswer(answer);
                }
            },
            nextLevel() {
                if (this.level > 4) {
                    this.$refs['my-modal'].show()
                }
                else {
                localStorage.setItem("level", this.level);
                window.location.reload()
                }
            },
            reset() {
                window.location.href = '/';
                localStorage.setItem("score", 0);
                localStorage.setItem("level", 0);
            },
            createPost() {
                if (this.post.player_name === "") {
                    return;
                }
                axios
                    .post("play/upload", {
                        post: {
                            player_name: this.post.player_name,
                            score: (this.totalScore + this.score),
                            game_mode: this.post.game_mode
                        }
                    })
                    .then(response => {
                        if (response.status === 201) {
                            this.reset();
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
        },
        computed: {
          game: {
              get() {
                  return this.$store.state.currentPlayer.game;
              }
          },
        }
    }
</script>
