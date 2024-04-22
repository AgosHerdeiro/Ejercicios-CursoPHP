<?php

session_start();

session_destroy();
$_SESSION = array(); // pasándole un array vacío, es como reiniciarlo

header('Location: ../');
die();