<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->post('/api/add', function(Request $request, Response $response){
   $this->logger->addInfo("Add two numbers");
   $a = $request->getParam('a');
   $b = $request->getParam('b');

   $sum = $a + $b;

   print '{ "answer":'.$sum.',"description":"Add two numbers" }';

});

$app->post('/api/sub', function(Request $request, Response $response){
   $this->logger->addInfo("Substract two numbers");
   $a = $request->getParam('a');
   $b = $request->getParam('b');

   $sum = $a - $b;

   print '{ "answer":'.$sum.',"description":"Substract two numbers" }';

});

$app->post('/api/mul', function(Request $request, Response $response){
   $this->logger->addInfo("Multiply two numbers");
   $a = $request->getParam('a');
   $b = $request->getParam('b');

   $sum = $a * $b;

   print '{ "answer":'.$sum.',"description":"Multiply two numbers" }';

});