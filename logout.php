<?php
require_once(__DIR__ . '/user_session/index2.php');

UserLogic::signOut();
header('Location: index.php'); 
?>