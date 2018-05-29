<template>
    <div class="scan--theme">   
        <theme-intro
            v-if="store.activequestion == 0"
            :theme="theme"
        >
        </theme-intro>

        <single-question
            v-for="question in theme.questions"
            :question="question"
            :key="question.id"
            :theme="theme"
            v-if="store.scan.answers && isActiveQuestion(question.id)"
        >
        </single-question>

        <theme-results
            v-if="store.activequestion == 6 && (store.group.scans || ! store.isgroup)"    
            :theme="theme"
        >
        </theme-results>

        <theme-measures
            v-if="store.activequestion == 7 && (store.group.scans || ! store.isgroup)"
            :theme="theme"
        >
        </theme-measures>
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
            this.$on('storescan', function(value){
                this.$parent.$emit('storescan', 'test');
            });
            this.$on('getscan', function(value){
                this.$parent.$emit('getscan');
            });
            this.$on('getgroup', function(value){
                this.$parent.$emit('getgroup');
            });
            this.$on('updateHintsModal', function(value){
                this.$parent.$emit('updateHintsModal');
            })
        },

        computed: {

        },

        methods: {
            isActiveQuestion: function(questionid) {
                var questionmodulo = ((questionid - 1 ) % 5) + 1;
                if(this.store.activequestion == questionmodulo) {
                    return true;
                }
                return false;
            }
        }
    }
</script>
