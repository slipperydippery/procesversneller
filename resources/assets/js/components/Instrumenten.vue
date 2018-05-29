<template>
	<div class="instrumenten infoblock">
		<div class="row searchitems">
			<div class="col-sm-6">
				<h3>Zoek op trefwoord</h3>
				<input type="text" v-model="search" placeholder="Vul trefwoord in">
			</div>
			<div class="col-sm-6">
				<h3 class="text-right">Zoekfilter</h3>
				<div v-for="thema in themas" class="searchfilter">
					<label :for="thema.id" class="inlinelabel">{{ thema.title }}</label>
					<input type="checkbox" :id="'id' + thema.id" :value="thema.title" v-model="checkedThemas">
				</div>
			</div>
			<br>
			<br>
		</div>

		<div class="row row--table table-header">
			<div class="col-sm-2">
				Naam
			</div>
			<div class="col-sm-7">
				Beschrijving
			</div>
			<div class="col-sm-3">
				Thema's
			</div>
		</div>


		<div class="row row--table"
			v-for="instrument in searchedAndFilteredInstruments"
		>
			<div class="col-sm-2">
				<a :href="instrument.adress" class="visible_link--basic" >
					{{ instrument.title }}
				</a>
			</div>
			<div class="col-sm-7">
				{{ instrument.description }}
			</div>
			<div class="col-sm-3">
				<span v-for="thema in instrument.themas">
					{{ thema }} <br>
				</span>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		components: {  },

		props: [],

		data() {
			return {
				search: '',
				instruments: [],
				themas: [],
				checkedThemas: [],
			}
		},

		mounted() {
			this.getThemas();
		},

		computed: {
			returnRoot: function () {
				return (window.location.protocol + "//" + window.location.host);
			},

			searchedAndFilteredInstruments: function () {
				var home = this;
				return home.filteredInstruments.filter(function(instrument) {
					if( (instrument.description.toLowerCase().indexOf(home.search.toLowerCase()) !== -1) ||
						(instrument.title.toLowerCase().indexOf(home.search.toLowerCase()) !== -1) ||
						(instrument.adress.toLowerCase().indexOf(home.search.toLowerCase()) !== -1) 
					)
					{
						return true;
					}
				})
			},

			filteredInstruments: function () {
				var home = this;
				return home.instruments.filter(function (instrument) {
					for(var thema in home.checkedThemas)
					{
						if(instrument.themas.includes(home.checkedThemas[thema]))
						{
							return true;
						}
					}
					if(home.checkedThemas.length == 0)
					{
						return true;
					}
				})
			}
		},

		methods: {
			getInstruments: function () {
				var home = this;
				axios.get('/api/instrument')
					.then(function(response){
						home.instruments = response.data;
						home.replaceThemas();
					})
					.catch(function(error){
						console.log(error)
					})
			},

			getThemas: function () {
				var home = this;
				axios.get('/api/theme')
					.then(function(response){
						home.themas = response.data;
						home.getInstruments();
					})
					.catch(function(error){
						console.log(error)
					})
			},

			replaceThemas: function () {
				var home = this; 
				this.instruments.forEach(function(thisinstrument){
					thisinstrument.themas = [];
					if(thisinstrument.one)
					{
						thisinstrument.one = home.themas[0].title;
						thisinstrument.themas.push(home.themas[0].title);
					}
					if(thisinstrument.two)
					{
						thisinstrument.two = home.themas[1].title;
						thisinstrument.themas.push(home.themas[1].title);
					}
					if(thisinstrument.three)
					{
						thisinstrument.three = home.themas[2].title;
						thisinstrument.themas.push(home.themas[2].title);
					}
				})
			},
		},
	}
</script>

<style>
	.searchfilter {
		text-align: right;
		label, input {
			display: inline-block;
		}
	}
</style>