<?php
session_start();
include 'temp/db.php';
include 'temp/head.php';
include 'temp/nav_zakazchik.php';
$id_users=$_SESSION['id_users']; 
$dir = 'img/client/'; //имя папки, для загрузки файла
$file = $dir.$id_com. basename($_FILES['photo']['name']);
move_uploaded_file($_FILES['photo']['tmp_name'], $file);   
$name_com=$_POST['name_com'];
if (isset($_POST['insert'])) 
{
    $sql="insert into comment(id_users,name_com, img) values('$id_users','$name_com','$file')";    
    $result=$connection->query($sql);
    header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/otzyv.php");
}
?>
<section class="banner_area">
        	<div class="container">
        		<div class="banner_text">
        			<h3>Отзывы</h3>
        			<ul>
        				<li><a href="#">Главная</a></li>
        				<li><a href="#">Отзывы</a></li>
        			</ul>
        		</div>
                </section>
<br>
                <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <?php
                   // var_dump($sql);
                  //  var_dump($result);
                    ?>
                <h3 class="card-title text-center font-weight-light">Отзыв</h3>
                    <form enctype="multipart/form-data"  method="POST" action="">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Наименование организации</label>
                            <input name="id_users" id="id_users" required type="text" class="form-control" placeholder="Введите наименование организации" id="name_u">
                        </div>
                        <div class="form-group">
    <label for="exampleFormControlTextarea1">Сообщение</label>
    <textarea class="form-control" name="name_com" id="name_com" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="exampleFormControlFile1">Пример ввода файла</label>
    <input type="file" name="photo" class="form-control-file" id="photo">
  </div>
                        <hr>
                        <div class="form-row justify-content-center">
                            <button type="submit" name="insert" class="btn btn-outline-info px-5">Отправить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        <br>
<?php
include 'temp/footer.php';
?>