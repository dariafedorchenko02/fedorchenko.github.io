<?php
   if (!empty($_POST)) {

    $name_type1 = $_POST['name_type'];
    $name_product = $_POST['name_product'];
    $price = $_POST['price'];
    $unit = $_POST['unit'];
    $dir = 'img/'; 
    $file = $dir.basename($_FILES['userfile']['name']);
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $file)) 
{
  echo "Файл  успешно загружен.\n";
  } else {
  echo "Возможная атака с помощью файловой загрузки!\n";
  }

    } 
    $sql="insert into product('name_product', price, unit, id_type, 'img') values ('$name_product', $price, $unit, '$name_type1', '$userfile')";
   var_dump($sql);
    $result=$connection->query($sql);
    //var_dump($result);
    if (move_uploaded_file($tempname, $uploaddir)) {
        echo "Файл корректен и был успешно загружен.\n";
    } else {
        echo "Возможная атака с помощью файловой загрузки!\n";
    }
?>                  