<template>
    <div class="group--create">
        <div class="alert alert-danger" v-if="errors.length">
            <strong>Belangrijk!</strong> {{ errors }}.
        </div>

        <div class="form-group" v-if=" ! isgroup">
            <label for="">Hoe wil je je groep noemen?</label> <br>
            <div class="alert alert-danger" v-if="errors.title" v-for="error in errors.title">
                <strong>Incompleet</strong> {{ error }}
            </div>
            <input type="text" v-model="title" placeholder="Geef jouw groep een naam die herkenbaar is voor mensen uit jouw regio" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Wat voor soort organisatie vertegenwoordig jij tijdens deze scan?</label> <br>
            <div class="alert alert-danger" v-if="errors.instantie_id" v-for="error in errors.instantie_id">
              <strong>Incompleet</strong> {{ error }}
            </div>
            <select v-model="instantie" class="form-control" placeholder="kies een instantie">
              <option v-for="instantie in instanties" :value="instantie"> {{ instantie.title }} --- {{ instantie.description }} </option>
            </select>
        </div>

        <div class="form-group" v-if=" ! isgroup">
            <label for="">Voor welke gemeente(n) maak je deze groep?</label> <br>
            <div class="alert alert-danger" v-if="errors.districts" v-for="error in errors.districts">
                <strong>Incompleet</strong> {{ error }}
            </div>
            <input type="text" v-model="districtsearch" class="form-control" placeholder="Zoek je gemeente">
            <div class="row resultstable--row" v-if="! isgroup">
                <div class="col-sm-12">
                    <div class="infoblock" v-if="selecteddistricts.length || districtsearch != '' ">
                        <span v-if=" ! selecteddistricts.length">Klik op een gemeente om het aan je lijst toe te voegen</span>
                        <span v-if=" selecteddistricts.length ">Je kan meer dan meer dan 1 gemeente kiezen</span> <br>
                        <span
                            v-for="district in selecteddistricts"
                            @click="removeDistrictFromSelection(district)"
                            class="clickable selectable selectable--active"    
                        >
                            {{ district.title }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="row resultstable--row" v-if="! isgroup">
                <div class="col-sm-12">
                    <span 
                        v-for="district in filteredAndSortedDistricts" 
                        @click="addDistrictToSelection(district)"
                        class="clickable selectable selectable--passive"
                    > 
                        {{ district.title }} 
                    </span>
                </div>
            </div>
        </div>
        <div class="row resultstable--row">
            <div class="col-sm-12">
                <button @click="saveGroup()" class="btn btn-primary btn--fullwidth" :disabled="clickedOnce">Maak de groep aan</button>
            </div>
        </div>
            
    </div>


</template>

<script>
    export default {


        props: [
            'instanties',
            'alldistricts'
        ],

        data() {
            return {
                isgroup: false,
                selectedgroup: {},
                title: '',
                instantie: {},
                selecteddistricts: [],
                districtsearch: '',
                errors: [],
                clickedOnce: false,
            }
        },

        mounted() {
        },

        ready() {   
        },

        computed: {
            filtereddistricts: function () {
                var filteredarray = [];
                var home = this;
                if(home.districtsearch != ''){
                    this.alldistricts.forEach(function(thisdistrict){
                        if(thisdistrict.title.toLowerCase().includes(home.districtsearch.toLowerCase())) {
                            filteredarray.push(thisdistrict);
                        } 
                    })
                }
                return filteredarray;
            },

            filteredAndSortedDistricts: function() {
                function compare(a, b) {
                    if (a.title < b.title){
                        return -1;
                    }
                    if (a.title > b.title){
                        return 1;
                    }
                    return 0;
                }

                return this.filtereddistricts.sort(compare);
            }
        },

        methods: {
            sortDistricts: function(thisarray) {
                function compare(a, b) {
                    if (a.title < b.title){
                        return -1;
                    }
                    if (a.title > b.title){
                        return 1;
                    }
                    return 0;
                }
                return thisarray.sort(compare);
            },

            addDistrictToSelection: function(thisdistrict) {
                this.selecteddistricts.push(thisdistrict);
                this.sortDistricts(this.selecteddistricts);
                this.alldistricts.splice(this.alldistricts.indexOf(thisdistrict), 1);
                this.filtereddistricts.splice(this.filtereddistricts.indexOf(thisdistrict), 1);
                this.$forceUpdate();
            },

            removeDistrictFromSelection: function(thisdistrict) {
                this.alldistricts.push(thisdistrict);
                this.filtereddistricts.push(thisdistrict);
                this.sortDistricts(this.filtereddistricts); 
                this.selecteddistricts.splice(this.selecteddistricts.indexOf(thisdistrict), 1);
                this.$forceUpdate();
            },

            saveGroup: function() {
                this.clickedOnce= true;
                this.checkInput();
                var home = this;
                axios.post('/api/group', {
                        title: this.title,
                        instantie_id: this.instantie.id,
                        districts: this.selecteddistricts,
                        scanmodel_id: 1,
                    })
                    .then(function(response){
                        window.location.href = '/group/' + response.data.id + '/created'; 
                        // window.location.href = '/home'; 
                    })
                    .catch(function(error){
                        home.errors = error.response.data.errors;
                        home.clickedOnce = false;
                    })
            },

            checkInput: function () {

            }

        }
    }
</script>
