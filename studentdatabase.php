<?php 
session_start();


$studentid=$sex=$sport=$fullname=$password=$email=$telephone=$address=$gardiantel=$position=$faculty=$acadamicyr=$image=$other=$target1=$target2="";

$msg="";
$msg2="";
include ("../config/config.php");
$edit_state=false;
$target1=$target2="";
//search function
function getpost(){
     
    $posts=array();
    $posts[0]=$_POST['stuid'];

     $posts[2]=$_POST['sport'];
     $posts[3]=$_POST['fullname'];
       $posts[4]=$_POST['password'];
     $posts[5]=$_POST['email'];
       $posts[6]=$_POST['telephone'];
     $posts[7]=$_POST['address'];
       $posts[8]=$_POST['gardiantel'];
     $posts[9]=$_POST['position'];
       $posts[10]=$_POST['faculty'];
     $posts[11]=$_POST['acadamicyr'];
     
     
     
     return $posts;
 }
 //searchcode
 if(isset($_POST['search'])){
   $data= getpost();
   $searchQuery="SELECT * FROM student WHERE studentid=$data[0]";
   $search_result= mysqli_query($db,$searchQuery);
   
   if($search_result){
   if(mysqli_num_rows($search_result)){
       while ($row= mysqli_fetch_array($search_result)) {
           $edit_state=true;
        $studentid=$row['studentid'];
      
       $sex=$row['sex'];
         $sport=$row['sport'];
       $fullname=$row['fullname'];
         $password=$row['password'];
       $email=$row['email'];
         $telephone=$row['telephoneno'];
       $address=$row['address'];
         $gardiantel=$row['gardianTel'];
       $position=$row['position'];
         $faculty=$row['faculty'];
      $acadamicyr=$row['acadamicyr'];
      
    
       
           
           
       }
   
          
           
       }
       
       
       
   }else{
       echo 'No data for this id';
       
   }
     
 }
//add

if(isset($_POST["save"])){
  
    $target1="stuphotos/".basename($_FILES['image']['name']);
    $target2="studetails/".basename($_FILES['other']['name']);
   
    $studentid=$_POST['stuid'];
    $sex=$_POST['sex'];
    $sport=$_POST['sport'];
    $fullname=$_POST['fullname'];
    $password=$_POST['password'];
    $email=$_POST['email'];
    $telephone=$_POST['telephone'];
    $address=$_POST['address'];
    $gardiantel=$_POST['gardiantel'];
    $position=$_POST['position'];
    $faculty=$_POST['faculty'];
    $acadamicyr=$_POST['acadamicyr'];
  
    $image=$_FILES['image']['name'];
   
    $other=$_FILES['other']['name'];
    $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
    $detectedType = exif_imagetype($_FILES['image']['tmp_name']);
    if(in_array($detectedType, $allowedTypes)){
    $sql="INSERT INTO student(studentid,sex,sport,fullname,password,email,telephoneno,address,gardianTel,position,faculty,acadamicyr,image,otherdetails) VALUES('$studentid','$sex','$sport','$fullname','$password','$email','$telephone','$address','$gardiantel','$position','$faculty','$acadamicyr','$image','$other')";
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
    $_SESSION['message']="Data Saved";
  header('location:indatabase.php'); 
    
    
} else {
       
    echo "<script>alert('Please Add only JPEG GIF or PNG Images')</script>";
     
}
    
    
    
     
  
    
}
//update records
if(isset($_POST['update'])){
   
   
     $target1="stuphotos/".basename($_FILES['image']['name']);
    $target2="studetails/".basename($_FILES['other']['name']);
    $studentid = mysqli_real_escape_string($db,$_POST['stuid']);
    $sex = mysqli_real_escape_string($db,$_POST['sex']);
    $sport = mysqli_real_escape_string($db,$_POST['sport']);
    $fullname = mysqli_real_escape_string($db,$_POST['fullname']);
    $password = mysqli_real_escape_string($db,$_POST['password']);
    $email = mysqli_real_escape_string($db,$_POST['email']);
    $telephone = mysqli_real_escape_string($db,$_POST['telephone']);
    $address = mysqli_real_escape_string($db,$_POST['address']);
    $gardiantel = mysqli_real_escape_string($db,$_POST['gardiantel']);
    $position = mysqli_real_escape_string($db,$_POST['position']);
    $faculty = mysqli_real_escape_string($db,$_POST['faculty']);
    $acadamicyr = mysqli_real_escape_string($db,$_POST['acadamicyr']);
    $image = mysqli_real_escape_string($db,$_FILES['image']['name']);
    $other = mysqli_real_escape_string($db,$_FILES['other']['name']);
    $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
    $detectedType = exif_imagetype($_FILES['image']['tmp_name']);
    if(in_array($detectedType, $allowedTypes) && !empty($_FILES['image']['name']) && !empty($_FILES['other']['name'])){
    $sql1="UPDATE student SET studentid='$studentid',sex='$sex',sport='$sport',fullname='$fullname',password='$password',email='$email',telephoneno='$telephone',address='$address', gardianTel='$gardiantel',position='$position',faculty='$faculty',acadamicyr='$acadamicyr',image='$image',otherdetails='$other' WHERE studentid='$studentid'  ";
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
    } else if(in_array($detectedType, $allowedTypes) &&!empty($_FILES['image']['name'])){
    $sql2="UPDATE student SET studentid='$studentid',sex='$sex',sport='$sport',fullname='$fullname',password='$password',email='$email',telephoneno='$telephone',address='$address', gardianTel='$gardiantel',position='$position',faculty='$faculty',acadamicyr='$acadamicyr',image='$image' WHERE studentid='$studentid'  ";
    mysqli_query($db,$sql2);
        if(move_uploaded_file($_FILES['image']['tmp_name'],$target1)){

$msg="Image uploded";


}else{
$msg="there was problem";


}
header('location:indatabase.php'); 
    }else if(!empty($_FILES['other']['name'])){
    $sql3="UPDATE student SET studentid='$studentid',sex='$sex',sport='$sport',fullname='$fullname',password='$password',email='$email',telephoneno='$telephone',address='$address', gardianTel='$gardiantel',position='$position',faculty='$faculty',acadamicyr='$acadamicyr',otherdetails='$other' WHERE studentid='$studentid'  ";
    mysqli_query($db,$sql3);
        
if(move_uploaded_file($_FILES['other']['tmp_name'],$target2)){

$msg2=" uploded";


}else{
$msg2="there was problem";


}
header('location:indatabase.php'); 
    }else if(empty($_FILES['image']['name']) && empty($_FILES['other']['name'])){
    $sql1="UPDATE student SET studentid='$studentid',sex='$sex',sport='$sport',fullname='$fullname',password='$password',email='$email',telephoneno='$telephone',address='$address', gardianTel='$gardiantel',position='$position',faculty='$faculty',acadamicyr='$acadamicyr' WHERE studentid='$studentid'  ";
    mysqli_query($db,$sql1);
    header('location:indatabase.php'); 
    } else {
    echo "<script>alert('Please Add only JPEG GIF or PNG Images')</script>";
}
    
     
     
    
}
//delete recodes
if(isset($_GET['del'])){
    $studentid=$_GET['del'];
 
    

mysqli_query($db,"DELETE FROM student WHERE studentid='$studentid'");
    $_SESSION['message']="DELETED";
     header('location:indatabase.php');
    
}
//retrive recodes 
$results= mysqli_query($db,"SELECT * FROM student" );
//fetch the recordes to be updated
if(isset($_GET['edit'])){
    
    $studentid=$_GET['edit'];
    $edit_state=true;
    $rec= mysqli_query($db,"SELECT * FROM student WHERE	studentid='$studentid' ");
    $record= mysqli_fetch_array($rec);
    $studentid=$record['studentid'];
    $sex=$record['sex'];
    $sport=$record['sport'];
    $fullname=$record['fullname'];
    $password=$record['password'];
    $email=$record['email'];
    $telephone=$record['telephoneno'];
    $address=$record['address'];
    $gardiantel=$record['gardianTel'];
    $position=$record['position'];
    $faculty=$record['faculty'];
    $acadamicyr=$record['acadamicyr'];
    
   
}
function display_message(){
    echo '<div class="msg">';
    echo '<p>'.$_SESSION['message'].'</p>';
    unset($_SESSION['message']);
    echo '</div>';
    
    
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

    <title>studentdatabase</title>

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
            <h1 class="style1">Student Database</h1>
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
                               
                                      <div align="center" >
                                              
                              
                              <?php 
                           $path= mysqli_query($db, "SELECT image FROM student where studentid='$studentid'");
       $count= mysqli_num_rows($path);
       if($count==1){
           $path1= mysqli_fetch_array($path);
           $path2=$path1[0];
           echo  '<img src="stuphotos/'.$path2.'" height="200" width="200" align="center" border="1"/>';
           
           
           
       }
                         
                         
       ?><br>
                              
                              
                              
                              
                              
                          </div>
                                      
                                      
                                  </td>
                              </tr>
                    </table><div id="form">
                    <form method="post" action="indatabase.php" enctype="multipart/form-data">
                        <div class="input-group">
                            <label>Student ID</label>
                            <input name="stuid" type="text" maxlength="20" value="<?php echo $studentid; ?>">
                            <input name="search" type="submit" value="Search"  >
                             
                            
                             </div>
                         <div class="input-group">
                            <label>Sex:</label>
                            
                            <label>Male
                            <input type="radio" name="sex"  value="male" <?php if (isset($sex) && $sex=="male"){ echo "checked";}?> >
                            Female
                              <input type="radio" name="sex"  value="female" <?php if (isset($sex) && $sex=="female") {echo "checked";}?>>
                          </label>
                             </div>
                         <div class="input-group">
                            <label>Sport</label>
                           <select name="sport" size="1">
                                                     <option value="<?php echo $sport; ?>"><?php echo $sport; ?></option>
						<?php
  $query = "SELECT * FROM sports";
  $result = mysqli_query($db,$query);
  while($row= mysqli_fetch_assoc($result)){
     echo "<option value='".$row["name"]."'>".$row["name"]."</option>";
   }?> 
					
					      </select>
                             </div>
                         <div class="input-group">
                            <label>Full Name</label>
                            <input name="fullname" type="text" maxlength="1000" value="<?php echo $fullname; ?>"  >
                             </div>
                         <div class="input-group">
                            <label>Password</label>
                             <input name="password" type="password" maxlength="1000" value="<?php echo $password; ?>">
                             </div>
                         <div class="input-group">
                            <label>Email</label>
                            <input name="email" type="email" maxlength="1000" value="<?php echo $email; ?>" >
                             </div>
                         <div class="input-group">
                            <label>Telephone No</label>
                            <input name="telephone" type="text" maxlength="100" value="<?php echo $telephone; ?>" >
                             </div>
                         <div class="input-group">
                            <label>Address</label>
                            <textarea name="address" cols="20" rows="3" ><?php echo $address; ?></textarea>
                             </div>
                         <div class="input-group">
                            <label>Gardian Telephone No</label>
                            <input name="gardiantel" type="text" maxlength="100" value="<?php echo $gardiantel; ?>">
                             </div>
                         <div class="input-group">
                            <label>Position</label>
                            <input name="position" type="text" maxlength="1000" value="<?php echo $position; ?>" >
                             </div>
                         <div class="input-group">
                            <label>Faculty</label>
                           <input name="faculty" type="text" maxlength="1000" value="<?php echo $faculty; ?>">
                             </div>
                         <div class="input-group">
                            <label>Acadamic Year</label>
                           <input name="acadamicyr" type="text" maxlength="100"value="<?php echo $acadamicyr; ?>" >
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
                              <th>Student ID &nbsp;&nbsp;</th>
                              <th>Sex&nbsp;&nbsp;</th>
                              <th>Sport&nbsp;&nbsp;</th>
                              <th>Full Name&nbsp;&nbsp;</th>
                              <th>Password&nbsp;&nbsp;</th>
                              <th>Email&nbsp;&nbsp;</th>
                              <th>Telephone No&nbsp;&nbsp;</th>
                              <th>Address&nbsp;&nbsp;</th>
                              <th>Gardian Telephone No&nbsp;&nbsp;</th>
                              <th>Position&nbsp;&nbsp;</th>
                              <th>Faculty&nbsp;&nbsp;</th>
                              <th>Acadamic Year&nbsp;&nbsp;</th>
                              <th>Image&nbsp;&nbsp;</th>
                              <th>Other Details&nbsp;&nbsp;</th>
                              <th colspan="2">Action&nbsp;&nbsp;</th>
                              
                              
                          </tr>
                          
                      </thead>
                      <tbody >
                          <?php 
                          while ($row= mysqli_fetch_array($results)){?>
                              
                              
                              <tr>
                              <td><?php echo $row['studentid'] ; ?>&nbsp;&nbsp;</td> 
                              <td><?php echo $row['sex'] ; ?>&nbsp;&nbsp;</td> 
                              <td><?php echo $row['sport'] ; ?>&nbsp;&nbsp;</td> 
                              <td><?php echo $row['fullname'] ; ?>&nbsp;&nbsp;</td> 
                              <td><?php echo $row['password'] ; ?>&nbsp;&nbsp;</td> 
                              <td><?php echo $row['email'] ; ?>&nbsp;&nbsp;</td> 
                              <td><?php echo $row['telephoneno'] ; ?>&nbsp;&nbsp;</td> 
                              <td><?php echo $row['address'] ; ?>&nbsp;&nbsp;</td> 
                              <td><?php echo $row['gardianTel'] ; ?>&nbsp;&nbsp;</td> 
                              <td><?php echo $row['position'] ; ?>&nbsp;&nbsp;</td> 
                              <td><?php echo $row['faculty'] ; ?>&nbsp;&nbsp;</td> 
                              <td><?php echo $row['acadamicyr'] ; ?>&nbsp;&nbsp;</td> 
                              
                              <td><?php 
                            
                             
                             $studentid2=$row['studentid'];
                         $path= mysqli_query($db, "SELECT image FROM student where studentid='$studentid2'");
       $count= mysqli_num_rows($path);
      
       if($count==1){
           $path1= mysqli_fetch_array($path);
         $path2=$path1[0];
          echo  '<img src="stuphotos/'.$path2.'" height="200" width="200" align="center" border="1"/>';
           
       }
                              
                               ?>&nbsp;&nbsp;</td> 
                              <td><?php 
                               $studentid2=$row['studentid'];
                        $path= mysqli_query($db, "SELECT otherdetails FROM student where studentid='$studentid2'");
       $count= mysqli_num_rows($path);
      if($count==1){
          $path1= mysqli_fetch_array($path);
          $path2=$path1[0];
          if(!empty($path2)){
          echo  '<a href="studetails/'.$path2.'" >Details</a>';
          
          } else {
              echo  '<a href="studetails/NoDetailsOfHim.docx" >Details</a>';
          }
                          }
           
                              ?>&nbsp;&nbsp;</td> 
                              <td><a href="#form">
                                      <a class="edit_btn" href="indatabase.php?edit=<?php echo $row['studentid'];?>">Edit</a></a>
                                      <a class="del_btn" href="indatabase.php?del=<?php echo $row['studentid'];?>">Delete</a>
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
            <h1>&quot;Just play.Have fun.Enjoy the Game.&quot;</h1>
            <p>Michael Jordan </p>
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