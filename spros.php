<?php
session_start();
include 'temp/db.php';
include 'temp/head.php';
include 'temp/nav_zav.php';

?>         
<?php
$id_type=$_POST['name_type'];
?>


<section class="banner_area">
        	<div class="container">
        		<div class="banner_text">
        			<h3>Статистика продаж</h3>
        			<ul>
        				<li><a href="#">Главная</a></li>
        				<li><a href="#">Статистика продаж</a></li>
        			</ul>
        		</div>
                </section>
                </div><br>
                <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <form  method="POST" action="" class="row g-2 needs-validation">
            <div class="col-md-4">
                <label for="exampleInputEmail" class="form-label">Вид изделия</label>
                <select name = "name_type" class="custom-select" id="name_type">
    <?php
    $sql =$connection ->query("select * from type_product"); 
    while ($row = mysqli_fetch_array($sql))
    {
    echo '<option value="'.$row['id_type'].'">'.$row['name_type'].'</option>';
    }
    ?>                     
    </select>  
            </div>
            <div class="col-md-4">
                <label for="exampleInputEmail" class="form-label">Дата С</label>
                <input type="date" name="date1" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="exampleInputEmail" class="form-label">Дата ПО</label>
                <input type="date" name="date2" class="form-control">
            </div>
            <div class="col-12" style="text-align: center; margin-top: 10px;">
                <button type="submit" class="btn btn-outline-info">Просмотреть</button>
            </div>
            </form>
        </div>
    </div>
</div><br>

<?php
   //var_dump($sql);
   //var_dump($result);
    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];
    //Таблица отчет о спросе
    if (isset($_POST['date1']) and isset($_POST['date2']))
    {
        echo'<div class="container">
        <div class="row">
            <div class="col-lg-12">
                <table class="table">
                    <tr>
                    <th>Наименование изделия</th>
                    <th>Количество</th>
                    <th>Дата продажи</th>
                    </tr>';
                    $sql= "SELECT product.name_product, orderr.number_ord, orderr.date_order, type_product.name_type FROM `orderr`,  `product`, `type_product`
                    WHERE product.id_product=orderr.id_product and product.id_type=type_product.id_type 
                    and type_product.id_type=$id_type and  orderr.date_order BETWEEN '$date1' AND '$date2'";
                $result = $connection ->query($sql);
                foreach($result as $row)
                {
                echo'
                    <tr>
                    <td>'.$row['name_product'].'</td>
                    <td>'.$row['number_ord'].'</td>
                    <td>'.$row['date_order'].'</td>
                    </tr>';
                }
                echo'
                </table>
            </div>
        </div>  
    </div>';
    }
?>


<?php
include 'temp/footer.php';
?>