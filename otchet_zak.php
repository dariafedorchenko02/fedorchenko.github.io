<?php
session_start();
include 'temp/db.php';
include 'temp/head.php';
include 'temp/nav_manager.php';
$status=$_POST['status'];
$id_order=$_POST['id_order'];
if (isset($_POST['update'])) 
{
$sql="UPDATE orderr SET status = '$status' WHERE id_order = '$id_order'";
$result=$connection->query($sql);
header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/otchet_zak.php");
}
?>
<!--Модальное окно добавления -->
<div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Изменить</h5>
      </div> 
      <div class="modal-body">
      <form method="POST"  action="">
<div class="form-row">
<div class="form-group col-md-6">
    <label for="id_order">Номер заказа</label>
    <input type="text" name="id_order" class="form-control" id="id_order">
    </div>
<div class="form-group col-md-6">
<label for="status">Статус</label>
    <select id="status" name="status" class="form-control">
    <option value="Выполнен">Выполнен</option>
    <option value="Не выполнен">Не выполнен</option>
    </select>
    </div>
    </div>
      <div class="modal-footer">
        <button type="submit" name="update" class="btn btn-outline-info">Сохранить</button>
        <button type="button" class="btn btn-outline-info" data-dismiss="modal">Закрыть</button>
      </div>
      </div></div>
      </form>
    </div>
  </div>
</div>
<br>
<br><br><br><br>
        <!--================End Main Header Area =================-->
        <section class="banner_area">
        	<div class="container">
        		<div class="banner_text">
        			<h3>Отчет по заказам</h3>
        			<ul>
        				<li><a href="index.php">Главная</a></li>
        				<li><a href="otchet_zak.php">Отчет по заказам</a></li>
        			</ul>
        		</div>
        	</div>
        </section>
        <!--================End Main Header Area =================-->
        <div class="row">
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
$result_count = mysqli_query($connection,"SELECT COUNT(*) as total_records FROM orderr");
	$total_records = mysqli_fetch_array($result_count);
	$total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1; // total page minus 1


 ?>	
        
            
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                              
                <br><br>
                <div class="card">
            <div class="card-header">
                <form  method="POST" action="" class="row g-2 needs-validation">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                <label for="exampleInputEmail" class="form-label">Дата С</label>
                <input type="date" name="date1" class="form-control">
    </div>
            <div class="col-md-4">
                <label for="exampleInputEmail" class="form-label">Дата ПО</label>
                <input type="date" name="date2" class="form-control">
            </div>
            <br><br>
            <div class="col-12" style="text-align: center; margin-top: 20px;">
                <button type="submit" class="btn btn-outline-info">Просмотреть</button>
            </div>
                </form>
            </div> 
                
            </div>
            </div>  
            </div>    

                <div class="col-lg-2"></div>
            </div>
        

        <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <br>
                        <?php 
                         $date1 = $_POST['date1'];
                         $date2 = $_POST['date2'];
                         if (isset($_POST['date1']) and isset($_POST['date2']))
                         {
                            echo'<div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-bordered table-striped" width="100%" >
                                        <tr>
                                        <th>Номер заказа</th>
                                        <th>Дата заказа</th>
                                        <th>Статус</th>
                                        <th>Наименование заказчика</th>
                                        <th>Сумма</th>
                                        <th>Действие</th>
                                        </tr>';
                        $sql=("select orderr.id_order, orderr.status, DATE_FORMAT(date_order,'%d.%m.%Y')as date_order, users.name_u, sum(orderr.number_ord*product.price) as summa_order
                         from orderr, users, product where orderr.id_users=users.id_users and orderr.id_product=product.id_product and orderr.date_order BETWEEN '$date1' AND '$date2' GROUP by orderr.id_order, orderr.status,users.name_u LIMIT $offset, $total_records_per_page ");
                            $result=$connection->query($sql);
                                foreach($result as $row)
                                {
                                
                                    echo ' <tr>
                                    <td>'.$row['id_order'].'</td>
                                    <td>'.$row['date_order'].'</td>
                                    <td>'.$row['status'].'</td>
                                    <td>'.$row['name_u'].'</td>
                                    <td>'.$row['summa_order'].'</td>
                                    <td>
                        <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#staticBackdrop" 
                            data-id_order="'.$row['id_order'].'"
                            data-status="'.$row['status'].'" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg>
                          </button> 
                          
                        </td>
                                    </tr>';
                                }
                                echo'
                </table>
                </div>
        </div>  
    </div>';
                            }
                        ?>
    
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
<script>
  $(document).ready(function(){
  $('#staticBackdrop').on('show.bs.modal', function (event) {
// кнопка, которая вызывает модаль

 var button = $(event.relatedTarget) 
// получим  data-id атрибут
var id_order = button.data('id_order');
var status = button.data('status');
// Здесь изменяем содержимое модали
var modal = $(this);
 modal.find('.modal-title').text('Изменить');
 modal.find('.modal-body #id_order').val(id_order);
 modal.find('.modal-body #status').val(status);
 modal.find('.modal-title').text('Изменить');
})
});
</script>