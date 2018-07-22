<template>
<div class="inner">
	<article class="post">
		<header>
			<div class="title">
				<h2>{{ post.post_title }}</h2>
				<p>{{ post.post_sub_title }}</p>
			</div>
			<div class="meta">
				<time class="published" :datetime="formatDate(post.date_published)">{{ formatDate(post.date_published, 'human') }}</time>
			</div>
		</header>
		<span class="image featured"><img :src="post.post_image" alt=""></span>
		<div class="body" v-html="post.post_full_text"></div>
  	</article>
</div>
</template>

<script>
export default {
	name: 'Post',
	props: ['id'],
	data () {
		return {
			post: null
		}
	},
	created() {
		this.fetchData()
	},
	methods: {
		fetchData() {
			if (!this.id)
			fetch(this.$apiUrl + '/api/v1/' + this.$blogName + '/posts').then(response => {
				return response.json()
			}).then(obj => {
				console.log(obj)
				this.post = obj.post
			}).catch(err => {
				console.log(err)
			})
		}
	}
}
</script>

<style scoped>
</style>
