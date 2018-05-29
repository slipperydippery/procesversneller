<template>
    <div>
        <div class="row">
            <div class="col-sm-12">
                <h2 class="page--title"><span class="theme--head--number">Thema {{ theme.id }}:</span> <span class="theme--head--title">{{ theme.title }}</span></h2>
                <span class="page--clarification">Selecteer de belangrijkste verbeterpunten, licht hier eventueel toe wat de concrete analyse of actie is, waartoe door de deelnemers aan de sessie is besloten. Deze komen verderop automatisch terug in de concept verbeteragenda. Als je aan een groepsscan meedoet, kan alleen de beheerder actiepunten aanvinken en een actie omschrijven.</span>
            </div>
        </div>
        <div class="row content--page">
            <div class="col-sm-12 resultstable">
                <div class="row resultstable--row resultstable--row--head">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2" v-for="question in theme.questions"> {{ question.title }} </div>
                </div>
                <div class="row resultstable--row resultstable--row--average" v-if="store.isgroup">
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
                <div class="row resultstable--row resultstable--row--average" v-if="! store.isgroup">
                    <div class="col-sm-2">Jouw Antwoorden</div>
                    <div class="col-sm-2" v-for="question in theme.questions"> 
                        <div class="resultslider">
                            <div class="resultslider--result"
                                :style="{ width: cssPercent(questionResult(store.scan, question.id)) }"
                            >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="measures">
                    <div class="measures--group">
                        <div class="row resultstable--row">
                            <div class="col-sm-2">Actiepunten</div>
                            <div class="col-sm-2" v-for="question in theme.questions">
                                <input type="checkbox" id="checkbox" :checked="isActiveMeasure(question.id)" @click="toggleActiveMeasure(question.id)" :disabled="isntOwner">
                            </div>
                        </div>
                        <div class="row resultstable--row">
                            <div class="col-sm-2">Aantekeningen</div>
                            <div class="col-sm-2" v-for="question in theme.questions">
                                <textarea  
                                    v-if="store.isgroup"
                                    class="form-control" 
                                    placeholder="Actie Omschrijving"
                                    rows="6"
                                    v-model="store.group.owner.measures[findMeasure(question.id)].measure"
                                    :disabled="isntOwner"
                                    @blur="updateMeasure(store.group.owner.measures[findMeasure(question.id)])"
                                >
                                </textarea>
                                <textarea  
                                    v-else
                                    class="form-control" 
                                    placeholder="Actie Omschrijving"
                                    rows="6"
                                    v-model="store.scan.measures[findMeasure(question.id)].measure"
                                    @blur="updateMeasure(store.scan.measures[findMeasure(question.id)])"
                                >
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <countdown date="300"></countdown>

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
                actions: [],
            }
        },

        mounted() {
        },

        computed: {
            isntOwner: function() {
                if(! store.isgroup) {
                    return false;
                } else {
                    if(store.group.owner.id == store.scan.id) {
                        return false;
                    }
                    return true;
                }
            }
        },

        methods: {
            findMeasure: function(questionid) {
                var returnmeasure = {};
                var home = this;
                if( ! store.isgroup) {
                    this.store.scan.measures.forEach(function(thismeasure) {
                        if(thismeasure.question_id == questionid) {
                            returnmeasure = store.scan.measures.indexOf(thismeasure);
                        }
                    }) 
                } else {
                    this.store.group.owner.measures.forEach(function(thismeasure){
                        if(thismeasure.question_id == questionid) {
                            returnmeasure = home.store.group.owner.measures.indexOf(thismeasure);
                        }
                    })
                }
                return returnmeasure;
            },

            isActiveQuestion: function(questionid) {
                var questionmodulo = ((questionid - 1 ) % 5) + 1;
                if(this.store.scan.activequestion == questionmodulo) {
                    return true;
                }
                return false;
            },

            isActiveMeasure: function (questionid) {
                var active = false;
                if( ! store.isgroup) {
                    this.store.scan.measures.forEach(function(thismeasure){
                        if (thismeasure.question_id == questionid) {
                            active = thismeasure.active;
                        }
                    })
                } else {
                    this.store.group.owner.measures.forEach(function(thismeasure) {
                        if (thismeasure.question_id == questionid) {
                            active = thismeasure.active;
                        }
                    })
                }
                return active;
            },

            toggleActiveMeasure: function (questionid) {
                var home = this;
                if( ! store.isgroup) {
                    this.store.scan.measures.forEach(function(thismeasure) {
                        if (thismeasure.question_id == questionid) {
                            thismeasure.active = ! thismeasure.active; 
                            home.storeMeasure(thismeasure);
                        }
                    })
                } else {
                    this.store.group.owner.measures.forEach(function(thismeasure) {
                        if (thismeasure.question_id == questionid) {
                            thismeasure.active = ! thismeasure.active; 
                            home.storeMeasure(thismeasure); 
                        }
                    })
                }
            },

            updateMeasure: function (thismeasure) {
                axios.patch('/api/measure/' + thismeasure.id, {
                    measure: thismeasure
                    })
                    .then(function(response){

                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            },

            storeMeasure: function (measure) {
                var home = this;
                axios.patch('/api/measure/' + measure.id, {
                    measure: measure
                })
                .then(function(response) {

                })
                .catch(function(error) {
                    console.log(error)
                })
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

            cssPercent: function (value) {
                return (value * 10) + '%';
            },

        }
    }
</script>
