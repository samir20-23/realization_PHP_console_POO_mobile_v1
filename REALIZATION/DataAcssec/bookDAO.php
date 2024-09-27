<?php
require('../DB/DataBase.php');
class DataDAO{
     public function getData(){
$classDataBase  = new DataBase();
return $classDataBase ->array;
     }
     public function setData($data){
          $classDataBase  = new DataBase();
          $classDataBase->array [] = $data;
          $classDataBase->save();
     }
}
?>