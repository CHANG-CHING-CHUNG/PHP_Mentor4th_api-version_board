<?php
  include("config.php");
  header('Content-Type: application/json; charset=utf-8');
  if (isset($_GET["offset"])) {
    $offset = (int)$_GET["offset"];
  } else {
    $offset = 0;
  }
  function getCommentsByOffset($offset) {
    global $conn;

    $sql = "SELECT * FROM comments ORDER BY id DESC LIMIT 5 OFFSET $offset";
    $result = mysqli_query($conn, $sql);
    $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $cleaned = array();
    foreach($comments as $comment) {
      $cleaned[] = array_map("htmlspecialchars", $comment);
    }
    // print_r($cleaned);

    echo json_encode($cleaned);
  }
  getCommentsByOffset($offset);
?>