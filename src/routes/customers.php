<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


$app = new \Slim\App;

//Get all customers
$app->get('/api/customers', function(Request $request, Response $response) {
   $sql = "SELECT * FROM customers";
   try{
      //Get DB object
      $db = new db();
      //Connect
      $db = $db->connect();

      $stmt = $db->query($sql);
      $customers = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db =null;
      echo json_encode($customers);

   }catch(PDOException $err){
      echo '{ "error": { "text": '.$err->getMessage().' } }';
   }

});

//Get single customer
$app->get('/api/customer/{id}', function(Request $request, Response $response) {
   $id = $request->getAttribute('id');

   $sql = "SELECT * FROM customers WHERE id = $id";
   try{
      //Get DB object
      $db = new db();
      //Connect
      $db = $db->connect();

      $stmt = $db->query($sql);
      $customer = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db =null;
      echo json_encode($customer);

   }catch(PDOException $err){
      echo '{ "error": { "text": '.$err->getMessage().' } }';
   }
});

//Update customer
$app->put('/api/customer/update/{id}', function(Request $request, Response $response) {
   $id = $request->getParam('id');
   $first_name = $request->getParam('first_name');
   $last_name = $request->getParam('last_name');
   $phone = $request->getParam('phone');
   $email = $request->getParam('email');
   $address = $request->getParam('address');
   $city = $request->getParam('city');
   $state = $request->getParam('state');

   $sql = "UPDATE customers SET
            first_name = :first_name,
            last_name = :last_name,
            phone = :phone,
            email = :email,
            address = :address,
            city = :city,
            state = :state
         WHERE id = $id";

   try{
      //Get DB object
      $db = new db();
      //Connect
      $db = $db->connect();

      $stmt = $db->prepare($sql);
      $stmt->bindParam(':first_name',  $first_name);
      $stmt->bindParam(':last_name',   $last_name);
      $stmt->bindParam(':phone',       $phone);
      $stmt->bindParam(':email',       $email);
      $stmt->bindParam(':address',     $address);
      $stmt->bindParam(':city',        $city);
      $stmt->bindParam(':state',       $state);

      $stmt->execute();

      echo'{"message": { "text": "Customer Updated"}';


   }catch(PDOException $err){
      echo '{ "error": { "text": '.$err->getMessage().' }';
   }
});

//Add a customer
$app->post('/api/customer/add', function(Request $request, Response $response) {

   $first_name = $request->getParam('first_name');
   $last_name = $request->getParam('last_name');
   $phone = $request->getParam('phone');
   $email = $request->getParam('email');
   $address = $request->getParam('address');
   $city = $request->getParam('city');
   $state = $request->getParam('state');

   $sql = "INSERT INTO customers (first_name,last_name,phone,email,address,city,state) VALUES (:first_name,:last_name,:phone,:email,:address,:city,:state)";

   try{
      //Get DB object
      $db = new db();
      //Connect
      $db = $db->connect();

      $stmt = $db->prepare($sql);
      $stmt->bindParam(':first_name',  $first_name);
      $stmt->bindParam(':last_name',   $last_name);
      $stmt->bindParam(':phone',       $phone);
      $stmt->bindParam(':email',       $email);
      $stmt->bindParam(':address',     $address);
      $stmt->bindParam(':city',        $city);
      $stmt->bindParam(':state',       $state);

      $stmt->execute();

      echo'{"message": { "text": "Customer Added"}';


   }catch(PDOException $err){
      echo '{ "error": { "text": '.$err->getMessage().' }';
   }
});

//Delete customer
$app->delete('/api/customer/delete/{id}', function(Request $request, Response $response) {
   $id = $request->getAttribute('id');

   $sql = "DELETE FROM customers customers WHERE id = $id";
   try{
      //Get DB object
      $db = new db();
      //Connect
      $db = $db->connect();

      $stmt = $db->prepare($sql);
      $stmt->execute();
      $db =null;
      echo'{"message": { "text": "Customer Deleted"}';

   }catch(PDOException $err){
      echo '{ "error": { "text": '.$err->getMessage().' } }';
   }
});
