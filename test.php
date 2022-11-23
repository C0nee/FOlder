<?php
require_once("config.php");

$v = array(
    'testVariable' =>'wartosc Testu'
);
$twig -> display("test.html.twig", $v);
?>