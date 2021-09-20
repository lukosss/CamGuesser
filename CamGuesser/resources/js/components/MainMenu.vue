<template>
    <div class="text-center d-flex flex-column overflow-hidden mt-4 mb-5">
        <h1 class="display-1 fw-bold">Cam<small class="text-danger">Guesser</small></h1>
        <p class="text-black-50 fw-bold h5">Welcome, this is a game where you will be presented with randomly picked webcams from all over the world.
            Some of them may be showing familiar sightings with famous locations and landmarks and some might just be
            traffic or security cameras.<br> Can you guess their location?</p>
        <hr>
        <div>
            <b-card
                class="mb-3"
                overlay
                img-src="https://picsum.photos/id/1002/1200/150/?blur"
                img-alt="Card Image"
                text-variant="white"
                title="Guess the country"
            >
                <b-btn variant="outline-light" class="mt-2 mb-1" @click="beginGameClassic()">Start guessing</b-btn>
                <b-card-text>
                    The original mode where you need to guess the country of a random camera from anywhere in the world.
                    You will have 4 options, but you will have to guess the correct one.
                </b-card-text>
            </b-card>
            <b-card
                class="mb-3"
                overlay
                img-src="https://picsum.photos/id/188/1200/150/?blur"
                img-alt="Card Image"
                text-variant="white"
                title="Guess the country, EU"
            >
                <b-btn variant="outline-light" class="mt-2 mb-1" @click="beginGameEU()">Start guessing</b-btn>
                <b-card-text>
                    Almost the same as original, but the cameras are only picked from Europe.
                    You will have 4 options, but you will have to guess the correct one.
                </b-card-text>
            </b-card>
            <b-card
                overlay
                img-src="https://picsum.photos/id/1029/1200/150/?blur"
                img-alt="Card Image"
                text-variant="white"
                title="Guess the state, US"
            >
                <b-btn variant="outline-light" class="mt-2 mb-1" @click="beginGameEU()">Start guessing</b-btn>
                <b-card-text>
                    In this mode you will only see cameras from USA and you will need to guess what state they are from.
                    You will have 4 options, but you will have to guess the correct one.
                </b-card-text>
            </b-card>
        </div>
        <hr>
    </div>
</template>

<script>
export default {
    methods: {
        beginGameClassic() {
            window.location.href = '/classic-mode';
        },
        beginGameEU() {
            window.location.href = '/europe-mode';
        }
    }
}
</script>

<style>
    .card-img{
        min-width: fit-content;
    }
</style>
