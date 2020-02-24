<?php

include dirname(__DIR__)."/vendor/autoload.php";
include "TestData.php";
use Panglongxia\MongoTest\Mongo;
use Panglongxia\MongoTest\Helper\MongoHelper;

$dataObj = TestData::instance();
$mongoInstance = Mongo::instance();
$collectionName = 'test';
$collection = $mongoInstance->getCollection($collectionName);

//
//$res = $collection->insertOne($dataObj->getData()); //会自动生成一个 _id
//var_dump((array)$res);

$data = $dataObj->getData();
$data['_id'] = MongoHelper::mongoId(); //自行生成_id
$res = $collection->insertOne($data);

$data = $dataObj->getData();
$data['_id'] = MongoHelper::mongoId();
$items = [
    $dataObj->getData(),
    $data
];
$res = $collection->insertMany($items); //批量插入


//外部传入bulk插入
$bulk = new \MongoDB\Driver\BulkWrite();
$bulk->insert($dataObj->getData());
$bulk->insert($dataObj->getData());
$bulk->insert($dataObj->getData());
$res = $mongoInstance->getMongoClient()->getManager()->executeBulkWrite(
    $mongoInstance->getConnection()->getDbName().'.'.$collectionName,$bulk);
var_dump((array)$res);