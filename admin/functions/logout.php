<?php
include '../../database/connection.php';

session_start();
session_destroy();
header("Location: ../login");

exit();
