<template>
<div class="inner">
	<article v-for="(post, index) in posts" :id="'post_' + post.post_id" class="mini-post" @click="loadPost(index)" :key="index">
		<header>
			<h3>{{ post.post_title }}</h3>
			<time class="published" :datetime="post.date_published | formatDate">{{ post.date_published | formatDate('human') }}</time>
		</header>
		<img :src="post.post_image">
		<div class="excerpt">
			{{ post.post_excerpt }}
		</div>
	</article>
</div>
</template>

<script>
export default {
	name: 'Home',
	props: ['blogName'],
	data () {
		return {
			posts: []
		}
	},
	created() {
		this.fetchData()
		console.log(this.$apiUrl, this.$blogName)
	},
	methods: {
		fetchData() {
			console.log(this.blogName)
			fetch(this.$apiUrl + '/api/v1/' + this.blogName + '/posts').then(response => {
				return response.json()
			}).then(obj => {
				console.log(obj)
				this.posts = obj.posts
				// this.posts = obj.posts
			}).catch(err => {
				console.log(err)
			})
		}
	}
}
</script>

<style scoped>
</style>
