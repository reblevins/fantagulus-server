var app = new Vue({
	el: '#main',
	data: {
		blogMeta: {
			avatar: null,
			title: null,
			subTitle: null
		},
		posts: []
	},
	created() {
		this.fetchData()
	},
	methods: {
		fetchData() {
			fetch('/blogs/reblevins/index.json').then(response => {
				return response.json()
			}).then(obj => {
				console.log(obj)
				this.blogMeta = obj.blogMeta
				this.posts = obj.posts
			}).catch(err => {
				console.log(err)
			})
		}
	}
})