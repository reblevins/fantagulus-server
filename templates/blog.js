// import AuthService from './auth/AuthService'

// const auth = new AuthService()

// const { login, logout, authenticated, authNotifier } = auth

var app = new Vue({
	el: '#main',
	data() {
		return {
			currentRoute: '/',
			blog: {
				avatar: null,
				title: null,
				subTitle: null,
				author: null
			},
			posts: [],
			currentPost: null,
			mainRect: null
		}
	},
	created() {
		this.fetchData()

		console.log(document.location)
		
		let main = document.getElementById("main")
		this.mainRect = main.getBoundingClientRect()

		window.addEventListener('scroll', (e) => {
			main = document.getElementById("main")
			this.mainRect = main.getBoundingClientRect()
		})
		window.addEventListener('popstate', () => {
			this.currentRoute = window.location.pathname
		})
	},
	computed: {
		headerClass() {
			let className = null
			console.log(this.mainRect.width)
			if ((this.mainRect.width < 568 && this.mainRect.top < 34) || (this.mainRect.width > 568 && this.mainRect.width < 700 && this.mainRect.top < 57)) {
				className = "small"
			}
			if (this.mainRect.width > 700 && this.mainRect.width < 797) {
				className = "small"
			}
			return className
		}
	},
	methods: {
		fetchData() {
			fetch('/api/v1/' + BLOGNAME + '/blog').then(response => {
				return response.json()
			}).then(obj => {
				console.log(obj)
				this.blog = obj.blog
				// this.posts = obj.posts
			}).catch(err => {
				console.log(err)
			})
			fetch('/api/v1/' + BLOGNAME + '/posts').then(response => {
				return response.json()
			}).then(obj => {
				console.log(obj)
				this.posts = obj.posts
				// this.posts = obj.posts
			}).catch(err => {
				console.log(err)
			})
		},
		formatDate(date, format) {
			let dateObj = new Date(date)
			if (format == 'human') {
				return DAYS_OF_WEEK[dateObj.getDay()] + ', ' + MONTH_ARRAY[dateObj.getMonth()] + ' ' + dateObj.getDate() + ', ' + dateObj.getFullYear()
			} else {
				return dateObj.getFullYear() + '-' + (dateObj.getMonth() + 1).toString().padStart(2, "0") + '-' + dateObj.getDate().toString().padStart(2, "0") 
			}
		},
		loadPost(index) {
			event.preventDefault()
	        this.currentRoute = this.href
	        window.history.pushState(
				null,
				routes[this.href],
				this.href
	        )
			this.currentPost = this.posts[index]
			console.log(this.currentPost)
		}
	}
})