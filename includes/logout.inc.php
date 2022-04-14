<?php

session_start();
session_unset();
session_destroy();
header("Location: ../index.php");

//Yannick Makwenge - E-Commerce-Website