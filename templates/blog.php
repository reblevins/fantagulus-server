<html>
<head>
	<title><?php echo $path[1]; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<!-- <link href="https://fantagul.us/css/blog.css" rel="stylesheet"> -->
	<link href="/css/blog.css" rel="stylesheet">
</head>
<body>
<div id="main" ref="main">
	<div id="header" :class="headerClass">
		<a href="#" class="author"><img :src="blogMeta.avatar"></a>
		<h1 id="blog_title">{{ blogMeta.title }}</h1>
		<h2 id="blog_sub_title">{{ blogMeta.sub_title }}</h2>
	</div>
	<template v-if="!currentPost">
	<article v-for="(post, index) in posts" :id="'post_' + post.id" class="mini-post" @click="loadPost(index)" :key="index">
		<header>
			<h3><a href="#">{{ post.title }}</a></h3>
			<time class="published" datetime="2015-10-17">{{ post.published_date }}</time>
		</header>
		<a href="#" class="image"><img :src="post.image"></a>
		<div class="excerpt">
			{{ post.excerpt }}
		</div>
	</article>
	</template>
	<article class="post" v-else>
		<header>
			<div class="title">
				<h2><a href="#">{{ currentPost.title }}</a></h2>
				<p>{{ currentPost.sub_title }}</p>
			</div>
			<div class="meta">
				<time class="published" datetime="2015-11-01">{{ currentPost.published_date }}</time>
			</div>
		</header>
		<span class="image featured"><img :src="currentPost.image" alt=""></span>
		<div v-html="currentPost.full_text"></div>
		<footer>
			<ul class="stats">
				<li><a href="#">General</a></li>
				<li><a href="#" class="icon fa-heart">28</a></li>
				<li><a href="#" class="icon fa-comment">128</a></li>
			</ul>
		</footer>
	</article>
	<section id="footer">
		<ul class="icons">
			<li><a href="#" class="fab fa-twitter"><span class="label">Twitter</span></a></li>
			<li><a href="#" class="fab fa-facebook"><span class="label">Facebook</span></a></li>
			<li><a href="#" class="fab fa-instagram"><span class="label">Instagram</span></a></li>
			<li><a href="#" class="fab fa-rss"><span class="label">RSS</span></a></li>
			<li><a href="#" class="fab fa-envelope"><span class="label">Email</span></a></li>
		</ul>
		<p class="copyright">© Untitled. Design: <a href="http://html5up.net">HTML5 UP</a>. Images: <a href="http://unsplash.com">Unsplash</a>.</p>
	</section>
</div><!-- /#main -->

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
	USERNAME = "<?php echo $path[1]; ?>"
</script>
<script src="/templates/blog.js"></script>
<!-- <script src="https://fantagul.us/templates/blog.js"></script> -->
</body>
</html>