$(function(){
    $("#saveComment").click(function(){
        
        $.post("saveComment.php", {
            'IdRecord': $('#IdRecord').val(),
            'IdAutor': $('#IdAutor').val(),
            'Text': $('#textComment').val()
            
        }, function(data, status){
            
            // $('#newComment').text(data);
            
        })
        $("#commentModal").modal('hide');
        $("#viewCommDiv").load("viewItemRecord.php #commentDiv");
    })

    
})