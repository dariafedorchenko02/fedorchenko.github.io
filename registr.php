<?php
include 'temp/db.php';
 if (!empty($_POST)) {
    $role = $_POST['role'];
    $name_u = $_POST['name_u'];
    $login = $_POST['login'];
    $passw = $_POST['passw'];
    $inn = $_POST['inn'];
    $adress = $_POST['adress'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
       $sql = "INSERT INTO users(`role`, `login`, `passw`, `name_u`, `inn`,`adress`,`tel`,`email`) VALUES ('$role','$login','$passw','$name_u','$inn','$adress','$tel','$email')";
      // var_dump($sql);
       $result = $connection->query($sql);
       header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/registr.php");
      // var_dump($result);
    }
include 'temp/head.php';
    ?>

<section>
		<div class="container">
		<div class="row">
        <div class="col-md-12">
            <h1 class="font-weight-light">Регистрация</h1>
            <hr>
        </div>
    </div>
			<div class="row">
				<div class="col-lg-3"></div>
				<div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center font-weight-light">Зарегистрироваться</h3>
                    <p class="card-text text-center text-muted">Уже есть аккаунт? Тогда используйте страницу <a href="auth1.php">Авторизации</a></p>
                    <?php echo $sms; ?>
                    <hr>
                    <form action="" method="POST">
                 <div class="form-group">
                            <label for="exampleInputlogin">Логин</label>
                            <input name="login" id="login" required type="text" class="form-control" placeholder="Введите логин" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Пароль</label>
                            <input name="passw" id="passw" required type="password" class="form-control" placeholder="Введите пароль">
                        </div> 
                        <div class="form-group">
                            <label for="exampleInputname">Наименование</label>
                            <input name="name_u" id="name_u" required type="text" class="form-control" placeholder="Введите наименование">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputinn">ИНН</label>
                            <input name="inn" id="inn" required type="text" class="form-control" placeholder="Введите ИНН">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputadress">Адрес</label>
                            <input name="adress" id="adress" required type="text" class="form-control" placeholder="Введите aдрес">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">E-mail</label>
                            <input name="email" id="email" required type="text" class="form-control" placeholder="Введите E-mail">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputtel">Контактный телефон</label>
                            <input name="tel" id="tel" required type="tel" class="form-control" placeholder="Введите контактный телефон">
                        </div>
                          <div class="form-group">
                            <label for="exampleInputstatus">Статус</label>
                            <select id="role" name="role" class="form-control">
                                <option>Заказчик</option>
                            </select>
                        </div>
                        <hr>
                        <div class="form-row justify-content-center">
						<a href="auth1.php"><button type="submit" class="btn btn-outline-info">Зарегистрироваться</button></a>
                        </div>
                    </form>
                </div>
            </div>
				</div>
				<div class="col-lg-3"></div>
			</div>
		</div>
	</section>
<?php
include 'temp/footer.php';
?>