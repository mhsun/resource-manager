import Vue from "vue";
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

require('./bootstrap');
require('./prototype');

Vue.use(ElementUI);

Vue.component('pdf-attachment', require('./components/PdfAttachment').default);
Vue.component('html-snippet', require('./components/HtmlSnippet').default);
Vue.component('external-links', require('./components/ExternalLinks').default);

const app = new Vue({
    el: '#app'
})
