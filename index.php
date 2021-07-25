<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_GET['action']) && $_GET['action']=="add"){
	$id=intval($_GET['id']);
	if(isset($_SESSION['cart'][$id])){
		$_SESSION['cart'][$id]['quantity']++;
	}else{
		$sql_p="SELECT * FROM products WHERE id={$id}";
		$query_p=mysqli_query($con,$sql_p);
		if(mysqli_num_rows($query_p)!=0){
			$row_p=mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['productPrice']);
		
		}else{
			$message="Product ID is invalid";
		}
	}
		echo "<script>alert('Product has been added to the cart')</script>";
		echo "<script type='text/javascript'> document.location ='my-cart.php'; </script>";
}


?>
<!DOCTYPE html>
<html lang="en">
	<head>
		
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

	    <title>CYBORG</title>
	    <link rel="shortcut icon" type="image/png" href="img/logo2.png">

	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    <link rel="stylesheet" type="text/css" href="assets/css/style1.css">
	    <link rel="stylesheet" href="assets/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/css/owl.transitions.css">
		<link rel="stylesheet" href="assets/css/owl.theme.css">
		<link href="assets/css/lightbox.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/animate.min.css">
		<link rel="stylesheet" href="assets/css/rateit.css">
		<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
	

               
	</head>
    <body class="cnt-home">
	
        <header class="header-style-1">
            <?php include('includes/top-header.php');?>
            <?php include('includes/main-header.php');?>
            <?php include('includes/menu-bar.php');?>
        </header>


        <div class="body-content" id="top-banner-and-menu">
	        <div class="container">
		        <div class="f-container homepage-container">
		            <div class="row bg">
			            <div class="col-sm-12 col-md-3 sidebar">
	                        <?php include('includes/side-menu.php');?>
			            </div>
			            <div class="col-sm-12 col-md-9 homebanner-holder">
			            	<h1>WELCOME TO <span class="headlight">CYBORG</span>!</h1>
			            </div>
			        </div>
			        <div class="row">
			        	<div id="product-tabs-slider" class="scroll-tabs inner-bottom-vs  wow fadeInUp">
			                <div class="more-info-tab clearfix">
			                    <h3 class="new-product-title pull-left headlight">Featured Products</h3>
				                <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
					                <li class="active"><a href="#all" data-toggle="tab">All</a></li>
					                <li><a href="#joysticks" data-toggle="tab">Joysticks</a></li>
					                <li><a href="#accesories" data-toggle="tab">Accesories</a></li>
				                </ul>
			                </div>
			                <div class="tab-content outer-top-xs">
				                <div class="tab-pane in active" id="all">			
					                <div class="product-slider">
						                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                                            <?php
                                            $ret=mysqli_query($con,"select * from products");
                                            while ($row=mysqli_fetch_array($ret)) {
                                            ?>
                                            <div class="item item-carousel">
                                            	<div class="products">
                                            		<div class="product">
                                            			<div class="product-image">
                                            				<div class="image">
                                            					<a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><img  src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="180" height="300" alt=""></a>
                                            				</div>
                                            			</div>
                                            			<div class="product-info text-left">
                                            				<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
			                                                <div class="rating rateit-small"></div>
			                                                <div class="description"></div>
			                                                <div class="product-price">	
				                                                <span class="price">Tk.<?php echo htmlentities($row['productPrice']);?></span>
										                        <span class="price-before-discount">Tk.<?php echo htmlentities($row['productPriceBeforeDiscount']);?>	</span>
										                    </div>
										                </div>
		                                                <?php if($row['productAvailability']=='In Stock'){?>
					                                    <div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">Add to Cart</a></div>
				                                        <?php } else {?>
						                                <div class="action" style="color:red">Out of Stock</div>
					                                    <?php } ?>
			                                        </div>
			                                    </div>
			                                </div>
	                                        <?php } ?>
			                            </div>
					                </div>
				                </div>
				                <div class="tab-pane" id="joysticks">
					                <div class="product-slider">
						                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
		                                    <?php
                                            $ret=mysqli_query($con,"select * from products where category=3");
                                            while ($row=mysqli_fetch_array($ret)){
                                            ?>
                                            <div class="item item-carousel">
			                                    <div class="products">
			                                    	<div class="product">		
		                                                <div class="product-image">
			                                                <div class="image">
				                                                <a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><img  src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="180" height="300" alt=""></a>
				                                            </div>
				                                        </div>
		                                                <div class="product-info text-left">
			                                                <h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
			                                                <div class="rating rateit-small"></div>
			                                                <div class="description"></div>
			                                                <div class="product-price">	
				                                                <span class="price">Tk. <?php echo htmlentities($row['productPrice']);?></span>
										                        <span class="price-before-discount">Tk.<?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>
										                    </div>
										                </div>
				                                        <?php if($row['productAvailability']=='In Stock'){?>
					                                    <div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">Add to Cart</a></div>
				                                        <?php } else {?>
						                                <div class="action" style="color:red">Out of Stock</div>
						                                <?php } ?>
			                                        </div>
			                                    </div>
			                                </div>
	                                        <?php } ?>
								        </div>
					                </div>
				                </div>
				                <div class="tab-pane" id="accesories">
					                <div class="product-slider">
						                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
		                                    <?php
                                            $ret=mysqli_query($con,"select * from products where category=5");
                                            while ($row=mysqli_fetch_array($ret)){
                                            ?>
                                            <div class="item item-carousel">
                                            	<div class="products">
	                                                <div class="product">
		                                                <div class="product-image">
			                                                <div class="image">
				                                                <a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><img  src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="180" height="300" alt=""></a>
				                                            </div>
				                                        </div>
				                                        <div class="product-info text-left">
			                                                <h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
			                                                <div class="rating rateit-small"></div>
			                                                <div class="description"></div>
			                                                <div class="product-price">
				                                                <span class="price">Tk.<?php echo htmlentities($row['productPrice']);?></span>
										                        <span class="price-before-discount">Tk.<?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>
										                    </div>
										                </div>
				                                        <?php if($row['productAvailability']=='In Stock'){?>
					                                    <div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">Add to Cart</a></div>
				                                        <?php } else {?>
						                                <div class="action" style="color:red">Out of Stock</div>
					                                    <?php } ?>
			                                        </div>
			                                    </div>
			                                </div>
	                                        <?php } ?>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="sections prod-slider-small outer-top-small">
				            <div class="row">
					            <div class="col-md-6">
	                                <section class="section">
	                   	                <h3 class="new-product-title section-title headlight">PS5 Games</h3>
	                   	                <div class="owl-carousel homepage-owl-carousel custom-carousel outer-top-xs owl-theme" data-item="2">
	                   	                	<?php
                                            $ret=mysqli_query($con,"select * from products where category=4 and subCategory=4");
                                            while ($row=mysqli_fetch_array($ret)) {
                                            ?>
                                            <div class="item item-carousel">
			                                    <div class="products">
			                                    	<div class="product">		
		                                                <div class="product-image">
			                                                <div class="image">
				                                                <a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><img  src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="180" height="300"></a>
				                                            </div>
				                                        </div>
		                                                <div class="product-info text-left">
			                                                <h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
			                                                <div class="rating rateit-small"></div>
			                                                <div class="description"></div>
			                                                <div class="product-price">	
				                                                <span class="price">Tk. <?php echo htmlentities($row['productPrice']);?></span>
										                        <span class="price-before-discount">Tk.<?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>					
			                                                </div>
		                                                </div>
				                                        <?php if($row['productAvailability']=='In Stock'){?>
					                                    <div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">Add to Cart</a></div>
				                                        <?php } else {?>
						                                <div class="action" style="color:red">Out of Stock</div>
					                                    <?php } ?>
					                                </div>
					                            </div>
					                        </div>
                                            <?php }?>
                                        </div>
	                                </section>
					            </div>
					            <div class="col-md-6">
						            <section class="section">
							            <h3 class="section-title headlight">PS4 Games</h3>
		                   	            <div class="owl-carousel homepage-owl-carousel custom-carousel outer-top-xs owl-theme" data-item="2">
	                                        <?php
                                            $ret=mysqli_query($con,"select * from products where category=4 and subCategory=3");
                                            while ($row=mysqli_fetch_array($ret)) {
                                            ?>
                                            <div class="item item-carousel">
                                            	<div class="products">
                                            		<div class="product">		
		                                                <div class="product-image">
			                                                <div class="image">
				                                                <a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><img  src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="300" height="300"></a>
			                                                </div>
			                                            </div>
			                                            <div class="product-info text-left">
			                                                <h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
			                                                <div class="rating rateit-small"></div>
			                                                <div class="description"></div>
			                                                <div class="product-price">	
			                                                	<span class="price">Tk.<?php echo htmlentities($row['productPrice']);?></span>
										                        <span class="price-before-discount">Tk.<?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>
										                    </div>
										                </div>
				                                        <?php if($row['productAvailability']=='In Stock'){?>
					                                    <div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">Add to Cart</a></div>
				                                        <?php } else {?>
						                                <div class="action" style="color:red">Out of Stock</div>
					                                    <?php } ?>
			                                        </div>
			                                    </div>
		                                    </div>
                                            <?php }?>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                        <section class="section featured-product inner-xs wow fadeInUp">
		                    <h3 class="section-title headlight">Posters</h3>
		                    <div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">
			                    <?php
                                $ret=mysqli_query($con,"select * from products where category=6");
                                while ($row=mysqli_fetch_array($ret)) {
                                ?>
				                <div class="item">
					                <div class="products">
										<div class="product">
							                <div class="product-micro">
								                <div class="row product-micro-row">
									                <div class="col col-xs-6">
										                <div class="product-image">
											                <div class="image">
												                <a href="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-lightbox="image-1" data-title="<?php echo htmlentities($row['productName']);?>">
													                <img data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" width="170" height="174" alt="">
													                <div class="zoom-overlay"></div>
												                </a>					
											                </div>
											            </div>
											        </div>
									                <div class="col col-xs-6">
										                <div class="product-info">
											                <h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
											                <div class="rating rateit-small"></div>
											                <div class="product-price">	
												                <span class="price">Tk. <?php echo htmlentities($row['productPrice']);?></span>
												            </div>
										                    <?php if($row['productAvailability']=='In Stock'){?>
					                                        <div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">Add to Cart</a></div>
				                                            <?php } else {?>
						                                    <div class="action" style="color:red">Out of Stock</div>
					                                        <?php } ?>
										                </div>
									                </div>
								                </div>
							                </div>
						                </div>
						            </div>
				                </div><?php } ?>
							</div>
						</section>
					</div>
				</div>
			</div>
			<div class="hr"></div>
			<?php include('includes/footer.php');?>
	
	<script src="assets/js/jquery-1.11.1.min.js"></script>
	
	<script src="assets/js/bootstrap.min.js"></script>
	
	<script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
	<script src="assets/js/owl.carousel.min.js"></script>
	
	<script src="assets/js/echo.min.js"></script>
	<script src="assets/js/jquery.easing-1.3.min.js"></script>
	<script src="assets/js/bootstrap-slider.min.js"></script>
    <script src="assets/js/jquery.rateit.min.js"></script>
    <script type="text/javascript" src="assets/js/lightbox.min.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
	<script src="assets/js/scripts.js"></script>
	
</body>
</html>