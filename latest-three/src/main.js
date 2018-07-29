// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import db from './database'

import './Functions'

Vue.config.productionTip = false

Vue.prototype.$db = db
Vue.prototype.$moment = require("moment")
Vue.prototype.$apiUrl = document.location.hostname
Vue.prototype.$apiUrl = () => {
	let host = document.location.hostname
	let path = document.location.pathname
	path = path.split('/')
	return host + '/api/v1/'
}
Vue.prototype.$md5 = require('md5')

Vue.filter('formateDate', (value, format) => {
  let moment = require("moment")
	if (!value) return

	let dateObj = moment(value)
  if (format == 'human') {
      return dateObj.format('dddd, MMMM Do YYYY')
  } else {
      return dateObj.format('YYYY-MM-DD')
  }
})

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
