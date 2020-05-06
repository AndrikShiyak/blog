<?php
    require_once('../configDB.php');

    $conn = mysqli_connect(servername, username, password, dbname);
        if(!$conn) {
            die('Помилка при підключенні до БД ' . mysqli_connect_error());
        }
    $email = $_GET['id'];
    $sql = "SELECT * FROM user WHERE Email = '" . $email . "'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result)>0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['Status']) {
?>
        <b>Електронна адреса не була підтверджена</b>
<?php
        }else{
            session_start();
            $_SESSION['isOut'] = true;
            $_SESSION['Login'] = $row['Login'];
            $_SESSION['urlAvatar'] = $row['urlAvatar'];
            $_SESSION['Role'] = 'follower';
            $sql = "UPDATE user SET Role = 'follower', Status = true";
            $result = mysqli_query($conn, $sql);
?>
        <b>Електронна адреса підтверджена</b>
<?php
        }
    }
    
?>
<a href="'http://localhost/Blog/">Повернутись на головну</a>    