<?php
    require_once('header.php');
    require_once('configDB.php');
?>

    <h1>ДОДАТИ ЗАПИС</h1>
    <form action="" method='post' class='m-5'>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Example textarea</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" name='Text'></textarea>
        </div>
        <button type='submit'>ЗБЕРЕГТИ</button>
    </form>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $conn = mysqli_connect(servername ,username,password,dbname);   // використовуэмо константи
        if (!$conn) {
            die('Помилка при підключенні до БД.' . mysqli_connect_error());
        }
        $sql = "SELECT * FROM user WHERE Login = '" . $_SESSION['Login'] . "'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $IdAutor = $row['Id'];
        $Text = $_POST['Text'];
        $Date = date('yy-m-d');  //  бере час коли ми вводимо дані
        $sql = "INSERT INTO record (Id_autor, Text, Date) VALUES ('" . $IdAutor . "', '" . $Text . "', '" . $Date . "')";
        if(mysqli_query($conn,$sql)) {
            mysqli_close($conn);
            Header('Location: index.php');
        } else {
            echo 'Error: ' . $sql . ' ' . mysqli_error($conn);
        }  
    }

    require_once('footer.php');