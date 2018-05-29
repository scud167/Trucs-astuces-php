<?php
class Voiture{
    var $marque;
    var $nbRoues;

    function showMarque(){
        echo "marque :".$this->marque;
    }
}

/*Instance*/
$v= new Voiture();
$v->marque = "Hyundai";
$v->showMarque();

$v= new Voiture();
$v->marque = "Peugeot";
$v->showMarque();
?>