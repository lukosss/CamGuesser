<template>
    <div>
        <button v-for="answer in answers" class="btn btn-lg btn-outline-info ml-2" :id="answer"
                @click="checkAnswer(answer)">
            {{answer}}
        </button>
        <div class="mt-3">
            <b-button variant="success" size="lg" v-if="levelStatus==='passed'" @click="nextLevel()">Next Level >>></b-button>
        </div>


    </div>
</template>

<script>
    export default {
        name: 'Game',
        props: ['answers','correct'],
        data: function() {
            return {
                levelStatus : null,
            }
        },
        methods: {
            checkAnswer($ans) {
                if($ans === this.correct)
                {
                    alert('Correct!');
                    this.levelStatus = 'passed';
                }
                else
                {
                    alert('Wrong answer, try again.');
                }
            },
            nextLevel() {
                window.location.href = '/play';
            }
        }
    }
</script>
