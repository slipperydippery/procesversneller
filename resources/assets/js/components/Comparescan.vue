<template>
	<section class="infoblock">
		<div class="row">   
			<div class="col-sm-12 clickable" > 
				<h4>Vergelijk scans met {{ scan.title }} </h4>
			</div>
		</div>
		<div class="row" >   
			<div class="col-sm-12"> 
				<div class="row row--table table-header">
					<div class="col-sm-2">Naam persoon</div>
					<div class="col-sm-3">Naam scan</div>
					<div class="col-sm-3">Gemeenten</div>
					<div class="col-sm-2">Instantie</div>
					<div class="col-sm-1">#beantwoord</div>
					<div class="col-sm-1"></div>
				</div>
				<div class="row row--table" v-for="comparison in scan.comparisons">
					<div class="col-sm-2"> <span class="emphasis">{{ comparison.compared.user.name }}</span> </div>
					<div class="col-sm-3"> {{ comparison.compared.title }} </div>
					<div class="col-sm-3"> <span v-for="district in comparison.compared.districts"> {{ district.title }} </span> </div>
					<div class="col-sm-2"> {{ comparison.compared.instantie.title }} </div>
					<div class="col-sm-1"> {{ answerCount(comparison.compared) }}/15 </div>
					<div class="col-sm-1"> 
						<span class="clickable accept" @click="confirm(comparison) ">&#10004;</span>
					</div>
				</div>
				<div class="row row--table row--empty" v-if="! scan.comparisons.length">
					<span class="center"><h5>--- nog geen scans in deze vergelijking ---</h5></span>
				</div>
			</div>
			<div class="col-sm-12">
				<h4 @click="activateCompare" class="clickable">+ voeg een scan toe aan je vergelijking</h4>
				<div class="addcompare" v-if="addcompareactive">
					<select v-model="districtfilter"  @change="filterScans">
						<option value="">--filter hier op gemeente--</option>
						<option v-for="district in districts" :value="district"> {{ district.title }} </option>
					</select>
					<select v-model="instantiefilter" @change="filterScans">
						<option value="">--filter hier op instantie--</option>
						<option v-for="instantie in instanties" :value="instantie"> {{ instantie.title }} </option>
					</select>
					<div class="row row--table table-header">
						<div class="col-sm-2">Naam persoon</div>
						<div class="col-sm-3">Naam scan</div>
						<div class="col-sm-3">Gemeenten</div>
						<div class="col-sm-2">Instantie</div>
						<div class="col-sm-1">#beantwoord</div>
						<div class="col-sm-1"></div>
					</div>
					<div class="row row--table clickable" v-for="scan in filteredscans" @click=" addCompare(scan) " title="Klik op deze scan om hem toe te voegen aan je vergelijking" v-if="isUncompared(scan)">
						<div class="col-sm-2"> <span class="emphasis">{{ scan.user.name }}</span> </div>
						<div class="col-sm-3"> {{ scan.title }} </div>
						<div class="col-sm-3"> <span v-for="district in scan.districts"> {{ district.title }} </span></div>
						<div class="col-sm-2"> {{ scan.instantie.title }} </div>
						<div class="col-sm-1"> {{ answerCount(scan) }}/15 </div>
						<div class="col-sm-1"> 
							<span class="warning">&#10006;</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12" v-if="scan.comparisons.length">
				<a :href="'/scan/' + scan.id + '/results'" class="btn">Start vergelijking</a>
			</div>
			<div class="confirm--container" v-if="confirmremovecomparebox" v-on-click-outside="cancelremovecompare"> 
				<div class="confirm">
					<p>Weet je zeker dat je <strong>{{ confirmcomparison.compared.user.name }}</strong> uit de vergelijking wilt verwijderen?</p>
					<button @click="confirmremovecompare">Ja</button>
					<button @click="cancelremovecompare" class="btn--delete">Nee</button>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
	import { mixin as onClickOutside } from 'vue-on-click-outside';

	export default {
		mixins: [onClickOutside],

		props: [
			'scan',
			'allscans',
			'districts',
			'instanties'
		],
		data() {
			return {
				active: false,
				addcompareactive: false,
				confirmremovecomparebox: false,
				districtfilter: "",
				instantiefilter: "",
				prefilteredscans: [],
				filteredscans: [],
				confirmcomparison: {},
			}
		},

		mounted() {
		},

		computed: {
		},

		methods: {
			isUncompared: function(scan) {
				var notcompared = true;
				this.scan.comparisons.forEach(function(thiscomparison){
					if(scan.id == thiscomparison.compared.id) {
						console.log('hello there');
						notcompared = false;
					}
				})
				return notcompared;
			},

			activateCompare: function() {
				this.filteredscans =  this.allscans.slice();
				this.active = ! this.active;
				this.addcompareactive = ! this.addcompareactive;
				this.filterScans();
			},

			addCompare: function (scan) {
				// this.filteredscans.splice(this.filteredscans.indexOf(scan), 1);
				var home = this;
				console.log(home.scan.id + ' and ' + scan.id) ;
				axios.post('/api/comparison', {
						scan: home.scan,
						comparison: scan
					})
					.then(function(response){
						console.log(response.data.id);
						home.scan.comparisons.push({compared: scan, id: response.data.id});

					})
					.catch(function(error){
						console.log(error);
					})
			},

			confirm: function (comparison) {
				this.confirmcomparison = comparison;
				this.confirmremovecomparebox = true;
			},

			cancelremovecompare: function() {
				this.confirmcomparison = {};
				this.confirmremovecomparebox = false;
			},

			confirmremovecompare: function () {
				var home = this;
				this.scan.comparisons.splice(this.scan.comparisons.indexOf(home.confirmcomparison), 1);
				axios.delete('/api/comparison/' + home.confirmcomparison.id)
					.then(function(response){
					})
					.catch(function(error){
						console.log(error);
					})
				this.confirmremovecomparebox = false;  
			},

			filterScans: function () {
				var home = this;
				home.prefilteredscans = [];
				home.filteredscans = [];
				if(home.districtfilter == ""){
					home.prefilteredscans =  home.allscans.slice();
				} else {
					home.allscans.filter(function (thisscan) {
						thisscan.districts.forEach(function(district){
							if(district.id == home.districtfilter.id)
							{
								home.prefilteredscans.push(thisscan);
							}
						})
					})
				}
				if(home.instantiefilter == ""){
					home.filteredscans = home.prefilteredscans.slice();
				} else {
					home.prefilteredscans.forEach(function(thisscan){
						if(thisscan.instantie.id == home.instantiefilter.id){
							home.filteredscans.push(thisscan);
						}
					})
				}
				home.filteredscans.forEach(function(scan){
					if(scan.id == home.scan.id) {
						home.filteredscans.splice(home.filteredscans.indexOf(scan), 1);
					}
				})
			},

			answerCount: function (scan) {
				var answercount = 0;
				scan.answers.forEach(function(answer){
					if(answer.answer != null){
						answercount ++;
					}
				});
				return answercount;
			},
		}
	}
</script>
