<?php
define('HOST', 'localhost:3306');
define('USUARIO', 'root');
define('SENHA', '');
define('DB', 'bd_login');

$conexao= mysqli_connect(HOST,USUARIO,SENHA,DB) or die ("não foi possivel conectar no servidor");
