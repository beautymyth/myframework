<?php

echo '<pre>';

//设置项目根目录
define('BASE_PATH', realpath(__DIR__ . '/../'));

//自动加载类
include __DIR__ . '/../framework/Loader.php';

//应用
$objApp = new Framework\Service\Foundation\Application(realpath(__DIR__ . '/../'));

//内核
$objKernel = $objApp->make(Framework\Service\Foundation\HttpKernel::class);

setcookie('UserInfo', json_encode(['user_id' => 1, 'user_name' => '小胖子']), time() + 3600, '/', 'beautymyth.cn');
//var_dump(ini_get('date.timezone'));
//var_dump(date('Y-m-d H:i:s', time() + 3600));
//2018-07-07T05:16:13.522Z
//http请求处理
$objResponse = $objKernel->handle();
//Cache::set('嘿嘿');
//var_dump(Cache::get());
//$objtest=$objApp->make(App\Service\test::class);
//$objtest->set('发送旅客登机');
//var_dump($objtest->get());
//$objApp->make(\App\Service\test::class);
//响应
//echo 'hello world' . time() . '<br>';
if (method_exists($objResponse, 'send')) {
    $objResponse->send();
}
