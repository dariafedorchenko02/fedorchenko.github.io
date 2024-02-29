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
        			<h3>Отчет о заказах</h3>
        			<ul>
        				<li><a href="#">Главная</a></li>
        				<li><a href="#">Отчет о заказах</a></li>
        			</ul>
        		</div>
                </section>
                </div><br>
                <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <form  method="POST" action="" class="row g-2 needs-validation">
            <div class="col-md-2"> </div>
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
            <div class="col-12" style="text-align: center; margin-top: 10px;">
                <button type="button" id="chart_button" class="btn btn-outline-info">Диаграмма</button>
            </div>
            <div class="col-md-2"> </div>
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
                    <th>№ заказа</th>
                    <th>№ договора</th>
                    <th>Наименование заказчика</th>
                    <th>Дата заказа</th>
                    <th>Сумма</th>
                    <th>Выполнено</th>
                    <th>Не выполнено</th>
                    </tr>';
                    $sql= "select orderr.id_order, dogovor.id_dogovor, users.name_u, orderr.date_order, SUM(orderr.status='Выполнен') as vypoln,
                    SUM(orderr.status='Не выполнен') as nevypoln,  SUM(orderr.number_ord*product.price) as summa_order 
                    from orderr, dogovor, users, product 
                    where orderr.id_users=users.id_users and orderr.id_product=product.id_product 
                    and dogovor.id_order=orderr.id_order and  orderr.date_order BETWEEN '$date1' AND '$date2' 
                   GROUP BY orderr.id_order, dogovor.id_dogovor, users.name_u, orderr.date_order";
                $result = $connection ->query($sql);
                foreach($result as $row)
                {
                echo'
                    <tr>
                    <td>'.$row['id_order'].'</td>
                    <td>'.$row['id_dogovor'].'</td>
                    <td>'.$row['name_u'].'</td>
                    <td>'.$row['date_order'].'</td>
                    <td>'.$row['summa_order'].'</td>
                    <td>'.$row['vypoln'].'</td>
                    <td>'.$row['nevypoln'].'</td>
                    </tr>';
                }
                echo'
                </table>
            </div>
        </div>  
    </div>';
    }
?>
<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
                        <!-- <table class="table mt-3">
                            <thead>
                                <tr class="table table-striped">
                                    <th scope="col">Номер заказа</th>
                                    <th scope="col">Количество</th>
                                    
                                </tr>
                            </thead>
                            <tbody id="report_use_cards">
                                
                                <tr class="table">
                                    
                                </tr>
                                
                            </tbody>
                        </table> -->
                        <?php 
                                $label = ""; $value = "";
                                foreach ($result as $row) {
                                $label .= $row['name_u'].',';
                                $value .= $row['summa_order'].',';
                                
                                }?>
                                <!-- Сбор данных -->
                                <input type="hidden" id="chart_label" value="<?=$label?>">
                                <input type="hidden" id="chart_value" value="<?=$value?>">
                        <canvas class="my-4 w-100" id="myChart" width="700" height="180"></canvas>
                        </div>
                        <div class="col-lg-1"></div>
                        </div>

<!-- Скрипт для диаграммы -->
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script src="js/dashboard.js"></script>
<?php
include 'temp/footer.php';
?>