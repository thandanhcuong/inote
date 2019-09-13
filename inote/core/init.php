<?php



//require_once '../classes/DB.php';
//require_once '../classes/Session.php';

require_once './classes/DB.php';
require_once './classes/Session.php';



$DB = new DB('localhost', 'root', '', 'inote');
$DB->connect();

$Session = new Session();
$Session->start();

// lay du dieu
$user = $Session->get();


// ner user ton tai => session vua sign-in or sign-up
if ($user){

   $data_user = $DB->fetch_assoc("SELECT * FROM users WHERE username = '$user'", 1);


}