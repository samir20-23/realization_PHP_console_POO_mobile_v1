<?php 
require('../DataAcssec/bookDAO.php');
class Service{
    public function getData(){
$databaseClass = new DataDAO();
return $databaseClass->getData();
    }
    public function setData($data){
        $databaseClass = new DataDAO();
        $databaseClass->setData($data);
    }
}
 ?>