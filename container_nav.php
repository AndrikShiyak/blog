<?php
    session_start();
?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light" id='nav'>
        <a class="navbar-brand" href="index.php">BLOG</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">ЗАПИСИ<span class="sr-only">(current)</span></a>
                </li>

<?php
    if (isset($_SESSION['Role']) && ($_SESSION['Role'] == 'autor')) {
?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Мої записи
                    </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="viewAutorAllRecord.php">мої записи</a>
                    <a class="dropdown-item" href="addRecord.php">додати запис</a>
                </div>
                </li>
        </div>

<?php
    }
?>

<?php
    if (isset($_SESSION['Role']) && ($_SESSION['Role'] == 'administrator')) {
?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ПАНЕЛЬ АДМІНІСТРАТОРА
                    </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Записи</a>
                    <a class="dropdown-item" href="#">Коментарі</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="adminUser.php">Користувачі</a>
                </div>
                </li>
      
   

<?php
    }
?>

            </ul>
<?php

    if(isset($_SESSION['isOut'])) {
?>  

        <img src="avatar/<?=$_SESSION['urlAvatar']?>" alt="" style="height:40px; width:auto; border-radius:50%">
        <a href="#"><?=$_SESSION['Login']?> / </a>
        <a href="logOut.php">Вихід</a>
<?php       
    } else {
?>     
        <a href="userInsert.php"> Реєстрація / </a>
        <a href="#" data-toggle="modal" data-target="#LoginModal"> Авторизуватися</a>
<?php      
    }
?>




    
        </div>
    </nav>