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

/* add PDO */
$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

$app->get('/api/customers', function(Request $request, Response $response){
   $this->logger->addInfo("Customer list");
    $mapper = new CustomerMapper($this->db);
    $customers = $mapper->getCustomers();
    $res = null;
    foreach ($customers as $customer) {
        $res[] = array (
            "id" => $customer->getId(),
            "first_name" => $customer->getFirstName(),
            "last_name" => $customer->getLastName(),
            "phone" => $customer->getPhone(),
            "email" => $customer->getEmail(),
            "address" => $customer->getAddress(),
            "city" => $customer->getCity(),
            "state" => $customer->getState()
        );
    }

   echo json_encode($res[0]);
});