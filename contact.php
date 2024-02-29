<?php
include 'temp/head.php';
include 'temp/nav.php';
?>

        
        <!--================End Main Header Area =================-->
        <section class="banner_area">
        	<div class="container">
        		<div class="banner_text">
        			<h3>Контакты</h3>
        			<ul>
        				<li><a href="index.php">Главная</a></li>
        				<li><a href="single-blog.php">Контакты</a></li>
        			</ul>
        		</div>
        	</div>
        </section>
        <!--================End Main Header Area =================-->
        
        <!--================Contact Form Area =================-->
        <section class="contact_form_area p_100">
        	<div class="container">
        		<div class="main_title">
					<h2>Обратная связь</h2>
				</div>
       			<div class="row">
       				<div class="col-lg-7">
       					<form class="row contact_us_form" action="http://galaxyanalytics.net/demos/cake/theme/cake-html/contact_process.php" method="post" id="contactForm" novalidate="novalidate">
							<div class="form-group col-md-6">
								<input type="text" class="form-control" id="name" name="name" placeholder="Ваше имя">
							</div>
							<div class="form-group col-md-6">
								<input type="email" class="form-control" id="email" name="email" placeholder="Эл. почта">
							</div>
							<div class="form-group col-md-12">
								<textarea class="form-control" name="message" id="message" rows="1" placeholder="Ваш вопрос"></textarea>
							</div>
							<div class="form-group col-md-12">
								<button type="submit" value="submit" class="btn order_s_btn form-control">Отправить</button>
							</div>
						</form>
       				</div>
       				<div class="col-lg-4 offset-md-1">
       					<div class="contact_details">
       						<div class="contact_d_item">
       							<h3>Адрес</h3>
       							<p>г. Новочеркасск <br /> пр-т Платовский 116</p>
       						</div>
       						<div class="contact_d_item">
       							<h5>Телефон:<a href="Телефон: +70184285306"> +70184285306</a></h5>
       							<h5>Email : <a href="Email: piecehappines2023@gmail.com"> piecehappines2023@gmail.com</a></h5>
       						</div>
       						<div class="contact_d_item">
       							<h3>Часы работы:</h3>
       							<p>Пн-Сб: 9:00-20:00</p>
       							<p>Вс: 10:00-21:00</p>
       						</div>
       					</div>
       				</div>
       			</div>
        	</div>
        </section>
        <!--================End Contact Form Area =================-->
        
		<?php
include 'temp/footer.php';
?>