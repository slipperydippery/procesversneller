<template>
    <div :class=" { infoblock: store.resultsview } ">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="page--title"><span class="theme--head--number">Thema {{ theme.id }}:</span> <span class="theme--head--title">{{ theme.title }}</span></h2>
                <span class="page--clarification" v-if="store.isgroup && store.loggedin && ! store.resultsview">Dit zijn de scores van de deelnemers. Bespreek met elkaar wat er uit springt en/of over welke onderwerpen sterk van mening wordt verschilt. In het volgende scherm kunnen de belangrijkste twee of drie verbeterpunten worden benoemd.</span>
                <span class="page--clarification" v-if=" ! store.isgroup && store.loggedin && ! store.resultsview">Dit zijn jouw antwoorden. Via het dashboard kun je jouw antwoorden vergelijken met andere deelnemers. Kies in het volgende scherm de belangrijkste verbeterpunten.</span>
                <span class="page--clarification" v-if=" ! store.loggedin && ! store.resultsview ">Dit zijn jouw antwoorden. Met een account kun je jouw antwoorden vergelijken met de groep of andere individuele scans. Kies in het volgende scherm de belangrijkste verbeterpunten.</span>
            </div>
        </div>
        <div class="row content--page">
            <div class="col-sm-12 resultstable">
                <div class="row resultstable--row resultstable--row--head">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2" v-for="question in theme.questions" :title=" question.norm "> {{ question.title }} </div>
                </div>
                <div class="row resultstable--row resultstable--row--average"  v-if="store.isgroup">
                    <div class="col-sm-2">Gemiddeld</div>
                    <div class="col-sm-2" v-for="question in theme.questions"> 
                        <div class="resultslider">
                            <div class="resultslider--result"
                                :style="{ width: cssPercent(questionAverage(question.id)) }"
                            >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row resultstable--row resultstable--row--average"  v-if="! store.isgroup && store.iscomparison">
                    <div class="col-sm-2">Gemiddeld</div>
                    <div class="col-sm-2" v-for="question in theme.questions"> 
                        <div class="resultslider">
                            <div class="resultslider--result"
                                :style="{ width: cssPercent(questionCompareAverage(question.id)) }"
                            >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row resultstable--row" 
                    v-if="store.isgroup"
                    v-for="thisscan in store.group.scans"
                >
                    <div class="col-sm-2"> 
                        {{ thisscan.user.name }} <br>        
                        <span class="emphasis">{{ thisscan.instantie.title }}</span>
                    </div>
                    <div class="col-sm-2 resultslider--container" v-for="question in theme.questions">
                        <div class="resultslider">
                            <div class="resultslider--result"
                                :style="{ width: cssPercent(questionResult(thisscan, question.id)), background: nullColor(thisscan, question.id) }"
                            >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row resultstable--row" v-if=" ! store.isgroup ">
                    <div class="col-sm-2">
                        {{ store.scan.user.name }} <br>
                        <span class="emphasis">{{ store.scan.instantie.title }}</span>
                    </div>
                    <div class="col-sm-2 resultslider--container" v-for="question in theme.questions">
                        <div class="resultslider">
                            <div class="resultslider--result"
                                :style="{ width: cssPercent(questionResult(store.scan, question.id)), background: nullColor(store.scan, question.id) }"
                            >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row resultstable--row" 
                    v-if="! store.isgroup && store.iscomparison"
                    v-for="thisscan in store.compares"
                >
                    <div class="col-sm-2"> 
                        {{ thisscan.user.name }} <br>        
                        <span class="emphasis">{{ thisscan.instantie.title }}</span>
                    </div>
                    <div class="col-sm-2 resultslider--container" v-for="question in theme.questions">
                        <div class="resultslider">
                            <div class="resultslider--result"
                                :style="{ width: cssPercent(questionResult(thisscan, question.id)), background: nullColor(thisscan, question.id) }"
                            >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <countdown date="600" v-if="! store.resultsview "></countdown>

    </div>

</template>

<script>
    import {store} from '../app.js';

    export default {
        props: [
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
            isActiveQuestion: function(questionid) {
                var questionmodulo = ((questionid - 1 ) % 5) + 1;
                if(this.store.scan.activequestion == questionmodulo) {
                    return true;
                }
                return false;
            },

            questionResult: function(thisscan, questionid) {
                var thisanswer = '-';
                thisscan.answers.forEach(function(answer) {
                    if(answer.question_id == questionid) {
                        thisanswer = answer.answer;
                    }
                })
                return thisanswer;
            },

            questionAverage: function(questionid) {
                var totalSum = 0;
                var validAnswers = 0;
                this.store.group.scans.forEach(function(thisscan) {
                    thisscan.answers.forEach(function(thisanswer) {
                        if(thisanswer.question_id == questionid && thisanswer.answer != null) {
                            totalSum = parseFloat(totalSum) + parseFloat(thisanswer.answer);
                            validAnswers ++;
                        }
                    })
                })
                return (totalSum / validAnswers);
            },

            questionCompareAverage: function(questionid) {
                var totalSum = 0;
                var validAnswers = 0;
                store.compares.forEach(function(thisscan) {
                    thisscan.answers.forEach(function(thisanswer) {
                        if(thisanswer.question_id == questionid && thisanswer.answer != null) {
                            totalSum += thisanswer.answer;
                            validAnswers ++;
                        }
                    })   
                })
                return (totalSum / validAnswers);
            },

            cssPercent: function (value) {
                if(value == null) {
                    return 100;
                } else {
                    return (value * 10) + '%';
                }
            },

            nullColor: function (thisscan, questionid) {
                var thiscolor = '';
                thisscan.answers.forEach(function(answer) {
                    if(answer.question_id == questionid && answer.answer == null) {
                        thiscolor = 'white';
                    }
                })
                return thiscolor;
            },
        }
    }
</script>
