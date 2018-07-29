<template>

<div class="edit">
	<div class="grid blog-info" v-if="blog">
		<h2>Blog Info</h2>
		<label><span>Blog Title</span><input class="title" type="text" v-model="blog.title"></label>
		<label><span>Blog Name (The URL slug, eg. last-three.com/blog-name)</span><input class="title" type="text" v-model="blog.name"></label>
		<label><span>Blog Subtitle</span><input type="text" v-model="blog.subTitle"></label>
		<!-- <label><span>Avatar</span><input id="upload-image" type="file"></label> -->
		<label class="upload upload-avatar" @click="uploadImage('avatar')">
			<span>Avatar</span>
			<img :src="imageUrlThumb + blog.avatar.path" v-if="blog.avatar.thumbnail_url">
			<img src="https://dummyimage.com/120x120/aaaaaa/fff.jpg&text=avatar" v-else>
			<span class="hover" v-if="blog.avatar.thumbnail_url">Replace</span>
			<!-- <span v-else>Upload</span> -->
		</label>
		<div class="controls">
			<div class="button" @click="createBlog" v-if="!blog.date_created">Create Blog</div>
			<div class="button" @click="saveBlog" v-else>Save Blog</div>
			<div class="button" @click="publishBlog" v-if="blog.date_created">Publish Blog</div>
			<span class="spinner" :class="{ show: savingBlog }"><i class="fas fa-spinner fa-spin"></i></span>
			<span class="message" v-if="savingBlogMessage">{{ savingBlogMessage }}</span>
		</div>
	</div>
	<div class="grid posts" v-if="blog.date_created">
		<h2>Posts</h2>
		<ul v-if="posts.length > 0">
			<li v-for="(post, index) in posts">
				<img class="post-image" :src="imageUrlThumb + post.post_image.path" v-if="post.post_image.path">
				<img src="https://dummyimage.com/300x150/aaaaaa/fff.jpg&text=No+Post+Image+Selected" v-else>
				<span class="title">{{ post.post_title }}</span>
				<span class="date-published">{{ post.date_published | formateDate("human") }}</span>
				<span class="excerpt">{{ post.post_excerpt }}</span>
				<span class="controls"><span class="button small" @click="editPost(index)">edit</span></span>
			</li>
		</ul>
		<h3 class="no-posts" v-else>No posts yet. When you add some, they'll show up here.</h3>

	</div>
	<div class="grid new-post" v-if="blog.date_created" ref="new_post">
		<h2><template v-if="!newPost.post_id">New</template><template v-else>Edit</template>  Post</h2>
		<label><span>Title</span><input class="title" type="text" v-model="newPost.post_title"></label>
		<label><span>Slug</span><input class="slug" type="text" v-model="newPost.post_slug"></label>
		<label><span>Date Published</span><input type="date" v-model="newPost.date_published"></label>
		<label class="upload upload-image" @click="uploadImage">
			<span>Post Image</span>
			<img :src="imageUrlThumb + newPost.post_image.path" v-if="newPost.post_image.path">
			<img src="https://dummyimage.com/300x150/aaaaaa/fff.jpg&text=+" v-else>
		</label>
		<label><span>Excerpt</span><textarea v-model="newPost.post_excerpt"></textarea></label>
		<label><span>Full Text</span><textarea v-model="newPost.post_full_text"></textarea></label>
		<div class="button" @click="createPost" v-if="!newPost.post_id">Create Post</div>
		<div class="button" @click="savePost" v-else>Save Post</div>
	</div>
</div>

</template>

<script>
export default {
	name: 'Edit',
	data() {
		return {
			database: null,
			imageUrl: 'https://res.cloudinary.com/reblevins/image/upload/c_crop,g_custom/',
			imageUrlThumb: 'http://res.cloudinary.com/reblevins/image/upload/c_crop,g_custom/c_scale,w_500/',
			blog: {
				blog_id: null,
				name: null,
				avatar: {
					secure_url: null,
					thumbnail_url: null
				},
				title: null,
				subTitle: null
			},
			posts: [],
			newPost: {
				post_title: "First Post",
				date_published: this.$moment().format('YYYY-MM-DD'),
				post_image: {
					secure_url: null,
					thumbnail_url: null
				},
				post_slug: null,
				post_excerpt: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eget finibus tortor. Aliquam nunc orci, tempus ut ultrices et, aliquet eget velit.",
				post_full_text: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eget finibus tortor. Aliquam nunc orci, tempus ut ultrices et, aliquet eget velit. Proin feugiat dapibus eros, vitae varius leo varius vel. Nullam facilisis, neque non blandit interdum, mauris massa viverra lectus, vitae lobortis turpis ipsum dictum libero. Nam blandit lacus ac massa aliquam, non finibus ligula sodales. Maecenas in semper ante, non imperdiet purus. Nam eu nibh et mi pharetra semper. Mauris sagittis massa vel ligula molestie facilisis ut eget tortor. Praesent diam justo, malesuada non molestie ac, scelerisque quis lacus. Nullam dictum posuere mi at volutpat. Etiam rutrum eleifend diam, porttitor sodales tellus. Nullam id risus tempor justo molestie facilisis. Etiam in elit sit amet ipsum semper malesuada. Cras tincidunt velit eu auctor ullamcorper. In sit amet nunc rutrum, pretium nisl vitae, lacinia dui. In dapibus vehicula odio quis ornare. Nam luctus mi quis nibh pellentesque ornare. Nunc leo mi, cursus in congue ac, eleifend in erat. Donec sit amet felis sollicitudin, fringilla nibh nec, ultrices nisl. Ut quis vestibulum turpis, eu suscipit turpis. Curabitur ut dui ut sapien maximus placerat. Suspendisse nec lorem eget ligula commodo feugiat. Fusce cursus velit ut rhoncus cursus. Morbi auctor accumsan aliquam. Mauris vulputate fermentum blandit. Suspendisse potenti. Sed pharetra vestibulum neque sed aliquet. Quisque scelerisque tristique venenatis. Nulla malesuada scelerisque viverra. Sed ac consequat nisi, a ullamcorper enim. Sed vestibulum, metus ac tempus lobortis, tellus metus porta elit, at semper est dolor a urna. Nullam pulvinar eleifend leo et sagittis. Nullam suscipit, ante eu egestas ultrices, ex leo vulputate neque, at pulvinar purus velit sagittis odio. Pellentesque nec aliquet purus. Etiam porta velit quam, vel lobortis magna vehicula sit amet. Etiam laoreet egestas ligula, non venenatis quam vehicula at. Cras nec enim blandit, volutpat elit quis, sagittis neque. Nam gravida, nibh sed posuere blandit, erat nisi pretium nisi, eu euismod dui mi eget elit. Nulla semper vestibulum lectus a efficitur. Curabitur elementum eleifend dui."
			},
			message: null,
			savingBlog: false,
			savingBlogMessage: null,
			savingPost: false,
			tabId: null
		}
	},
	created() {
		this.fetchData()
	},
	watch: {
		'blog.title'(newVal) {
			// if (this.blog.name) return

			this.blog.name = this.$string_to_slug(this.blog.title)
		},
		'newPost.post_title'(newVal) {
			// if (this.blog.name) return

			this.newPost.post_slug = this.$string_to_slug(this.newPost.post_title)
		},
		savingBlogMessage(newVal) {
			if (newVal) {
				setTimeout(() => {
					this.savingBlogMessage = null
				}, 2000)
			}
		}
	},
	computed: {
		today() {
			return moment()
		}
	},
	methods: {
		fetchData() {
			this.posts = []
			
			this.$db.blog_meta.get(1).then((blog) => {
				console.log(blog)
				if (!blog) {
					this.blog = {
						blog_id: null,
						avatar: {
							secure_url: null,
							thumbnail_url: null
						},
						title: null,
						subTitle: null
					}
				} else {
					this.blog = blog
				}
			})
			this.getPosts()
		},
		getPosts() {
			this.posts = []
			this.$db.posts.toCollection().each(post => {
				this.posts.push(post)
			})
		},
		uploadImage(image) {
			// "http://res.cloudinary.com/reblevins/image/upload/c_limit,h_60,w_90/v1532402735/banner_bak_rv9hbi.jpg"
			// "https://res.cloudinary.com/reblevins/image/upload/c_crop,g_custom,c_limit,h_120,w_120/v1532402735/banner_bak_rv9hbi.jpg"
			let cropping_aspect_ratio = (image == 'avatar') ? 1 : 2
			// Cloudinary::Uploader.upload("sample.jpg", :crop => "limit", :tags => "samples", :width => 3000, :height => 2000)
			cloudinary.openUploadWidget({
				cloud_name: 'reblevins',
				upload_preset: 'ermutdx3',
				multiple: false,
				cropping: 'server',
				cropping_aspect_ratio: cropping_aspect_ratio,
				cropping_coordinates_mode: 'custom'
			}, 
			(error, result) => {
				console.log(error, result)
				if (image == 'avatar') {
					// this.blog.avatar.secure_url = result[0].secure_url
					// this.blog.avatar.thumbnail_url = result[0].thumbnail_url
					this.blog.avatar = result[0]
				} else {
					// this.newPost.post_image.secure_url = result[0].secure_url
					// this.newPost.post_image.thumbnail_url = result[0].thumbnail_url
					this.newPost.post_image = result[0]
				}
			});
		},
		createBlog() {
			this.savingBlog = true
			this.blog.date_created = this.$moment().format('YYYY-MM-DD')
			this.$db.blog_meta.put(this.blog).then(() => { this.savingBlog = false })
		},
		saveBlog() {
			this.savingBlog = true
			this.$db.transaction('rw', this.$db.blog_meta, () => {
				return this.$db.blog_meta.put(this.blog).then(() => {
					this.savingBlog = false	
				})
			}).then(() => {
				
			}).catch(err => { console.log(err) })
		},
		createPost() {
			this.$db.transaction('rw', this.$db.posts, () => {
				return this.$db.posts.add(this.newPost)
			}).then(() => {
				this.newPost = {
					post_title: "First Post",
					date_published: this.$moment().format('YYYY-MM-DD'),
					post_image: {
						secure_url: null,
						thumbnail_url: null
					},
					post_excerpt: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eget finibus tortor. Aliquam nunc orci, tempus ut ultrices et, aliquet eget velit.",
					post_full_text: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eget finibus tortor. Aliquam nunc orci, tempus ut ultrices et, aliquet eget velit. Proin feugiat dapibus eros, vitae varius leo varius vel. Nullam facilisis, neque non blandit interdum, mauris massa viverra lectus, vitae lobortis turpis ipsum dictum libero. Nam blandit lacus ac massa aliquam, non finibus ligula sodales. Maecenas in semper ante, non imperdiet purus. Nam eu nibh et mi pharetra semper. Mauris sagittis massa vel ligula molestie facilisis ut eget tortor. Praesent diam justo, malesuada non molestie ac, scelerisque quis lacus. Nullam dictum posuere mi at volutpat. Etiam rutrum eleifend diam, porttitor sodales tellus. Nullam id risus tempor justo molestie facilisis. Etiam in elit sit amet ipsum semper malesuada. Cras tincidunt velit eu auctor ullamcorper. In sit amet nunc rutrum, pretium nisl vitae, lacinia dui. In dapibus vehicula odio quis ornare. Nam luctus mi quis nibh pellentesque ornare. Nunc leo mi, cursus in congue ac, eleifend in erat. Donec sit amet felis sollicitudin, fringilla nibh nec, ultrices nisl. Ut quis vestibulum turpis, eu suscipit turpis. Curabitur ut dui ut sapien maximus placerat. Suspendisse nec lorem eget ligula commodo feugiat. Fusce cursus velit ut rhoncus cursus. Morbi auctor accumsan aliquam. Mauris vulputate fermentum blandit. Suspendisse potenti. Sed pharetra vestibulum neque sed aliquet. Quisque scelerisque tristique venenatis. Nulla malesuada scelerisque viverra. Sed ac consequat nisi, a ullamcorper enim. Sed vestibulum, metus ac tempus lobortis, tellus metus porta elit, at semper est dolor a urna. Nullam pulvinar eleifend leo et sagittis. Nullam suscipit, ante eu egestas ultrices, ex leo vulputate neque, at pulvinar purus velit sagittis odio. Pellentesque nec aliquet purus. Etiam porta velit quam, vel lobortis magna vehicula sit amet. Etiam laoreet egestas ligula, non venenatis quam vehicula at. Cras nec enim blandit, volutpat elit quis, sagittis neque. Nam gravida, nibh sed posuere blandit, erat nisi pretium nisi, eu euismod dui mi eget elit. Nulla semper vestibulum lectus a efficitur. Curabitur elementum eleifend dui."
				}
				this.getPosts()
			}).catch(err => { console.log(err) })
		},
		editPost(index) {
			this.newPost = this.posts[index]
			console.log(this.$refs)
			this.$refs.new_post.scrollIntoView()
			// this.$refs.new_post.scrollTop = this.$refs.new_post.scrollHeight
		},
		savePost() {
			this.savingPost = true
			this.$db.transaction('rw', this.$db.posts, () => {
				this.$db.posts.put(this.newPost)
			}).then(() => {
				this.newPost = { 
					post_id: null,
					post_title: null,
					date_published: this.$moment().format('YYYY-MM-DD'),
					post_image: {
						secure_url: null,
						thumbnail_url: null
					},
					post_excerpt: null,
					post_full_text: null
				}
				this.getPosts()
			}).catch(err => { console.log(err) })
		},
		publishBlog() {
			let data = {
				blog: this.blog,
				posts: this.posts
			}
			let headers = {
				method: "POST",
				// credentials: true,
				body: JSON.stringify(data)
			}
			fetch('http://fantagulus.test/api/v1/' + this.blog.name + '/publish', headers).then(response => {
				return response.json()
			}).then(obj => {
				console.log(obj)
			}).catch(err => { console.log(err) })
		}
	}
}
</script>

<style name="scss">

body {
	font-size: 15px;
	font-family: 'Rubik', sans-serif;
}

#app {
    width: 80%;
    margin: 3em auto;
}

h2 {
	margin-top: 0;
}
h3.no-posts {
    font-weight: normal;
    text-align: center;
    color: gray;
}

.button {
    display: grid;
    align-items: center;
    justify-items: center;
    background: lightgray;
    width: 10%;
    padding: 0.5em;
    border-radius: 3px;
    cursor: pointer;
    min-width: 6em;
}
.button.small {
    font-size: 0.7em;
    max-width: 30px;
    padding: 3px;
}

.grid {
	display: grid;
	grid-gap: 1em;
    /*margin-bottom: 2em;*/
    border-bottom: 1px solid;
    padding: 2em 0;
}
.grid label {
    display: grid;
    grid-gap: 0.5em;
}
.grid label span.hover {
    opacity: 0;
    transform: all 0.5s;
    position: absolute;
    bottom: 8px;
    right: 29px;
    font-size: 0.7em;
    background: rgba(255, 255, 255, 0.5);
    border-radius: 2px;
    padding: 1px 2px;
    text-transform: lowercase;
    color: white;
}
.grid label:hover span {
    opacity: 1;
}

.grid.blog-info {
    grid-template-columns: 7fr 1fr;
    grid-template-rows: 0.3fr 1fr 1fr 1fr 0.5fr;
}

.grid.blog-info h2 {
    grid-column: 1 / 2;
    grid-row: 1;
}

.grid.blog-info label {
    grid-column: 1;
}

.grid.blog-info label.upload.upload-avatar {
    grid-column: 2;
    grid-row: 2 / 4;
}
.blog-info .controls {
    grid-row: 5;
    display: grid;
    grid-template-columns: 0.1fr 24px;
    align-items: center;
    grid-gap: 1em;
}
i.fa-spinner {
    /*display: none;*/
    font-size: 1.5em;
}
.spinner { display: none; }
.spinner.show { display: inline-block; }

.posts ul {
    list-style-type: none;
}
.posts li {
    display: grid;
    grid-template-columns: 25% 1fr;
    grid-column-gap: 2em;
    margin-bottom: 2em;
    border-bottom: 1px dotted;
    padding-bottom: 2em;
    grid-row-gap: 0.5em;
    grid-template-rows: 0.2fr 0.2fr 0.6fr;
}
.posts li img {
    width: 100%;
    grid-row: span 4;
}
.posts li span.title, .posts li span.date-published, .posts li span.excerpt {
    grid-column: 2;
}
.posts li span.title {
    grid-row: 1;
    font-size: 1.3em;
    font-weight: bold;
}
.posts li span.date-published {
    grid-row: 2;
    color: #999;
    font-style: italic;
}
.posts li span.excerpt {
    grid-row: 3;
}
.posts li span.controls {
    grid-column: 2;
}

input, textarea {
    font-size: 1.4em;
    padding: 1rem 1rem 0.2rem 0.3rem;
    border: dotted black;
    border-width: 0 0 1px 0;
    outline: none;
    background: rgb(244, 244, 244);
}
.title {
	width: 50%;
}
input[type="date"] {
    width: 17%;
    border: none;
    min-width: 9.4em;
    background: rgb(244, 244, 244);
}

.upload {
    position: relative;
    cursor: pointer;
}
.upload-avatar img {
    max-width: 120px;
    height: auto;
}
.upload-image img, .post-image img {
    max-width: 300px;
    height: auto;
}

</style>