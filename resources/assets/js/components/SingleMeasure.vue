<template>
    <div class="col-sm-12 resultstable resultstable__measure infoblock">
        <div class="row resultstable--row resultstable--row--head">
            <div class="col-sm-12" > {{ question.title }} </div>
        </div>
        <div class="measures">
            <div class="measures--group">
                <div class="row resultstable--row">
                    <div class="col-sm-2">Actiepunten en betrokkenen</div>
                    <div class="col-sm-10">
                        <textarea  
                            v-if="store.isgroup && store.group.owner.measures"
                            class="form-control" 
                            placeholder="Actie Omschrijving"
                            rows="6"
                            v-model="store.group.owner.measures[findMeasure(question.id)].measure"
                            @blur="updateMeasure(store.group.owner.measures[findMeasure(question.id)])"
                            :disabled="isntOwner"
                        >
                        </textarea>
                        <textarea  
                            v-else
                            class="form-control" 
                            placeholder="Actie Omschrijving"
                            rows="6"
                            v-model="store.scan.measures[findMeasure(question.id)].measure"
                            @blur="updateMeasure(store.scan.measures[findMeasure(question.id)])"
                        >
                        </textarea>
                    </div>
                </div>

                <div class="row resultstable--row" v-if="store.isgroup && (! isntOwner)">
                    <div class="col-sm-2">
                        Trekker
                    </div>
                    <div class="col-sm-5">
                        <span 
                            v-for="user in store.group.owner.measures[this.measure].users" 
                            @click="removeUser(user)"
                            class="clickable selectable selectable--active"
                        > 
                            {{ user.name }} 
                        </span>
                    </div>
                    <div class="col-sm-5">
                        <span 
                            v-for="user in passiveusers" 
                            @click="addUser(user)"
                            class="clickable selectable selectable--passive"
                        > 
                            {{ user.name }} 
                        </span><br>    
                    </div>
                </div>

                <div class="row resultstable--row" v-if="store.isgroup && isntOwner">
                    <div class="col-sm-2">
                        Trekker
                    </div>
                    <div class="col-sm-5">
                        <span 
                            v-for="user in store.group.owner.measures[this.measure].users" 
                            class=" selectable selectable--active"
                        > 
                            {{ user.name }} 
                        </span>
                    </div>
                    <div class="col-sm-5">
                        <span 
                            v-for="user in passiveusers" 
                            class=" selectable selectable--passive"
                        > 
                            {{ user.name }} 
                        </span><br>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {store} from '../app.js';

    export default {
        props: [
            'question',
            'groupusers',
            'measure'
        ],

        data() {
            return {
                store,
                actions: [],
                activeusers: [],
            }
        },

        mounted() {
        },

        computed: {
            passiveusers: function() {
                var theseusers = [];
                var home = this;
                home.groupusers.forEach(function(thisuser){
                    var match = false;
                    store.group.owner.measures[home.measure].users.forEach(function(thatuser){
                        if(thisuser.id == thatuser.id){
                            match = true;
                        }
                    })
                    match ? '' : theseusers.push(thisuser) ;
                })
                return theseusers;
            },
            
            isntOwner: function() {
                if(! store.isgroup) {
                    return false;
                } else {
                    if(store.group.owner.id == store.scan.id) {
                        return false;
                    }
                    return true;
                }
            }
        },

        methods: {
            findMeasure: function(questionid) {
                var returnmeasure = {};
                var home = this;
                if( ! store.isgroup) {
                    this.store.scan.measures.forEach(function(thismeasure) {
                        if(thismeasure.question_id == questionid) {
                            returnmeasure = store.scan.measures.indexOf(thismeasure);
                        }
                    }) 
                } else {
                    this.store.group.owner.measures.forEach(function(thismeasure){
                        if(thismeasure.question_id == questionid) {
                            returnmeasure = home.store.group.owner.measures.indexOf(thismeasure);
                        }
                    })
                }
                return returnmeasure;
            },

            updateMeasure: function (thismeasure) {
                axios.patch('/api/measure/' + thismeasure.id, {
                    measure: thismeasure
                    })
                    .then(function(response){

                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            },

            storeMeasure: function (measure) {
                var home = this;
                axios.patch('/api/measure/' + measure.id, {
                    measure: measure
                })
                .then(function(response) {

                })
                .catch(function(error) {
                    console.log(error)
                })
            },

            addUser: function (user) {
                var home = this;
                var thismeasure = store.group.owner.measures[this.measure];
                store.group.owner.measures[home.measure].users = [];
                store.group.owner.measures[home.measure].users.push(user);
                axios.post('/api/measure/' + thismeasure.id + '/user/' + user.id, {
                        user: user
                    })
                    .then(function(response){
                        home.$parent.$emit('getgroup', 'test');
                    })
                    .catch(function(error){
                        console.log(error)
                    })
            },

            removeUser: function (user) {
                var home = this;
                var thismeasure = store.group.owner.measures[this.measure];
                store.group.owner.measures[home.measure].users = [];
                axios.get('/api/measure/' + thismeasure.id + '/user/' + user.id + '/removeuser')
                    .then(function(response){
                        home.$parent.$emit('getgroup');
                    })
                    .catch(function(error){
                        console.log(error)
                    })


            }

        }
    }
</script>
