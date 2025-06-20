<?php

$connection = mysqli_connect("localhost", "root", "", "project");

if (!$connection) {
    echo "Unable to connect";
    die;
}
