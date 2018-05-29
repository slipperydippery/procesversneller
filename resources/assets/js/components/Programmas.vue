<template>
	<div class="programmas infoblock">
		
		<div class="row searchitems">
			<div class="col-sm-6 columns">
				<h3>Zoek op trefwoord</h3>
				<input type="text" v-model="search" placeholder="Vul trefwoord in">
			</div>

		</div>

		<div class="row row--table table-header">
			<div class="col-sm-2 columns">
				Naam
			</div>
			<div class="col-sm-10 columns">
				Beschrijving
			</div>
		</div>

		<div class="row row--table row--table--body"
			v-for="programma in searchedProgrammas"
		>
			<div class="col-sm-2 columns">
				<a :href="programma.adress">
					{{ programma.title}}
				</a>
			</div>
			<div class="col-sm-10 columns">
				{{ programma.description }}
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: [],

		data() {
			return {
				search: '',
				programmas: [],
			}
		},

		mounted() {
			this.getProgrammas(); //get participants and set availableinstances
		},

		computed: {
			returnRoot: function () {
				return (window.location.protocol + "//" + window.location.host);
			},

			searchedProgrammas: function () {
				var self = this;
				return self.programmas.filter(function(programma) {
					if( (programma.description.toLowerCase().indexOf(self.search.toLowerCase()) !== -1) ||
						(programma.title.toLowerCase().indexOf(self.search.toLowerCase()) !== -1) ||
						(programma.adress.toLowerCase().indexOf(self.search.toLowerCase()) !== -1) 
					)
					{
						return true;
					}
				})
			},
		},

		methods: {
			getProgrammas: function () {
				var home = this;
				axios.get('/api/programma')
					.then(function(response){
						home.programmas = response.data;
					})
					.catch(function(error){
						console.log(error);
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