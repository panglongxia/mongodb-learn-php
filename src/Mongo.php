<?php

namespace Panglongxia\MongoTest;

use MongoDB\Client as MongoDBClient;
use Panglongxia\MongoTest\Core\Connection;

class Mongo
{

    protected static $instance = null;

    /**
     * @var Connection
     */
    protected $connection = null;

    /**
     * @var MongoDBClient
     */
    protected $mongoClient = null;


    public static function instance()
    {
        if (self::$instance == null) {
            self::$instance = new static();
            self::$instance->setConnection(new Connection());
        }
        return self::$instance;
    }

    /**
     * @param Connection $connection
     * 重置连接
     */
    public function setConnection(Connection $connection)
    {
        $this->connection = $connection;
        $this->mongoClient = new MongoDBClient(
            $this->connection->getUri(),
            $this->connection->getUriOptions(),
            $this->connection->getDriverOptions()
        );
    }

    public function getConnection()
    {
        if ($this->connection == null) {
            $this->setConnection(new Connection());
        }
        return $this->connection;
    }

    /**
     * @param array $uriOptions
     * @param array $driverOptions
     * 重置
     */
    public function resetMongoClient($uriOptions = [], $driverOptions = [])
    {
        $this->mongoClient = new MongoDBClient($uriOptions, $driverOptions);
    }

    /**
     * @return MongoDBClient
     */
    public function getMongoClient()
    {
        return $this->mongoClient;
    }

    /**
     * @param $collectionName
     * @return \MongoDB\Collection
     */
    public function getCollection($collectionName)
    {
        return $this->mongoClient->selectCollection($this->getConnection()->getDbName(), $collectionName);
    }

}