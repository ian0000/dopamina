<?php
require('vendor/autoload.php');
$my_env_var = getenv('EMAILUSERNAME');
echo $my_env_var;

$my_env_var = getenv('EMAILPASSWORD');
echo $my_env_var;