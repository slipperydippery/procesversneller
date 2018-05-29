<template>
    <div class="infoblock" >
        <div class="row">
            <div class="col-sm-12 resultstable">
                <h2 class="page--title"><span class="theme--head--number">Algemeenbeeld resultaten</span></h2>
            </div>
        </div>
        <div class="row content--page">
            <div class="col-sm-12 resultstable">
                <div class="row resultstable--row resultstable--row--average"  v-if="store.isgroup || store.iscomparison">
                    <div class="col-sm-2">Gemiddeld</div>
                    <div class="col-sm-10"> 
                        <div class="resultslider">
                            <div class="resultslider--result"
                                :style="{ width: cssPercent(algemeenAverage()) }"
                            >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row resultstable--row" 
                    v-if="store.isgroup && store.group.scans"
                    v-for="thisscan in store.group.scans"
                >
                    <div class="col-sm-2"> 
                        {{ thisscan.user.name }} <br>
                        <span class="emphasis">{{ thisscan.instantie.title }}</span>
                    </div>
                    <div class="col-sm-10 resultslider--container">
                        <div class="resultslider" :style="{background: thisscan.algemeenbeeld ? '' : 'white'}">
                            <div class="resultslider--result"
                                :style="{ width: cssPercent(thisscan.algemeenbeeld)}"
                            >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row resultstable--row" v-if=" ! store.isgroup  ">
                    <div class="col-sm-2">
                        {{ store.scan.user.name }} <br>
                        <span class="emphasis">{{ store.scan.instantie.title }}</span>
                    </div>
                    <div class="col-sm-10 resultslider--container">
                        <div class="resultslider" :style="{background: store.scan.algemeenbeeld ? '' : 'white'}">
                            <div class="resultslider--result"
                                :style="{ width: cssPercent(store.scan.algemeenbeeld)}"
                            >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row resultstable--row" 
                    v-if="store.iscomparison && store.compares.length"
                    v-for="thisscan in store.compares"
                >
                    <div class="col-sm-2"> 
                        {{ thisscan.user.name }} <br>        
                        <span class="emphasis">{{ thisscan.instantie.title }}</span>
                    </div>
                    <div class="col-sm-10 resultslider--container">
                        <div class="resultslider" :style="{ background: thisscan.algemeenbeeld ? '' : 'white' }">
                            <div class="resultslider--result"
                                :style="{ width: cssPercent(thisscan.algemeenbeeld)}"
                            >
                            </div>
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
            algemeenAverage: function () {
                var algemeenresults = 0;
                var algemeencount = 0;
                if(store.isgroup && store.group.scans) {
                    store.group.scans.forEach(function(thisscan){
                        if (thisscan.algemeenbeeld != null) {
                            algemeenresults = parseFloat(algemeenresults) + parseFloat(thisscan.algemeenbeeld);
                            algemeencount ++;
                        }
                    })
                } else if (store.iscomparison && store.compares.scans) {
                    store.compares.forEach(function(thisscan){
                        if (thisscan.algemeenbeeld != null) {
                            algemeenresults = parseFloat(algemeenresults) + parseFloat(thisscan.algemeenbeeld);
                            algemeencount ++;
                        }
                    })
                }
                return (algemeenresults / algemeencount);
            },

            cssPercent: function (value) {
                return (value * 10) + '%';
            },
        }
    }
</script>
