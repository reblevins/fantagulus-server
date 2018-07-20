var app = new Vue({
	el: '#main',
	data: {
		blogMeta: {
			avatar: null,
			title: null,
			subTitle: null
		},
		posts: [],
		currentPost: null,
		mainRect: null
	},
	created() {
		this.fetchData()
		
		let main = document.getElementById("main")
		this.mainRect = main.getBoundingClientRect()

		window.addEventListener('scroll', (e) => {
			main = document.getElementById("main")
			this.mainRect = main.getBoundingClientRect()
		})
	},
	computed: {
		headerClass() {
			let className = null
			if ((this.mainRect.width < 568 && this.mainRect.top < 34) || (this.mainRect.width > 568 && this.mainRect.top < 57)) {
				className = "small"
			}
			return className
		}
	},
	methods: {
		fetchData() {
			fetch('/blog_data/' + USERNAME + '/index.json').then(response => {
				return response.json()
			}).then(obj => {
				console.log(obj)
				this.blogMeta = obj.blogMeta
				this.posts = obj.posts
			}).catch(err => {
				console.log(err)
			})
		},
		loadPost(index) {
			this.currentPost = this.posts[index]
			console.log(this.currentPost)
		}
	}
})