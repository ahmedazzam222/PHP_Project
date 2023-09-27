<?php
include "dataBaseConnect.php";
$id = $_GET["id"];
$sql1 = "SELECT image FROM Stores WHERE id = $id";
$result = $conn->query($sql1);
$row = $result->fetch_assoc();
$image = $row['image'];
$sql = "DELETE FROM Stores WHERE id = $id";



if ($conn->query($sql)) {
  unlink($image);
  header("Location: ShowStore.php?msg=Data deleted successfully");
  exit();
} else {
  echo "Failed: " . $conn->error;

}
?>