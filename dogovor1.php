<?php
session_start();

include 'temp/db.php';
include 'temp/head.php';
include 'temp/nav_manager.php';

if (isset($_POST['insert'])) 
{
    $date_dogovor=$_POST['date_dogovor'];
    $period=$_POST['period'];
    $id_order=$_POST['id_order'];
    $delivery=$_POST['delivery'];
$sql1="insert into dogovor(date_dogovor,period, delivery,id_order) values ( '$date_dogovor', '$period', '$delivery', $id_order)";
$result=$connection->query($sql1);
header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/dogovor1.php");
}
if (isset($_GET['pechat'])) 
        {
        $id_dogovor=$_GET['pechat'];
        $sql="select dogovor.id_dogovor,  dogovor.date_dogovor, users.name_u, users.adress, users.inn, users.tel, users.email 
        from users, dogovor 
        where dogovor.id_users=users.id_users and dogovor.id_dogovor='$id_dogovor'";
        $result=$connection->query($sql);
        }
if (isset($_GET['delete'])) 
        {
        $id_dogovor=$_GET['delete'];
        $sql="delete from dogovor where dogovor.id_dogovor=$id_dogovor";
        $result=$connection->query($sql);
        }

?>
<section class="banner_area">
        	<div class="container">
        		<div class="banner_text">
        			<h3>Договор</h3>
        			<ul>
        				<li><a href="#">Главная</a></li>
        				<li><a href="#">Договор</a></li>
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
$result_count = mysqli_query($connection,"SELECT COUNT(*) as total_records FROM dogovor");
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
                <h4>Данные договора
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#staticBackdrop">
                Ввод договора
                </button>
                <button  type="button"  class="btn btn-outline-info"  data-toggle="modal" data-target="#dogModal">
                Печатные формы
                </button>
                </h4>
            </div>
            <div class="card-body">
                <!--Модальное окно Добавление -->
           
                <div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Добавить</h5>
      </div> 
      <div class="modal-body">
      <form method="POST" action="">
  <div class="form-row">
    <div class="form-group col-md-4">
    <?php
  echo '<br><input type="hidden" id="id_dogovor" name="id_dogovor">'; 
//НЕВИДИМОЕ ОКНО ВВОДА, ЧТОБЫ ПЕРЕДАТЬ ID В $_POST
?>
<label for="inputname">Номер заказа</label>
    <select name = "id_order" class="custom-select" id="id_order">
    <?php
    $sql =$connection ->query("select * from orderr"); 
    while ($row = mysqli_fetch_array($sql))
    {
    echo '<option value="'.$row['id_order'].'">'.$row['id_order'].'</option>';
    }
    ?>                     
    </select>  
    </div>
    <div class="form-group col-md-4">
    <label for="inputdate">Дата договора</label>
    <input type="date" class="form-control"  name="date_dogovor"  id="date_dogovor">
    </div>
  <div class="form-group  col-md-4">
  <label for="inputdate1">Срок действия</label>
    <input type="date" class="form-control"  name="period"  id="period">
  </div>
   
  </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="insert" class="btn btn-secondary">Сохранить</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="dogModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dogModalLabel">Печать</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      </div> 
      <div class="modal-body">
        
      <form method="POST" action="dogovor_pechat1.php">
  <div class="form-row">
  <div class="form-group  col-md-12">
    <label for="address">Номер договора</label>
    <select  name="id_dogovor" class="form-control" >
    <option id='id_dogovor'>Выберите номер договора</option>

        <?php
        $sql=$connection->query("select id_dogovor, date_order from dogovor, orderr where orderr.id_order=dogovor.id_order ORDER BY id_dogovor DESC LIMIT 1");
        while ($row=mysqli_fetch_array($sql))
        { 
          echo  '<option value="'.$row['id_dogovor'].'">'.$row['id_dogovor'].' </option>';
        }
        ?>
    </select>
  </div>
  </div>
      </div>
      <div class="modal-footer">
      <div class="col-sm-3"><button type="submit" class="btn btn-secondary form-control size-text" style="">Печать</button></div>
      
    </div>
      </form>


    </div>
  </div>
</div>




                <table class="table table-bordered table-striped" width="100%" >
                    <thead>
                        <tr>
                        <th>Номер заказа</th>  
                        <th>Наименование заказчика</th>
                        <th>Дата заказа</th>
                        <th>Дата договора</th>
                            <th>Срок действия</th>  
                            <th>Удалить</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $result=$connection->query("select orderr.id_order,DATE_FORMAT(date_order,'%d.%m.%Y')as date_order ,dogovor.id_dogovor,  DATE_FORMAT(date_dogovor,'%d.%m.%Y')as date_dogovor,  DATE_FORMAT(period,'%d.%m.%Y')as period, 
                            users.name_u
                            from dogovor, orderr, users
                            where orderr.id_order=dogovor.id_order and users.id_users=orderr.id_users LIMIT $offset, $total_records_per_page  ");
                                foreach($result as $row)
                                {
                                
                                    echo ' <tr>
                                    <td>'.$row['id_order'].'</td>    
                                    <td>'.$row['name_u'].'</td>
                                    <td>'.$row['date_order'].'</td>
                                    <td>'.$row['date_dogovor'].'</td>
                                    <td>'.$row['period'].'</td>

                                   
                                    <td><form method="GET"> <button type="submit" name="delete" class="btn btn-outline-info"  
                                    value="'.$row['id_dogovor'].'">
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
                        
                    </tbody>
                </table>

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

<script>
  $(document).ready(function(){
  $('#dogModal').on('show.bs.modal', function (event) {
// кнопка, которая вызывает модаль

 var button = $(event.relatedTarget) 
// получим  data-id атрибут
var id_dogovor = button.data('id_dogovor');
// Здесь изменяем содержимое модали
var modal = $(this);
 modal.find('.modal-title').text('Печать');
 modal.find('.modal-body #id_dogovor').val(id_dogovor);
 modal.find('.modal-title').text('Печать');
})
});
</script>