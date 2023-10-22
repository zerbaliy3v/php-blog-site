<?php include('include/head.php') ?>


<body>

	<!-- Navigation -->
	<?php include('include/navbar.php') ?>

<!--==========================
    INSIDE HERO SECTION Section
============================-->	
<section class="page-image page-image-portfolio md-padding">
    <h1 class="text-white text-center">PORTFOLIO</h1>
</section>
    
<!--==========================
    PORTFOLIO Section
============================-->
<section id="portfolio" class="md-padding">
    <div class="container">

			<div class="row text-center">
				<div class="col-md-4 offset-md-4">
					<div class="section-header">
						<h2 class="title">Our Works</h2>
					</div>
				</div>
			</div>
        <div class="row">
    <?php
    $sql = 'SELECT * FROM portfolio';
    $result=mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $portfolio_category = $row['portfolio_category']; //!xss
            $portfolio_name = $row['portfolio_name'];
            $portfolio_img_bg = $row['portfolio_img_bg'];
            $portfolio_img_sm = $row['portfolio_img_sm'];
            ?>
            <div class="col-md-4 col-sm-6 portfolio-item">
                <a href="img/<?= $portfolio_img_bg ?>" class="portfolio-link" data-lightbox="web-design" data-title="<?= $portfolio_name ?>" >
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fas fa-search fa-3x"></i>
                        </div>
                    </div>
                    <img class="img-fluid" src="img/<?= $portfolio_img_sm ?>" alt="">
                </a>
                <div class="portfolio-caption">
                    <h4><?= $portfolio_name ?></h4>
                    <p class="text-muted"><?= $portfolio_category ?></p>
                </div>
            </div>
            <?php
               }
            }else {
                echo'No Result!';
            }
            ?>
        </div>
    </div>
</section>
<?php include('include/footer.php') ?>
