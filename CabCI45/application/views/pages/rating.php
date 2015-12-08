<?php

require_once 'application/views/pages/config.php';
?>

<div id="wrapper"> 
   


<div class="row">

  <div class="panel panel-primary">
    <div class="panel-heading">
 
      <h3 class="panel-title">Welcome <?php echo $USER_NAME; ?>!</h3>
    </div>
 
  </div>


  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Rate Our Drivers</h3>
    </div>
    <div class="panel-body">

      <?php
      $sql = "SELECT * FROM `driver` WHERE 1";
      try {
        $stmt = $DB->prepare($sql);
        $stmt->execute();
        $drivers = $stmt->fetchAll();
      } catch (Exception $ex) {
        echo $ex->getMessage();
      }


      $ratings_sql = "SELECT count(*) as count, AVG(rating_score) as score FROM `driver_ratings` WHERE 1 AND driver_id = :pid";
      $stmt2 = $DB->prepare($ratings_sql);

      for ($i = 0; $i < count($drivers); $i++) {

        try {
          $stmt2->bindValue(":pid", $drivers[$i]["driver_id"]);
          $stmt2->execute();
          $product_rating = $stmt2->fetchAll();
        } catch (Exception $ex) {

          echo $ex->getMessage();
        }
        ?>
        <div class="col-sm-3 adjustdiv">
          <a href="index.php/products?pid=<?php echo $drivers[$i]["driver_id"] ?>">
              
                
            <img src="<?php echo $drivers[$i]["Photo"]; ?> "  >
          </a>
          <div class="textContainer caption" >
            <div class="row">
              <div class="col-lg-12 prdname"><?php echo $drivers[$i]["LName"] ?><span style="color: #000;"> - </span><span class="prdprice"><?php echo $drivers[$i]["NIC"] ?></span></div>
            </div>
            <div class="row padding5 nlp nrp">
              <div class="col-lg-12">
                <?php
                if ($product_rating[0]["count"] > 0) {
                  echo "Average rating <strong>" . round($product_rating[0]["score"], 2) . "</strong> based on <strong>" . $product_rating[0]["count"] . "</strong> users";
                } else {
                  echo 'No ratings for this product';
                }
                ?>
              </div>
            </div>
          </div>
        </div>
                <?php } ?>     

    </div>
  </div>

</div>
