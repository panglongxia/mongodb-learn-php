<?php
include dirname(__DIR__)."/vendor/autoload.php";
use Panglongxia\MongoTest\Mongo;
use Panglongxia\MongoTest\Helper\MongoHelper;


$id = MongoHelper::mongoId();
var_dump($id);
var_dump((string)$id);
$idStr = "5e703bc99b9c6d1b7254d6e1";

var_dump(date("Y-m-d H:i:s",$id->getTimestamp()));
var_dump(date("Y-m-d H:i:s",time()));
