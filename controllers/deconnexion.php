<?php

unset($_SESSION['client']);

session_destroy();

header('location:index.php');

