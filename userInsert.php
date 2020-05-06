<?php
    require_once('header.php');
    require_once('configDB.php');
    require_once('passwordHasher.php')
?>
<h1>РЕЄСТРАЦІЯ КОРИСТУВАЧА</h1>
<form action="" method="POST" class='m-5' enctype="multipart/form-data">
    <div class="form-group">
        <label for="formGroupExampleInput">Нік</label>
        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder" name="Login">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Електронна адреса</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="Email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">Пароль</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="Password">
    </div>

    <div class="form-group">
        <label for="exampleFormControlFile1">Завантажте файл аватарки</label>
        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="Avatar">
    </div>
    <button type="submit">ЗБЕРІГТИ</button>
</form>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $conn = mysqli_connect(servername, username, password, dbname);
        if(!$conn) {
            die('Помилка при підключенні до БД ' . mysqli_connect_error());
        }
        $login = $_POST['Login'];
        $email = $_POST['Email'];
        $password = passwordHasher($_POST['Password']);
        $sql = "SELECT * FROM user WHERE Email = '" . $email . "'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result)>0) {
            echo 'Користувач з таким емайл вже їснує';
            exit();
        }
        if ($_FILES['Avatar']['name'] != '') {
            $fileExtention = explode(".", $_FILES['Avatar']['name']);
            $fileName = md5(microtime()) . '.' . $fileExtention[count($fileExtention) - 1];
            if (!file_exists('avatar')) {
                mkdir('avatar');
            }
            move_uploaded_file($_FILES['Avatar']["tmp_name"], 'avatar/' . $fileName);
        } else {
            $fileName='noFoto.png';
        }
        $sql = "INSERT INTO user (Login, Email, Password, urlAvatar) VALUES ('" . $login . "', '" . $email . "', '" . $password . "', '" . $fileName . "')";
        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            $checkUrl = 'http://localhost/Blog/email/check_email.php?id=' . $email;
            $message_email = 'Підтвердіть електронну адресу за';
            $message_email .= '<a href="' .$checkUrl. '">посиланням</a>';
            Header('Location: email/Send_Email.php?Email=' . $email . '&Text=' . $message_email);
            
            
        } else {
            echo 'Error: ' . $sql . ' ' . mysqli_error($conn);
        }
    }

    require_once('footer.php');