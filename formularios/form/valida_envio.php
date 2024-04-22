<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo "Se enviaron por GET";
} else {
    echo "Se enviaron por POST";
}
//
//if (isset($_POST['sumbit'])) {
//    echo "Se han enviado los datos correctamente";
//    print_r($_POST['sumbit']);
//}