<?php

require_once("customers.php");

$coustomer = new Customer();

if(isset($_POST['action'])){
    switch ($_POST['action']) {
        case 'save':
            unset($_POST['action']);
            $result = $coustomer->saveCoustomer($_POST);
            echo $result;
            break;
        case 'select':
            $result = (!empty($_POST['id'])) ? $coustomer->getCoustomer($_POST['id']) :  $coustomer->getCoustomer();
            echo $result;
            break;
        case 'delete':
            $result = $coustomer->delete($_POST['id']);
            echo $result;
            break;
        
        default:
            # code...
            break;
    }
}else{
    echo json_encode(['status' => false, 'message' => 'Action is invalid!']);
}