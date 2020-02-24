<?php


include dirname(__DIR__)."/vendor/autoload.php";
include "TestData.php";
use Panglongxia\MongoTest\Helper\MongoHelper;
use Panglongxia\MongoTest\Mongo;

$mongoInstance = Mongo::instance();
$collectionName = 'test';
$collection = $mongoInstance->getCollection($collectionName);
//$res = $collection->updateOne(['_id'=>MongoHelper::mongoId('5e50d5a48966b862f25e2cf2')],['$set'=>['gender'=>3]]);
//var_dump((array)$res);
//
//$res = $collection->updateOne(['type'=>10],['$set'=>['gender'=>5]]); //即使多条数据满足条件，也只会修改满足条件的第一条
//var_dump((array)$res);
//
//$res = $collection->updateMany(['type'=>10],['$set'=>['gender'=>6]]); //满足条件的都会修改
//var_dump((array)$res);

//$bulk = new \MongoDB\Driver\BulkWrite();
//$bulk->update(['type'=>0],['$set'=>['gender'=>5]]);//这里如果不加上 $set 其他字段将会清空
//$res = $mongoInstance->getMongoClient()->getManager()->executeBulkWrite(
//    $mongoInstance->getConnection()->getDbName().'.'.$collectionName,$bulk);
//var_dump((array)$res);



//$res = $collection->deleteOne(['gender'=>6]);//即使多条数据满足条件，也只会删除满足条件的第一条
//var_dump((array)$res);
//$res = $collection->deleteMany(['gender'=>2]);//满足条件的删除
//var_dump((array)$res);