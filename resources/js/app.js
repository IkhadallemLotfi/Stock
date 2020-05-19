import Vue from 'vue';
import VueRouter from 'vue-router';

import mainvue from './components/mainvue.vue';
import sidebar from './components/admin/sidebar.vue';
import navbar from './components/navbar.vue';
import produitListe from './components/admin/produitListe';
import fournisseurs from './components/admin/fournisseurs';
import factures from './components/admin/factures';
import destinations from './components/admin/destinations';
import entreesortie from './components/admin/entreesortie.vue';


import axios from 'axios'
import VueAxios from 'vue-axios'
Vue.use(VueAxios, axios)


import JsonExcel from 'vue-json-excel' 
Vue.component('downloadExcel', JsonExcel)



import Calendar from 'v-calendar/lib/components/calendar.umd'
import DatePicker from 'v-calendar/lib/components/date-picker.umd'

// Register components in your 'main.js'
Vue.component('vc-calendar', Calendar)
Vue.component('v-date-picker', DatePicker)







import VueGoodTablePlugin from 'vue-good-table';
import 'vue-good-table/dist/vue-good-table.css'
Vue.use(VueGoodTablePlugin);





import 'bootstrap-vue/dist/bootstrap-vue.css'
import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue);

import 'bootstrap/dist/css/bootstrap.css'

const moment = require('moment')
require('moment/locale/fr')
Vue.use(require('vue-moment'), {
    moment
})

import RingLoader from 'vue-spinner/src/RingLoader.vue';

Vue.component('ring-loader',RingLoader);

import {ModelSelect} from 'vue-search-select';
Vue.component('model-select', ModelSelect)

import { MultiSelect } from 'vue-search-select';
Vue.component('multi-select', MultiSelect)


import '@lazy-copilot/datetimepicker/dist/datetimepicker.css'
import { DateTimePicker } from "@lazy-copilot/datetimepicker";
 
Vue.component('date-time-picker', DateTimePicker)

Vue.use(VueRouter);

require('./bootstrap');

window.Vue = require('vue');

const router = new VueRouter({
    mode: 'history',
    scrollBehavior (to, from, savedPosition) {
        return { x: 0, y: 0 }
    },
    routes: [
        {
            path : '/factures',
            name: 'factures',
            component : factures
        },
        {
            path : '/destinations',
            name: 'destinations',
            component : destinations
        },
        {
            path : '/fournisseurs',
            name: 'fournisseurs',
            component : fournisseurs
        },
        {
            path : '/entreesortie/:date',
            props:true,
            name: 'entreesortie',
            component : entreesortie,
        },
        {
            path : '/produits',
            name : 'produits',
            component : produitListe,
            alias : '/'
        },
    ]
})


const app = new Vue({
    el: '#app',
    components : {
        mainvue,
    },
    router
});

const app1 = new Vue({
    el: '#app1',
    components : {
        sidebar,
    },
    router
});

const nav = new Vue({
    el: '#nav',
    components : {
        navbar,
    },
    router
});