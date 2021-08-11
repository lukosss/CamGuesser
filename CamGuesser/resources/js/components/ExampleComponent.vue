<template>
    <div>
            <button v-for="answer in answers" class="btn btn-lg btn-outline-info"
                    @click="checkAnswer(answer)">
                {{answer}}
            </button>

    </div>
</template>

<script>
    export default {
        name: 'Basic',
        props: ['answers','correct'],
        data: function() {
            return {
                // state : null,
            }
        },
        methods: {
            checkAnswer($ans) {
                if($ans === this.correct)
                {
                    alert('Correct!');
                }
                else
                {
                    alert('Wrong answer, try again.');
                }
            }
        }
    }
</script>
