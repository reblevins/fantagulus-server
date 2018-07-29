import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/Home'
import Edit from '@/components/Edit'
import Post from '@/components/Post'

Vue.use(Router)

export default new Router({
	routes: [
		{
			path: '/edit',
			name: 'Edit',
			component: Edit
		},
		// {
		// 	path: '',
			// children: [
			// 	{
			// 		path: '/:blogName',
			// 		name: 'Home',
			// 		component: Home,
			// 		props: true
			// 	},
			// 	{
			// 		path: ':id',
			// 		name: 'Post',
			// 		component: Post,
			// 		props: true
			// 	}
			// ]
		// }
	]
})
