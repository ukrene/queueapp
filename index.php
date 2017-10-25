<?php
	include 'dbh.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Q-Up v.0.1</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
  	//jQuery code here!
  	$(document).ready(function() {

      $("form").on("submit", function(event){
        event.preventDefault();
        var service = $( "input[type=radio][name=service]:checked" ).val();
        var oname = $("#oname").val();
        var title = $("#title").val();
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        
  			$("#list").load("load-list.php", {
  				service: service,
          oname: oname,
          title: title,
          fname: fname,
          lname: lname
  			});
        $("#oname").val("");
        $("#fname").val("");
        $("#lname").val("");
      });
    });
  </script>
</head>
<body>
<?php $services = array("Housing", "Benefits", "Council Tax", "Fly-tipping", "Missed Bin"); ?>
<img class=" logo" src="logo.png">

<div class="container">
  <div class="row">
    <div class="col-xs-12 col-md-4 col-lg-4">
      <h2 style="">New Customer</h2>
      <form class="">
        <label>Services</label>
        <div class="row radio">
        <?php foreach ($services as $key => $value) { ?>
          <div class="col-xs-6 col-md-6 col-lg-6">
            <label><input type="radio" name="service" value="<?php echo $value;?>" required> <?php echo $value;?></label>
          </div>
        <?php } ?>
        </div>

        <ul class="nav nav-pills">
          <li class="active"><a data-toggle="pill" href="#citizen">Citizen</a></li>
          <li><a data-toggle="pill" href="#org">Organisation</a></li>
          <li><a data-toggle="pill" href="#ano">Anonymous</a></li>
        </ul>

        <div class="tab-content">
          <div id="citizen" class="tab-pane fade in active">

              <div class="form-group">
                <label>Title</label>
                <select class="form-control" id="title">
                  <option value="Mr.">Mr.</option>
                  <option value="Mrs.">Mrs.</option>
                  <option value="Ms">Ms.</option>
                </select>
              </div>
              <div class="form-group">
                <label>First Name</label>
               <input type="text" class="form-control" id="fname" placeholder="First Name">
              </div>
              <div class="form-group">
                <label>Last Name</label>
               <input type="text" class="form-control" id="lname" placeholder="Last Name">
              </div>

          </div>
          <div id="org" class="tab-pane fade">

              <div class="form-group">
                <label>Organisation</label>
               <input type="text" class="form-control" id="oname" placeholder="Name">
              </div>

          </div>
          <div id="ano" class="tab-pane fade">
          </div>
        </div>

        <button type="submit" class="btn btn-xl">Submit</button>
      </form>
    </div>
    <div class="col-xs-12 col-md-8 col-lg-8">
      <h2>Queue</h2>
      <form>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Type</th>
              <th>Name</th>
              <th>Service</th>
              <th>Queued at</th>
            </tr>
          </thead>
          <tbody id="list">
            	<?php
            		$sql = "SELECT * FROM customers";
            		$result = mysqli_query($conn, $sql);
            		if (mysqli_num_rows($result) > 0) {
            			while ($row = mysqli_fetch_assoc($result)) {
            				echo "<tr><td>";
            				echo $row['id'];
            				echo "</td><td>";
            				echo $row['type'];
            				echo "</td><td>";
                    echo $row['name'];
            				echo "</td><td>";
                    echo $row['service'];
            				echo "</td><td>";
                    echo $row['queued'];
            				echo "</td></tr>";
            			}
            		} else {
            			echo "There are no customers!";
            		}
            	?>
          </tbody>
        </table>
      </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>
