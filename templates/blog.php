<html>
<head>
	<title><?php echo $path[1]; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
	<!-- <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"> -->
	<!-- <link href="https://fantagul.us/css/blog.css" rel="stylesheet"> -->
	<link href="/css/blog.css" rel="stylesheet">
</head>
<body>
<div id="main" ref="main">
	<div id="header" :class="headerClass">
		<div href="#" class="author"><img :src="blog.avatar"></div>
		<h1 id="blog_title">{{ blog.title }}</h1>
		<h2 id="blog_sub_title">{{ blog.subTitle }}</h2>
	</div>
	<template v-if="currentRoute == '/'">
	<article v-for="(post, index) in posts" :id="'post_' + post.post_id" class="mini-post" @click="loadPost(index)" :key="index">
		<header>
			<h3>{{ post.post_title }}</h3>
			<time class="published" :datetime="formatDate(post.date_published)">{{ formatDate(post.date_published, 'human') }}</time>
		</header>
		<img :src="post.post_image">
		<div class="excerpt">
			{{ post.post_excerpt }}
		</div>
	</article>
	</template>
	<article class="post" v-else>
		<header>
			<div class="title">
				<h2>{{ currentPost.post_title }}</h2>
				<p>{{ currentPost.post_sub_title }}</p>
			</div>
			<div class="meta">
				<time class="published" :datetime="formatDate(currentPost.date_published)">{{ formatDate(currentPost.date_published, 'human') }}</time>
			</div>
		</header>
		<span class="image featured"><img :src="currentPost.post_image" alt=""></span>
		<div class="body" v-html="currentPost.post_full_text"></div>
		<!-- <footer>
			<ul class="stats">
				<li><a href="#">General</a></li>
				<li><a href="#" class="far fa-heart">28</a></li>
				<li><a href="#" class="far fa-comment">128</a></li>
			</ul>
		</footer> -->
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

<script src="https://www.gstatic.com/firebasejs/5.3.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.3.0/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.3.0/firebase-database.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyDW5hu9qmou0Qlfez6W08Xm69tB6IsLHFE",
    authDomain: "fantagulus.firebaseapp.com",
    databaseURL: "https://fantagulus.firebaseio.com",
    projectId: "fantagulus",
    storageBucket: "fantagulus.appspot.com",
    messagingSenderId: "68736317493"
  };
  firebase.initializeApp(config);
</script>

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
	BLOGNAME = "<?php echo $path[1]; ?>";
</script>
<script src="/templates/blog.js"></script>
<!-- <script src="https://fantagul.us/templates/blog.js"></script> -->
</body>
</html>