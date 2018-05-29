<template>
    <div class="scan--container">
        <div class="row">
            <div class="col-md-12">
                <span class="breadcrumb" v-if="store.isgroup"> 
                    Arbeidsmarktregios: 
                    <span v-for="district in store.group.owner.districts"> {{ district.title }} </span>
                 </span>
                <h1 class="section--title" v-if="store.isgroup"> Groepsscan: {{ store.group.owner.title }} </h1>
                <span class="breadcrumb" v-if=" ! store.isgroup"> 
                    Arbeidsmarktregios: 
                    <span v-for="district in store.scan.districts"> {{ district.title }} </span>
                 </span>
                <h1 class="section--title" v-if=" ! store.isgroup"> {{ store.scan.title }} </h1>
            </div>
        </div>

        <theme-section
            v-for="theme in scanmodel.themes"
            :theme="theme"
            :key="theme.id"
            v-if="store.activetheme == theme.id"
        >
        </theme-section>

        <div class="confirm--container" v-if=" finished">
            <div class="confirm">
                <button class="alert topright" @click="finished = false">&#10006;</button>
                <span class="page--clarification">
                    Dank je voor het uitvoeren van de testscan!
                </span> <br>
                <p>Met een account kun je jouw scanresultaten opslaan en vergelijken met een groep of andere deelnemers aan de scan.</p>
                <button @click="goRegister">Maak een account aan</button>
                <button @click="goHome">Terug naar de homepagina</button>
            </div>
        </div>

        <div class="prev-next-nav">
            <a href="#" class="btn prev-next-nav--prev" @click=" previousQuestion ">
                << vorige pagina
            </a>
            <a href="#" class="btn prev-next-nav--next"  @click=" nextQuestion " >
                volgende pagina >>
            </a>
        </div>
        <scan-progress
            :scanmodel="scanmodel"
            :workscan="workscan"
            :page="'show'"
        >
        </scan-progress>
    </div>

</template>

<script>
    import {store} from '../app.js';

    export default {


        props: [
            'workscan',
            'scanmodel',
            'loggedin'
        ],

        data() {
            return {
                store,
                answers: [],
                finished: false,
            }
        },

        mounted() {
            this.getAnswers();
            store.scan = this.workscan;
            store.loggedin = this.loggedin ? this.loggedin : false;
            if(store.scan.group_id) {
                store.isgroup = true;
                this.getGroup(this.workscan.group_id);
                window.Echo.private('groupscores.' + this.workscan.group_id).listen('GroupscoresUpdated', e => {
                    this.getScan();
                });
            }
            this.$on('getscan', function(value){
                this.getScan();
            });
            this.$on('storescan', function(value){
                this.storeScan();
            });
            this.$on('getanswers', function(value){
                this.getAnswers();
            });
            this.$on('getgroup', function(value){
                this.getGroup(store.group.id);
            });
            this.$on('updateAssets', function(value){
                this.updateHintsModal();
                this.broadcastUpdate();
            });
        },

        ready() {   
        },

        computed: {
        },

        methods: {
            getScan: function() {
                console.log('getting scan');
                if(store.loggedin) {
                    var home = this;
                    axios.get('/api/scan/' + home.workscan.id )
                        .then(function(response){
                            store.scan = response.data;
                        })
                        .catch(function(error){
                            console.log(error)
                        })
                }
                if(store.isgroup) {
                    this.getGroup(store.group.id);
                }
            },

            getAnswers: function() {
                var home = this;
                axios.get('/api/scan/' + home.workscan.id + '/answers')
                    .then(function(response){
                        home.answers = response.data;
                    })
                    .catch(function(error){
                        console.log(error)
                    })
            },

            getGroup: function(groupid) {
                if(store.loggedin) {
                    var home = this;
                    axios.get('/api/group/' + groupid)
                        .then(function(response){
                            store.group = response.data;
                            home.reorderGroup();
                        })
                        .catch(function(error){
                            console.log(error)
                        })
                }
            },

            reorderGroup: function() {
                store.group.scans.sort(function(a, b) {
                    return a.instantie_id - b.instantie_id;
                })
            }, 

            getCompares: function(groupid) {
                if(store.loggedin) {
                    var home = this;
                    axios.get('/api/compare/scan/' + groupid)
                        .then(function(response){
                            store.compares = response.data;
                        })
                        .catch(function(error){
                            console.log(error)
                        })
                }
            },

            nextQuestion: function () {
                if(store.activequestion < 7) {
                    store.activequestion ++;
                    if(store.activequestion >= 6) {
                        this.getScan();
                    }
                } else if (store.activetheme == 3) {
                    if(! store.loggedin) {
                        this.finished = true;
                    } else {
                        window.location.href = '/scan/' +  store.scan.id + '/showmeasures';
                    }
                } else {
                    store.activequestion = 0;
                    store.activetheme ++;
                }
                this.updateHintsModal();
                this.storeScan();
                this.broadcastUpdate();
            },

            previousQuestion: function () {
                if(store.activequestion > 0) {
                    store.activequestion --;
                } else if (store.activetheme > 1) {
                    store.activetheme --;
                    store.activequestion = 7;
                } else {
                    window.location.href = '/scan/' + store.scan.id + '/algemeenbeeldresultaten';
                }
                this.storeScan();
                this.updateHintsModal();
                this.broadcastUpdate();
            },

            updateHintsModal: function () {
                console.log('updating hints');
                var showsModalHints = store.loggedin ? store.loggedin.hints : true;
                if(store.activequestion == 1) {
                    store.hintsmodal.active = showsModalHints;
                    store.hintsmodal.messages = [
                        'Als je een vraag hebt ingevuld, zie je dat in het menu onderin. Via het menu onderin kun je ook versneld door de scan bladeren.',
                        'Je kunt altijd direct naar je dashboard via het icoon bovenin. Als je tussentijds stop worden je vragen opgeslagen.'
                    ];
                } else if (store.activequestion == 6 ) {
                    store.hintsmodal.active = showsModalHints;
                    if(store.isgroup) {
                        store.hintsmodal.messages = [
                            'Dit zijn de scores van de deelnemers. Bespreek met elkaar wat Bespreek met elkaar wat er uit springt en/of overe welke onderwerpen sterk van mening wordt verschilt.  In het volgende scherm kunnen de belangrijkste twee of drie verbeterpunten worden benoemd.'
                        ];
                    } else {
                        store.hintsmodal.messages = [
                            'Dit is jouw score. Deze kun je eventueel via het dashboard vergelijken met scans van andere deelnemers. Als je een groepsscan doet, zie je hier meteen de scores van de deelnemers uit jouw groep.'
                        ];
                    }
                } else if (store.activequestion == 7) {
                    store.hintsmodal.active = showsModalHints;
                    store.hintsmodal.messages = [
                        'Licht hier eventueel toe wat de concrete analyse of actie is, waartoe door de deelnemers aan de sessie is besloten. Deze komen verderop automatisch terug in de concept verbeteragenda.'
                    ];
                }
            },

            storeScan: function() {
                if(store.loggedin) {
                    axios.post('/api/scan/' + store.scan.id, {
                        scan: store.scan
                    })
                    .then( response => {
                        this.getScan();
                    } )
                    .catch( e => {
                        this.errors.push( e )
                    })
                }
            },

            broadcastUpdate: function() {
                if(store.isgroup) {
                    console.log('broadcasting update');
                    axios.get('/api/group/' + store.group.id + '/broadcastupdate')
                    .then()
                    .catch(function(error){
                        console.log(error)
                    })
                }
            },

            goRegister: function() {
                window.location.href = '/register';
            },

            goHome: function() {
                window.location.href = '/';
            }

        }
    }
</script>
