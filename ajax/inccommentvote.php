<?php

$result = [
  'data' => [],
  'error' => []
];

if (isset($_GET['id'])) {
  $commentId = $_GET['id'];

  $conn = new mysqli('localhost', 'root', '', 'based');

  if (mysqli_connect_error()) {
    array_push($result['error'], 'database connection failed.');
    die();
  }

  $sql = "UPDATE tbl_discussion_comment SET CommentVotes = CommentVotes + 1 WHERE CommentID = '$commentId';";
  $updateResult = $conn->query($sql);
  
  if ($conn->affected_rows > 0) {
    $selectResult = $conn->query("SELECT CommentVotes FROM tbl_discussion_comment WHERE CommentID = '$commentId'");
    if ($selectResult->num_rows > 0) {
      $row = $selectResult->fetch_assoc();
      $votes = $row['CommentVotes'];
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