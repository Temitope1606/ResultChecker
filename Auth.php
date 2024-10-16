<?php
ob_start();
session_start();
require_once("ResultChecker.php");

$rc = new ResultChecker("localhost", "root", "","ResultChecker");

$sql = "CREATE TABLE IF NOT EXISTS pin_table(
    sn INT AUTO_INCREMENT PRIMARY KEY,
    fullname text NOT NULL,
    email text NOT NULL,
    pin text NOT NULL,
    matric text NOT NULL,
    session text NOT NULL,
    semester int NOT NULL, 
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$resultTableSql = "CREATE TABLE IF NOT EXISTS results(
  sn INT AUTO_INCREMENT PRIMARY KEY not null,
  pin_id int NULL,
  email text NOT NULL,
  session text NOT NULL,
  semester int NOT NULL,
  course_title text NOT NULL,
  course_code text NOT NULL,
  unit int NOT NULL,
  exam_score float NOT NULL,
  test_score float NOT NULL,
  date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
 
  $rc->createTable($sql);
  $rc->createTable($resultTableSql);
 
?>