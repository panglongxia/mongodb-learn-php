<?php

namespace Panglongxia\MongoTest\Core;

class Connection
{
    public static $instance = null;


    private $config = [
        "user" => "panglongxia",
        "pass" => "panglongxia",
        "host" => "127.0.0.1",
        "port" => 27017,
        'dbname' => 'test'
    ];

    private $uriOptions = [];
    private $driverOptions = [];


    public function __construct($config = [])
    {
        if (!empty($config)) {
            $this->config = array_merge($this->config, $config);
        }
    }


    public function getUri()
    {
        return sprintf("mongodb://%s:%s@%s:%d/%s",
            $this->config['user'],
            $this->config['pass'],
            $this->config['host'],
            $this->config['port'],
            $this->getDbName()
        );
    }

    /**
     * @param $name //设置数据库名称
     */
    public function setDbName($name)
    {
        $this->config['dbname'] = $name;
    }

    /**
     * @return mixed 获取数据库名
     */
    public function getDbName()
    {
        return $this->config['dbname'];
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    public function setUriOptions(array $uriOptions)
    {
        $this->uriOptions = $uriOptions;
        return $this;
    }

    public function getUriOptions()
    {
        return $this->uriOptions;
    }

    public function setDriverOptions(array $options)
    {
        $this->driverOptions = $options;
        return $this;
    }

    public function getDriverOptions()
    {
        return $this->driverOptions;
    }


}