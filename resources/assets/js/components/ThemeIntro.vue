<template>
    <div class="introvideo" >
        <div class="row">
            <div class="col-sm-12">
                <h2 class="page--title"><span class="theme--head--number">Thema {{ theme.id }}:</span> <span class="theme--head--title">{{ theme.title }}</span></h2>
                <span class="page--clarification">Bekijk de introductiefilm over "Thema {{ theme.id }}: {{ theme.title }}" of ga direct door naar de vragen.</span>
            </div>
        </div>
        <div class="row content--page">
            <div class="col-sm-12 youtube--container">
                <iframe width="560" height="315" :src="'https://www.youtube.com/embed/' + videoId" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
            
            </div>
        </div>
    </div>

</template>


<script>
    import {store} from '../app.js';

    export default {
        props: [
            'theme'
        ],

        data() {
            return {
                store,
            }
        },

        mounted() {
        },

        computed: {
            videoId: function () {
                switch(this.theme.id) {
                    case 1:
                        return 'UjItL3RGbU0'
                        break;
                    case 2:
                        return 'BCd3b2NfnDM'
                        break;
                    case 3:
                        return 'tYNpt95zTWc'
                        break;
                    default:
                        return 'oOSoBnCPHlk'
                        break;
                }
            }

        },

        methods: {
            isActiveQuestion: function(questionid) {
                var questionmodulo = ((questionid - 1 ) % 5) + 1;
                if(this.store.scan.activequestion == questionmodulo) {
                    return true;
                }
                return false;
            }
        }
    }
</script>
