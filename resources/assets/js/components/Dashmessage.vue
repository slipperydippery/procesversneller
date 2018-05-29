<template>
    <div class="row dashmessage">
        <div class="col-sm-12 ">
            <span class="dashmessage--delete" @click="">x</span>
            <span class="dashmessage--message" v-html="message.message">
            </span>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'message'
        ],

        mounted() {
        },

        methods: {  
        }
    }
</script>
