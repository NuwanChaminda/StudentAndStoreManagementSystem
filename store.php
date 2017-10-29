<?php 
$equipmentid=$sportid=$name=$amount=$image=$other=$target1=$target2="";
session_start();
$msg="";
$msg2="";
include ("../config/config.php");
$edit_state=false;
$target1=$target2="";
//search function
function getpost(){
     
    $posts=array();
    $posts[0]=$_POST['equipmentid'];

     
     $posts[1]=$_POST['sportid'];
       $posts[2]=$_POST['name'];
     $posts[3]=$_POST['amount'];
      
    
     
     
     return $posts;
 }
 //searchcode
 if(isset($_POST['search'])){
   $data= getpost();
   $searchQuery="SELECT * FROM store WHERE equipmentid=$data[0]";
   $search_result= mysqli_query($db,$searchQuery);
   
   if($search_result){
   if(mysqli_num_rows($search_result)){
       while ($row= mysqli_fetch_array($search_result)) {
           $edit_state=true;
        $equipmentid=$row['equipmentid'];
      
      
       $name=$row['name'];
         $sportid=$row['sportid'];
       $amount=$row['amount'];
         
      
      
       
           
           
       }
   
          
           
       }
       
       
       
   }else{
       echo 'No data for this id';
       
   }
     
 }
//add

if(isset($_POST["save"])){
  
    $target1="storephotos/".basename($_FILES['image']['name']);
    $target2="storedetails/".basename($_FILES['other']['name']);
   
    $equipmentid=$_POST['equipmentid'];
  
    $name=$_POST['name'];
    $sportid=$_POST['sportid'];
    $amount=$_POST['amount'];
    
    
  
    $image=$_FILES['image']['name'];
   
    $other=$_FILES['other']['name'];
     $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
    $detectedType = exif_imagetype($_FILES['image']['tmp_name']);
    if(in_array($detectedType, $allowedTypes)){
    $sql="INSERT INTO store (equipmentid,sportid,name,amount,image,other) VALUES('$equipmentid','$sportid','$name','$amount','$image','$other')";
    mysqli_query($db,$sql);
    if(move_uploaded_file($_FILES['image']['tmp_name'],$target1)){

$msg="Image uploded";


}else{
$msg="there was problem";


}
if(move_uploaded_file($_FILES['other']['tmp_name'],$target2)){

$msg2=" uploded";


}else{
$msg2="there was problem";


}
    
    
    
    $_SESSION['msg']="Data Saved";
  header('location:indatabase.php');  
    } else {
        echo "<script>alert('Please Add only JPEG GIF or PNG Images')</script>";
    }
    
}
//update records
if(isset($_POST['update'])){
    
     $target1="storephotos/".basename($_FILES['image']['name']);
    $target2="storedetails/".basename($_FILES['other']['name']);
    $equipmentid = mysqli_real_escape_string($db,$_POST['equipmentid']);
   
   
    $sportid= mysqli_real_escape_string($db,$_POST['sportid']);
    $name = mysqli_real_escape_string($db,$_POST['name']);
    $amount = mysqli_real_escape_string($db,$_POST['amount']);
    
    
    $image = mysqli_real_escape_string($db,$_FILES['image']['name']);
    $other = mysqli_real_escape_string($db,$_FILES['other']['name']);
    $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
    $detectedType = exif_imagetype($_FILES['image']['tmp_name']);
    if(in_array($detectedType, $allowedTypes) && !empty($_FILES['image']['name'] && $_FILES['other']['name'] )){
    $sql1="UPDATE store SET equipmentid='$equipmentid',sportid='$sportid',name='$name',amount='$amount',image='$image',other='$other' WHERE equipmentid='$equipmentid'  ";
    mysqli_query($db,$sql1);
     if(move_uploaded_file($_FILES['image']['tmp_name'],$target1)){

$msg="Image uploded";


}else{
$msg="there was problem";


}
if(move_uploaded_file($_FILES['other']['tmp_name'],$target2)){

$msg2=" uploded";


}else{
$msg2="there was problem";


}
    
     header('location:indatabase.php'); 
    
    }else if(in_array($detectedType, $allowedTypes) && !empty($_FILES['image']['name'])){
    $sql1="UPDATE store SET equipmentid='$equipmentid',sportid='$sportid',name='$name',amount='$amount',image='$image' WHERE equipmentid='$equipmentid'  ";
    mysqli_query($db,$sql1);
     if(move_uploaded_file($_FILES['image']['tmp_name'],$target1)){

$msg="Image uploded";


}else{
$msg="there was problem";


}

    
     header('location:indatabase.php'); 
    
    }else if(!empty($_FILES['other']['name'] )){
    $sql1="UPDATE store SET equipmentid='$equipmentid',sportid='$sportid',name='$name',amount='$amount',other='$other' WHERE equipmentid='$equipmentid'  ";
    mysqli_query($db,$sql1);
     
if(move_uploaded_file($_FILES['other']['tmp_name'],$target2)){

$msg2=" uploded";


}else{
$msg2="there was problem";


}
    
     header('location:indatabase.php'); 
    
    }else if(empty($_FILES['image']['name'] && $_FILES['other']['name'] )){
    $sql1="UPDATE store SET equipmentid='$equipmentid',sportid='$sportid',name='$name',amount='$amount' WHERE equipmentid='$equipmentid'  ";
    mysqli_query($db,$sql1);
     
    
     header('location:indatabase.php'); 
    
    } else {
    echo "<script>alert('Please Add only JPEG GIF or PNG Images')</script>";
}
    
}
//delete recodes
if(isset($_GET['del'])){
    $equipmentid=$_GET['del'];
    mysqli_query($db,"DELETE FROM store WHERE equipmentid='$equipmentid'");
    $_SESSION['msg']="DELETED";
     header('location:indatabase.php');
    
}
//retrive recodes 
$results= mysqli_query($db,"SELECT * FROM store" );
//fetch the recordes to be updated
if(isset($_GET['edit'])){
    
    $equipmentid=$_GET['edit'];
    $edit_state=true;
    $rec= mysqli_query($db,"SELECT * FROM store WHERE	equipmentid='$equipmentid' ");
    $record= mysqli_fetch_array($rec);
    $equipmentid=$record['equipmentid'];
    
    $sportid=$record['sportid'];
    $name=$record['name'];
    $amount=$record['amount'];
   
  
   
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   
    <title>Displaying   Table</title>
    <link rel="stylesheet" type="text/css" href="style.css">
	
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>store</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/stylish-portfolio.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="photocss/style.css">
    <style type="text/css">
<!--
.style1 {color: #FFFF80}
-->
    </style>
</head>

<body>


    <!-- Side Menu -->
     <a id="menu-toggle" href="#" class="btn btn-primary btn-lg toggle"><i class="fa fa-bars"></i></a>
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <a id="menu-close" href="#" class="btn btn-default btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
            <li class="sidebar-brand"><a href="../index.php">Logout</a>
            </li>
            <li><a href="../Admin/index.php">Admin Home</a>
            </li>
            <li><a href="../StudentReg/index.php">Student SignUP</a>
            </li>
            <li><a href="../StaffReg/index.php">Staff SignUp</a>
            </li>
            <li><a href="../coachReg/index.php">Couch SignUp</a>
            </li>
            <li><a href="../Store/indatabase.php">Store</a>
            </li>
			 <li><a href="../StudentReg/indatabase.php">Student Database</a>
            </li>
			<li><a href="../coachReg/indatabase.php">Couch Database</a>
            </li>
			<li><a href="../StaffReg/indatabase.php">Staff Database</a>
            </li>
			
			<li><a href="../Sport/indatabase.php">Sports</a>
            </li>
			<li><a href="../Event/indatabase.php">Event</a>
            </li>
			<li><a href="../recievedBorrowd/indatabase.php">Received And Borrowed</a>
            </li>
        </ul>
    </div>
    <!-- /Side Menu -->

    <!-- Full Page Image Header Area -->
    <div id="top" class="header">
      <div class="vert-text">
        <div id="top2" class="header">
          <div class="vert-text">
            <h1 class="style1">Store</h1>
            <h3>&nbsp;</h3>
            <a href="#database" class="btn btn-default btn-lg">Go to Database</a> </div>
        </div>
      </div>
    </div>
    <!-- /Full Page Image Header Area -->

    <!-- Intro -->
    <div >
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-0 text-center">
                    <table  border="0px" align="center">
                     
                       
                         
                              <tr>
                                  <td>
                                         <div align="center">
                              <?php 
                           $path= mysqli_query($db, "SELECT image FROM store where equipmentid='$equipmentid'");
       $count= mysqli_num_rows($path);
       if($count==1){
           $path1= mysqli_fetch_array($path);
           $path2=$path1[0];
           echo  '<img src="storephotos/'.$path2.'" height="200" width="200" align="center" border="1"/>';
           
           
           
       }
                         
                         
       ?><br>
                              
                              
                              
                              
                              
                          </div>
                                      
                                      
                                  </td>
                              </tr>
                    </table><div id="form">
                    <form method="post" action="indatabase.php" enctype="multipart/form-data">
                        <div class="input-group">
                            <label>Equipment ID</label>
                            <input name="equipmentid" type="text" maxlength="20" value="<?php echo $equipmentid; ?>">
                          
                            <input name="search" type="submit" value="Search"  >
                             
                            
                             </div>
                        
                         <div class="input-group">
                            <label>Sport ID</label>
                            <select name="sportid" size="1">
                                                     <option value="<?php echo $sportid; ?>"><?php echo $sportid; ?></option>
						<?php
  $query = "SELECT * FROM sports";
  $result = mysqli_query($db,$query);
  while($row= mysqli_fetch_assoc($result)){
     echo "<option value='".$row["name"]."'>".$row["name"]."</option>";
   }?> 
					
					      </select>
                             </div>
                         <div class="input-group">
                            <label>Name</label>
                            <input name="name" type="text" maxlength="1000" value="<?php echo $name; ?>">
                             </div>
                         <div class="input-group">
                            <label>Amount</label>
                            <input name="amount" type="number" maxlength="1000" value="<?php echo $amount; ?>" >
                             </div>
                       
                       
                         <div class="input-group">
                            <label>Image</label>
                            <input type="file" name="image" value="<?php echo $image; ?>">
                             </div>
                         <div class="input-group">
                            <label>Other Details</label>
                           <input type="file" name="other" value="<?php echo $other; ?>">
                             </div>
                         <div class="input-group">
                           <?php if($edit_state == false):  ?>
                             <button type="submit" name="save" class="btn">Save</button>
                             <?php  else :?>
                              <button type="submit" name="update" class="btn">Update</button>
                             <?php endif ?>
                             
                             </div>
                        
                        
                        
                    </form> </div>
                  <p>
                    <label for="textfield2">
                    <div align="left" id="database" >
					
					
		<?php  
                if(isset($_SESSION['msg'])):
                
                ?>
                        <div class="msg">
                            <?php
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                            
                            ?>
                            
                        </div>
                        <?php endif ?>
                  <table border="1" align="left" >
                      <thead>
                          <tr>
                              <th>Equipment ID &nbsp;&nbsp;</th>
                             
                              <th>Sport ID&nbsp;&nbsp;</th>
                              <th>Name&nbsp;&nbsp;</th>
                              <th>Amount&nbsp;&nbsp;</th>
                             
                             
                              <th>Image&nbsp;&nbsp;</th>
                              <th>Other Details&nbsp;&nbsp;</th>
                              <th colspan="2">Action&nbsp;&nbsp;</th>
                              
                              
                          </tr>
                          
                      </thead>
                      <tbody >
                          <?php 
                          while ($row= mysqli_fetch_array($results)){?>
                              
                              
                              <tr>
                              <td><?php echo $row['equipmentid'] ; ?>&nbsp;&nbsp;</td> 
                             
                              <td><?php echo $row['sportid'] ; ?>&nbsp;&nbsp;</td> 
                              <td><?php echo $row['name'] ; ?>&nbsp;&nbsp;</td> 
                              <td><?php echo $row['amount'] ; ?>&nbsp;&nbsp;</td> 
                            
                             
                              
                              <td><?php 
                            
                             
                             $equipmentid2=$row['equipmentid'];
                         $path= mysqli_query($db, "SELECT image FROM store where equipmentid='$equipmentid2'");
       $count= mysqli_num_rows($path);
      
       if($count==1){
           $path1= mysqli_fetch_array($path);
         $path2=$path1[0];
          echo  '<img src="storephotos/'.$path2.'" height="200" width="200" align="center" border="1"/>';
           
       }
                              
                               ?>&nbsp;&nbsp;</td> 
                              <td><?php 
                              $equipmentid2=$row['equipmentid'];
                        $path= mysqli_query($db, "SELECT other FROM store where equipmentid='$equipmentid2'");
       $count= mysqli_num_rows($path);
      if($count==1){
          $path1= mysqli_fetch_array($path);
          $path2=$path1[0];
          if(!empty($path2)){
          echo  '<a href="storedetails/'.$path2.'" >Details</a>';
          
          } else {
              echo  '<a href="storedetails/NoDetailsOfThis.docx" >Details</a>';
          }
                          }
           
                              ?>&nbsp;&nbsp;</td> 
                              <td><a href="#form">
                                      <a class="edit_btn" href="indatabase.php?edit=<?php echo $row['equipmentid'];?>">Edit</a></a>
                                      <a class="del_btn" href="indatabase.php?del=<?php echo $row['equipmentid'];?>">Delete</a>
                             &nbsp;&nbsp; </td> 
                              
                          </tr>
                              
                              
                          <?php    
                              
                          }
                      
                          
                          ?>
                          
                          
                      </tbody>
                      
                      
                  </table>
                                      
                             			</div>
              </label>
                  </p>         
                       
                      <p align="justify">
                      </p>
<p align="justify"><label for="textfield"></label>
              </p>
                      <p align="justify">&nbsp;</p>
                      <p>&nbsp;</p>
                      <p><br>
                      </p>
                      <p><br/>
                  </p>
                    <p>&nbsp; </p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
          </div>
            </div>
        </div>
    </div>
    <!-- /Intro -->

    <!-- Services -->
    <div id="services" class="services">
        <div class="container">
          <div class="row"></div>
            <div class="row"></div>
        </div>
    </div>
    <!-- /Services -->

    <!-- Callout -->
    <div class="callout">
        <div class="vert-text">
            <h1>&quot;Finding good players is easy. Getting them to play as a team is another story.&quot;</h1>
            <p>Casey Stengel </p>
        </div>
    </div>
    <!-- /Callout -->

    <!-- Portfolio -->
    <div id="portfolio" class="portfolio">
        <div class="container">
          <div class="row">
            <div class="col-md-4 col-md-offset-4 text-center">
              <h2>&nbsp;</h2>
              <hr>
            </div>
          </div>
          <div class="row"></div>
            <div class="row"></div>
        </div>
    </div>
    <!-- /Portfolio -->

    <!-- Call to Action -->
    <div class="call-to-action">
        <div class="container">
          <div class="row"></div>
        </div>
    </div>
    <!-- /Call to Action -->

    <!-- Map --><!-- /Map -->

    <!-- Footer --><!-- /Footer -->

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

    <!-- Custom JavaScript for the Side Menu and Smooth Scrolling -->
    <script>
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });
    </script>
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });
    </script>
    <script>
    $(function() {
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
    </script>

</body>

</html>