<template>
    <div>
        <div class="row">
            <div class="col-sm-12">

                <h2 class="page--title"><span class="theme--head--number">Thema {{ theme.id }}:</span> <span class="theme--head--title">{{ theme.title }}</span></h2>
                <span class="page--clarification" v-if="store.isgroup && store.loggedin">Hieronder zie je de verbeterpunten die tijdens de scan door de deelnemers zijn geselecteerd. Je kunt per verbeterpunt een duidelijk omschrijving maken van de acties die je neemt, en je kunt aangeven wie de trekker is. Als je aan een groepsscan meedoet, kan alleen de beheer actiepunten aanvinken en een actie omschrijven</span>
                <span class="page--clarification" v-if=" ! store.isgroup && store.loggedin">Hieronder zie je de verbeterpunten die je tijdens de scan hebt geselecteerd. Je kunt per verbeterpunt een duidelijk omschrijving maken van de acties die je neemt.</span>
                <span class="page--clarification" v-if="! store.isgroup && ! store.loggedin">Hieronder zie je de verbeterpunten die je tijdens de scan hebt geselecteerd. Je kunt per verbeterpunt een duidelijk omschrijving maken van de acties die je neemt.</span>
            </div>
        </div>

        <countdown date="300"></countdown>

        <div class="row content--page">
            <single-measure
                v-for="question in theme.questions" v-if="isActiveMeasure(question.id)"
                :measure="findMeasure(question.id)"
                :question="question"
                :groupusers="groupusers"
                :key="question.id"    
            >
            </single-measure>
            <div class="infoblock" v-if="! activeMeasuresCount">Er zijn geen verbeterpunten geselecteerd in de vorige schermen. Ga door naar het volgende thema, of ga terug om alsnog verbeterpunten te selecteren om hier uit te werken.</div>
            
        </div>
    </div>

</template>

<script>
    import {store} from '../app.js';

    export default {
        props: [
            'theme',
            'groupusers'
        ],

        data() {
            return {
                store,
                actions: [],
            }
        },

        mounted() {
            this.$on('getgroup', function(value){
                this.$parent.$emit('getgroup', 'test');
            });
        },

        computed: {
            activeMeasuresCount: function () {
                var activecount = 0;
                var home = this;
                this.theme.questions.forEach(function(thisquestion) {
                    if (home.isActiveMeasure(thisquestion.id)){
                        activecount ++;
                    }
                })
                console.log(activecount);
                return activecount;
            }
        },

        methods: {
            findMeasure: function(questionid) {
                var returnmeasure = {};
                var home = this;
                if( ! store.isgroup) {
                    store.scan.measures.forEach(function(thismeasure) {
                        if(thismeasure.question_id == questionid) {
                            returnmeasure = store.scan.measures.indexOf(thismeasure);
                        }
                    }) 
                } else {
                    store.group.owner.measures.forEach(function(thismeasure){
                        if(thismeasure.question_id == questionid) {
                            returnmeasure = home.store.group.owner.measures.indexOf(thismeasure);
                        }
                    })
                }
                return returnmeasure;
            },

            isActiveMeasure: function (questionid) {
                var active = false;
                if( ! store.isgroup) {
                    if(store.scan.measures){
                        store.scan.measures.forEach(function(thismeasure){
                            if (thismeasure.question_id == questionid) {
                                active = thismeasure.active;
                            }
                        })
                    }
                } else {
                    if(store.group.owner){
                        store.group.owner.measures.forEach(function(thismeasure) {
                            if (thismeasure.question_id == questionid) {
                                active = thismeasure.active;
                            }
                        })
                    }
                }
                return active;
            },


        }
    }
</script>
