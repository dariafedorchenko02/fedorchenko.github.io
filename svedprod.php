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
        			<h3>Сведения о продажах изделий</h3>
        			<ul>
        				<li><a href="#">Главная</a></li>
        				<li><a href="#">Сведения о продажах изделий</a></li>
        			</ul>
        		</div>
                </section>
                </div><br>
                <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <form  method="POST" action="" class="row g-2 needs-validation">
            <div class="col-md-2">  </div>
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
                    <th>Номер заказа</th>
                    <th>Наименование изделия</th>
                    <th>Заказчик</th>
                    <th>Дата заказа</th>
                    <th>Сумма</th>
                    </tr>';
                    $sql= "SELECT orderr.id_order, product.name_product, users.name_u, orderr.date_order, SUM(product.price*orderr.number_ord) as summa_order
                    FROM `orderr`,  `product`, `users`
                   WHERE product.id_product=orderr.id_product and users.id_users=orderr.id_users
                   and  orderr.date_order BETWEEN '$date1' AND '$date2' GROUP BY  orderr.id_order, product.name_product, users.name_u, orderr.date_order";
            
                $result = $connection ->query($sql);
                foreach($result as $row)
                {
                echo'
                    <tr>
                    <td>'.$row['id_order'].'</td>
                    <td>'.$row['name_product'].'</td>
                    <td>'.$row['name_u'].'</td>
                    <td>'.$row['date_order'].'</td>
                    <td>'.$row['summa_order'].'</td>
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