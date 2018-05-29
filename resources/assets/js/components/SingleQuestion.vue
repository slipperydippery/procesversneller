<template>
    <div class="question">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="page--title"><span class="theme--head--number">Thema {{ theme.id }}:</span> <span class="theme--head--title">{{ theme.title }}</span></h2>
                <span class="page--clarification"><span class="">Vraag {{ (question.id - 1 ) % 5 + 1 }}:</span> <span class="highlight">{{ question.title }}</span></span>
            </div>
        </div>
        <div class="">
            <p class="questionbody">{{ question.norm }}</p>
        </div>

        <countdown date="60"></countdown>
        
        <div class="rangeslider--container">
            <input type="range" 
                min="0" max="10"
                step="0.1"
                v-if="store.scan.answers"
                v-model="store.scan.answers[question.id - 1].answer" 
                v-on:change="onChange"
            >
            <span class="question--answer" v-if=" store.scan.answers[question.id - 1].answer " >{{ store.scan.answers[question.id - 1].answer }}</span>
            <span class="question--answer question--answer__preanswer" v-else >5</span>
        </div>
    </div>
</template>

<script>
    import {store} from '../app.js';

    export default {
        props: [
            'question',
            'theme'
        ],

        data() {
            return {
                store,
            }
        },

        mounted() {
        },

        computed: {
        },

        methods: {
            onChange: function () {
                var home = this;
                var thisanswer = store.scan.answers[home.question.id - 1];
                if(store.loggedin) {
                    axios.post('/api/answer/' + store.scan.answers[home.question.id - 1].id, {
                        answer: thisanswer
                    })
                    .then(response => {})
                    .catch(e => {
                        home.errors.push(e)
                    })
                }
            },
        }
    }
</script>

<style>

</style> 