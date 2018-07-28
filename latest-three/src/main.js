// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import db from './database'

Vue.config.productionTip = false

Vue.prototype.$db = db
Vue.prototype.$moment = require("moment")
Vue.prototype.$apiUrl = document.location.hostname
// Vue.prototype.$apiUrl = () => {
// 	let host = document.location.hostname
// 	let path = document.location.pathname
// 	path = path.split('/')
// 	return host + '/api/v1/' + path[0]
// }
Vue.prototype.$md5 = require('md5')

Vue.filter('formateDate', (value, format) => {
	if (!value) return

	let dateObj = new Date(date)
    if (format == 'human') {
        return DAYS_OF_WEEK[dateObj.getDay()] + ', ' + MONTH_ARRAY[dateObj.getMonth()] + ' ' + dateObj.getDate() + ', ' + dateObj.getFullYear()
    } else {
        return dateObj.getFullYear() + '-' + (dateObj.getMonth() + 1).toString().padStart(2, "0") + '-' + dateObj.getDate().toString().padStart(2, "0") 
    }
})

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
