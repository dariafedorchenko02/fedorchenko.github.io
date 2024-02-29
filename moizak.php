<?php
include 'temp/db.php';
include 'temp/nav_zakazchik.php';
include 'temp/head.php';

?>
<section class="banner_area">
    <br>
    <br>
    <br><br>
    <br>
        	<div class="container">
        		<div class="banner_text">
        			<h3>Мои заказы</h3>
        			<ul>
        				<li><a href="#">Главная</a></li>
        				<li><a href="#">Мои заказы</a></li>
        			</ul>
        		</div>
                </section>

                <section>
            <div class="container">
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered align-middle">
                            <tr>
                            <th>Номер заказа</th>  
                            <th>Дата заказа</th>
                            <th>Наименование изделия</th>
                            <th>Цена изделия</th>
                            <th>Количество изделий</th>
                            <th>Способ доставки</th>
                            <th>Статус</th>
                            <th>Сумма</th>
                    </tr>
                        </tr>

                        <?php
                            session_start();
                            $id_users=$_SESSION['id_users'];
                            $sql = "SELECT  orderr.id_order, name_product,  DATE_FORMAT(date_order,'%d.%m.%Y')as date_order, orderr.number_ord, orderr.delivery, orderr.status, product.price, 
                            SUM(product.price*orderr.number_ord) as summ_prod FROM product, orderr WHERE orderr.id_product = product.id_product 
                            and id_users=$id_users
                            GROUP BY id_order, name_product, date_order, number_ord, delivery, product.price, status";
                            $result = $connection->query($sql);

                            foreach($result as $row)
                            {
                                echo '<tr>
                                    <th scope="row">'.$row['id_order'].'</th> 
                                    <td>'.$row['date_order'].'</td>
                                    <td>'.$row['name_product'].'</td>
                                    <td>'.$row['price'].'</td>
                                    <td>'.$row['number_ord'].'</td>
                                    <td>'.$row['delivery'].'</td>
                                    <td>'.$row['status'].'</td>
                                    <td>'.$row['summ_prod'].'</td>
                                </tr>';
                            }
                            $result->close();
                        ?>

                        <tfoot>
                            <?php
                            session_start();
                            $id_users = $_SESSION['id_users'];

                            $sql = "SELECT SUM(orderr.number_ord) as sum1, SUM(orderr.number_ord*product.price) as summa_order
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
                                <th>'.$row['sum1'].'</th>
                                <th></th>
                                <th></th>
                                 <th>'.$row['summa_order'].'</th>
                                ';
                            }
                            ?>
                        <tfoot>
                        </table><br>

                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                            <button type="button" class="btn btn-outline-primary"><</button>
                            <button type="button" class="btn btn-outline-primary">></button>
                        </div>
                    </div>
                </div>
            </div>
    </section>
<?php
include 'temp/footer.php';
?>