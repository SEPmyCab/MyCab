<?php

require_once 'application/views/pages/config.php';

?>


<html lang="en">
  <head>


    <title><?php echo PROJECT_NAME; ?></title>

    <!-- Bootstrap -->
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">

    <script src="./bootstrap/js/jquery-1.9.0.min.js"></script>
    <script src="./raty/jquery.raty.js" type="text/javascript"></script>
  </head>






<div class="row">
  <div class="panel panel-warning">
    <div class="panel-heading">
      <h3 class="panel-title">Welcome <?php echo $USER_NAME; ?>!</h3>
    </div>
  </div>


  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Driver Details</h3>
    </div>
    <div class="panel-body">

      <?php
 
      $sql = "SELECT * FROM `driver` WHERE 1 AND driver_id = :pid";
      try {

        $stmt = $DB->prepare($sql);
        $stmt->bindValue(":pid", intval($_GET["pid"]));
        $stmt->execute();

        $drivers = $stmt->fetchAll();
      } catch (Exception $ex) {
        echo $ex->getMessage();
      }


      $ratings_sql = "SELECT count(*) as count, AVG(rating_score) as score FROM `driver_ratings` WHERE 1 AND driver_id = :pid";
      $stmt2 = $DB->prepare($ratings_sql);

      try {
        $stmt2->bindValue(":pid", $_GET["pid"]);
        $stmt2->execute();
        $driver_rating = $stmt2->fetchAll();
      } catch (Exception $ex) {

        echo $ex->getMessage();
      }

      if (isset($USER_ID)) {

        $user_rating_sql = "SELECT count(*) as count FROM `driver_ratings` WHERE 1 AND driver_id = :pid AND user_id= :uid";
        $stmt3 = $DB->prepare($user_rating_sql);

        try {
          $stmt3->bindValue(":pid", $_GET["pid"]);
          $stmt3->bindValue(":uid", $USER_ID);
          $stmt3->execute();
          $user_driver_rating = $stmt3->fetchAll();
        } catch (Exception $ex) {

          echo $ex->getMessage();
        }
      }
      ?>

      <div class="col-sm-12">
        <div class="row">

          <?php
          if (count($drivers) > 0) {
            ?>
            <div class="col-sm-4">
              <a href="index.php/products?pid=<?php echo $drivers[0]["driver_id"] ?>">
 
                  <img src="<?php echo $drivers[0]["Photo"]; ?> " class="img-rounded" width="400px" height="400px" >
              
              </a>
            </div>
            <div class="col-sm-8">
              <div class="padding10 ntp">
                <h3 class="ntm">NIC  :<?php echo $drivers[0]["NIC"] ?></h3>
                <h3>Name :<?php echo $drivers[0]["LName"] ?></h3>

                <div id="avg_ratings">
                  <?php

                  if ($driver_rating[0]["count"] > 0) {
                    echo "Average rating <strong>" . round($driver_rating[0]["score"], 2) . "</strong> based on <strong>" . $driver_rating[0]["count"] . "</strong> users";
                  } else {
                    echo 'No ratings for this driver';
                  }
                  ?>
                </div>

                <?php

                if ($user_driver_rating[0]["count"] == 0) {
                  ?>  
                  <div class=" padding10 clearfix"></div>
                  <div id="rating_zone">

                    <div class="pull-left">

                      <div id="prd"></div>
                    </div>
                    <div class="pull-left">
                      <button class="btn btn-primary btn-sm" id="submit" type="button">submit</button>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <?php
                } else {
                  echo '<div class="padding20 nlp"><p><b>You have already rated this driver</b></p></div>';
                }
                ?>
                <div class="padding10 clearfix"></div>
                <a class="btn btn-info" href="index.php/rating"><span class="glyphicon glyphicon-chevron-left"></span> back to driver listing</a>
              </div>
            </div>
          <?php } else { ?>
            <div class="col-sm-12">
              <div class="padding20 nlp"><p><strike>No drivers found</strike></p></div>
            </div>
          <?php } ?>

        </div>

      </div>

    </div>
  </div>
</div>

<script>
  $(function() {
    $('#prd').raty({
      number: 5, starOff: './raty/img/star-off-big.png', starOn: './raty/img/star-on-big.png', width: 180, scoreName: "score",
    });
  });
</script>

<script>
  $(document).on('click', '#submit', function() {
<?php
if (!isset($USER_ID)) {
  ?>
      alert("You need to have a account to rate this driver?");
      return false;
<?php } else { ?>

      var score = $("#score").val();
      if (score.length > 0) {
        $("#rating_zone").html('processing...');
        $.post("update_ratings.php", {
          pid: "<?php echo $_GET["pid"]; ?>",
          uid: "<?php echo $USER_ID; ?>",
          score: score
        }, function(data) {
          if (!data.error) {
 
            $("#avg_ratings").html(data.updated_rating);
            $("#rating_zone").html(data.message).show();
          } else {

            $("#rating_zone").html(data.message).show();
          }
        }, 'json'
                );
      } else {
        alert("select the ratings.");
      }

<?php } ?>
  });
</script>
