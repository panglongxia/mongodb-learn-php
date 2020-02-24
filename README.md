### mongodb 测试
```
"php": "^7.0",
"ext-hash": "*",
"ext-json": "*",
"ext-mongodb": "^1.7"
```

下载 对应的php扩展包
https://pecl.php.net/package/mongodb
```
$ wget https://pecl.php.net/get/mongodb-1.7.1.tgz
$ cd mongodb-1.7.1
$ /usr/local/php/bin/phpize
$ ./configure --with-php-config=/usr/local/php/bin/php-config
$ make && make install

php.ini 中加入
extension=mongodb.so
```

下载第三方 mongodb 包
https://github.com/mongodb/mongo-php-library
文档：https://docs.mongodb.com/php-library/
```
 composer require mongodb/mongodb
```