<template>
    <div class="dashmessages">
        <div v-for="grouprequest in grouprequests" class="row dashmessage">
            <div class="col-sm-10 ">
                <span class="dashmessage--message" title="verwijder bericht"> {{ grouprequest.scan.user.name }} wil graag meedoen met de groep <i>{{ grouprequest.group.title }}</i>
                </span>
            </div>
            <div class="col-sm-1">
                <span class="accept clickable" @click="acceptGrouprequest(grouprequest)">Accepteer</span>  
            </div>
            <div class="col-sm-1">  
                <span class="deny clickable" @click="denyGrouprequest(grouprequest)">Weiger</span>
            </div>
        </div>
        <div v-for="message in dashmessages" class="row dashmessage">
            <div class="col-sm-11"> 
                <span class="dashmessage--message" v-html="message.message" title="verwijder bericht">
                </span>
            </div>
            <div class="col-sm-1 ">
                <span class="dashmessage--delete" @click="deleteMessage(message)">x</span>
            </div>    
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'user'
        ],

        data() {
            return {
                dashmessages: [],
                groups: [],
                grouprequests: [],
            }
        },

        mounted() {
            this.getDashmessages();
            this.getGroups();
            window.Echo.private('dashmessages.' + this.user.id).listen('DashmessageUpdate', e => {
                this.dashmessages.push(e.dashmessage);
                // this.getDashmessages();
            });
            window.Echo.private('dashmessages.' + this.user.id).listen('GrouprequestCreated', e => {
                this.getGroups();
            })
        },

        methods: {  
            getDashmessages: function() {
                var home = this;
                axios.get('/api/dashmessage/user/' + home.user.id)
                    .then(function(response){
                        home.dashmessages = response.data;
                    })
                    .catch(function(error){
                        console.log(error);
                    });
            },

            deleteMessage: function(message) {
                var home = this;
                axios.delete('/api/dashmessage/' + message.id)
                    .then(function(response){
                        home.dashmessages.splice(home.dashmessages.indexOf(message), 1);
                    })
                    .catch(function(error){
                        console.log(error);
                    });
            },

            getGroups: function () {
                var home = this;
                axios.get('/api/group/user/' + home.user.id)
                    .then(function(response){
                        home.groups = response.data;
                        home.getGrouprequests();
                    })
                    .catch(function(error){
                        console.log(error)
                    })
            },

            getGrouprequests: function () {
                var home = this;
                home.groups.forEach(function(group){
                    axios.get('/api/grouprequest/' + group.id)
                        .then(function(response){
                            home.grouprequests = [];
                            response.data.forEach(function(group){
                                home.grouprequests.push(group);
                            })
                        })
                        .catch(function(error){
                            console.log(error)
                        })
                })
            },

            acceptGrouprequest: function (grouprequest) {
                var home = this;
                axios.get('/api/grouprequest/' + grouprequest.id + '/accept')
                    .then(function(response){
                        home.grouprequests.splice(home.grouprequests.indexOf(grouprequest), 1);
                    })
                    .catch(function(error){
                        console.log(error);
                    })
            },

            denyGrouprequest: function (grouprequest) {
                var home = this;    
                axios.get('/api/grouprequest/' + grouprequest.id + '/deny')
                    .then(function(response){
                        home.grouprequests.splice(home.grouprequests.indexOf(grouprequest), 1);
                    })
                    .catch(function(error){
                        console.log(error);
                    })
            },
        },
    }
</script>
