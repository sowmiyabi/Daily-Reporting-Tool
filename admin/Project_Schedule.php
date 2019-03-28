<?php require_once("header.php");?>
<body>
<?php require_once("NavBar.php");

	
if (isset($_REQUEST['Submit'])) 
{
 echo "<script>alert('email.....');</script>";
   $qry=mysqli_query($conn,"select ifnull(max(Id),10) from Project_Schedule");
   list($id)=mysqli_fetch_array($qry);
   $id = $id+1;
   $Project_Schedule_Id = "Project_Schedule_".$id;

$qer="insert into Project_Schedule set Id='".$id."',Project_Schedule_Id='".$Project_Schedule_Id."' , Project_Name='".inp('Project_Name')."',Employee_Name='".inp('Employee_Name')."' , Technology='".inp('Technology')."', Activity='".inp('Activity')."' , Duration='".inp('Duration')."' ";
  if(mysqli_query($conn,$qer))
  {
          $flag=1;
		  $sqll = "update Employee SET flag='".$flag."' where  Employee_Name = '".inp('Employee_Name')."'";
		  mysqli_query($conn,$sqll);
		  
		//    $qry2 = mysqli_query($conn,"update Client set flag='1' where Project_Name='".inp('Project_Name')."'");
 // mysqli_fetch_array($qry2);
  
  
   $sqllie = "update project SET flag_allocate='1' where  Project_Name = '".inp('Project_Name')."'";
		  mysqli_query($conn,$sqllie);
  
  
          header("Location:Project_Schedule.php");
  }
   else
   { 
      die("Error : ".mysqli_error($conn));
   }
   

	$qry_mail="select * from employee where Employee_Name='".$_REQUEST['pns']."'";
     $res_mail = mysqli_fetch_array($qry_mail);
	 while($fthmail=mysqli_fetch_array($res_mail)) 
	 {
		 $to=$fthmail['Email'];
		
   
	 }

  // $to = $email;
 // $to="nklvijay@gmail.com";
 $to=inp('Email');
$subject = "Project Allocation";
$txt = "The project has been Allocated...Project Name :".inp('Project_Name');
$headers = "From: dailyreportingtools@gmail.com" . "\r\n";

if(mail($to,$subject,$txt,$headers))
	echo "Email Sent...";
else
	echo "note sent";
   
   
}
$Project_Id = inp('Edit');

if(isset($_REQUEST['Edit']))
{
  $qry = mysqli_query($conn,"select * from Project_Schedule where Project_Schedule_Id='".$Project_Schedule_Id."'");
        $res = mysqli_fetch_array($qry);
}

if(isset($_REQUEST['Update']))
{
  $Project_Schedule_Id = inp('Project_Schedule_Id');

$qry="update Project_Schedule set Project_Name='".inp('Project_Name')."', Client_Name='".inp('Client_Name')."' , Technology='".inp('Technology')."', Duration='".inp('Duration')."' where  Project_Schedule_Id='". $Project_Schedule_Id."'";
   if(mysqli_query($conn,$qry))
      header("Location:Project_Schedule");
   else
      die("Error : ".mysqli_error($conn));
}




?>

    <div class="container-fluid">
        <div class="container" id="heading">
        <h4><?php echo (isset($_REQUEST['Edit'])) ? 'Update Project' : 'Project scheduling & Allocation' ?></h4>        
        </div> 
    </div>
	
    <div class="container" id="content">
        <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              
		<?php echo $res['Project_Name']; ?>
               <div class="col-sm-2">
			   
			   <form action="Project_Schedule.php" name="project_se_dro" id="project_se_dro" method="get">
               <?php 
                  $qry="select * from project";
                  $exe=mysqli_query($conn,$qry);
               ?>
                <select required name="Project_Name" id="Project_Name" class="form-control" onchange="disp();">
                <option value="">--Select Project--</option>
                <?php while($fth=mysqli_fetch_array($exe)) { 
                 
                    ?>
					  <?php
                   
					 if(isset($_REQUEST['pn']) && $_REQUEST['pn'] == $fth['Project_Name'])
					 {
						 $s ="selected";
					 }
					 else
					 {$s='';
					 }
                    ?>
                      <option <?php echo $s; ?> value="<?php echo $fth['Project_Name'] ;?>"><?php echo $fth['Project_Name']; ?></option>
				
					
                  
				       
                
					
					
                    <?php
                  
                  ?>
                <?php }?>
                </select>
				</form>
			
				
				
				</script> 	
			
		<?php  if (isset($_REQUEST['pn'])) 
				{
					$qry2="select * from project where Project_Name='".$_REQUEST['pn']."'";
						$exe1=mysqli_query($conn,$qry2);	
				}

				$fthe=mysqli_fetch_array($exe1);
					

			 ?>
	
       <?php  if (isset($_REQUEST['pn'])) 
{
 $qry="select * from employee where Technical_Skills='".$fthe['Technology']."' and flag='0'";
 $exe1=mysqli_query($conn,$qry);	
}?>
                      <select  required name="Employee_Name" id="Employee_Name" class="form-control" onchange="disp();">
                <option value="">--Select Employee--</option>
                <?php while($fth1=mysqli_fetch_array($exe1)) { 
                  
                    ?>
					  <?php
                   
					 if(isset($_REQUEST['pns']) && $_REQUEST['pns'] == $fth1['Employee_Name'])
					 {
						 $st ="selected";
					 }
					 else
					 {$st='';
					 }
                    ?>
                      <option <?php echo $st; ?> value="<?php echo $fth1['Employee_Name'] ;?>"><?php echo $fth1['Employee_Name']; ?></option>
				
					
                  
				       
                
					
					
                    <?php
                  
                  ?>
                <?php } ?>
                </select>
              
				
               </div>
			   
			<?php  if (isset($_REQUEST['pn'])) 
				{
					$qry2="select * from project where Project_Name='".$_REQUEST['pn']."'";
						$exe1=mysqli_query($conn,$qry2);	
				}

				$fthe=mysqli_fetch_array($exe1);
					

			 ?>
				   
			     
			   
				 <div class="col-sm-3">
                <input type="hidden"  name="Project_Id" class="form-control" value="<?php echo (isset($_REQUEST['Edit'])) ? $res['Project_Id'] : '' ?>">
				
                  <input type="text" name="Technology" required="required" maxlength="35" class="form-control" value="<?php echo $fthe['Technology'];?>" placeholder="Technology">
				    
				    <input type="text" name="Duration" required="required" maxlength="35" class="form-control" value="<?php echo $fthe['Duration']; ?>" placeholder="Duration">
				    
				    <input type="text" name="Activity" required="required" maxlength="35" class="form-control" value="<?php  ?>" placeholder="Activity">
               </div>
			   
			   <?php  if (isset($_REQUEST['pns'])) 
				{
					$qry12="select * from employee where Employee_Name='".$_REQUEST['pns']."'";
						$exe12=mysqli_query($conn,$qry12);	
				}

				$fthes=mysqli_fetch_array($exe12);
					

			 ?>
				
			   
				<div class="col-sm-3">
              <input type="email" required name="Email"  required="required" maxlength="50" class="form-control" value="<?php echo $fthes['Email']; ?>" placeholder="Email">
               </div>
			   
               <div class="col-sm-2">
                 <input type="submit" name="<?php echo (isset($_REQUEST['Edit'])) ? 'Update' : 'Submit' ?>" Value="<?php echo (isset($_REQUEST['Edit'])) ? 'UPDATE' : 'SAVE' ?>" class="btn btn-primary">
               </div>
            </div>  
        </form>
    </div>
    <div class="container tblarea">
     <table id="table" class="table table-bordered table-hover table-responsive">
      <thead>
         <tr>
            <th>#</th><th>Project Name</th>><th>Employee Name</th><th>Technology</th><th>Activity</th><th>Duration</th>
         </tr>
      </thead>
      <tbody>
         <?php 
            $count = 0;
            $qry = mysqli_query($conn,"select * from Project_Schedule where flag='0' order by Id Desc");
            while($res=mysqli_fetch_array($qry)){ $count++;
         ?>
         <tr>
         <td><?php echo $count;?></td>
                <td><?php echo $res['Project_Name'];?></td>
         <td><?php echo $res['Employee_Name'];?></td>
		 <td><?php echo $res['Technology'];?></td>
		 		   <td><?php echo $res['Activity'];?></td>
		  <td><?php echo $res['Duration'];?></td>

          
         </tr>
         <?php }?>
      </tbody>
     </table>
    </div>

</body>
<script>
function disp()
{
var	a=document.getElementById("Project_Name").value;
var	b=document.getElementById("Employee_Name").value;
	location.replace("Project_Schedule.php?pn="+a+"&pns="+b);
	//document.getElementById('project_se_dro').submit();
}

</script>
</html>