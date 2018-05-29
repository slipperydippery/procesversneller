<template>
	<div class="row content--page">
		<div class="col-sm-12">
	        <div class="row">
	            <div class="col-sm-2">  </div>
	            <div class="col-sm-2 table--instantie">  </div>
	            <div class="col-sm-1 table--score"> score </div>
	            <div class="col-sm-7">
	            </div>
	        </div>
            <div class="row" v-if="store.isgroup" v-for="scan in store.group.scans">
                <div class="col-sm-2"> {{ scan.user.name }} </div>
                <div class="col-sm-2 table--instantie"> {{ scan.instantie.title }} </div>
                <div class="col-sm-1 table--score"> {{ scan.algemeenbeeld }} </div>
                <div class="col-sm-7">
                	<div class="resultslider">
                	    <div class="resultslider--result"
                	        :style="{ width: cssPercent(scan.algemeenbeeld), background: scan.algemeenbeeld ? '' : 'white' }"
                	    >
                	    </div>
                	</div>
                </div>
            </div>
            <div class="row" v-if=" ! store.isgroup">
                <div class="col-sm-2"> {{ store.scan.user.name }} </div>
                <div class="col-sm-2 table--instantie"> {{ store.scan.instantie.title }} </div>
                <div class="col-sm-1 table--score"> {{ store.scan.algemeenbeeld }} </div>
                <div class="col-sm-7">
                	<div class="resultslider">
                	    <div class="resultslider--result"
                	        :style="{ width: cssPercent(store.scan.algemeenbeeld), background: store.scan.algemeenbeeld ? '' : 'white' }"
                	    >
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
            store.scan = this.workscan;
            store.loggedin = this.loggedin ? true : false;
            if(store.scan.group_id) {
                store.isgroup = true;
                this.getGroup(this.workscan.group_id);
                window.Echo.private('groupscores.' + this.workscan.group_id).listen('AlgemeenbeeldUpdated', e => {
                    this.getGroup(this.workscan.group_id);
                });
            };
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

            cssPercent: function (value) {
                return (value * 10) + '%';
            },
        }
    }
</script>