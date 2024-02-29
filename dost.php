<?php
session_start();
$role = $row['role'];
include 'temp/db.php';
include 'temp/head.php';
include 'temp/nav_manager.php';
$delivery=$_POST['delivery'];
$id_order=$_POST['id_order'];
if (isset($_POST['update'])) 
{

$sql="UPDATE orderr SET delivery = '$delivery' WHERE id_order = '$id_order'";
$result=$connection->query($sql);
header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/dost.php");
}
?>
<br>
<br>
<!--Модальное окно добавления -->
<div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Добавить</h5>
      </div> 
      <div class="modal-body">
      <form method="POST"  action="">
<div class="form-row">
    <div class="form-group col-md-6"><br>
    <label for="id_order">Номер заказа</label>
    <select id="id_order" name="id_order" class="form-control">
        <?php
        $sql=$connection->query("select id_order from orderr ");
        while ($row=mysqli_fetch_array($sql))
        {
          echo  '<option value="'.$row['id_order'].'">'.$row['id_order'].' </option>';
        }
        ?>
    </select>
    </div>
<div class="form-group col-md-6"><br>
<label for="delivery">ФИО экспедитора</label>
    <select id="delivery" name="delivery" class="form-control">
    <option value="Жуков Иван Алексеевич">Жуков Иван Алексеевич</option>
    <option value="Петров Петр Иванович">Петров Петр Иванович</option>
    <option value="Дронов Юрий Николаевич">Дронов Юрий Николаевич</option>
    <option value="Вихрь Виктор Петрович">Вихрь Виктор Петрович </option>
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


<!--Модальное окно для путевых листов -->
<div class="modal fade" id="putModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="putModalLabel">Путевой лист</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      </div> 
      <div class="modal-body">
        
      <form method="POST" action="putlist.php">
  <div class="form-row">
  <div class="form-group  col-md-12">
    <label for="id_order">Номер заказа</label>
    <select  name="id_order" class="form-control" >
    <option id='id_order'>Выберите номер заказа</option>

        <?php
        $sql=$connection->query("select id_order from orderr where status='Не выполнен'");
        while ($row=mysqli_fetch_array($sql))
        { 
          echo  '<option value="'.$row['id_order'].'">'.$row['id_order'].' </option>';
        }
        ?>
    </select>
  </div>
  </div>
      </div>
      <div class="modal-footer">
      <div class="col-sm-3"><button type="submit" class="btn btn-outline-info form-control size-text" style="">Печать</button></div>
      
    </div>
      </form>


    </div>
  </div>
</div>
<br><br><br>
<section class="banner_area">
        	<div class="container">
        		<div class="banner_text">
                <br>
<br>
        			<h3>Оформление доставки</h3>
        			<ul>
        				<li><a href="#">Главная</a></li>
        				<li><a href="#">Оформление доставки</a></li>
        			</ul>
        		</div>
                </section>



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
<div class="card">
            <div class="card-header">
                <h4>Данные оформления доставки
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <button type="button"  class="btn btn-outline-info"  data-toggle="modal" data-target="#staticBackdrop">Добавить</button>
                <button type="button"  class="btn btn-outline-info" data-toggle="modal" data-target="#putModal">Путевые листы</button>
                </h4>
            </div>

<table class="table table-bordered">
                    <thead>
                        <tr>
                        <th>№ заказа</th>
                        <th>Дата заказа</th>
                        <th>Наименование заказчика</th>
                        <th>ФИО экспедитора</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
$id_order=$_GET['id_order'];
$delivery=$_GET['delivery'];
$sql="select orderr.id_order, DATE_FORMAT(date_order,'%d.%m.%Y')as date_order,users.name_u, orderr.delivery from orderr,users where orderr.id_users=users.id_users LIMIT $offset, $total_records_per_page";
$result = $connection->query($sql);
                                foreach($result as $row)
                                {
                                  echo '
                                    <tr>
                                <td>'.$row['id_order'] .'</td>
                                <td>'.$row['date_order'].'</td>
                                <td>'.$row['name_u'].'</td>
                                <td>'.$row['delivery'].'</td>
                                </tr>';
                                
                                }
                            ?>
                             </tbody>
                </table>
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
</div>

                <?php
include 'temp/footer.php';
?>
<script>
  $(document).ready(function(){
  $('#putModal').on('show.bs.modal', function (event) {
// кнопка, которая вызывает модаль

 var button = $(event.relatedTarget) 
// получим  data-id атрибут
var id_order = button.data('id_order');
// Здесь изменяем содержимое модали
var modal = $(this);
 modal.find('.modal-title').text('Путевой лист');
 modal.find('.modal-body #id_order').val(id_order);
 modal.find('.modal-title').text('Путевой лист');
})
});
</script>