
<?php
$msg="";
$msg2="";
 include ("../config/config.php");
 $studentid1=$sex=$sport1=$fullname1=$password1=$email1=$telephone1=$address1=$gardiantel1=$position1=$faculty1=$acadamicyr1=$image1=$other1=$target1=$target2="";
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
     //$image=$_FILES['image']['name'];
    
     
     return $posts;
 }
 //add
if(isset($_POST['submit'])){
  
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
    
    
    
   header('location:index.php');  
    } else {
       echo "<script>alert('Please Add only JPEG GIF or PNG Images')</script>";  
    }
    
}
//search
 if(isset($_POST['search'])){
   $data= getpost();
   $searchQuery="SELECT * FROM student WHERE studentid=$data[0]";
   $search_result= mysqli_query($db,$searchQuery);
   
   if($search_result){
   if(mysqli_num_rows($search_result)){
       while ($row= mysqli_fetch_array($search_result)) {
        $studentid1=$row['studentid'];
      
       $sex=$row['sex'];
         $sport1=$row['sport'];
       $fullname1=$row['fullname'];
         $password1=$row['password'];
       $email1=$row['email'];
         $telephone1=$row['telephoneno'];
       $address1=$row['address'];
         $gardiantel1=$row['gardianTel'];
       $position1=$row['position'];
         $faculty1=$row['faculty'];
      $acadamicyr1=$row['acadamicyr'];
    
    
       
           
           
       }
   
          
           
       }
       
       
       
   }else{
       echo 'No data for this id';
       
   }
     
 } else{
       echo 'welcome'; 
       
   }
 
     
 
?>

						  
						  








<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>studentregistration</title>

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
            <h1 class="style1">Student Registration</h1>
            <h3>&nbsp;</h3>
            <a href="#about" class="btn btn-default btn-lg">Go to Registration Form</a> </div>
        </div>
      </div>
    </div>
    <!-- /Full Page Image Header Area -->

    <!-- Intro -->
    <div id="about" class="intro">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                   
                  <p>
                    <label for="textfield2">
                    <div align="justify">
					
					
					</div>
              </label>
                  </p><table  border="0px" align="center">
                     
                       
                         
                              <tr>
                                  <td>
                                         <div align="center">
                              <?php 
                           $path= mysqli_query($db, "SELECT image FROM student where studentid='$studentid1'");
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
                  </table>
                                       <form action="index.php" method="POST" name="SignUP" enctype="multipart/form-data">
                       
                         
					   <label> 
					   <div align="center">Student ID</div>
					   </label>
                        <div align="center">
                            <input name="stuid" type="number" value="<?php echo $studentid1; ?>" maxlength="20">
                          <br>
                        </div>
                        <p align="center"> <label> Sex</label>
                          <label>
                          <input type="radio" name="sex"  value="male" <?php if (isset($sex) && $sex=="male"){ echo "checked";}?>>
                            Male</label>
                          <label>
                          <input type="radio" name="sex"  value="female" <?php if (isset($sex) && $sex=="female") {echo "checked";}?>>
                            Female</label>
                          <br>
                        </p>
						<label>
						<div align="center">Sport</div>
						</label>
						<div align="center">
						  <select name="sport" size="1">
                                                      <option value="<?php echo $sport1; ?>"><?php echo $sport1; ?></option>
						<?php
  $query = "SELECT * FROM sports";
  $result = mysqli_query($db,$query);
  while($row= mysqli_fetch_assoc($result)){
     echo "<option value='".$row["name"]."'>".$row["name"]."</option>";
   }?> 
					
					      </select>
						  <br>
					    </div>
						<label>
						<div align="center">Full Name</div>
						</label>
						<div align="center">
						  <input name="fullname" type="text" maxlength="1000" value="<?php echo $fullname1; ?>" >
						  <br>
					    </div>
						<label>
						<div align="center">Password</div>
						</label>
						<div align="center">
						  <input name="password" type="password" maxlength="1000" value="<?php echo $password1; ?>">
						  <br>
					    </div>
						<label>
						<div align="center">Email</div>
						</label>
						<div align="center">
                                                    <input name="email" type="email" maxlength="1000" value="<?php echo $email1; ?>">
						  <br>
					    </div>
						<label>
						<div align="center">Telephone No</div>
						</label>
						<div align="center">
						  <input name="telephone" type="text" maxlength="100" value="<?php echo $telephone1; ?>">
						  <br>
					    </div>
						<label>
						<div align="center">Address</div>
						</label>
						<div align="center">
						  <textarea name="address" cols="20" rows="3" ><?php echo $address1; ?></textarea>
						  <br>
					    </div>
						<label>
						<div align="center">Gardian Telephone No</div>
						</label>
						<div align="center">
						  <input name="gardiantel" type="text" maxlength="100" value="<?php echo $gardiantel1; ?>">
						  <br>
					    </div>
						<label>
						<div align="center">Position</div>
						</label>
						<div align="center">
						  <input name="position" type="text" maxlength="1000" value="<?php echo $position1; ?>">
						  <br>
					    </div>
						<label>
						<div align="center">Faculty</div>
						</label>
						<div align="center">
						  <input name="faculty" type="text" maxlength="1000" value="<?php echo $faculty1; ?>">
						  <br>
					    </div>
						<label>
						<div align="center">Acadamic Year</div>
						</label>
						<div align="center">
						  <input name="acadamicyr" type="text" maxlength="100" value="<?php echo $acadamicyr1; ?>">
						  <br>
					    </div>
						<label>
						<div align="center">Image</div>
						</label>
						<div align="center">
                                                    <input type="file" name="image" value="<?php echo $image1; ?>">
					      </div>
						  <label>
						<div align="center">Other Details</div>
						</label>
                        <div align="center">
                            
                            <input type="file" name="other" value="<?php echo $other1; ?>" >
					      </div>
						  <div align="center">
						  <input name="submit" type="submit" value="Add">
                                                  <input name="search" type="submit" value="Search"  >
						  
						  </div>
						
						  
                      </form>
                                      
                                      
                       
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
