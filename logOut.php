<?php
   session_start();
   session_unset();  // обнулити дані
   session_destroy();  // знищити сесію
   header ('Location: index.php');