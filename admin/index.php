<!DOCTYPE html>
<?php require_once("header.php");?> 
<?php require_once("NavBar.php");?>
<?php
// $datas = array();
// $result = mysqli_query($conn,"select id,Client_Id,Client_Name from Client");
$result = mysqli_query($conn,"SELECT project.Project_Name as project_name,count(project_schedule.id) as employee_count FROM `project_schedule` left join project on(project_schedule.Project_Name=project.Project_Name) group by project.Project_Name
");
 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
       <div id="piechart" style="width: 1360px; height: 540px;"></div>
</head>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          // ['TVS', 2],['sowmiya', 2],['ice', 2],
          <?php
          if($result->num_rows > 0){
              while($row = $result->fetch_assoc()){
                echo "['".$row['project_name']."',".$row['employee_count']."],";
                // echo "['asd', 2],";
              }
          }
          ?>
        ]);

        var options = {
          title: 'Project Wise Report'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
</script>
</html>
