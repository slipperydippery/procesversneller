<template>
    <div class="scan--create">
        <div class="form-group">
            <label for="">Wil je je scan aan een groep koppelen?</label> <br>
            <input type="checkbox" v-model="isgroup">
        </div>

        <div class="form-group" v-if="isgroup">
            <label for="">Aan welke groep wil je je scan koppelen</label> <br>
            <div class="alert alert-danger" v-if="errors.selectedgroup" v-for="error in errors.selectedgroup">
                <strong>Incompleet</strong> {{ error }}
            </div>
            <select v-model="selectedgroup" class="form-control" placeholder="kies een groep" >
              <option  disabled value="">Kies een groep</option>
              <option v-for="group in groups" :value="group"> {{ group.title }} - {{ group.owner.user.name }} </option>
            </select>
        </div>

        <div class="form-group" v-if=" ! isgroup">
            <label for="">Hoe wil je je scan noemen?</label> <br>
            <div class="alert alert-danger" v-if="errors.title" v-for="error in errors.title">
                <strong>Incompleet</strong> {{ error }}
            </div>
            <input type="text" v-model="title" placeholder="Geef jouw scan een naam die herkenbaar is voor mensen uit jouw regio, zodat ze je kunnen vinden" class="form-control">
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
            <label for="">Voor welke gemeente(n) doe je deze scan?</label> <br>
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
                <button @click="saveScan()" class="btn btn-primary btn--fullwidth" :disabled="clickedOnce">Save scan</button>
            </div>
        </div>
            
    </div>


</template>

<script>

    export default {


        props: [
            'instanties',
            'groups',
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
                    home.alldistricts.forEach(function(thisdistrict){
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

            saveScan: function() {
                this.clickedOnce = true;
                var home = this;
                axios.post('/api/scan', {
                        isgroup: home.isgroup,
                        selectedgroup: home.selectedgroup.id,
                        title: home.title,
                        instantie_id: home.instantie.id,
                        districts: home.selecteddistricts,
                        scanmodel_id: 1,
                    })
                    .then(function(response){
                        if(home.isgroup){
                            window.location.href = '/grouprequested';
                        } else {
                            window.location.href = '/';
                        }
                    })
                    .catch(function(error){
                        home.errors = error.response.data.errors;
                        home.clickedOnce = false;
                    })
            },

        }
    }
</script>
