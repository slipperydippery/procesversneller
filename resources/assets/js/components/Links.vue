<template>
	<div class="links infoblock">
		<div class="row searchitems">
			<div class="col-sm-6 columns">
				<h3>Zoek op trefwoord</h3>
				<input type="text" v-model="search" placeholder="Vul trefwoord in">
			</div>
		</div>

		<div class="row row--table table-header">
			<div class="col-sm-4 columns">
				Link
			</div>
			<div class="col-sm-8 columns">
				Adress
			</div>
		</div>

		<div class="row row--table row--table--body"
			v-for="link in searchedLinks"
		>
			<div class="col-sm-4 columns">
				{{ link.title }}
			</div>
			<div class="col-sm-8 columns">
				<a :href="pdfAdress(link)" class="visible_link--basic" >
					{{ link.adress }}
				</a>
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
				links: [],
				themas: [],
				checkedThemas: [],
			}
		},

		mounted() {
			this.getLinks();
		},

		computed: {
			returnRoot: function () {
				return (window.location.protocol + "//" + window.location.host);
			},

			searchedLinks: function () {
				var self = this;
				return this.links.filter(function(link) {
					if( (link.title.toLowerCase().indexOf(self.search.toLowerCase()) !== -1) ||
						(link.adress.toLowerCase().indexOf(self.search.toLowerCase()) !== -1)
					)
					{
						return true;
					}
				})
			},
		},

		methods: {
			getLinks: function () {
				var home = this;
			    axios.get('/api/link')
			        .then(function(response){
			            home.links = response.data;
			        });
			},

			pdfAdress: function (link) {
				return this.returnRoot + '/link/' + link.adress;
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