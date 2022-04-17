<link href="css/googleapis.css" rel="stylesheet" />
<link href="css/mdb.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<?php
$connect = mysqli_connect("localhost", "root", "", "gym");
$query = "SELECT gender, count(*) as number FROM tbl_employee GROUP BY gender";
$result = mysqli_query($connect, $query);
?>

<div class="col-xl-6 col-lg-6">
     <div class="card shadow mb-4">
          <div class="card-body">
               <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
               </div>
               <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
               <script type="text/javascript">
                    google.charts.load('current', {
                         'packages': ['corechart']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                         var data = google.visualization.arrayToDataTable([
                              ['Gender', 'Number'],
                              <?php
                              while ($row = mysqli_fetch_array($result)) {
                                   echo "['" . $row["gender"] . "', " . $row["number"] . "],";
                              }
                              ?>
                         ]);
                         var options = {
                              title: 'Percentage of Male and Female Employee',
                              is3D:true,  
                              pieHole: 0.4
                         };
                         var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                         chart.draw(data, options);
                    }
               </script>

               <div class="container">
                    <div style="width:900px;">
                         <h3 align="center">Make Simple Pie Chart by Google Chart API with PHP Mysql</h3>
                         <br />
                         <div id="piechart" style="width: 900px; height: 500px;"></div>
                    </div>

               </div>
          </div>
     </div>
</div>




