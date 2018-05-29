<template>
    <div class="progress--container">
        <div class="row progressbar">
            <a :href="'/scan/' + workscan.id + '/startscan'" class="progressbar--element" :class=" { active: (page == 'start') } " title="Bekijk de instructiefilm">
                <div>
                    <img src="/img/play.svg" alt="">
                </div>
            </a>
            <a :href="'/scan/' + workscan.id + '/kennismaken'" class="progressbar--element" :class=" { active: (page == 'kennismaken') } " title="Kennismaken" v-if="workscan.group_id">
                <div>
                    <img src="/img/group.svg" alt="">
                </div>
            </a>
            <a :href=" '/scan/' + workscan.id + '/regioincijfers' " class="progressbar--element" :class=" { active: (page == 'regioincijfers') } " title="Cijfers uit jouw regio">
                <div>
                    <img src="/img/nederland-square.svg" alt="">
                </div>
            </a>
            <a :href=" '/scan/' + workscan.id + '/algemeenbeeld' " class="progressbar--element" :class=" { active: (page == 'algemeenbeeld') } " title="Beoordeel de huidige gezamenlijke aanpak">
                <div>
                    <img src="/img/eye.svg" alt="">
                </div>
            </a>
            <a :href=" '/scan/' + workscan.id + '/algemeenbeeldresultaten' " class="progressbar--element" :class=" { active: (page == 'algemeenbeeldresultaten') } " title="Resultaten beoordeling gezamenlijke aanpak">
                <div>
                    <img src="/img/checkmark.svg" alt="">
                </div>
            </a>
            <a :href=" '/scan/' + workscan.id + '/showscan' " class="progressbar--element" :class=" { active: (page == 'show') } " title="15 vragen over 3 themas">
                <div>
                    <img src="/img/questionmark.svg" alt="">
                </div>
            </a>
            <a :href=" '/scan/' + workscan.id + '/showmeasures' " class="progressbar--element" :class=" { active: (page == 'showmeasures') } " title="Uitwerken verbeterpunten" v-if="workscan.id != 1">
                <div>
                    <img src="/img/scoreboard.svg" alt="">
                </div>
            </a>
        </div>
        <div class="scan--progress row progressbar progressbar__double" v-if="page == 'show'">
            <div class="col-sm-4" v-for="theme in scanmodel.themes" :class="'themecolor-' +theme.id">
                <div class="row">
                    <div class="col-sm-12 progress--themetitle" >
                        <span> {{ theme.title }} </span>
                    </div>
                </div>

                <div class="row">
                    <div class="progress--theme progressbar">
                        <div class="progressbar--element clickable" @click=" gotoTheme(theme.id) " :class="{active: isActiveIntro(theme.id)}">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="15px"
                                 height="15px" viewBox="0 0 15 15" enable-background="new 0 0 15 15" xml:space="preserve">
                            <g>
                                <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M3.252,1.366c0-0.483,0.393-0.876,0.877-0.876
                                    c0.215,0,0.412,0.078,0.565,0.206l8.23,6.065l0,0C13.169,6.917,13.33,7.19,13.33,7.5s-0.161,0.583-0.405,0.739l0,0l-8.23,6.064
                                    c-0.153,0.129-0.351,0.206-0.565,0.206c-0.484,0-0.877-0.392-0.877-0.876V1.366z"/>
                            </g>
                            </svg>
                        </div>
                        <div class="progressbar--element clickable"  
                            v-for="question in theme.questions" 
                            @click=" gotoQuestion(question.id) "
                            :class=" { active: isActiveQuestion(question.id) } "
                        >
                            <div class="progress--question" 
                                :class=" { questioncomplete: store.scan.answers[question.id - 1].answer } "
                                :id=" 'progressquestion_' + question.id "
                                :style=" { background: colorvalue(store.scan.answers[question.id - 1].answer) } "
                                :title=" question.title "
                            >
                            </div>
                        </div>
                        <div class="progressbar--element clickable" @click=" gotoThemeResults(theme.id) " :class="{active: isActiveResult(theme.id)}">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 width="449.192px" height="362.45px" viewBox="0 0 449.192 362.45" enable-background="new 0 0 449.192 362.45"
                                 xml:space="preserve">
                                <g>
                                    <path fill="#FFFFFF" d="M445.885,64.035l-53.38,53.38l-37.899,37.9l-203.83,203.82c-4.42,4.42-11.581,4.42-16,0
                                        l-52.71-52.721l-78.75-78.75c-4.42-4.41-4.42-11.58,0-16l44.68-44.68c4.42-4.42,11.59-4.42,16,0l70.75,70.75
                                        c4.42,4.41,11.59,4.41,16,0l234.42-234.42c4.42-4.42,11.58-4.42,16,0l44.72,44.72C450.295,52.445,450.295,59.615,445.885,64.035z"
                                        />
                                </g>
                            </svg>
                        </div>
                        <div class="progressbar--element clickable" @click=" gotoThemeMeasures(theme.id) " :class="{active: isActiveMeasures(theme.id)}">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 width="800px" height="799.992px" viewBox="0 0 800 799.992" enable-background="new 0 0 800 799.992" xml:space="preserve">
                            <g>
                                <path fill="#FFFFFF" d="M788.285,124.854L675.149,11.715c-15.62-15.62-40.947-15.62-56.567,0L247.974,382.324
                                    c-5.204,5.2-8.872,11.744-10.596,18.9L200.418,554.33c-3.772,26.396,18.856,49.023,45.255,45.252l153.106-36.956
                                    c7.156-1.728,13.696-5.396,18.9-10.6l370.605-370.609C803.904,165.798,803.904,140.474,788.285,124.854z"/>
                                <path fill="#FFFFFF" d="M706.338,376.508l-64,63.991c-1.5,1.5-2.344,3.536-2.344,5.656v273.837H79.999V159.998h273.85
                                    c2.124,0,4.156-0.844,5.66-2.344l64.003-64c5.044-5.04,1.473-13.656-5.656-13.656H40c-22.092,0-40,17.904-40,40v639.994
                                    c0,22.088,17.908,40,40,40h639.994c22.092,0,40-17.912,40-40V382.164C719.994,375.04,711.377,371.468,706.338,376.508z"/>
                            </g>
                            </svg>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
    import {store} from '../app.js';

    export default {
        props: [
            'scanmodel',
            'workscan',
            'page'
        ],

        data() {
            return {
                store,
            }
        },

        mounted() {
            this.getScan();
        },

        computed: {
        },

        methods: {
            getScan: function() {
                if(store.loggedin) {
                    var home = this;
                    axios.get('/api/scan/' + home.workscan.id )
                        .then(function(response){
                            console.log('getting scan');
                            home.store.scan = response.data;
                        })
                        .catch(function(error){
                            console.log(error)
                        })
                }
            },

            colorvalue: function (value) {
                if(value == null){ return '#f1f1f1' }
                value = value * 10;
                if(value < 50) {
                    var green = value * 5;
                    var blue = value * 5;
                    var red = 250;
                } else {
                    var green =  250;
                    var red = (50 - (value - 50)) * 5;
                    var blue = (50 - (value - 50)) * 5;
                }
                var color = 'rgba(' + red + ',' + green + ',' + blue + ',1)';
                return color;
            },

            gotoQuestion: function(questionid) {
                this.store.activetheme = Math.ceil(questionid / 5);
                this.store.activequestion = (questionid - 1) % 5 + 1;
                this.$parent.$emit('updateAssets');
            },

            gotoTheme: function (themeid) {
                this.store.activequestion = 0;
                this.store.activetheme = themeid;
                this.$parent.$emit('updateAssets');
            },

            gotoThemeResults: function (themeid) {
                this.store.activequestion = 6;
                this.store.activetheme = themeid;
                if(store.isgroup){
                    this.$parent.$emit('getgroup');
                } else {
                    this.$parent.$emit('getscan');
                }
                this.$parent.$emit('updateAssets');
            },

            gotoThemeMeasures: function (themeid) {
                this.store.activequestion = 7;
                this.store.activetheme = themeid;
                if(store.isgroup){
                    this.$parent.$emit('getgroup');
                } else {
                    this.$parent.$emit('getscan');
                }
                this.$parent.$emit('updateAssets');
            },

            isActiveQuestion: function(questionid) {
                var thememodulo = Math.ceil(questionid / 5);
                var questionmodulo = ((questionid - 1 ) % 5) + 1;
                if(this.store.activequestion == questionmodulo && this.store.activetheme == thememodulo) {
                    return true;
                }
                return false;
            },

            isActiveResult: function (themeid) {
                return (this.store.activetheme == themeid && this.store.activequestion == 6) ? true : false;
            },

            isActiveMeasures: function (themeid) {
                return (this.store.activetheme == themeid && this.store.activequestion == 7) ? true : false;
            },

            isActiveIntro: function (themeid) {
                return (this.store.activetheme == themeid && this.store.activequestion == 0) ? true : false;
            }
        }
    }
</script>

<style>

</style>