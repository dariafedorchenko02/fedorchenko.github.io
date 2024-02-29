<?php
session_start();
include 'temp/db.php';

//Если $_POST['update'] непустой, то изменить запись в базе
if (isset($_POST['update'])) 
{
    $id_product = $_POST['id_product'];
    $name_product = $_POST['name_product'];
    $price = $_POST['price'];
    $unit = $_POST['unit'];
    // $dir = 'img/'; 
    // $file = $dir.basename($_FILES['userfile']['name']);
    $sql="UPDATE `product` SET name_product='$name_product', price='$price' WHERE product.id_product='$id_product'";    
    $result=$connection->query($sql);
}
if (isset($_GET['delete'])) 
        {
        $id_product=$_GET['delete'];
        $sql="delete from product where id_product=$id_product";
        $result=$connection->query($sql);
        }

    include 'temp/head.php';
include 'temp/nav_manager.php';
    //var_dump($result);
?>         
 <section class="banner_area">
        	<div class="container">
        		<div class="banner_text">
        			<h3>Изделие</h3>
        			<ul>
        				<li><a href="#">Главная</a></li>
        				<li><a href="#">Изделие</a></li>
        			</ul>
        		</div>
                </section>
<section>  
<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
    <br><br>
    <div class="card">
    <div class="card-header">
        <h4>Данные изделий
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </h4>
    </div>
    <div class="card-body">

<!--Модальное окно Изменить -->
<div class="modal fade" id="productModal">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
        <h5 class="modal-title" id="productModalLabel">Изменить</h5>
      </div> 
      <div class="modal-body">
      <form action="" method="POST">
      <?php
  echo '<br><input type="hidden" id="id_product" name="id_product">'; 
//НЕВИДИМОЕ ОКНО ВВОДА, ЧТОБЫ ПЕРЕДАТЬ ID В $_POST
?>
<div class="mb-2">
    <label>Наименование изделия</label>
    <input type="text" name="name_product" id="name_product" class="form-control">
</div>
<div class="mb-2">
    <label>Цена</label>
    <input type="text" name="price" id="price" class="form-control">
</div>
</div>

<div class="modal-footer">
        <button type="submit" name="update" class="btn btn-secondary">Изменить</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
</form>
</div>
</div>
</div>
</div>
</div>

<!-- Пагинация -->
<?php
if (isset($_GET['page_no']) && $_GET['page_no']!="") {
    $page_no = $_GET['page_no'];
    } else {
        $page_no = 1;
        }
	
$total_records_per_page = 4;

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
<table class="table table-bordered">
                    <thead>
                        <tr>
                        <th>Наименование изделия</th>
                            <th>Цена</th>
                            <th>Вид изделия</th>
                            <th>Изображение</th>
                            <th>Изменить</th>
                            <th>Удалить</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql="select product.id_product, product.name_product, product.price, type_product.name_type, img from product,type_product where type_product.id_type=product.id_type LIMIT $offset, $total_records_per_page ";
                        $result = $connection->query($sql);
                    foreach($result as $row)
                     {
                        echo '<tr>
                        <td>'.$row['name_product'].'</td>
                        <td>'.$row['price'].'</td>
                        <td>'.$row['name_type'].'</td>
                        <td><img src="'.$row['img'].'"class="card-img-top" alt="..." width="150" height="150"></td>
                        <td>
                        <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#productModal" 
                            data-id_product="'.$row['id_product'].'" 
                            data-name_product="'.$row['name_product'].'" 
                            data-price="'.$row['price'].'" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg>
                          </button> 
                          
                        </td>
                        <td>
                        <form method="GET"> <button type="submit" name="delete" class="btn btn-outline-info"  
                        value="'.$row['id_product'].'">
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







    <div class="col-lg-2">
        
    </div>
    </section>

	




    <script>
$(document).ready(function(){
  $('#productModal').on('show.bs.modal', function (event) {
// кнопка, которая вызывает модаль

 var button = $(event.relatedTarget) 
// получим  data-id атрибут
var id_product = button.data('id_product');
var name_product = button.data('name_product');
var price = button.data('price');

// Здесь изменяем содержимое модали
var modal = $(this);
 modal.find('.modal-title').text('Изменить');
 modal.find('.modal-body #id_product').val(id_product);
 modal.find('.modal-body #name_product').val(name_product);
 modal.find('.modal-body #price').val(price);
 
})
});
</script>



<?php
include 'temp/footer.php';
?>