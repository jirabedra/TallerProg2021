<?php
require_once 'datos.php';
session_start();
session_destroy();
header('location:index.php');
