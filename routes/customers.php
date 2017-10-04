<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

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

   echo json_encode($res);
});

// Get Single Customer
$app->get('/api/customer/{id}', function(Request $request, Response $response){
  $this->logger->addInfo("Get customer by iD");
  $id = $request->getAttribute('id');
  $mapper = new CustomerMapper($this->db);
  $customer = $mapper->getCustomerById($id);

  if($customer === null) {
    die('{"notice": {"text": "customer id not exist."}}');
  }

  $res = array (
            "id" => $customer->getId(),
            "first_name" => $customer->getFirstName(),
            "last_name" => $customer->getLastName(),
            "phone" => $customer->getPhone(),
            "email" => $customer->getEmail(),
            "address" => $customer->getAddress(),
            "city" => $customer->getCity(),
            "state" => $customer->getState()
        );
  echo json_encode($res);
});