<?php

$result = [
  'data' => [],
  'error' => []
];

if (isset($_GET['id'])) {
  $questionId = $_GET['id'];

  $conn = new mysqli('localhost', 'root', '', 'based');

  if (mysqli_connect_error()) {
    array_push($result['error'], 'database connection failed.');
    die();
  }

  $sql = "UPDATE tbl_discussion SET Votes = Votes - 1 WHERE ID = '$questionId';";
  $updateResult = $conn->query($sql);
  
  if ($conn->affected_rows > 0) {
    $selectResult = $conn->query("SELECT Votes FROM tbl_discussion WHERE ID = '$questionId'");
    if ($selectResult->num_rows > 0) {
      $row = $selectResult->fetch_assoc();
      $votes = $row['Votes'];
      array_push($result['data'], $votes);
    } else {
      array_push($result['error'], 0);
      array_push($result['error'], 'select failed..');
    }
  } else {
    array_push($result['error'], 'update failed.');
  }
} else {
  array_push($result['error'], 'operation failed.');
}

echo json_encode($result);