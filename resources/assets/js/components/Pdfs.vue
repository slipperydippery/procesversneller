<template>
	<div class="pdfs infoblock">
		<div class="row searchitems">
			<div class="col-sm-6 columns">
				<h3>Zoek op trefwoord</h3>
				<input type="text" v-model="search" placeholder="Vul trefwoord in">
			</div>
		</div>

		<div class="row row--table table-header">
			<div class="col-sm-2 columns">
				Organisatie
			</div>
			<div class="col-sm-8 columns">
				Beschrijving
			</div>
			<div class="col-sm-2 columns text-center">
				jaar
			</div>
		</div>

		<div class="row row--table row--table--body"
			v-for="pdf in searchedAndFilteredPdfs"
		>
			<div class="col-sm-2 columns">
				{{ pdf.organisation }}
			</div>
			<div class="col-sm-8 columns">
				<a :href="pdfAdress(pdf)" class="visible_link--basic" >
					{{ pdf.description }}
				</a>
			</div>
			<div class="col-sm-2 columns text-center">
				{{ pdf.publication_year }} 
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
				pdfs: [],
				themas: [],
				checkedThemas: [],
			}
		},

		mounted() {
			this.getPdfs();
		},

		computed: {
			returnRoot: function () {
				return (window.location.protocol + "//" + window.location.host);
			},

			searchedAndFilteredPdfs: function () {
				var self = this;
				return this.pdfs.filter(function(pdf) {
					if( (pdf.organisation.toLowerCase().indexOf(self.search.toLowerCase()) !== -1) ||
						(pdf.description.toLowerCase().indexOf(self.search.toLowerCase()) !== -1) ||
						(pdf.publication_year.toLowerCase().indexOf(self.search.toLowerCase()) !== -1) ||
						(pdf.adress.toLowerCase().indexOf(self.search.toLowerCase()) !== -1) 
					)
					{
						return true;
					}
				})
			},
		},

		methods: {
			getPdfs: function () {
				var home = this;
				axios.get('/api/pdf')
					.then(function(response){
						home.pdfs = response.data;
					})
			},

			pdfAdress: function (pdf) {
				return this.returnRoot + '/pdf/' + pdf.adress;
			}
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