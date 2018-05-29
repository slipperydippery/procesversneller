<template>
	<div class="groupmanager">  
		<div class="row page--head">
			<div class="col-sm-12">
				<h2 class="page--title">Hier kan je een scan vergelijken </h2>
				<span class="page--clarification">Klik op een van jouw scans die je wilt vergelijken met andere scans. Voeg daar scans toe om mee te vergelijken, en als je tevreden bent met je selectie, klik dan op "start vergelijking"</span>

			</div>
		</div>
		<div class="row content--page">   
			<div class="col-sm-12">
				<comparescan 
					:scan="scan"
					:allscans="allscans"
					:districts="districts"
					:instanties="instanties"
					v-for="scan in scans"	
					v-if="! scan.group"
					:key="scan.id"
				>
				</comparescan>
				<div class="" v-if="scanstocompare">
					Je hebt helaas geen scans om te vergelijken. Scans die gekoppeld zijn aan een groep kun je niet gebruiken om met andere scans te vergelijken. <a href="/scan/create">Maak een scan aan</a> om een vergelijking mee te kunnen maken. 
				</div>
				
			</div>
		</div>
	</div>
</template>

<script>
	import { mixin as onClickOutside } from 'vue-on-click-outside';

	export default {
		mixins: [onClickOutside],

		props: [
			'user',
			'districts',
			'instanties'
		],
		data() {
			return {
				scans: [],
				allscans: [],
			}
		},

		mounted() {
			this.getScans();
			this.getAllScans();
		},

		computed: {
			scanstocompare: function () {
				var comparescancount = 0;
				this.scans.forEach(function(thisscan){
					if(! thisscan.group){
						console.log('here');
						comparescancount ++;
					}
				})
				return comparescancount ? false : true;
			}
		},

		methods: {
			getScans: function() {
				var home = this;
				axios.get('/api/scan/user/' + home.user.id)
					.then(function(response){
						home.scans = response.data;
					})
					.catch(function(error){
						console.log(error)
					})
			},

			getAllScans: function () {
				var home = this;
				axios.get('/api/scan')
					.then(function(response){
						home.allscans = response.data;
					})
					.catch(function(error){
						console.log(error);
					})
			}
		}
	}
</script>
