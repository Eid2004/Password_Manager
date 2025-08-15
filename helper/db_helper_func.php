<?php
// Load the bootstrap file
require_once dirname(__DIR__) . '/config/config.php';


// Get database connection
$conn = require_once DB_PATH . 'db_connection.php';



/**
 * Insert data into the database tables
 * @param string tableName
 * @param array column of table
 * @param array values of column
 * @return true|false
 */
function insert(string $tableName, array $tableColumn, array $tableValues) :bool {
  global $conn;

  if (count($tableColumn) != count($tableValues)) {
    return false;
  }

  // Create placeholders for prepared statement
  $placeholders = str_repeat('?,', count($tableValues) - 1) . '?';
  $column = implode(', ', $tableColumn);

  $query = "INSERT INTO `$tableName`($column) VALUES($placeholders)";
  //Prepare and execute the statement
  $stmt = mysqli_prepare($conn, $query);
  if (!$stmt) {
    return false;
  }

  // Bind parameters
  $types = str_repeat('s', count($tableValues)); // All as strings for simplicity
  mysqli_stmt_bind_param($stmt, $types, ...$tableValues);
  $result = mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  return $result;
}


/**
 * Select data from database tables
 * @param string table name
 * @param array|string|Defult'*' column names
 * @param string|bool condition
 */
function select(string $tableName, array|string $columnName = '*', string|bool $condition = false) {
  global $conn;
  $quary = "";
  $name_of_column = '*';
  if ($columnName != '*') {
    $name_of_column = implode(', ', $columnName);
  }
  if ($condition === false || empty($condition)) {
    $quary = "SELECT $name_of_column FROM $tableName";
  } else {
    $quary = "SELECT $name_of_column FROM $tableName WHERE $condition";
  }
  $runQuery = mysqli_query($conn, $quary);
  $data = mysqli_fetch_all($runQuery,MYSQLI_ASSOC);
  return $data;
}


/**
 * Check if exist in data base table
 * @param string table name
 * @param string check
 * @return bool if exist return true else false
 */
function isExist(string $tableName, string $columnName, string $checkColumn, string $checkCondition): bool {
  global $conn;
  $exist = false;
  $query = "SELECT $columnName FROM $tableName WHERE $checkColumn='$checkCondition'";
  $runQuery = mysqli_query($conn, $query);
  if (mysqli_num_rows($runQuery)) {
    $exist = true;
  }
  return $exist;
}
