<?php
    require_once('header.php');
    require_once('configDB.php');

   
        if (!$conn) {
            die('Помилка при підключенні до БД.' . mysqli_connect_error());
        }

    $sql = "SELECT * FROM user WHERE Login = '" . $_SESSION['Login'] . "'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $IdAutor = $row['Id'];

    $sql = "SELECT * FROM record WHERE Id_autor = '" . $IdAutor . "'";
    $result = mysqli_query($conn,$sql);
    while ($record = mysqli_fetch_assoc($result)) {
        switch($record['Status']) {
            case 'approved':
                $status = 'Підтверджено адміністратором';
            break;
            case 'not approved':
                $status = 'Не підтверджено адміністратором';
            break;
            case 'delete':
                $status = 'Видалено адміністратором';
            break;
        }
        ?>

        <div class='m-5 p-2' style="border: solid black 2px; ">
           <span> Дата: </span> <?=$record['Date']?>
           <br>
           <span> Статус: </span> <?=$status?>
           <br>
           <p align=justify> <?=$record['Text']?></p>
           <div>
                <p style="display:inline">
                   <?=$record['Like']?>
                </p>
                <img src="img/like.png" alt="" style="width:30px; height:auto">
                <p style="display:inline">
                   <?=$record['DisLike']?>
                </p>
                <img src="img/dislike.png" alt="" style="width:30px;  height:auto">
            </div>
            <a href="updateRecord.php?id_record=<?=$record['Id']?>" type="button" class="btn btn-success">РЕДАГУВАТИ</a>
        </div>

<?php

    }

?>




<?php
    require_once('footer.php');
