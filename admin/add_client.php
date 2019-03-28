<?php require_once("header.php");?>
<body>
<?php require_once("NavBar.php");

if (isset($_REQUEST['submit'])) 
{

      $query="select ifnull(max(Id),10) from Client";
      $execute=mysqli_query($conn,$query);
      list($id)=mysqli_fetch_array($execute);
      $id = $id+1;
      $act_id = "CL_".$id;
	  $flag=0;

      
           
      $query = "INSERT INTO Client SET Id='".$id."', flag='".$flag."', Client_Id='".$act_id."', Client_Name='".inp('Client_Name')."', Mobile='".inp('Mobile')."', Email='".inp('Email')."', Project_Name='".inp('Project_Name')."', Company_Name='".inp('Company_Name')."', Address='".inp('Address')."',flag_allocate='0'";
      if(mysqli_query($conn,$query))
      {
         echo "<script>alert('Inserted Successfully');window.location='Client.php'</script>";
      }
      else
      {
         die("Error : ".mysqli_error($conn));
      }
   }
       $edi=$_REQUEST["Edit"];
   if(isset($edi))
   {
	
	
      $qry = mysqli_query($conn,"select * from Client where Client_Id = '".$edi."'");
      $res = mysqli_fetch_array($qry);
	  
	  
	  
	 
   }

   if(isset($_REQUEST["update"]))
   {
		
	 $sqlt = "update Client SET  Mobile='".inp('Mobile')."', Email='".inp('Email')."', Project_Name='".inp('Project_Name')."', Company_Name='".inp('Company_Name')."', Address='".inp('Address')."' where  Client_Name='".inp('Client_Name')."'";
      if(mysqli_query($conn,$sqlt))
      {
        header("location:Client.php");
	  
      }
      else
      {
        die("Error : ".mysql_error($conn));
      }
	  

   }

?>
    <div class="container-fluid">
        <div class="container" id="heading">
         <h4>Add Client</h4>        
        </div> 
    </div>
   <div class="container" id="content">
        <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label class="control-label col-sm-3">Client Name <b style="color:red">*</b>:</label>
                <div class="col-sm-5">
                  
                    <input type="text" required="required" maxlength="25" name="Client_Name" class="form-control" value="<?php echo (isset($_REQUEST['Edit'])) ? $res['Client_Name'] : '' ?>">
                </div>
            </div>
      
        <div class="form-group">
                <label class="control-label col-sm-3">Mobile No.<b style="color:red">*</b>: </label>
                <div class="col-sm-5">
                  <input type="text" name="Mobile" id="Mobile" class="form-control" maxlength="12" pattern="[1-9]{1}[0-9]{9}" required="required" value="<?php echo (isset($_REQUEST['Edit'])) ? $res['Mobile'] : '' ?>">
                </div>
            </div>
      
        <div class="form-group">
                <label class="control-label col-sm-3">Email<b style="color:red">*</b>: </label>
                <div class="col-sm-5">
                  <input type="email" name="Email" maxlength="35" id="Email" required="required" class="form-control" value="<?php echo (isset($_REQUEST['Edit'])) ? $res['Email'] : '' ?>">
                </div>
            </div>
      
       <div class="form-group">
                <label class="control-label col-sm-3">Project Name<b style="color:red">*</b>: </label>
                <div class="col-sm-5">
                  <input type="text" maxlength="25" name="Project_Name" class="form-control" required="required" value="<?php echo (isset($_REQUEST['Edit'])) ? $res['Project_Name'] : '' ?>">
                </div>
            </div>
      
       <div class="form-group">
                <label class="control-label col-sm-3">Company Name<b style="color:red">*</b>: </label>
                <div class="col-sm-5">
                  <input type="text" name="Company_Name" maxlength="25" required="required" class="form-control" value="<?php echo (isset($_REQUEST['Edit'])) ? $res['Company_Name'] : '' ?>">
                </div>
            </div>
      
            <div class="form-group">
                <label class="control-label col-sm-3">Address : </label>
                <div class="col-sm-5">
                    <textarea name="Address" class="form-control" rows="5"><?php echo (isset($_REQUEST['Edit'])) ? $res['Address'] : '' ?></textarea>
                </div>
            </div>
      
        <div class="col-sm-6">
            <div class="col-sm-3">
            <div class="form-group">                
                <div class="col-sm-offset-5 col-sm-2">
                    <input type="submit" name="<?php echo (isset($_REQUEST['Edit'])) ? 'update' : 'submit' ?>" value="<?php echo (isset($_REQUEST['Edit'])) ? 'Update' : 'Save' ?>" class="btn btn-primary">
                </div>
            </div>

            </div><div class="col-sm-3">
            <div class="form-group">                
                <div class="col-sm-offset-5 col-sm-2">
                    <a href="client.php">
                    <input type="button" name="close" id="close" value="Close" class="btn btn-primary">
                    </a>
                </div>
            </div>

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
  // $("#Email").keypress(function (e) {
  //   var userinput = $(this).val();
  //   var pattern = "/^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i";
  //   if(!pattern.test(userinput)){
  //     alert('not a valid e-mail address');
  //   }​
  //   });

});
</script>
</html>