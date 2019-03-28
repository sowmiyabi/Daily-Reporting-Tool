<?php require_once("header.php");?>
<body>
<?php require_once("NavBar.php");

if (isset($_REQUEST['submit'])) 
{

      $query="select ifnull(max(Id),10) from Employee";
      $execute=mysqli_query($conn,$query);
      list($id)=mysqli_fetch_array($execute);
      $id = $id+1;
      $act_id = "Emp_".$id;
	  $flag=0;

      
           
      $query = "INSERT INTO Employee SET Id='".$id."', flag='".$flag."', Employee_Id='".$act_id."', Employee_Name='".inp('Employee_Name')."', Password='".inp('Password')."',  Mobile='".inp('Mobile')."', Email='".inp('Email')."', Technical_Skills='".inp('Technical_Skills')."', Experience='".inp('Experience')."', Address='".inp('Address')."'";
      if(mysqli_query($conn,$query))
      {
		  mysqli_query($conn,$sql);
         echo "<script>alert('Inserted Successfully');window.location='employee.php'</script>";
      }
      else
      {
         die("Error : ".mysqli_error($conn));
      }
   }
       $edi=$_REQUEST["Edit"];
   if(isset($edi))
   {

      $qry = mysqli_query($conn,"select * from Employee where Employee_Id = '".$edi."'");
      $res = mysqli_fetch_array($qry);
	 
	  
   }

if(isset($_REQUEST["update"]))
   {
		 
	
	 $sql = "update employee SET  Password='".inp('Password')."', Mobile='".inp('Mobile')."', Email='".inp('Email')."', Technical_Skills='".inp('Technical_Skills')."', Experience='".inp('Experience')."', Address='".inp('Address')."' where  Employee_Name = '".inp('Employee_Name')."'";
      if(mysqli_query($conn,$sql))
      {
       header("location:employee.php");
	
      }
      else
      {
        die("Error : ".mysql_error($conn));
      }

   }

?>
    <div class="container-fluid">
        <div class="container" id="heading">
         <h4>Add Employee</h4>        
        </div> 
    </div>
    <div class="container" id="content">
        <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" enctype="multipart/form-data">
          
			
			<div class="form-group">
                <label class="control-label col-sm-3">Employee Name<b style="color:red">*</b>: </label>
                <div class="col-sm-5">
                  
                    <input type="text" name="Employee_Name" required="required" class="form-control" maxlength="25" value="<?php echo (isset($_REQUEST['Edit'])) ? $res['Employee_Name'] : '' ?>">
                </div>
            </div>
        <div class="form-group">
                <label class="control-label col-sm-3">Password<b style="color:red">*</b>: </label>
                <div class="col-sm-5">
                  
                    <input type="Password" name="Password" class="form-control"  required="required" value="<?php echo (isset($_REQUEST['Edit'])) ? $res['Password'] : '' ?>">
                </div>
            </div>
      
        <div class="form-group">
                <label class="control-label col-sm-3">Mobile No.<b style="color:red">*</b>: </label>
                <div class="col-sm-5">
                  <input type="text" name="Mobile" id="Mobile" maxlength="12" pattern="[1-9]{1}[0-9]{9}" required="required" class="form-control" value="<?php echo (isset($_REQUEST['Edit'])) ? $res['Mobile'] : '' ?>">
                </div>
            </div>
      
        <div class="form-group">
                <label class="control-label col-sm-3">Email<b style="color:red">*</b>: </label>
                <div class="col-sm-5">
                  <input type="email" name="Email"  maxlength="35" required="required" class="form-control" value="<?php echo (isset($_REQUEST['Edit'])) ? $res['Email'] : '' ?>">
                </div>
            </div>
      
       <div class="form-group">
                <label class="control-label col-sm-3">Experience<b style="color:red">*</b>: </label>
                <div class="col-sm-5">
                  <input type="text" name="Experience"  maxlength="20" required="required" class="form-control" value="<?php echo (isset($_REQUEST['Edit'])) ? $res['Experience'] : '' ?>">
                </div>
            </div>
      
       <div class="form-group">
                <label class="control-label col-sm-3">Technical Skills<b style="color:red">*</b>: </label>
                <div class="col-sm-5">
                  <input type="text" name="Technical_Skills"  maxlength="20" required="required"  class="form-control" value="<?php echo (isset($_REQUEST['Edit'])) ? $res['Technical_Skills'] : '' ?>">
                </div>
            </div>
      
            <div class="form-group">
                <label class="control-label col-sm-3">Address : </label>
                <div class="col-sm-5">
                    <textarea name="Address" class="form-control" rows="5"><?php echo (isset($_REQUEST['Edit'])) ? $res['Address'] : '' ?></textarea>
                </div>
            </div>
          
           
            <div class="form-group">                
                <div class="col-sm-offset-3 col-sm-2">
                    <input type="submit" name="<?php echo (isset($_REQUEST['Edit'])) ? 'update' : 'submit' ?>" value="<?php echo (isset($_REQUEST['Edit'])) ? 'Update' : 'Save' ?>" class="btn btn-primary">
                </div>
          <div class="col-sm-offset-2">
                    <a href="employee.php">
                    <input type="button" name="close" id="close" value="Close" class="btn btn-primary">
                    </a>
                </div>
            </div>

      
        </form>
    </div>

</body>
<script type="text/javascript">
  $(document).ready(function () {
  //called when key is pressed in textbox
  $("#Mobile").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        // $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
   });
</script>
</html>