<template>
    <div>
        <div>
            <h5>Level: {{game.level ? Number(game.level)+1 : 1}}/5 | Score: {{game.score ? game.score : 0}}</h5>
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
                    alert('Correct! +' + this.score + ' points');
                    localStorage.setItem("score", (this.totalScore + this.score));
                    this.levelStatus = 'passed';
                    this.disableCorrectAnswer(answer);
                }
                else
                {
                    alert('Wrong answer. -33 points');
                    this.score -= 33;
                    this.disableWrongAnswer(answer);
                }
            },
            nextLevel() {
                if (this.level > 4) {
                    alert('Final Score: ' + this.totalScore);
                    window.location.href = '/';
                    localStorage.setItem("score", 0);
                    localStorage.setItem("level", 0);
                }
                else {
                localStorage.setItem("level", this.level)
                window.location.href = '/play';
                }
            },
            reset() {
                window.location.href = '/';
                localStorage.setItem("score", 0);
                localStorage.setItem("level", 0);
            }
        },
        computed: {
          game: {
              get() {
                  return this.$store.state.currentPlayer.game;
              }
          }
        }
    }
</script>
