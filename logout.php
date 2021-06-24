<?php
session_start();
session_unset();
session_destroy();

require "lib/constants.php";

header("Location: /CSE442-542/2021-Summer/cse-442c/start.php");
?>