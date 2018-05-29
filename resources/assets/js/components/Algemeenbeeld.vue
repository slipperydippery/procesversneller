<template>
    <div class="rangeslider--container" >
        <input type="range" 
            min="0" max="10"
            step="0.1"
            v-model="scan.algemeenbeeld" 
            v-on:change="onChange"
        >
        <span class="question--answer" v-if="scan.algemeenbeeld">{{ scan.algemeenbeeld }}</span>
        <span class="question--answer question--answer__preanswer" v-else>5</span>

    </div>
</template>

<script>
    export default {
        props: [
            'workscan',
            'loggedin'
        ],

        data() {
            return {
                scan: {}
            }
        },

        mounted() {
            this.scan = this.workscan;
        },

        computed: {
        },

        methods: {
            onChange: function () {
                var home = this;
                if(this.loggedin){
                    axios.post('/api/scan/' + this.scan.id, {
                            scan: home.scan
                        })
                        .then( response =>{} )
                        .catch( e => {
                            home.errors.push( e )
                    } )   
                }
            },
        }
    }
</script>

<style>

</style> 