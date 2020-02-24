<?php
include dirname(__DIR__)."/vendor/autoload.php";
include "TestData.php";
use Panglongxia\MongoTest\Mongo;
use Panglongxia\MongoTest\Helper\MongoHelper;


class TestQuery{
    //准备数据
   public function prepareData(){
       $dataObj = TestData::instance();
       $collection = Mongo::instance()->getCollection('test');
       //插入100万条数数据，用于测试索引
        for ($i=0; $i<10000; $i++){
            $data = [];
            for ($j=0;$j<100;$j++){
                $data[] = $dataObj->getData();
            }
           $collection->insertMany($data);
            var_dump("success:".$i);
        }
   }

    //打印索引
   private function dumpIndexes(\MongoDB\Collection $collection){
       $listIndex = $collection->listIndexes();
       foreach ($listIndex as $indexInfo) {
           var_dump($indexInfo);
       }
   }

   public function demoUnique(){
        $collection = Mongo::instance()->getCollection('test');
        $filter = ['username' => '1582510537068657'];
        //$res = $collection->findOne($filter);
        //$findOne = new \MongoDB\Operation\FindOne($collection->getDatabaseName(),$collection->getCollectionName(),$filter);
        //$res = $collection->explain($findOne); //耗时：executionTimeMills:465 , stage:COLLSCAN 全表扫描

        //加上唯一索引
       //$res = $collection->createIndex(['username'=>1],['unique'=>true]);
        $findOne = new \MongoDB\Operation\FindOne($collection->getDatabaseName(),$collection->getCollectionName(),$filter);
        $res = $collection->explain($findOne); //
        var_dump(MongoHelper::toArray($res));
   }

   public function demoNullUnique(){
       $collection = Mongo::instance()->getCollection('test');
       $filter = ['tel' => '1582524322908005'];
       //$res = $collection->findOne($filter);
       //$this->varDump($res);
       //$findOne = new \MongoDB\Operation\FindOne($collection->getDatabaseName(),$collection->getCollectionName(),$filter);
       //$res = $collection->explain($findOne);//executionTimeMillis:465   stage:COLLSCAN

       //手机号允许为空 , 加 稀疏 唯一索引，这里踩了个坑，是手机号不存在，就是没有值，而不是为null或者空字符串
       //$collection->createIndex(['tel'=>1],[ 'sparse'=>true,'unique'=>true]);

        //$res = $collection->findOne($filter);
       // $findOne = new \MongoDB\Operation\FindOne($collection->getDatabaseName(),$collection->getCollectionName(),$filter);
        //$res = $collection->explain($findOne);// executionTimeMillis:0 , stage:FETCH
       $res = $collection->findOne($filter);
       $this->varDump($res);
   }


   public function demoFind(){
       //gender[0-2],type[0-10]
       $collection = Mongo::instance()->getCollection('test');

       $options = [
           'projection'=>['gender'=>1,'type'=>1],
           'skip'=>100,
           'limit' =>10
       ];
//       $filter = [
//           'gender'=>['$lt'=>1],
//           'type' => ['$gt'=>8]
//       ];

        $filter = [
            'gender' => 1,
            'type' => 8
        ];
       //加上索引 ， 创建2个索引，字段一样，顺序不一样
       //$collection->createIndex(['gender'=>1,'type'=>1]); // gender_1_type_1
       //$collection->createIndex(['type'=>1, 'gender'=>1]); //type_1_gender_1
       //die;

       //$res = $collection->find($filter, $options);
       //die;
       $options['hint'] = 'gender_1_type_1';
       $find = new \MongoDB\Operation\Find($collection->getDatabaseName(),$collection->getCollectionName(),$filter,$options);
       $res = $collection->explain($find,['verbosity'=>'executionStats']);
       $this->varDump($res);
   }

   public function demoFind1(){
       $collection = Mongo::instance()->getCollection('test');
       $options = [
           'projection'=>['gender'=>1,'type'=>1],
           'skip'=>100,
           'limit' =>10,
           'order'=>['time'=>-1]
       ];

       //https://blog.fundebug.com/2018/09/19/18-principle-to-improve-mongodb-performance/
       //filter 不用考虑顺序。相对于索引也要遵循靠左原则，即filter 里的条件 包含 组合索引的最左边边那个
       $filter = [
           'type' => ['$in'=>[1,2,3,4,5,6,7,8,9,10]],
           'gender' => 1,
           'time' => ['$lt' => 1582524283],
       ];
//       $options['hint'] = 'type_1_gender_1_time_-1';
//       $collection->createIndex(['type'=>1,'gender'=>1,'time'=>-1]);
//       $collection->createIndex(['time'=>-1]); //时间建立倒序索引
       //$collection->createIndex(['time'=>1]); //时间建立正序索引


       //$res = $collection->find($filter, $options);

        $find = new \MongoDB\Operation\Find($collection->getDatabaseName(),$collection->getCollectionName(),$filter,$options);
       $res = $collection->explain($find,['verbosity'=>'executionStats']);
       $this->varDump($res);


   }


   public function varDump($ret){
       var_dump(MongoHelper::toArray($ret));
   }

}

$obj = new TestQuery();
//$obj->prepareData();
//die;
$obj->demoFind1();
//$obj->demoNullUnique();

