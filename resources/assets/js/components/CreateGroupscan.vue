<template>
    <div class="scan--create">

        <div class="form-group">
            <label for="">Wat voor soort organisatie vertegenwoordig jij tijdens deze scan?</label> <br>
            <div class="alert alert-danger" v-if="errors.instantie_id" v-for="error in errors.instantie_id">
                <strong>Incompleet</strong> {{ error }}
            </div>
            <select v-model="instantie" class="form-control" placeholder="kies een instantie">
              <option v-for="instantie in instanties" :value="instantie"> {{ instantie.title }} --- {{ instantie.description }} </option>
            </select>
        </div>
        
        <div class="row resultstable--row">
            <div class="col-sm-12">
                <button @click="saveScan()" class="btn btn-primary btn--fullwidth">Sla scan op</button>
            </div>
        </div>    
    </div>

</template>

<script>

    export default {
        props: [
            'instanties',
            'group',
        ],

        data() {
            return {
                instantie: {},
                errors: [],
            }
        },

        mounted() {
        },

        ready() {   
        },

        computed: {
        },

        methods: {
            saveScan: function() {
                var home = this;
                axios.post('/api/group/' + this.group.id + '/storescan', {
                        title: this.group.title,
                        instantie_id: this.instantie.id,
                        scanmodel_id: 1,
                    })
                    .then(function(response){
                        window.location.href = '/home';
                    })
                    .catch(function(error){
                        home.errors = error.response.data.errors;
                    })
            },

        }
    }
</script>
