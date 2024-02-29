<?php
if (!empty($_POST['insert'])) 
{
    $name_product = $_POST['name_product'];
    $number_ord = $_POST['number_ord'];
    $delivery = $_POST['delivery'];
    $date_order = $today = date("d.m.y");     
    $sql="insert into orderr(date_order, number_ord, id_product, delivery) values ('$date_order', $number, $name_product, $delivery)";
    //var_dump($sql);
    $result=$connection->query($sql);
header("Location: moizak.php");
}
?>