<?php include('include/head.php') ?>


<body>

	<!-- Navigation -->
	<?php include('include/navbar.php') ?>

	<!--==========================
	INSIDE HERO SECTION Section
============================-->
	<section class="page-image page-image-contact md-padding">
		<h1 class="text-white text-center">BLOG</h1>
	</section>

	<!--==========================
	Contact Section
============================-->

<?php

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "SELECT * FROM posts WHERE post_id = '$id'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result)) {
			$post_id = $row['post_id'];
			$post_image = $row['post_image'];
			$post_title = $row['post_title'];
			$post_text =htmlentities($row['post_text']);
			$post_author = $row['post_author'];
			$post_date = substr($row['post_date'], 0, 10);
		?>
		
<?php
$sql_comment_show = "SELECT * FROM comments WHERE comment_post_id = '$post_id' AND comment_status = 'yes' order by comment_id DESC";
$result_comment_show = mysqli_query($conn, $sql_comment_show);

if(!$result_comment_show){
	die("Query Failed");
}
if (mysqli_num_rows($result_comment_show) > 0) {
	$post_comment_number = mysqli_num_rows($result_comment_show);}
else {
	$post_comment_number=0;
}
?>
	<section id="blog" class="md-padding">
		<div class="container">
			<div class="row">
				<main id="main" class="col-md-8">
					<div class="blog">
						<div class="blog-img">
							<img class="img-fluid" src="./img/<?= $post_image ?>" alt="">
						</div>
						<div class="blog-content">
							<ul class="blog-meta">
								<li><i class="fas fa-user"></i><?= $post_author ?></li>
								<li><i class="fas fa-clock"></i><?= $post_date ?></li>
								<li><i class="fas fa-comments"></i><?= $post_comment_number ?></li>
							</ul>
							<h3  class="text-center display-4 p-3 mb-2 bg-dark text-white"><?= $post_title ?></h3>
							<hr>
							<p class="p-3 mb-2 bg-secondary text-white" style="font-size: 17px;">
							<?= $post_text ?>
							</p>
							<hr>

						</div>
				<?php
				}
				}
				}?>

						<!-- blog comments -->
						<div class="blog-comments">
							<?php
							
							if (mysqli_num_rows($result_comment_show) > 0) {
								while ($row = mysqli_fetch_assoc($result_comment_show)) {
									$comment_author_show = $row['comment_author'];
									$comment_text_show = $row['comment_text'];
									$comment_date_show = $row['comment_date'];
								

							?>

							<!-- comment -->
							<div class="media">
								<div class="media-body">
									<h4 class="media-heading"><?=$comment_author_show ?><span class="time"><?=$comment_date_show ?></span></h4>
									<p><?=$comment_text_show ?></p>
								</div>
							</div>
							<!-- /comment -->
							
							
							<?php	}
							} else {
							echo "<h3>There is no comment</h3>";}
							?>

						</div>
						<!-- /blog comments -->

						<!-- reply form -->
						<?php 
							if (isset($_POST['submit'])) {
								$comment_author = $_POST['comment_author'];
								$comment_email = $_POST['comment_email'];
								$comment_text = htmlentities($_POST['comment_text']);
								$comment_post_id = $post_id;
								$comment_status = 'no';
								$comment_date = (string) date('d-m-y');
								$sql_comment = "INSERT INTO comments (comment_author, comment_email, comment_text, comment_post_id, comment_status, comment_date) VALUES ('$comment_author', '$comment_email', '$comment_text', '$comment_post_id', '$comment_status', '$comment_date')";
								$result_comment = mysqli_query($conn, $sql_comment);
								if (!$result_comment) {
									die("Query Failed");
								}
								if ($result_comment) {
								header("Location: blog-single.php?id=$post_id");
								exit;
								}
							
								
							}

						?>
						<div class="reply-form">
							<h3>Leave A Comment</h3>
							<form method="post">
								<input class="form-control mb-4" type="text" placeholder="Name" name="comment_author">
								<input class="form-control mb-4" type="email" placeholder="Email" name="comment_email">
								<textarea class="form-control mb-4" row="5" placeholder="Add Your Commment" name="comment_text"></textarea>

								<button type="submit" class="main-btn" name="submit">Submit</button>
							</form>
						</div>
						<!-- /reply form -->
					</div>
				</main>
				<!-- /Main -->
				<?php mysqli_close($conn) ?>

				<?php include('include/slideblog.php') ?>




			</div>

		</div>
	</section>
	<?php include('include/footer.php') ?>