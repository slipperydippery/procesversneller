
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
// import router from './routes';

window.Vue = require('vue');


export let store = {
	scan: {
		answers: [
			 { "id": 1, "answer": null},
			 { "id": 2, "answer": null},
			 { "id": 3, "answer": null},
			 { "id": 4, "answer": null},
			 { "id": 5, "answer": null},
			 { "id": 6, "answer": null},
			 { "id": 7, "answer": null},
			 { "id": 8, "answer": null},
			 { "id": 9, "answer": null},
			 { "id": 10, "answer": null},
			 { "id": 11, "answer": null},
			 { "id": 12, "answer": null},
			 { "id": 13, "answer": null},
			 { "id": 14, "answer": null},
			 { "id": 15, "answer": null},
		],
	},
    activetheme: 1,
    activequestion: 0,
	pageboolean: false,
	showdeletescan: false,
	loggedin: false,
	isgroup: false,
	group: {},
	iscomparison: false,
	compares: [],
	resultsview: false,
	hintsmodal: {
		active: true,
		messages: [],
		loggedin: 0,
	}
};

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('passport-clients', require('./components/passport/Clients.vue') );
Vue.component('passport-authorized-clients', require('./components/passport/AuthorizedClients.vue') );
Vue.component('passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue') );

Vue.component('hintsmodal', require('./components/Hintsmodal.vue'));
Vue.component('turnonhints', require('./components/Turnonhints.vue'));

Vue.component('dashmessages', require('./components/Dashmessages.vue'));
Vue.component('dashmessage', require('./components/Dashmessage.vue'));

Vue.component('create-scan', require('./components/CreateScan.vue'));
Vue.component('create-group', require('./components/CreateGroup.vue'));
Vue.component('create-groupscan', require('./components/CreateGroupscan.vue'));

Vue.component('scan-header', require('./components/ScanHeader.vue'));
Vue.component('scan-container', require('./components/ScanContainer.vue'));
Vue.component('scan-progress', require('./components/ScanProgress.vue'));
Vue.component('theme-section', require('./components/ThemeSection.vue'));
Vue.component('single-question', require('./components/SingleQuestion.vue'));
Vue.component('theme-intro', require('./components/ThemeIntro.vue'));	
Vue.component('theme-results', require('./components/ThemeResults.vue'));	
Vue.component('theme-measures', require('./components/ThemeMeasures.vue'));	
Vue.component('results-slider', require('./components/ResultsSlider.vue'));	

Vue.component('results-container', require('./components/ResultsContainer.vue'));
Vue.component('algemeenbeeld-section', require('./components/AlgemeenbeeldSection.vue'));

Vue.component('algemeenbeeld', require('./components/Algemeenbeeld.vue'));
Vue.component('algemeenbeeldresultaten', require('./components/Algemeenbeeldresultaten.vue'));

Vue.component('groupmanager', require('./components/Groupmanager.vue'));
Vue.component('comparemanager', require('./components/Comparemanager.vue'));
Vue.component('comparescan', require('./components/Comparescan.vue'));

Vue.component('measures-container', require('./components/MeasuresContainer.vue'));
Vue.component('measure-theme-section', require('./components/MeasureThemeSection.vue'));
Vue.component('measures-progress', require('./components/MeasuresProgress.vue'));
Vue.component('single-measure', require('./components/SingleMeasure.vue'));
Vue.component('edit-districts', require('./components/EditDistricts.vue'));

Vue.component('countdown', require('./components/Countdown.vue'));

Vue.component('instrumenten', require('./components/Instrumenten.vue'));
Vue.component('programmas', require('./components/Programmas.vue'));
Vue.component('praktijkvoorbeelds', require('./components/Praktijkvoorbeelds.vue'));
Vue.component('pdfs', require('./components/Pdfs.vue'));
Vue.component('links', require('./components/Links.vue'));

Vue.component('dateholder', require('./components/Dateholder.vue'));

import Datepicker from 'vuejs-datepicker';

Vue.use(Datepicker);

 
const app = new Vue({
    el: '#app',
    components: {
        Datepicker
    },
    data: {
		pageboolean: false,
		showdeletescan: false,
    }

});



