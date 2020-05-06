<?php 
   require_once("header.php");
   require_once('configDB.php');



   if (!$conn) {
      die('Помилка при підключенні до БД.' . mysqli_connect_error());
   }
  
  
  
   $sql = "SELECT * FROM record WHERE status = 'approved'";
   $result = mysqli_query($conn,$sql);
   while ($record = mysqli_fetch_assoc($result)) {
      $sql_comment = "SELECT COUNT(IdRecord) as CountComm FROM `comment` WHERE IdRecord='".$record['Id']."'";
      $res_comm = mysqli_query($conn, $sql_comment);
      $res_comm = mysqli_fetch_assoc($res_comm);
   
?>




      <div class='m-5 p-2' style="border: solid black 2px; ">
         <span> Дата: </span> <?=$record['Date']?>
         <br>
         <p align=justify> <?=$record['Text']?></p>
         <p align=left>Коментарів:<?=$res_comm['CountComm']?></p>
         <div>
            <p style="display:inline" >
               <span  id="countLike<?=$record['Id']?>"><?=$record['Like']?></span>
            </p>
            <img src="img/like.png" alt="" onclick="addLike(<?=$record['Id']?>)" style="width:30px; height:auto">

            
            <p style="display:inline">
               <span id="countDisLike<?=$record['Id']?>"><?=$record['DisLike']?></span>
            </p>
            <img src="img/dislike.png" alt="" onclick="addDisLike(<?=$record['Id']?>)" style="width:30px;  height:auto">
         </div>
         <a href="viewItemRecord.php?Id=<?=$record['Id']?>" type="button" class="w-100 btn btn-success">ПЕРЕГЛЯНУТИ</a>
      </div>

<?php

   }

?>




<?php
   require_once("footer.php");
?>

<script>
   function addLike(Id){
      $.post('addLike.php', {
           'Id': Id
         }, function(data, status){
            if (data) {
               var result = JSON.parse(data);
               $('#countLike'+result.Id).text(result.Like);
            }
           
         })
      }

   function addDisLike(Id){
      $.post('addDisLike.php', {
         'Id': Id
      }, function(data, status){
         if (data) {
            var result = JSON.parse(data);
            $('#countDisLike'+result.Id).text(result.DisLike);
         }
      })
   }   
</script>