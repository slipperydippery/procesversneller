<template>
	<div class="resultslider">
	    <div class="resultslider--result"
	        :style="{ width: cssPercent(result), background: result ? '' : 'white' }"
	    >
	    </div>
	</div>

</template>

<script>
    import {store} from '../app.js';

    export default {
        props: [
	        'result'
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
            cssPercent: function (value) {
                return (value * 10) + '%';
            },
        }
    }
</script>

