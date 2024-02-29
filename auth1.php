<?php
include 'temp/db.php';
if(!empty($_POST['login']) and (!empty($_POST['passw'])))
{
$login = $_POST['login'];
$passw = $_POST['passw'];
$role = $_POST['role'];
$name_u = $_POST['name_u'];
$sql = "select id_users, role, login, passw, name_u from users where login='".$login."' and passw='".$passw."'";
    $result = $connection->query($sql);
//var_dump($result);
    // $row = $result->fetch_array();
// if(!empty($result)){
//     $data_user = array(
//         'id_users'=>$row['id_users'],
//         'role'=>$row['role'],
//         'login'=>$row['login'],
//         'name_u'=>$row['name_u']
//     );
//     $_SESSION['data_user']=$data_user;
//     $_SESSION['data_user']['id_users']=$id_users;
//     if ($_SESSION['data_user']['role']=='Менеджер')
//  {
//  header("Location: manager.php");
//  }
//  else
//  if ($_SESSION['data_user']['role'] =='Заведующий')
//  {
//  header("Location: zav.php"); 
//  }
//  else
//  if ($_SESSION['data_user']['role'] =='Заказчик')
//  {
//  header("Location: cake_z.php"); 
//  }
//  $result->free();
// }
// }
$user = mysqli_fetch_assoc($result);

if(!empty($user)){
session_start();
$_SESSION['id_users'] = $user['id_users']; 
$_SESSION['role'] = $user['role']; 
$_SESSION['name_u'] = $user['name_u']; 
if ($_SESSION['role'] == 'Заказчик') 
{
     header('location:cake_z.php');
 }
 if ($_SESSION['role'] == 'Менеджер') 
 {
      header('location:manager.php');
  }
  if ($_SESSION['role'] == 'Заведующий') 
  {
       header('location:zav.php');
   }
}
}
include 'temp/head.php';
?>
<div class="container">
</br>
    <div class="row">
        <div class="col-md-12">
            <h1 class="font-weight-light">Авторизация</h1>
            <hr>
        </div>
    </div>
    </br>
</br>
</br>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                <h3 class="card-title text-center font-weight-light">Войдите в свой аккаунт</h3>
                    <p class="card-text text-center text-muted">Добро пожаловать! Если вы не зарегистрированы, пройдите <a href="registr.php">Регистрацию</a> на сайте.</p>
                    <?php echo $sms; ?>
                    <hr>
                    <form method="POST">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Логин</label>
                            <input name="login" required type="text" class="form-control" placeholder="Введите логин" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Пароль</label>
                            <input name="passw" required type="password" class="form-control" placeholder="Введите пароль" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Роль</label>
                            <select class="form-control" required name="role">
                             <option>Менеджер</option>
                             <option>Заведующий</option>
                             <option>Заказчик</option>
                            </select>
                        </div>
                        <hr>
                        <div class="form-row justify-content-center">
                            <button type="submit" class="btn btn-outline-info px-5">Войти</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
</div>
<?php
include 'temp/footer.php';
?>