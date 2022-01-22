<?php
require('vendor/autoload.php');
$my_env_var = getenv('EMAILUSERNAME', 'EMAILPASSWORD');
echo $my_env_var;