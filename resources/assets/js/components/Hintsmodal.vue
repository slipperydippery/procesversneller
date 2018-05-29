<template>
	<div class="hintsmodal" v-if="store.hintsmodal.active && store.hintsmodal.messages.length" @click.self="store.hintsmodal.active = false">
		<div class="hintscontainer infoblock">
			<a href="#" class="close" @click="store.hintsmodal.active = false">
				X
			</a>
			<h4><img src="/img/hints.svg" class="hinticon"> Hints</h4>
			<ul>
				<li class="hint" v-for="message in store.hintsmodal.messages">
					{{ message }}
				</li>
				
			</ul>
			<div class="nomorehints clearfix" v-if="loggedin">
				<span class="btn btn--small right" @click="noMoreHints()">Hints overal uitzetten</span>
			</div>
			
		</div>
	</div>

</template>

<script>
    import {store} from '../app.js';

    export default {
        props: [
        	'active',
        	'messages',
        	'loggedin'
        ],

        data() {
            return {
		        store,
            }
        },

        mounted() {
        	store.hintsmodal.active = this.checkActive();
            store.hintsmodal.loggedin = this.loggedin;
            store.hintsmodal.messages = this.messages;
        },

        ready() {   
        },

        computed: {
        },

        methods: {
        	noMoreHints: function() {
        		var home = this;
        		axios.get('/api/user/' + home.loggedin.id + '/nomorehints')
        			.then(function(response){
        				home.active = false;
                        store.hintsmodal.active = false;
        			})
        			.catch(function(error){
        				console.log(error)
        			})
        	},

            checkActive: function() {
                if (this.loggedin) {
                    return this.loggedin.hints;
                }
                return true;
            }

        }
    }
</script>