<?php
session_start();
$role = $row['role'];
include 'temp/db.php';
include 'temp/head.php';
include 'temp/nav_director.php';
echo'Вы зашли как '.$_SESSION['role'];
?>
<div class="container">
<div class="row">
<div class="col-lg-2"></div>
<div class="col-lg-8">
<div class="card-header">
                        <h4>Клиенты</h4>
                    </div>
                    <div class="card-body">

                        <form action="" method="POST">
                            <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th>Наименование клиента</th>
                            <th>ИНН</th>
                            <th>Адрес</th>
                            <th>Телефон</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql="select * from customer";
                        $result = $connection->query($sql);
                    foreach($result as $row)
                     {
                        echo '<tr>
                        <td>'.$row['name_customer'].'</td>
                        <td>'.$row['inn'].'</td>
                        <td>'.$row['adress'].'</td>
                        <td>'.$row['tel'].'</td>
                        </tr>';
                      }
                    ?>
                        
  </table>

                        </form>
                    
                    </div>
        </div>
</div>
<div class="col-lg-2"></div>
</div>
</div>
<?php
include 'temp/footer.php';
?>