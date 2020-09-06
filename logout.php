<?php
/** @noinspection ALL */
session_start();
	session_unset($_SESSION['user']);
	session_destroy();
	header('location: index.php');
