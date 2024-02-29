<?php
include 'temp/db.php';
include 'temp/head.php';
include 'temp/nav.php';

?>

        <!--================End Main Header Area =================-->
        <section class="banner_area">
        	<div class="container">
        		<div class="banner_text">
        			<h3>Прайс-лист</h3>
        			<ul>
        				<li><a href="index.php">Главная</a></li>
        				<li><a href="cakes.php">Прайс-лист</a></li>
        			</ul>
        		</div>
        	</div>
        </section>
        <!--================End Main Header Area =================-->
<section class="our_cakes_area p_100">
    <div class="container">
	<div class="main_title">
        			<h2>Каталог</h2>
        		</div>
		<div class="row">
			<div class="col-md-2">
                <form action="" method="POST">
                    <div class="card shadow mt-3">
                        <div class="card-header">
                            <h5>
                                <button type="submit" class="btn btn-secondary btn-sm float-end">Выбрать</button>
                            </h5>
                        </div>
                        <div class="card-body">
                            <hr>
                            <?php
                             
                                $type_query = "SELECT * FROM type_product";
                                $type_query_run  = mysqli_query($connection, $type_query);

                                if(mysqli_num_rows($type_query_run) > 0)
                                {
                                    foreach($type_query_run as $type)
                                    {
                                        $checked = [];
                                        if(isset($_POST['type_products']))
                                        {
                                            $checked = $_POST['type_products'];
                                        }
                                        ?>
                                            <div>
                                                <input type="checkbox" name="type_products[]" value="<?= $type['id_type']; ?>" 
                                                    <?php if(in_array($type['id_type'], $checked)){ echo "checked"; } ?>
                                                 />
                                                <?= $type['name_type']; ?>
                                            </div>
                                        <?php
                                    }
                                }
                                else
                                {
                                    echo "Никаких брендов не найдено";
                                }
                            ?>
                        </div>
                    </div>
                </form>
			</div>
			<div class="col-md-10">
			<div class="cake_feature_row row">
				<?php
				 if(isset($_POST['type_products']))
				 {
					 $sql = [];
					 $sql = $_POST['type_products'];
					 foreach($sql as $row)
                                {
					$product="select id_product, name_product, img, price, id_type, describes from product where product.id_type in ($row)";
					$result=$connection->query($product);
					if(mysqli_num_rows($result) > 0)
					{
					foreach($result as $row){
						echo' <div class="col-lg-3 col-md-4 col-6">
						<div class="cake_feature_item">
							<div class="cake_img">
								<img src="'.$row['img'].'" alt="">
							</div>
							<div class="cake_text">
							<h4>'.$row['price'].'</h4>
							<h3>'.$row['name_product'].'</h3>
							</div>
						</div>
					</div>';
					}
				}
			}
				
				}
				else
				{

					$products = "select id_product, name_product, img, price, describes from product";
					$result = mysqli_query($connection, $products);
					if(mysqli_num_rows($result) > 0)
					{
						foreach($result as $row) 
							{
								echo '<div class="col-lg-4 col-md-3 col-6">
						<div class="cake_feature_item">
							<div class="cake_img">

								<img src="'.$row['img'].'" alt="">
							</div>
							<div class="cake_text">
							<h4 class="font-weight-bold">'.$row['price'].'p.</h4>
							<h3 class="font-weight-bold">'.$row['name_product'].'</h3>
							<p>'.$row['describes'].'</p>
							</div>
						</div>
					</div>';
							}
							
					}
					else
					{
						echo "Ничего не найдено";
					}
				}
				?>
				</div>
			</div>
		</div>
    </div>
</section>
        

 <!-- Central Modal Medium Info -->
 <div class="modal fade" id="centralModalInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-notify modal-info" role="document">
     <!--Content--><?php
  echo '<br><input type="hidden" id="id_product" name="id_product">'; 
//НЕВИДИМОЕ ОКНО ВВОДА, ЧТОБЫ ПЕРЕДАТЬ ID В $_POST
?>
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         <?php echo '<p class="heading lead">'.$row['name_product'].'</p>'?>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>

       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
		 <i class="fa fa-birthday-cake text-primary m-3 fa-6x" aria-hidden="true"></i>
		 <?php echo '<p class="heading lead">'.$row['describes'].'</p>'?>
         </div>

       </div>

       <!--Footer-->
       <div class="modal-footer justify-content-center">
         <a type="submit" class="btn btn-outline-primary waves-effect" name="view" data-dismiss="modal">Спасибо</a>
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 <!-- Central Modal Medium Info-->

			  <script>
$(document).ready(function(){
  $('#exampleModal').on('show.bs.modal', function (event) {
// кнопка, которая вызывает модаль

 var button = $(event.relatedTarget) 
// получим  data-id атрибут
var id_product = button.data('id_product');
var name_product = button.data('name_product');
var describes = button.data('describes');
// Здесь изменяем содержимое модали
var modal = $(this);
 modal.find('.modal-title').text('Описание');
 modal.find('.modal-body #id_product').val(id_product);
 modal.find('.modal-body #name_product').val(name_product);
 modal.find('.modal-body #describes').val(describes);
})
});
</script>

		<?php
include 'temp/footer.php';
?>