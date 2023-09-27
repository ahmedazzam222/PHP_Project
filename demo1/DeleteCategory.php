<?php
include "dataBaseConnect.php";
$id = $_GET["id"];
$sql = "DELETE FROM categories WHERE id = $id";
if ($conn->query($sql)) {
  header("Location: categories.php?msg=Data_deleted_successfully");
} else {
  echo "Failed: " . $conn->error;
}
?>