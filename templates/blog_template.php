<?php
$blog = $postObject['blog'];
$posts = $postObject['posts'];
// $currentPost = (!empty($postObject['current_post'])) ? $postObject['current_post'] : null;
$postTemplate = (!empty($currentPost));
$imageUrl = 'https://res.cloudinary.com/reblevins/image/upload/c_crop,g_custom/';
$imageUrlThumb = 'https://res.cloudinary.com/reblevins/image/upload/c_crop,g_custom/c_scale,w_500/';
?>
<html>
<head>
	<title><?php echo $blog['title']; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<link href="https://fantagul.us/css/blog.css" rel="stylesheet">
	<!-- <link href="/css/blog.css" rel="stylesheet"> -->
</head>
<body>
<div id="main" ref="main">
	<div id="header">
		<?php if (!empty($blog['avatar']['path'])) { ?><div href="#" class="author"><img src="<?php echo $imageUrlThumb . $blog['avatar']['path'] ?>"></div><?php } ?>
		<h1 id="blog_title"><?php echo $blog['title'] ?></h1>
		<h2 id="blog_sub_title"><?php echo $blog['subTitle'] ?></h2>
	</div>
	<?php
	if (!$postTemplate) {
		foreach ($posts as $key => $post) { ?>
		<article>
			<header>
				<h3><?php echo $post['post_title'] ?></h3>
				<time class="published" datetime="<?php echo formatDate($post['date_published']) ?>"><?php echo formatDate($post['date_published'], "l, F d, Y") ?></time>
			</header>
			<?php if (!empty($post['post_image']['path'])) { ?><img src="<?php echo $imageUrlThumb . $post['post_image']['path'] ?>"><?php } ?>
			<div class="excerpt">
				<?php echo $post['post_excerpt'] ?>
			</div>
		</article>
		<?php
		} 
	} else { ?>
	<!-- Posts -->
	<article class="post" v-else>
		<header>
			<div class="title">
				<h2><?php echo $currentPost['post_title'] ?></h2>
				<p><?php echo $currentPost['post_sub_title'] ?></p>
			</div>
			<div class="meta">
				<time class="published" datetime="<?php echo formatDate($currentPost['date_published']) ?>"><?php echo formatDate($currentPost['date_published'], "l, F d, Y") ?></time>
			</div>
		</header>
		<?php if (!empty($currentPost['post_image']['path'])) { ?><span class="image featured"><img src="<?php echo $imageUrl . $currentPost['post_image']['path'] ?>" alt=""></span><?php }?>
		<div class="body"><?php echo $currentPost['post_full_text'] ?></div>
		<!-- <footer>
			<ul class="stats">
				<li><a href="#">General</a></li>
				<li><a href="#" class="far fa-heart">28</a></li>
				<li><a href="#" class="far fa-comment">128</a></li>
			</ul>
		</footer> -->
	</article>
	<?php } ?>

	<section id="footer">
		<ul class="icons">
			<?php if (!empty($blog['twitter'])) { ?><li><a href="<?php echo $blog['twitter'] ?>" class="fab fa-twitter"><span class="label">Twitter</span></a></li><?php } ?>
			<?php if (!empty($blog['facebook'])) { ?><li><a href="<?php echo $blog['facebook'] ?>" class="fab fa-facebook"><span class="label">Facebook</span></a></li><?php } ?>
			<?php if (!empty($blog['instagram'])) { ?><li><a href="<?php echo $blog['instagram'] ?>" class="fab fa-instagram"><span class="label">Instagram</span></a></li><?php } ?>
		</ul>
		<p class="copyright">© <?php echo $blog['title'] ?>.</p>
	</section>
</div><!-- /#main -->

</body>
</html>