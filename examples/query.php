<?php

//https://dinghuiye.online/article/mongo-aggregate-statement

include dirname(__DIR__)."/vendor/autoload.php";
include "TestData.php";
use Panglongxia\MongoTest\Mongo;
use Panglongxia\MongoTest\Helper\MongoHelper;

$dataObj = TestData::instance();
$mongoInstance = Mongo::instance();
$collectionName = 'test';
$collection = $mongoInstance->getCollection($collectionName);

// ['projection'=>['username'=>1,'gender'=>1]] 指定需要查询的字段， 1 显示，0 排除
//$res = $collection->findOne(['gender'=>1],['projection'=>['days'=>0,'content'=>0]]); //查询一条数据
//var_dump(MongoHelper::toArray($res));
//
//$res = $collection->find()->toArray();
//var_dump(count($res));

// in 查询
//$filter = [
//    'gender'=>['$in'=>[1,0]],
//    'days'=>['$in'=>['2020-01-01']]
//];
//$options = [
//    'projection'=>['days'=>1,'gender'=>1],
//];
//$res = $collection->find($filter, $options)->toArray();
//var_dump(count($res));
//var_dump($res);


// 排序
//$filter = [
//];
//$options = [
//    'projection'=>['gender'=>1],
//    'sort' => ['gender'=>1], //根虎 gender 排序， 1 升序，-1降序
//    'skip' => 3, // offset
//    'limit' => 2 //kimit
//];
//$res = $collection->find($filter, $options)->toArray();
//
//var_dump($collection->count());

//
//$options = [
//    'projection'=>['gender'=>1],
//    'sort' => ['gender'=>1], //根虎 gender 排序， 1 升序，-1降序
//];
//$res = $collection->find([],$options)->toArray();

//select * from test where (type>=7 or type <= 1) and (gender=0 and ('username'='1582380858778266' or 'username'='1582380858778355'))
//$filter = [
//    '$or'=>[['type'=>['$gte'=>7]],['type'=>['$lte'=>1]]],
//    '$and'=>[['gender'=>0],['$or'=>[['username'=>'1582380858778266'],['username'=>'1582380858778355']]]]
//];
//$res = $collection->find($filter)->toArray();
//var_dump(MongoHelper::toArray($res));


// 模糊查询
//select gender,title from test where title like '%我不打野%' limit 0,5 order by gender asc
//$filter = [
//    'title'=>['$regex'=>'我不打野']
//];
//$options = [
//    'projection'=>['gender'=>1,'title'=>1],
//    'sort' => ['gender'=>1], //根据gender 排序， 1 升序，-1降序
//    'skip' => 0,
//    'limit' => 5
//];
//$res = $collection->find($filter, $options)->toArray();
//var_dump(MongoHelper::toArray($res));

$pipe = [
    ['$match'=>$filter],
//    ['$sort' =>['gender'=>1]],
];

$res = MongoHelper::toArray($collection->aggregate($pipe));






//select type,username,count(*) as count,sum(`type`) as `type_sum` from `test` where type>=3 group by `gender`;
$filter = [
];
$options = [
    'projection'=>['gender'=>1],
    'sort' => ['gender'=>1], //根据gender 排序， 1 升序，-1降序
];

$pipe = [
    ['$match'=>['type'=>['$gte'=>4]]],
    ['$group'=>['_id'=>['gender'=>'$gender'],'count'=>['$sum'=>1],'type_sum'=>['$sum'=>'$type']]],
    ['$project'=>['gender'=>'$_id.gender','type_sum'=>'$type_sum','count'=>'$count']]
];

$res = $collection->aggregate($pipe);
var_dump(MongoHelper::toArray($res));