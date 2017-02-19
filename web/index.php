<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

$app = (new yii\web\Application($config));

if(!Yii::$app->user->isGuest){
    $user = Yii::$app->user->identity;
    $config['components'] ['db'] =[
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=127.0.0.1;dbname='.$user->getIdEmpresa()->one()->db_name,
        'username' => $user->getIdEmpresa()->one()->db_username,
        'password' => $user->getIdEmpresa()->one()->db_password,
        'charset' => 'utf8'
    ];

    //die(Yii::$app->get('db'));
}

(new yii\web\Application($config))->run();
