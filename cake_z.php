<?php
session_start();
include 'temp/db.php';

    $id_users=$_SESSION['id_users'];
if (isset($_POST['insert'])) 
{
	   $number_ord = $_POST['number_ord'];	
	   $name_product = $_POST['id_product'];
	   $delivery = $_POST['delivery'];
       $oplata = $_POST['oplata'];
    $sql11="insert into orderr(date_order, number_ord, delivery, oplata,  id_users, id_product) 
	values(NOW(), $number_ord, '$delivery', '$oplata', $id_users, '$name_product')";
    $result=$connection->query($sql11);
header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/cake_z.php");
}

//Если $_POST['update'] непустой, то изменить запись в базе
if (isset($_POST['update'])) 
{
    $id_order = $_POST['id_order'];;
    $number_ord = $_POST['number_ord'];
    $oplata =$_POST['oplata'];
    $sql = "UPDATE orderr SET number_ord='$number_ord', oplata='$oplata' WHERE id_order='$id_order'"; 
    $result=$connection->query($sql);
}
if (isset($_GET['delete'])) 
        {
            $id_order = $_GET['id_order'];
            $sql = "DELETE FROM orderr WHERE id_order='$id_order'";
        $result=$connection->query($sql);
        }
include 'temp/head.php';
include 'temp/nav_zakazchik.php';
?>

 
 <!--Модальное окно Добавление-->
<div class="modal fade" id="cakeAddModal" tabindex="-1" aria-labelledby="cakeAddModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cakeAddModalLabel">Купить продукцию</h5>
      </div> 
      <div class="modal-body">
      <form  method="POST" action="cake_z.php">
  <div class="form-row">
  <?php
  echo '<br><input type="hidden" id="id_product" name="id_product">'; 
//НЕВИДИМОЕ ОКНО ВВОДА, ЧТОБЫ ПЕРЕДАТЬ ID В $_POST
?>
 <div class="form-group col-md-6">
    <label for="number_ord">Количество</label>
    <input type="text" class="form-control" name ="number_ord" placeholder="Введите количество товара">
  </div>
  <div class="form-group col-md-6">
  <label for="delivery">Условия доставки</label>
  <select name="delivery" class="form-control">
        <option value="Экспедитор">Экспедитор</option>
    </select>
  </div>
  <div class="form-group col-md-6">
  <label for="oplata">Условия оплаты</label>
  <select name="oplata" class="form-control">
        <option value="Наличные перечисления">Наличные перечисления</option>
		<option value="Безналичные перечисления">Безналичные перечисления</option>
    </select>
  </div>
  </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="insert" class="btn btn-outline-info">Заказать</button>
        <button type="button" class="btn btn-outline-info" data-dismiss="modal" aria-hidden="true">Закрыть</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>




<!--Модальное окно Редактирование-->
<div class="modal fade" id="orderEditModal" tabindex="-1" aria-labelledby="orderEditModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="orderEditModalLabel">Изменить</h5>
      </div> 
      <div class="modal-body">
      <form method="POST" action="">
  <div class="form-row">
	<?php
  echo '<br><input type="hidden" id="id_order" name="id_order">'; 
//НЕВИДИМОЕ ОКНО ВВОДА, ЧТОБЫ ПЕРЕДАТЬ ID В $_POST
?>
 <div class="form-group col-md-6">
    <label for="number_ord">Количество</label>
    <input type="text" class="form-control" id="number_ord" name ="number_ord" placeholder="Введите количество товара">
  </div>
  <div class="form-group col-md-6">
  <label for="oplata">Условия оплаты</label>
  <select id="oplata" name="oplata" class="form-control">
        <option value="Наличные перечисления">Наличные перечисления</option>
		<option value="Безналичные перечисления">Безналичные перечисления</option>
    </select>
  </div>
  </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="update" class="btn btn-outline-info">Изменить</button>
        <button type="button" class="btn btn-outline-info" data-dismiss="modal" aria-hidden="true">Закрыть</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>


   
 
        <!--================End Main Header Area =================-->
        <section class="banner_area">
        	<div class="container">
        		<div class="banner_text">
        			<h3>Каталог</h3>
        			<ul>
        				<li><a href="index.php">Главная</a></li>
        				<li><a href="cake_z.php">Каталог</a></li>
        			</ul>
        		</div>
        	</div>
        </section>
		<br>
        <!--================End Main Header Area =================-->
		<?php
echo' <h4> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$_SESSION['name_u'].'</h4>';
 ?>
		<section class="our_cakes_area p_100">

    <div class="container">
	<div class="main_title">
        			
        		</div>
		<div class="row">
			<div class="col-md-1">
                
			</div>
			<!-- Пагинация -->
<?php
if (isset($_GET['page_no']) && $_GET['page_no']!="") {
    $page_no = $_GET['page_no'];
    } else {
        $page_no = 1;
        }
	
$total_records_per_page = 8;

$offset = ($page_no-1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";
$result_count = mysqli_query($connection,"SELECT COUNT(*) as total_records FROM product");
	$total_records = mysqli_fetch_array($result_count);
	$total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1; // total page minus 1


 ?>	
			<div class="col-md-10">
			<div class="cake_feature_row row">


				<?php
					// $products = "select id_product, name_product, img, price, describes from product  LIMIT $offset, $total_records_per_page";
					// $result = mysqli_query($connection, $products);
					// if(mysqli_num_rows($result) > 0)
					// {


  
$sql="select * from product  LIMIT $offset, $total_records_per_page";
$result=$connection->query($sql);
if($result->num_rows>0)
{
	
}
foreach($result as $row)
{
	echo '<div class="col-lg-3 col-md-4 col-6">
	<div class="cake_feature_item">
	<div class="cake_img">
		<img src="'.$row['img'].'" alt="">
	</div>
	<div class="cake_text">
	<h4 class="font-weight-bold">'.$row['price'].'р</h4>
	<h3>'.$row['name_product'].'</h3>
</div>
<button type="button" class="btn btn-outline-info"
data-toggle="modal" data-target="#cakeAddModal" 
data-id_product="'.$row['id_product'].'"
 data-name_product="'.$row['name_product'].'" >Купить</button>
	</div>
	</div>';
}
							
				?>
				</div>
				
			</div>



<div class="col-md-1">
                
			</div>
<!-- 
<div style='padding: 10px 20px 5px 200px; border-top: dotted 1px #CCC;'>

<table class="table table-bordered align-middle" width="100%"> -->


<!-- Вывод -->



			<div style='padding: 10px 20px 5px 550px; border-top: dotted 1px #CCC;'>
<strong>Страница <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
</div>
</div>
<nav aria-label="Page navigation example">
<ul class="pagination justify-content-center">
	<?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
    
	<li class='page-item ' <?php if($page_no <= 1){ echo "class='disabled' class='page-item ' "; } ?>>
	<a class='page-link' <?php if($page_no > 1){ echo " class='page-link' href='?page_no=$previous_page'"; } ?>>&laquo; Предыдущая</a>
	</li>
       
    <?php 
	if ($total_no_of_pages <= 10){  	 
		for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
			if ($counter == $page_no) {
		   echo "<li class='active' class='page-item' ><a class='page-link'  >$counter</a></li>";	
				}else{
           echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
				}
        }
	}
	elseif($total_no_of_pages > 10){
		
	if($page_no <= 4) {			
	 for ($counter = 1; $counter < 8; $counter++){		 
			if ($counter == $page_no) {
		   echo "<li class='active' class='page-item' ><a class='page-link' >$counter</a></li>";	
				}else{
           echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
				}
        }
		echo "<li class='page-item' ><a class='page-link'>...</a></li>";
		echo "<li class='page-item' ><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
		echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
		}

	 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
		echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
		echo "<li class='page-item' ><a class='page-link' href='?page_no=2'>2</a></li>";
        echo "<li class='page-item'><a class='page-link' >...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
           if ($counter == $page_no) {
		   echo "<li class='active' 'page-item' ><a class='page-link'  >$counter</a></li>";	
				}else{
           echo "<li class='page-item'  ><a class='page-link'  href='?page_no=$counter'>$counter</a></li>";
				}                  
       }
       echo "<li class='page-item' ><a class='page-link' >...</a></li>";
	   echo "<li class='page-item' ><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
	   echo "<li class='page-item' ><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
            }
		
		else {
        echo "<li class='page-item' ><a class='page-link' href='?page_no=1'>1</a></li>";
		echo "<li class='page-item' ><a class='page-link' href='?page_no=2'>2</a></li>";
        echo "<li class='page-item' ><a class='page-link' >...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
		   echo "<li  class='page-item' class='active'><a class='page-link' >$counter</a></li>";	
				}else{
           echo "<li class='page-item' ><a  class='page-link' href='?page_no=$counter'>$counter</a></li>";
				}                   
                }
            }
	}
?>
    
	<li  class='page-item ' <?php if($page_no >= $total_no_of_pages){ echo "class='disabled' class='page-item'"; } ?>>
	<a class='page-link' <?php if($page_no < $total_no_of_pages) { echo " class='page-link' href='?page_no=$next_page'"; } ?>>Следующая</a>
	</li>
    <?php if($page_no < $total_no_of_pages){
		echo "<li class='page-item' ><a  class='page-link' href='?page_no=$total_no_of_pages'>Последняя &rsaquo;&rsaquo;</a></li>";
		} ?>
</ul>
</nav>
</div>
		</div>
    </div>
	
</section>

<section>
            <div class="container">
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <table id="myTable" class="table table-bordered align-middle">
                            <tr>
							 <th>Дата заказа</th>
                            <th>Наименование изделия</th>
							<th>Цена</th>
                            <th>Количество изделий</th>
                            <th>Способ доставки</th>
							<th>Способ оплаты</th>
                            <th>Сумма</th>
							<th colspan="2">Действия</th>
                    </tr>
                        </tr>

                        <?php
                            $id_users=$_SESSION['id_users'];
                            $sql = "SELECT  id_order, name_product,DATE_FORMAT(date_order,'%d.%m.%Y')as date_order, number_ord, delivery, oplata, product.price, SUM(product.price*orderr.number_ord) as summa_order 
							FROM product, orderr WHERE orderr.id_product = product.id_product and id_users=$id_users GROUP BY id_order, name_product, date_order, number_ord, delivery, oplata, price ORDER BY id_order DESC LIMIT 1";
                            $result = $connection->query($sql);

                            foreach($result as $row)
                            {
                                echo '<tr>
									<td>'.$row['date_order'].'</td>
                                    <td>'.$row['name_product'].'</td>
									<td>'.$row['price'].'</td>
                                    <td>'.$row['number_ord'].'</td>
                                    <td>'.$row['delivery'].'</td>
                                    <td>'.$row['oplata'].'</td>
									<td>'.$row['summa_order'].'</td>
									<td><button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#orderEditModal" 
                                            data-id_order="'.$row['id_order'].'" 
                                            data-number_ord="'.$row['number_ord'].'"
                                            data-oplata="'.$row['oplata'].'" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
											<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
											<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
										  </svg></button>  </td>
                      <td>
                                            <form method="GET"><button type="submit"  name="delete"  class="btn btn-outline-info" value="'.$row['id_order'].'">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                  </svg>
                                  </button>
                                  </form>
                                  </td>
                                </tr>';
                            }
                        ?>
                        </table>
</div>
</div>
            </div>
			
    </section>
 
<script>
$(document).ready(function(){
  $('#cakeAddModal').on('show.bs.modal', function (event) {
// кнопка, которая вызывает модаль
 var button = $(event.relatedTarget) 
// получим  data-id_tovar атрибут
  var id_product = button.data('id_product') 
// получим  data-name_tovar атрибут
  var name_product = button.data('name_product');
   // Здесь изменяем содержимое модали
  var modal = $(this);
 modal.find('.modal-title').text('Заказать '+name_product);
 modal.find('.modal-body #id_product').val(id_product);
})
});
</script>


<script>
$(document).ready(function(){
  $('#orderEditModal').on('show.bs.modal', function (event) {
// кнопка, которая вызывает модаль

 var button = $(event.relatedTarget) 
// получим  data-id атрибут
var id_order = button.data('id_order');
var number_ord = button.data('number_ord');
var oplata = button.data('oplata');
// Здесь изменяем содержимое модали
var modal = $(this);
 modal.find('.modal-title').text('Изменить');
 modal.find('.modal-body #id_order').val(id_order);
 modal.find('.modal-body #number_ord').val(number_ord);
 modal.find('.modal-body #oplata').val(oplata);
 
})
});
</script>

    		<?php
include 'temp/footer.php';
?>