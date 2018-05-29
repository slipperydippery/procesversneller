<template>
    <div class="scan--container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="page--title">Resultaten</h2>
                <span class="page--clarification">Dit is een overzicht van de resultaten van jouw scan en de scans die je hebt geselecteerd</span>
            </div>
        </div>
        <algemeenbeeld-section
            v-if="store.scan.id"
        >
        </algemeenbeeld-section>
        <theme-section
            v-for="theme in scanmodel.themes"
            :theme="theme"
            :key="theme.id"
            v-if="store.activetheme == theme.id || store.activetheme != theme.id"
        >
        </theme-section>

       
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
            store.activequestion = 6;
            store.resultsview = true;
            this.getAnswers();
            store.scan = this.workscan;
            store.loggedin = this.loggedin ? true : false;
            if(store.scan.group_id) {
                store.isgroup = true;
                this.getGroup(this.workscan.group_id);
            };
            this.getCompares(this.workscan.id);
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
        },

        ready() {   
        },

        computed: {
        },

        methods: {
            getScan: function() {
                if(store.loggedin) {
                    var home = this;
                    axios.get('/api/scan/' + home.workscan.id )
                        .then(function(response){
                            home.store.scan = response.data;
                        })
                        .catch(function(error){
                            console.log(error)
                        })
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
                            home.store.group = response.data;
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
                console.log('getting compares');
                store.compares = [];
                if(store.loggedin) {
                    var home = this;
                    axios.get('/api/scan/' + groupid + '/comparison/')
                        .then(function(response){
                            response.data.comparisons.forEach(function(comparison){
                                store.compares.push(comparison.compared);
                            });
                            if(store.compares.length){
                                store.iscomparison = true;
                            }
                            home.reorderCompares();
                        })
                        .catch(function(error){
                            console.log(error)
                        })
                }
            },

            reorderCompares: function() {
                console.log('reordering compares');
                store.compares.sort(function(a, b) {
                    return a.instantie_id - b.instantie_id;
                })
            }, 

            nextQuestion: function () {
                if(store.activequestion < 7) {
                    store.activequestion ++;
                    if(store.activequestion == 6) {
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
                this.storeScan();
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

            goRegister: function() {
                window.location.href = '/register';
            },

            goHome: function() {
                window.location.href = '/';
            }

        }
    }
</script>
