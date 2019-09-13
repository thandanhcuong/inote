<?php

require_once 'DB.php';
$DB = new DB('localhost', 'root', '', 'inote');
$DB->connect();

echo $DB->update('notes', array('title' => '13456', 'body' => '123456'), " WHERE id_note = '1'");