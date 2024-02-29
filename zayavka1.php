<?php
session_start();
$role = $row['role'];
include 'temp/db.php';
include 'temp/head.php';
include 'temp/nav_manager.php';

if (!empty($_POST['delete'])) 
{
$id_order=$_POST['delete'];
$sql1="delete from orderr where id_order=$id_order";
$result=$connection->query($sql1);
}

?>
<br>
<br><br><br><br>
<section class="banner_area">
        	<div class="container">
        		<div class="banner_text">
        			<h3>Заказы</h3>
        			<ul>
        				<li><a href="#">Главная</a></li>
        				<li><a href="#">Заказы</a></li>
        			</ul>
        		</div>
                </section>
<div class="row">
<div class="col-lg-2"></div>

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

    <div class="col-lg-8">
      <br><br>
        <div class="card">
            <?php
           // var_dump($sql1);
            ?>
            <div class="card-header">
                <h4>Данные заказа
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </h4>
            </div>
  <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th>№ заказа</th>
                          <th>Дата заказа</th>
                          <th>Наименование заказчика</th>
                          <th>Наименование изделия</th>
                          <th>Цена</th>
                          <th>Количество</th>
                          <th>Способ доставки</th>
                          <th>Способ оплаты</th>
                          <th>Сумма</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
$id_order=$_GET['id_order'];
$date_order=$_GET['date_order'];
$name_u=$_GET['name_u'];
$name_product=$_GET['name_product'];
$price=$_GET['price'];
$number_ord=$_GET['number_ord'];
$delivery=$_GET['delivery'];
$oplata=$_GET['oplata'];
$sql="select orderr.id_order, DATE_FORMAT(date_order,'%d.%m.%Y')as date_order, orderr.delivery, orderr.oplata, users.name_u, product.name_product, 
product.price, orderr.number_ord, SUM(product.price*orderr.number_ord) as summa_order  
from orderr, users, product where orderr.id_users=users.id_users and orderr.id_product=product.id_product GROUP by orderr.id_order,  users.name_u, product.name_product, 
product.price, orderr.number_ord LIMIT $offset, $total_records_per_page";
$result = $connection->query($sql);
foreach($result as $row){
echo '
<tr>
<td>'.$row['id_order'] .'</td>
<td>'.$row['date_order'] .'</td>
<td>'.$row['name_u'].'</td>
<td>'.$row['name_product'].'</td>
<td>'.$row['price'].'</td>
<td>'.$row['number_ord'].'</td>
<td>'.$row['delivery'].'</td>
<td>'.$row['oplata'].'</td>
<td>'.$row['summa_order'].'</td>
</tr>';}?>
                             </tbody>
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



    <div class="col-lg-2"></div>
</div>
<?php
include 'temp/footer.php';
?>