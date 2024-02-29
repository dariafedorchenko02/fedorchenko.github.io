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
        			<h3>Печать договора</h3>
        			<ul>
        				<li><a href="#">Главная</a></li>
        				<li><a href="#">Печать договора</a></li>
        			</ul>
        		</div>
                </section>


</div>


            </div>
    <div class="col-lg-4"></div>
    </div>
        </div>
        </div>
    

    <div class="container">    
      <div class="row">
      <div class="col-lg-0"></div>
	  
      <div class="col-lg-11">

	  <table border="1" cellpadding="1" cellspacing="1" style="width:1200px">
	<tbody>
	<?php
    if (!empty($_POST)) 
    { 
    $id_dogovor=$_POST['id_dogovor'];
    }
$result=$connection->query("select orderr.id_order, orderr.summa_order, dogovor.id_dogovor,dogovor.delivery,dogovor.period,
 dogovor.date_dogovor, users.name_u, users.adress, users.inn, users.tel, users.email 
from orderr, dogovor, users
where orderr.id_order=dogovor.id_order and users.id_users=orderr.id_users and dogovor.id_dogovor='$id_dogovor'");
foreach($result as $row)
{
echo '<tr>
			<td colspan="2"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ДОГОВОР ПОСТАВКИ КОНДИТЕРСКИХ ИЗДЕЛИЙ №'.$id_dogovor.'</td>
		</tr>
		<tr>
			<td>г. Новочеркасск</td>
			<td>Дата договора '.$row['date_dogovor'].'</td>
		</tr>
		<tr>
			<td colspan="2">
			<p><strong>Кондитерская &laquo;Кусочек счастья&raquo;</strong> именуемое в дальнейшем <strong>&laquo;Поставщик&raquo;</strong>, в лице Исполнительного директора Шевцовой Людмилы Васильевны, действующей на основании доверенности № 32 АБ 1753224 от 10 ноября 2020г, с одной стороны, и</p>

			<p><strong>'.$row['name_u'].'</strong>, именуемое(ый) в дальнейшем <strong>&laquo;Покупатель&raquo;</strong>, с другой стороны, совместно именуемые &laquo;Стороны&raquo;, заключили настоящий договор (далее по тексту &ndash; &laquo;Договор&raquo;) о нижеследующем:</p>
			</td>
		</tr>
		<tr>
			<td colspan="2">
			<p><strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;1. ПРЕДМЕТ ДОГОВОРА</strong></p>

			<p><strong>1.1.</strong>Поставщик обязуется, в течение срока действия Договора, поставлять в собственность Покупателя Товар (кондитерские изделия), конкретные наименование, ассортимент, количество и стоимость (цена) которого согласовываются Сторонами в товарных накладных, счетах на оплату, счетах-фактурах,содержащих указанные выше условия,а Покупатель обязуется принимать Товар и оплачивать его.</p>
			<strong>1.2.</strong>Поставка Товара осуществляется партиями, на основании своевременно поданных заявок Покупателя. В случае несвоевременной подачи заявки Покупателем, Поставщик не гарантирует наличие необходимого количества Товара на своем складе, и, соответственно, поставка Товара осуществляется Поставщиком при условии наличия на складе Поставщика необходимого количества Товара. Поставщик обязуется сопроводить каждую партию Товара товарной накладной на сумму <strong>'.$row['summa_order'].' Руб.</strong> </td>
		</tr>
		<tr>
			<td colspan="2">
			<p>1.3.<strong>Заявка(№'.$row['id_order'].')</strong>, содержащая условия о наименовании, ассортименте, количестве заказываемого Покупателем Товара, а также о желаемой дате поставки и месте передачи соответствующей партии Товара,подается Покупателем в адрес Поставщика посредством телефонной / электронной связи в следующие сроки:</p>

			<p>1.3.1.<strong>Заявка(№'.$row['id_order'].')</strong> на поставку кондитерских изделий подается Покупателем не позднее 17:00 часов (МСК) дня, предшествующего дню (дате) поставки соответствующей партии Товара;</p>

			<p>1.3.2.Заявка на поставку кондитерских изделий подается Покупателем не позднее, чем за 2 (два) дня до дня (даты) поставки соответствующей партии Товара.</p>
			</td>
		</tr>
		<tr>
			<td colspan="2">
			<p><strong>  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;2. КАЧЕСТВО ТОВАРА</strong></p>
			<strong>2.1.</strong>Качество поставляемого Товара должно соответствовать требованиям законодательства РФ, ГОСТов (либо соответствующих технических регламентов), ТУ, Технических регламентов ТС, а также качественным удостоверениям производителя (если применимо).</td>
		</tr>
		<tr>
			<td colspan="2">
			<p><strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;3. ПОРЯДОК, СРОКИ И СПОСОБ ПОСТАВКИ ТОВАРА</strong></p>
			<strong>3.1.</strong> Готовая продукция направляется заказчикам. Доставка готовой продукции в торговую сеть производится автомобильным транспортом. Продукция развозится на автомобилях, принадлежащих кондитерской &laquo;Кусочек счастья&raquo;, причём за каждым автомобилем закреплены свои определённые торговые точки.</td>
		</tr>
		<tr>
			<td colspan="2">
			<p><strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;4.ПОРЯДОК И СРОКИ ПРИЕМКИ ТОВАРА</strong></p>
			<strong>4.1.</strong>Покупатель обязан совершить все необходимые действия, обеспечивающие принятие Товара. Датой принятия (поставки) Товара считается дата, указанная в путёвке экспедитора.</td>
		</tr>
		<tr>
			<td colspan="2">
			<p><strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;5. ЦЕНА, ПОРЯДОК И СРОКИ РАСЧЕТОВ</strong></p>

			<p><strong>5.1.</strong>Стоимость (цена) партии Товара согласовывается Сторонами впорядке, предусмотренном п. 1.1.Договора</p>
			<strong>5.2.</strong>Оплата поставленного Товара производится Покупателем в российских рублях, в порядке и в сроки, согласованные Сторонами в Договоре.</td>
		</tr>
		<tr>
			<td colspan="2">
			<p><strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 6. СРОК ДЕЙСТВИЯ ДОГОВОРА</strong></p>
			<strong>6.1.</strong>Договор вступает в силу с момента его подписания Сторонами и действует <strong>до <em>&laquo;</em></strong><strong><em>'.$row['period'].'&raquo;</em></strong></td>
		</tr>
		<tr>
			<td colspan="2"><strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 7.АДРЕСА, РЕКВИЗИТЫ И ПОДПИСИ СТОРОН</strong></td>
		</tr>
		<tr>
			<td><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Поставщик:&nbsp; &nbsp;&nbsp;</strong></td>
			<td><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Покупатель:</strong></td>
		</tr>
		<tr>
			<td>Кондитерская &laquo;Кусочек счастья&raquo;</td>
			<td>'.$row['name_u'].'</td>
		</tr>
		<tr>
			<td>Юридический адрес: 346400 г. Новочеркасск,&nbsp;пр-т Платовский 75, д.44Б, офис №11.</td>
			<td>Юридический адрес:'.$row['adress'].'</td>
		</tr>
		<tr>
			<td>Почтовый адрес: 346400 г. Новочеркасск,&nbsp;пр-т Платовский 75, д.44Б, офис №11.</td>
			<td>Почтовый адрес:'.$row['adress'].'</td>
		</tr>
		<tr>
			<td>ИНН/КПП: 3254004420/325701001,</td>
			<td>ИНН/КПП:'.$row['inn'].'</td>
		</tr>
		<tr>
			<td>Телефон: +70184285306</td>
			<td>Телефон:'.$row['tel'].'</td>
		</tr>
		<tr>
			<td>E-mail: piecehappines2023@gmail.com</td>
			<td>E-mail:'.$row['email'].'</td>
		</tr>' ;     }
		?>
	</tbody>
</table>

<p>&nbsp;</p>



<p>&nbsp;</p>

      </div>
      <div class="col-lg-1"></div>
      </div>
    </div>

<?php
include 'temp/footer.php';
?>