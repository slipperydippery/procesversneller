<template>
	<div class="">
		<div class="row">
		    <div class="col-sm-12">
			    <datepicker 
					v-model="workdate"
			    	:format="customFormatter"
			    	language="nl"
			    	:inline="true"
				>
				</datepicker>
		    </div>
		</div>

		<div class="row" >
            <div class="col-sm-12" v-if="! isntOwner">
                <button @click="logdate">bevestig</button>
                <button @click="slaover">sla over</button>
            </div>
            <div class="col-sm-12" v-else>
                <button @click="slaover">ok</button>
            </div>
		</div>
	</div>

</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    Vue.use(Datepicker);
    import moment from "moment";
    import VueMomentJS from "vue-momentjs";
     
    Vue.use(VueMomentJS, moment);

    export default {
        props: [
            'workscan',
            'scandate'
        ],

	    components: {
	        Datepicker
	    },

        data() {
            return {
            	workdate: new Date(moment())
            }
        },

        mounted() {
        	if(this.workscan.scandate){
        		this.workdate = new Date(this.workscan.scandate.date);
        	}
        },

        computed: {
            isntOwner: function() {
                if(! this.workscan.group_id) {
                    return false;
                } else {
                    if(this.workscan.group_id == this.workscan.id) {
                        return false;
                    }
                    return true;
                }
            }
        },

        methods: {

        	customFormatter(date) {
				return moment(date).format('DD MM YYYY');
        	},

        	logdate: function() {
        		var home = this;
        		axios.post('/api/scan/' + this.workscan.id + '/scandate/', {
        			date: home.workdate,
        			date_readable: moment(home.workdate).format('DD MM YYYY')
        		})
        		.then(function(response){
        			window.location.href = '/scan/' + home.workscan.id + '/complete';
        		})
        		.catch(function(error){
        			console.log(error)
        		})
        	},

        	slaover: function() {
    			window.location.href = '/scan/' + this.workscan.id + '/complete';
        	}
        }
    }
</script>