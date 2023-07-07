<?php

$conn = mysqli_connect("localhost", "root", "", "cos");

if (!$conn) {
    echo "Connection Failed";
}