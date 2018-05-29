<template>
	<div class="praktijkvoorbeelds infoblock">
		<div class="row searchitems">
			<div class="col-sm-6 columns">
				<h3>Zoek op trefwoord</h3>
				<input type="text" v-model="search" placeholder="Vul trefwoord in">
			</div>
			<br>
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
			v-for="praktijkvoorbeeld in searchedAndFilteredPraktijkvoorbeelds"
		>
			<div class="col-sm-2 columns">
				<a :href="praktijkvoorbeeld.adress">
					{{ praktijkvoorbeeld.title}}
				</a>
			</div>
			<div class="col-sm-10 columns">
				{{ praktijkvoorbeeld.description }}
			</div>
		</div>
		
	</div>
	
</template>

<script>
	export default {
		components: {  },

		data() {
			return {
				search: '',
				praktijkvoorbeelds: [],
				checkedThemas: [],
				instanties: [
					'bedrijven',
					'scholen',
					'gemeenten',
					'overig',
				],
			}
		},

		mounted() {
			this.getpraktijkvoorbeelds(); //get participants and set availableinstances
		},

		computed: {
			returnRoot: function () {
				return (window.location.protocol + "//" + window.location.host);
			},

			searchedAndFilteredPraktijkvoorbeelds: function () {
				var self = this;
				return self.praktijkvoorbeelds.filter(function(praktijkvoorbeeld) {
					if( (praktijkvoorbeeld.description.toLowerCase().indexOf(self.search.toLowerCase()) !== -1) ||
						(praktijkvoorbeeld.title.toLowerCase().indexOf(self.search.toLowerCase()) !== -1) ||
						(praktijkvoorbeeld.adress.toLowerCase().indexOf(self.search.toLowerCase()) !== -1) 
					)
					{
						return true;
					}
				})
			},

			// filteredPraktijkvoorbeelds: function () {
			// 	var self = this;
			// 	return self.praktijkvoorbeelds.filter(function (praktijkvoorbeeld) {
			// 		for(var thema in self.checkedThemas)
			// 		{
			// 			if(praktijkvoorbeeld.themas.includes(self.checkedThemas[thema]))
			// 			{
			// 				return true;
			// 			}
			// 		}
			// 		if(self.checkedThemas.length == 0)
			// 		{
			// 			return true;
			// 		}
			// 	})
			// }
		},

		methods: {
			getpraktijkvoorbeelds: function () {
				var home = this;
				axios.get('/api/praktijkvoorbeeld')
					.then(function(response){
						home.praktijkvoorbeelds = response.data;
					})
			},

			// replaceThemas: function () {
			// 	for (var praktijkvoorbeeld in this.praktijkvoorbeelds)
			// 	{
			// 		if(this.praktijkvoorbeelds[praktijkvoorbeeld].bedrijven)
			// 		{
			// 			this.praktijkvoorbeelds[praktijkvoorbeeld].bedrijven = 'bedrijven';
			// 			this.praktijkvoorbeelds[praktijkvoorbeeld].themas.push('bedrijven');
			// 		}
			// 		if(this.praktijkvoorbeelds[praktijkvoorbeeld].scholen)
			// 		{
			// 			this.praktijkvoorbeelds[praktijkvoorbeeld].scholen = 'scholen';
			// 			this.praktijkvoorbeelds[praktijkvoorbeeld].themas.push('scholen');
			// 		}
			// 		if(this.praktijkvoorbeelds[praktijkvoorbeeld].gemeenten)
			// 		{
			// 			this.praktijkvoorbeelds[praktijkvoorbeeld].gemeenten = 'gemeenten';
			// 			this.praktijkvoorbeelds[praktijkvoorbeeld].themas.push('gemeenten');
			// 		}
			// 		if(this.praktijkvoorbeelds[praktijkvoorbeeld].overig)
			// 		{
			// 			this.praktijkvoorbeelds[praktijkvoorbeeld].overig = 'overig';
			// 			this.praktijkvoorbeelds[praktijkvoorbeeld].themas.push('overig');
			// 		}
			// 	}
			// },
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