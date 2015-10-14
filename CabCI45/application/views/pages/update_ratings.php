<?php
require_once './config.php';

$pid = intval($_POST["pid"]);
$uid = intval($_POST["uid"]);
$score = intval($_POST["score"]);

$aResponse['error'] = FALSE;
$aResponse['message'] = '';
$aResponse['updated_rating'] = '';

$return_message = "";
$success = FALSE;

$sql = "INSERT INTO `driver_ratings` (`driver_id`, `user_id`, `rating_score`) VALUES "
        . "( :pid, :uid, :score)";
$stmt = $DB->prepare($sql);
try {

  $stmt->bindValue(":pid", $pid);
  $stmt->bindValue(":uid", $uid);
  $stmt->bindValue(":score", $score);
  $stmt->execute();
  $result = $stmt->rowCount();
  if ($result > 0) {
    $aResponse['message'] = "Your rating has been added successfully";
  } else {
    $aResponse['error'] = TRUE;
    $aResponse['message'] = "There was a problem updating your rating. Try again later";
  }
} catch (Exception $ex) {
  $aResponse['error'] = TRUE;
  $aResponse['message'] = $ex->getMessage();
}

if ($aResponse['error'] === FALSE) {

  $sql = "SELECT count(*) as count, AVG(rating_score) as score FROM `driver_ratings` WHERE 1 AND driver_id = :pid";
  try {
    $stmt = $DB->prepare($sql);
    $stmt->bindValue(":pid", $pid);
    $stmt->execute();
    $products = $stmt->fetchAll();

    if ($products[0]["count"] > 0) {

      $aResponse['updated_rating'] = "Average rating <strong>" . round($products[0]["score"], 2) . "</strong> based on <strong>" . $products[0]["count"] . "</strong> users";
    } else {
      $aResponse['updated_rating'] = '<strong>Ratings: </strong>No ratings for this driver';
    }
  } catch (Exception $ex) {

  }
}

echo json_encode($aResponse);
?>