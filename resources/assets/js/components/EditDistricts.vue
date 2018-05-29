<template>
    <div class="edit-districts"> 
        <div class="row resultstable--row">
            <div class="col-sm-12" v-if=" ! districtedit ">
                <div class="clickable hidden--container" v-if="selecteddistricts.length || districtsearch != '' "  @click="districtedit = ! districtedit">
                    <span
                        v-for="district in selecteddistricts"
                    >
                        {{ district.title }} <span v-if="!last(district, selecteddistricts)">-</span>
                    </span>
                     <img src="/img/editicon.svg" alt="" class="icon icon--edit hidden--item">
                </div>
            </div>
        </div>

        <div class="infoblock" v-if="districtedit" v-on-click-outside=" updateDistricts ">
            <div class="close" @click="updateDistricts">Klaar met bewerken</div>
            <div class="row resultstable--row">
                <div class="col-sm-12">
                    <label for="" >Bewerk je gemeente's</label>
                    <div class="form-group" v-if="selecteddistricts.length || districtsearch != '' ">
                        <span v-if=" ! selecteddistricts.length">Klik op een gemeente om het aan je lijst toe te voegen</span>
                        <span v-if=" selecteddistricts.length ">Voeg nog een gemeente toe, of klik er er eentje weg</span> <br>
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
            <div class="row resultstable--row">   
                <div class="col-sm-12"> 
                    <div class="form-group">    
                        <label for="" >Voeg nog een gemeente toe</label>
                        <input type="text" v-model="districtsearch" class="form-control" placeholder="Zoek hier je gemeente" v-if=" ! selecteddistricts.length">
                        <input type="text" v-model="districtsearch" class="form-control" placeholder="Zoek hier naar meer gemeentes" v-else>
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
        </div>
           
    </div>


</template>

<script>
    import { mixin as onClickOutside } from 'vue-on-click-outside';

    export default {
        mixins: [onClickOutside],


        props: [
            'scan',
        ],

        data() {
            return {
                districtedit: false,
                selectedgroup: {},
                instantie: {},
                selecteddistricts: [],
                districtsearch: '',
            }
        },

        mounted() {
            this.getDistricts();
            this.getScanDistricts();
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

            getScanDistricts: function() {
                var home = this;
                axios.get('/api/scan/' + home.scan.id + '/getdistricts')
                    .then(function(response){
                        home.selecteddistricts = response.data;
                    })
                    .catch(function(error){
                        console.log(error)
                    })
            },

            getDistricts: function() {
                var home = this;
                axios.get('/api/district')
                    .then(function(response){
                        home.alldistricts = response.data;
                    })
                    .catch(function(error){
                        console.log(error)
                    })
            },

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

            updateDistricts: function() {
                var home = this;
                home.districtedit = false;
                var districtids = [];
                home.selecteddistricts.forEach(function(thisdistrict){
                    districtids.push(thisdistrict.id);
                });
                axios.post('/api/scan/' + home.scan.id + '/updatedistricts', {
                        districts: districtids
                    })
                    .then(function(response){
                    })
                    .catch(function(error){
                        console.log(error);
                    })
            },

            last: function (item, list) {
                return item === list[list.length - 1]
            }

        }
    }
</script>
