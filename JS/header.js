$(function(){
    $("#userLogin").click(function(){     // AJAX
        $.post('userLogin.php', {
           'Email': $('#Email').val(),   // дані з інпутів
           'Password': $('#Password').val()
        }, function(data, status){
            if (data == true) {
                $('#container-nav').load('container_nav.php #nav');        // id контейнера що треба перезавантажити
                 
            } else {
                alert('Невірний логін або пароль');
            }
            $('#LoginModal').modal('hide');
        })
    })

    $('#logOut').click(function(){
        $.get('logOut.php', function(){
            var locationUrl = location.href;
            locationUrl = locationUrl.split('/');    // розбиваєм стрічку на масив
            if (locationUrl[locationUrl.length-1] != 'index.php') {      // останній елемент масиву
                locationUrl[locationUrl.length-1] = 'index.php';
                window.location.href = locationUrl.join('/');          // зєднуємо масив в стрічку
            }
            $('#container-nav').load('container_nav.php #nav');
        })
    })
})