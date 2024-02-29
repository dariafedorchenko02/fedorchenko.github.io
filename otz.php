<?php
session_start();
include 'temp/db.php';
include 'temp/head.php';
include 'temp/nav.php';
?>
        
        <!--================End Main Header Area =================-->
		<section class="banner_area">
        	<div class="container">
        		<div class="banner_text">
        			<h3>Отзывы</h3>
        			<ul>
        				<li><a href="#">Главная</a></li>
        				<li><a href="#">Отзывы</a></li>
        			</ul>
        		</div>
        	</div>
        </section>
        <!--================End Main Header Area =================-->
		<br>
		<h3><center>Спасибо за Ваши отзывы!
Мы становимся лучше только благодаря Вам!</h3>
		<h4><center>Если хотите оставить отзыв, авторизуйтесь!</h4><br>
		<div class="form-row justify-content-center">
			
						<a href="registr.php"><button type="submit" class="btn btn-outline-info px-5">Оставить отзыв</button></a>
                        </div>
						<br><hr>
        <!--================Testimonials item Area =================-->
        <section class="testimonials_item_area p_100">
        	<div class="container">
        		<div class="testi_item_inner">
						<?php
						$sql="select id_com, name_u, name_com, img from comment, users where users.id_users=comment.id_users";
						$result=$connection->query($sql);
						foreach($result as $row){
							echo '
							<div class="media">
							<div class="d-flex">
							<img src="'.$row['img'].'" alt="">
							<h3>“</h3>
						</div>
						<div class="media-body">
							<p>'.$row['name_com'].'</p>
							<h5>'.$row['name_u'].'</h5>
						</div></div>';
						}
						?>
					
        		</div>
        	</div>
        </section>
        <!--================End Testimonials item Area =================-->
        <?php
include 'temp/footer.php';
?>