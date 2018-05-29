<template>
	<a href="#">
		<img src="/img/hints.svg" alt="" @click.prevent="turnOnHints()">
	</a>
</template>

<script>
    import {store} from '../app.js';

    export default {
        props: [
	        'user'
        ],

        data() {
            return {
            }
        },

        mounted() {
        },

        ready() {   
        },

        computed: {
        },

        methods: {
        	turnOnHints: function() {
        		store.hintsmodal.active = true;
        		var home = this;
        		axios.get('/api/user/' + home.user.id + '/turnonhints')
        			.then(function(response){

        			})
        			.catch(function(error){
        				console.log(error)
        			})
        	}
        }
    }
</script>