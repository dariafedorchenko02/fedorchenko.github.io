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
        			<h3>Список договоров с заказчиками </h3>
        			<ul>
        				<li><a href="#">Главная</a></li>
        				<li><a href="#">Список договоров с заказчиками </a></li>
        			</ul>
        		</div>
                </section>
                </div><br>
                <div class="container">
    <div class="row">
        <div class="col-lg-12">
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
            <div class="col-md-2"></div>
            <div class="col-12" style="text-align: center; margin-top: 10px;">
                <button type="submit" class="btn btn-outline-info">Просмотреть</button>
            </div>
            </form>
        </div>
    </div>
</div><br>

<div class="container">
                <br>
                <div class="row">
                    <div class="col-lg-12">
                    <table class="table table-bordered align-middle">
                            <tr>
                            <th>Номер договора</th>  
                            <th>Наименование заказчика</th>
                            <th>Адрес</th>
                            <th>Телефон</th>
                            <th>Наименование изделия</th>
                            <th>Дата заключения договора</th>
                            <th>Сумма</th>
                    </tr>
                        </tr>

                        <?php
                            session_start();
                            $id_users=$_SESSION['id_users'];
                            $date1 = $_POST['date1'];
                            $date2 = $_POST['date2'];
                            if (isset($_POST['date1']) and isset($_POST['date2']))
    {
        $sql = "SELECT  dogovor.id_dogovor, users.name_u, users.adress, users.tel, product.name_product, DATE_FORMAT(date_dogovor,'%d.%m.%Y')as date_dogovor,
        SUM(product.price*orderr.number_ord) as summ_prod FROM product, orderr, users, dogovor WHERE orderr.id_product = product.id_product and orderr.id_users=users.id_users and dogovor.id_order=orderr.id_order
        GROUP BY id_dogovor, name_u, adress, name_product, tel, date_dogovor";
                            $result = $connection->query($sql);

                            foreach($result as $row)
                            {
                                echo '<tr>
                                    <th scope="row">'.$row['id_dogovor'].'</th> 
                                    <td>'.$row['name_u'].'</td>
                                    <td>'.$row['adress'].'</td>
                                    <td>'.$row['tel'].'</td>
                                    <td>'.$row['name_product'].'</td>
                                    <td>'.$row['date_dogovor'].'</td>
                                    <td>'.$row['summ_prod'].'</td>
                                </tr>';
                            }
                            $result->close();
                        ?>

                        <tfoot>
                            <?php
                            session_start();
                            $id_users = $_SESSION['id_users'];

                            $sql = "SELECT SUM(orderr.number_ord*product.price) as summa_order
                                    FROM orderr, product
                                    WHERE orderr.id_product=product.id_product AND id_users=$id_users
                                    GROUP BY id_users";
                            $result=$connection->query($sql);

                            foreach ($result as $row) 
                            {   
                                echo '                                
                                <th class="table-info">Итого: </th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                 <th>'.$row['summa_order'].'</th>
                                ';
                            }
    }
                            
                            ?>
                        <tfoot>
                        </table>
                    </div>
                    </div>
                    </div>


<?php
include 'temp/footer.php';
?>