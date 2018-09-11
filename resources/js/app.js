import './bootstrap'
import Vue from 'vue'

Vue.component('tahun-ajaran-table', require('./components/TahunAjaranTable.vue'));

const app = new Vue({
    el: '#app'
});
