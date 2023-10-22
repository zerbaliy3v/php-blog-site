<?php include('include/db.php'); ?>
<aside id="aside" class="col-md-4">

	<div class="widget">
		<div class="widget-search">
			<input class="search-input form-control" type="text" placeholder="Search" name="search">
			<button class="search-btn" type="button"><i class="fas fa-search"></i></button>
		</div>
	</div>
	<!-- /Search -->

	<div class="widget">
		<h3 class="mb-3">Categories</h3>
		<div class="widget-category">

			<?php
			#sql query
			$sql = 'SELECT * FROM categories'; #sql query
			$result = mysqli_query($conn, $sql); #get result
			if (mysqli_num_rows($result) > 0) {
				#assoc setir setir baxir
			
				while ($row = mysqli_fetch_assoc($result)) {
					$name = htmlentities($row['category_name']);
					$sql1 = "SELECT * FROM posts WHERE post_category='$name'";
					$result1 = mysqli_query($conn, $sql1);
					$cout = mysqli_num_rows($result1);
					echo "<a href='category.php?cat={$name}'>{$name}<span>({$cout})</span></a>";
				}

			} else {
				echo " 0 categories";
			}
			?>


		</div>
	</div>
	<!-- /Category -->

	<!-- Posts sidebar -->
	<div class="widget">
		<h3 class="mb-3">Latest Posts</h3>



		<!-- single post -->
		<?php
		#sql query
		$sql = 'SELECT * FROM posts ORDER BY post_id DESC'; #sql query
		$result = mysqli_query($conn, $sql); #get result
		if (mysqli_num_rows($result) > 0) {
			#assoc setir setir baxir
			$c = 0;
			while ($row = mysqli_fetch_assoc($result)) {
				$post_t = htmlentities($row['post_title']);
				$post_d = htmlentities($row['post_date']);
				$post_i = htmlentities($row['post_image']);
				$post_ii = htmlentities($row['post_id']);

				echo "
						<div class='widget-post'>
							<a href='blog-single.php?id=$post_ii'>
								<img class='img-fluid' src='./img/$post_i' alt=''>$post_t
							</a>
							<ul class='blog-meta'>
								<li>$post_d</li>
							</ul>
						</div>";
				$c++;
				if ($c == 4) {
					break;
				}
			}

		} else {
			echo " 0 categories";
		}
		?>
		<!-- /single post -->



	</div>
	<!-- /Posts sidebar -->
	<?php mysqli_close($conn); ?>
</aside>