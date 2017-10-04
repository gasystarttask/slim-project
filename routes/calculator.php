<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../config/config.php';

$app = new \Slim\App(["settings" => $config]);
$container = $app->getContainer();
/* add logger */
$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler("../logs/app.log");
    $logger->pushHandler($file_handler);
    return $logger;
};

$app->post('/api/add', function(Request $request, Response $response){
   $this->logger->addInfo("adding two numbers");
   $a = $request->getParam('a');
   $b = $request->getParam('b');

   $sum = $a + $b;

   print '{ "answer":'.$sum.',"description":"Adding two integers" }';

});

$app->post('/api/sub', function(Request $request, Response $response){
   $this->logger->addInfo("substract two numbers");
   $a = $request->getParam('a');
   $b = $request->getParam('b');

   $sum = $a - $b;

   print '{ "answer":'.$sum.',"description":"Substract two integers" }';

});