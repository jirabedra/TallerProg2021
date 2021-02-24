<?php
require_once 'datos.php';
require_once 'doLogin.php';
dejarDeSerAdmin();
session_start();
session_destroy();
header('location:index.php');

