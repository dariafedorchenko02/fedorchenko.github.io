<?php
include 'temp/db.php';
include 'temp/head.php';
include 'temp/nav_manager.php';
?>


        <!--================End Main Header Area =================-->
        <section class="banner_area">
        	<div class="container">
        		<div class="banner_text">
        			<h3>Отчет по экспедиторам</h3>
        			<ul>
        				<li><a href="index.php">Главная</a></li>
        				<li><a href="otchet_zak.php">Отчет по экспедиторам</a></li>
        			</ul>
        		</div>
        	</div>
        </section>
        <!--================End Main Header Area =================-->

        <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <br>
        <table class="table table-bordered table-striped" width="100%" >
                    <thead>
                        <tr>                         
                            <th>Дата заказа</th> 
                            <th>Номер заказа</th>
                            <th>Наименование заказчика</th>
                            <th>Сумма заказа</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $result=$connection->query("select order_no, date_order, name_u, summa_order from orderr, users where users.id_users=orderr.id_users");
                                foreach($result as $row)
                                {
                                
                                    echo ' <tr>                                    
                                    <td>'.$row['date_order'].'</td>
                                    <td>'.$row['order_no'].'</td>
                                    <td>'.$row['name_u'].'</td>
                                    <td>'.$row['summa_order'].'</td>
                                    </tr>';
                                }
                        ?>
                        
                    </tbody>
                </table>
                <br>
        </div>
        <div class="col-lg-2"></div>
        </div>
<?php
include 'temp/footer.php';
?>