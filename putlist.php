<?php
session_start();
$role = $row['role'];
include 'temp/db.php';  
include 'temp/head.php';
include 'temp/nav_manager.php';
?>
    <section class="banner_area">
        	<div class="container">
        		<div class="banner_text">
        			<h3>Путевой лист</h3>
        			<ul>
        				<li><a href="#">Главная</a></li>
        				<li><a href="#">Путевой лист</a></li>
        			</ul>
        		</div>
                </section>
                <div class="container">    
      <div class="row">
      <div class="col-lg-12">
      <table border="1" cellpadding="1" cellspacing="1" style="width:1200px">
      <?php
    if (!empty($_POST)) 
    { 
    $id_order=$_POST['id_order'];
    }
    $sql1="select product.id_product, orderr.number_ord, product.price, product.name_product, 
SUM(orderr.number_ord*product.price) as summa_order, orderr.delivery, dogovor.period, users.name_u, users.adress, product.weight 
from product, orderr, dogovor, users where product.id_product=orderr.id_product 
and users.id_users=orderr.id_users and orderr.id_order=dogovor.id_order and orderr.id_order='$id_order'
GROUP by product.id_product, orderr.number_ord, price, product.name_product,dogovor.delivery, dogovor.period, users.name_u, users.adress";
$result=$connection->query($sql1);
//var_dump($result);
foreach($result as $row)
{ 
    echo '
	<tbody>
		<tr>
			<br><td colspan="12"><center><b>Товарно-транспортная накладная</b>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="12">Грузоотправитель: <b>Кондитерская &quot;Кусочек счастья</b>&quot;,&nbsp;<i>г. Новочеркасск, ул. Мира, д. 188</i>&nbsp;</td>
		</tr>
        <tr>
			<td colspan="12">Плательщик: <b>'.$row['name_u'].'</b>&quot; <i>'.$row['adress'].'</i>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="12"><center><b>I. ТОВАРНЫЙ РАЗДЕЛ (заполняется грузоотправителем)</b></td>
		</tr>
		<tr>
			<td>Код продукции</td>
			<td>Количество</td>
			<td>Цена, руб. коп.</td>
			<td colspan="3" rowspan="1">Наименование продукции, товара&nbsp;</td>
			<td colspan="2" rowspan="1">Вид упаковки</td>
			<td colspan="4" rowspan="1">Сумма руб. коп.</td>
		</tr>
		<tr>
			<td><b>'.$row['id_product'].'</b></td>
			<td><b>'.$row['number_ord'].'</b></td>
			<td><b>'.$row['price'].'</b></td>
			<td colspan="3"><b>'.$row['name_product'].'</b>
			<td colspan="2">Коробка</td>
			<td colspan="4"><b>'.$row['summa_order'].'</b></td>
		</tr>
		<tr>
			<td>Всего мест</td>
			<td>1</td>
			<td>Масса груза (брутто)</td>
			<td>'.$row['weight'].'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="6">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="2" rowspan="1">Всего к оплате</td>
			<td colspan="6"><b>'.$row['summa_order'].'</b></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Всего отпущено на сумму</td>
			<td><b>'.$row['summa_order'].' <i>руб.</i></b></td>
			<td>Груз получил экспедитор</td>
			<td><b>'.$row['delivery'].'</b></td>
			<td colspan="4">&nbsp;</td>
            <td colspan="4">&nbsp;</td>
		</tr>
		<tr>
			<td>Директор&nbsp;</td>
			<td>Шевцова Людмила Васильевна</td>
			<td colspan="10">&nbsp;</td>


		</tr>
		<tr>
			<td>Отпуск груза произвел</td>
			<td>Менеджер Иванов Дмитрий Кириллович</td>
			<td colspan="10" rowspan="1">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="10" rowspan="1">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>Дата</td>
			<td colspan="10" rowspan="1">'.$row['period'].'</td>
		</tr>
		<tr>
			<td colspan="12">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="12"><center><b>II. ТРАНСПОРТНЫЙ РАЗДЕЛ</b></td>
		</tr>
		<tr>
			<td>Срок доставки груза</td>
			<td><b>'.$row['period'].'</b></td>
			<td colspan="10">&nbsp;</td>
		</tr>
		<tr>
			<td>Организация&nbsp;</td>
			<td><b>Кондитерская "Кусочек счастья"</b></td>
			<td>Автомобиль</td>
			<td>Тойота</td>
			<td>Государственный номерной знак</td>
			<td>М 092 97</td>
			<td colspan="6">&nbsp;</td>
		</tr>
		<tr>
			<td>Заказчик (плательщик)</td>
			<td><b>'.$row['name_u'].'</b></td>
			<td colspan="10">&nbsp;</td>
		</tr>
		<tr>
			<td>Экспедитор</td>
			<td><b>'.$row['delivery'].'</b></td>
			<td>Удостоверение №</td>
			<td colspan="9" rowspan="1">340203</td>
		</tr>
		<tr>
			<td>Лицензионная карточка</td>
			<td>стандартная, ограниченная</td>
			<td>Вид перевозки</td>
			<td colspan="4" rowspan="1">коммерческий</td>
			<td colspan="3" rowspan="1">Код</td>
		</tr>
		<tr>
			<td>Пункт погрузки</td>
			<td><i>г. Новочеркасск, ул. Мира, д. 188</i></td>
			<td>Пункт разгрузки</td>
			<td colspan="3" rowspan="1"><i>'.$row['adress'].'</i></td>
			<td>Маршрут</td>
			<td colspan="5" rowspan="1">&nbsp;</td>
		</tr>';
}
?>
	</tbody>
</table>

<p>&nbsp;</p>

      </div>
      </div>
      </div>

      <?php
include 'temp/footer.php';
?>