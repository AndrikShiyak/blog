<?php
    require_once('header.php');
    require_once('configDB.php');

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $conn = mysqli_connect(servername, username, password, dbname);    // використовуємо константи
        if (!$conn) {
            die('Помилка при підключенні до БД.' . mysqli_connect_error());
        }

        $sql = "SELECT * FROM record WHERE Id = '" . $_GET['id_record'] . "'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
   
?>
    <h1>РЕДАГУВАТИ ЗАПИС</h1>
    <form action="" method='post' class='m-5'>
        <div class="form-group">
            <label for="Id">ID оголошення</label>
            <input type="text" name="Id" readonly value=<?=$row['Id']?>>
            <label for="exampleFormControlTextarea1">Example textarea</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" name='Text'><?=$row['Text']?></textarea>
        </div>
        <button type='submit'>ЗБЕРЕГТИ</button>
    </form>

<?php
    }
?>

<?php 

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $conn = mysqli_connect(servername, username, password, dbname);    // використовуємо константи
        if (!$conn) {
            die('Помилка при підключенні до БД.' . mysqli_connect_error());
        }
        $sql = "UPDATE record SET Text ='" . $_POST['Text'] . "', Status = 'not approved' WHERE Id = '" . $_POST['Id'] . "'";
        if(mysqli_query($conn,$sql)) {
            mysqli_close($conn);
            Header('Location: viewAutorAllRecord.php');
        } else {
            echo 'Error: ' . $sql . ' ' . mysqli_error($conn);
        }  
    }


    require_once('footer.php');