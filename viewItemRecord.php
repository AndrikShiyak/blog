<?php
    require_once("header.php");
    require_once('configDB.php');
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        $conn = mysqli_connect(servername, username, password, dbname);   
        if (!$conn) {
            die('Помилка при підключенні до БД.' . mysqli_connect_error());
        }
        $sql = "SELECT record.Id as Id, record.Date as `Date`, record.Text as `Text`, record.Like as `Like`, record.DisLike as `DisLike`,
         user.Login as autor, comment.Text as comm
         FROM record
         LEFT JOIN `user`
         ON record.Id_autor = user.Id
         LEFT JOIN comment
         ON record.Id_autor = comment.IdAutor
         WHERE record.Id = '".$_GET['Id']."'";
         $result = mysqli_query($conn,$sql);
         $record = mysqli_fetch_assoc($result);

         $autor = $record['autor'];
         $Date = $record['Date'];
         $Text = $record['Text'];
         $Id = $record['Id'];
         $Like = $record['Like'];
         $DisLike = $record['DisLike'];
         echo $record['Id'];
         
         

         
         
         
         
?>

    <div class='m-5 p-2' id="viewCommDiv"style="border: solid black 2px; ">
        <div  id="commentDiv">
            <?=$autor?>
            
            <span>Автор:</span> <?=$autor?>
            <br>
            <span> Дата: </span> <?=$Date?>
            <br>
            <p align=justify> <?=$Text?></p>
            <div>
                <p style="display:inline" >
                <span  id="countLike<?=$Id?>"><?=$Like?></span>
                </p>
                <img src="img/like.png" alt=""  style="width:30px; height:auto">

                
                <p style="display:inline">
                <span id="countDisLike<?=$Id?>"><?=$DisLike?></span>
                </p>
                <img src="img/dislike.png" alt=""  style="width:30px;  height:auto">
            </div>
            <div id="divCom">
<?php
    $sql = "SELECT * FROM comment WHERE IdRecord='".$record['Id']."'";
    $res = mysqli_query($conn,$sql);
    // $record= mysqli_fetch_assoc($result);
    while($rec= mysqli_fetch_assoc($res)){
?>
            <p ><?=$rec['Text']?></p>
<?php
    }
?>
            </div>
            <a href="viewItemRecord.php?Id=<?=$record['Id']?>" type="button" class="w-100 btn btn-success" data-toggle="modal" data-target="#commentModal">ДОДАТИ КОМЕНТАР</a>
        </div>
    </div>

<?php
    }
?>

<!-- Modal -->
    <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Додати коментар</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <input type="text" style="visibility:visible" id="IdRecord" value="<?=$record['Id']?>">
            <input type="text" style="visibility:hidden" id="IdAutor" value="<?=$_SESSION['IdAutor']?>">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Example textarea</label>
                <textarea class="form-control" id="textComment" rows="10" name='Text'></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ЗАКРИТИ</button>
            <button type="button" class="btn btn-primary" id="saveComment">ЗБЕРЕГТИ</button>
        </div>
        </div>
    </div>
    </div>














    

<?php
    require_once("footer.php");
?>

<script src="JS/addComment.js"></script>