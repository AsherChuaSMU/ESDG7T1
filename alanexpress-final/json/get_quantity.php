<?php

require_once '../include/common.php';
require_once '../include/protect.php';

$isbn13 = $_GET['isbn13'];

$dao = new BookDAO();
$book = $dao->retrieve($isbn13);

// Cannot locate book with ISBN, error state
if (empty($book)) {
  $message = "Cannot find book with ISBN13 of value [" . $isbn13 .  "]";
  $result = [
              "status"=>"error",
              "message"=>$message
          ];
} else {
// Book located, return quantity which is represented as availability in DB
  $result = [
              "status"=>"success",
              "quantity"=>$book->availability
          ];
}
        
header('Content-Type: application/json');
echo json_encode($result, JSON_PRETTY_PRINT);
 
?>
