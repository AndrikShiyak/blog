<?php 

    const solt = 'Hello World';

    function passwordHasher($password){
        return sha1(solt . $password . solt);
    }