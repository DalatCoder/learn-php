<?php

include('App/Authenticate/Authenticate.php');

session_start();

Authenticate::logout();

header('Location: /');
