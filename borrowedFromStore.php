<?php 

$stuid=$empid=$equipmentid=$borroweddate=$recevieddate=$amount="";

session_start();



include ("../config/config.php");

$edit_state=false;



//search function

function getpost(){

     

    $posts=array();

    $posts[0]=$_POST['equipmentid'];



     $posts[2]=$_POST['empid'];

     $posts[3]=$_POST['stuid'];

       $posts[4]=$_POST['borroweddate'];

     $posts[5]=$_POST['recevieddate'];

       $posts[6]=$_POST['amount'];

     

     

     

     return $posts;

 }

 

 //searchcode

 if(isset($_POST['search'])){

   $data= getpost();

   $searchQuery="SELECT * FROM receviedborrowed WHERE equipmentid=$data[0]";

   $search_result= mysqli_query($db,$searchQuery);

   

   if($search_result){

   if(mysqli_num_rows($search_result)){

       while ($row= mysqli_fetch_array($search_result)) {

           $edit_state=true;

        $equipmentid=$row['equipmentid'];

      

       $empid=$row['empid'];

         $stuid=$row['stuid'];

       $borroweddate=$row['borroweddate'];

         

       $amount=$row['amount'];

         

    

       

           

           

       }

   

          

           

       }

       

       

       

   }else{

       echo 'No data for this id';

       

   }

     

 }



//add



if(isset($_POST["save"])){

  

   

    

   $equipmentid=$_POST['equipmentid'];

    $stuid=$_POST['stuid'];

    

    $empid=$_POST['empid'];

    

   

   

    $amount=$_POST['amount'];
$date = date('Y-m-d H:i:s');
   

    

  

    

   

    

    $sql="INSERT INTO receviedborrowed(equipmentid,empid,stuid,borroweddate,amount) VALUES('$equipmentid','$empid','$stuid','$date','$amount')";

    mysqli_query($db,$sql);

    if(isset($_POST['save'])){

        

        

      

       // 

     //update store set amount=(amount-'$amount' )WHERE equipmentid='$equipmentid' ;  

   // }

//$rec3=$rec1-$amount;

   

        $sql3="UPDATE store SET amount=(amount-'$amount' ) WHERE name='$equipmentid' ";

         mysqli_query($db,$sql3);

    

    $_SESSION['msg']="Data Saved";

  header('location:indatabase.php');  

  

    }

}

//update records

if(isset($_POST['update'])){

    

     

    $equipmentid = mysqli_real_escape_string($db,$_POST['equipmentid']);

    $stuid= mysqli_real_escape_string($db,$_POST['stuid']);

    

    $empid = mysqli_real_escape_string($db,$_POST['empid']);

    

  

    $amount = mysqli_real_escape_string($db,$_POST['amount']);

   

    

    

   

    $sql1="UPDATE receviedborrowed SET stuid='$stuid',empid='$empid',equipmentid='$equipmentid',amount='$amount' WHERE equipmentid='$equipmentid'  ";

    mysqli_query($db,$sql1);

     $_SESSION['msg']="UPDATED";

     header('location:indatabase.php'); 

    

}

//delete recodes



  if(isset($_GET['del'])){

    $equipmentid=$_GET['del'];

   

    $sql4="SELECT amount FROM receviedborrowed WHERE equipmentid='$equipmentid'";

    $amu=mysqli_query($db,$sql4);

    $res1 = mysqli_fetch_array($amu);

    $amt = $res1[0];

    

    



    $sql3="UPDATE store SET amount=(amount+$amt) WHERE name='$equipmentid'

";

    mysqli_query($db,$sql3);

 

    mysqli_query($db,"DELETE FROM receviedborrowed WHERE equipmentid='$equipmentid'");

    $_SESSION['msg']="DELETED";

     header('location:../recievedBorrowd/indatabase.php');

    

}



//echo $na;



//retrive recodes 

$results= mysqli_query($db,"SELECT * FROM receviedborrowed" );

//fetch the recordes to be updated

if(isset($_GET['edit'])){

    

    $equipmentid=$_GET['edit'];

    $edit_state=true;

    $rec= mysqli_query($db,"SELECT * FROM receviedborrowed WHERE equipmentid='$equipmentid' ");

    $record= mysqli_fetch_array($rec);

    $equipmentid=$record['equipmentid'];

   

    $empid=$record['empid'];

    $stuid=$record['stuid'];

    

    

    $amount=$record['amount'];

    

   

   

}



?>



<!DOCTYPE html>

<html lang="en">



<head>

    

  

   

    <title>Displaying  Table</title>

    <link rel="stylesheet" type="text/css" href="style.css">

	

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">

    <meta name="author" content="">



 

  

    <title>receviedborrowed</title>

    <!-- date calander-->

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <link rel="stylesheet" href="/resources/demos/style.css">

     <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script>

  $( function() {

    $( "#datepicker" ).datepicker();

  } );

  </script>



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

			<li><a href="../recievedBorrowd/indatabase.php">Received And Borrowed</a>

            </li>

			<li><a href="../Sport/indatabase.php">Sports</a>

            </li>

			<li><a href="../Event/indatabase.php">Event</a>

            </li>

			

        </ul>

    </div>

    <!-- /Side Menu -->



    <!-- Full Page Image Header Area -->

    <div id="top" class="header">

      <div class="vert-text">

        <div id="top2" class="header">

          <div class="vert-text">

            <h1 class="style1">Recevied Borrowed Recoder</h1>

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

                <div class="col-md-6 col-md-offset-0 text-center">

                   <div id="form">

                    <form method="post" action="indatabase.php" enctype="multipart/form-data">

                        <div class="input-group">

                            <label>Equipment ID</label>

                            <select name="equipmentid" size="1">

                                                     <option value="<?php echo $equipmentid; ?>"><?php echo $equipmentid; ?></option>

						<?php

  $query = "SELECT * FROM store";

  $result = mysqli_query($db,$query);

  while($row= mysqli_fetch_assoc($result)){

     echo "<option value='".$row["name"]."'>".$row["name"]."</option>";

   }?> 

					

					      </select>

                             </div>

                        

                         <div class="input-group">

                            <label>Employee ID</label>

                          <select name="empid" size="1">

                                                     <option value="<?php echo $empid; ?>"><?php echo $empid; ?></option>

						<?php

  $query = "SELECT * FROM staff";

  $result = mysqli_query($db,$query);

  while($row= mysqli_fetch_assoc($result)){

     echo "<option value='".$row["empid"]."'>".$row["fullname"]."</option>";

   }?> 

					

					      </select>

                             </div>

                         <div class="input-group">

                            <label>Student ID</label>

                            <select name="stuid" size="1">

                                                     <option value="<?php echo $stuid; ?>"><?php echo $stuid; ?></option>

						<?php

  $query = "SELECT * FROM student";

  $result = mysqli_query($db,$query);

  while($row= mysqli_fetch_assoc($result)){

     echo "<option value='".$row["studentid"]."'>".$row["studentid"]."</option>";

   }?> 

					

					      </select>

                             </div>

                     

                        

                         <div class="input-group">

                            <label>Amount</label>

                            <input name="amount" type="text" maxlength="100" value="<?php echo $amount; ?>" >

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

                              

                              <th>Employee ID&nbsp;&nbsp;</th>

                              <th>Student ID&nbsp;&nbsp;</th>

                              <th>Borrowed Date&nbsp;&nbsp;</th>

                              <th>Due Dates&nbsp;&nbsp;</th>

                          

                              <th>Amount&nbsp;&nbsp;</th>

                              

                              

                              

                              <th colspan="2">Action&nbsp;&nbsp;</th>

                              

                              

                          </tr>

                          

                      </thead>

                      <tbody >

                          <?php 

                          while ($row= mysqli_fetch_array($results)){?>

                              

                              

                              <tr>

                              <td><?php echo $row['equipmentid'] ; ?>&nbsp;&nbsp;</td> 

                             

                              <td><?php echo $row['empid'] ; ?>&nbsp;&nbsp;</td> 

                              <td><?php echo $row['stuid'] ; ?>&nbsp;&nbsp;</td> 

                              <td><?php echo $row['borroweddate'] ; ?>&nbsp;&nbsp;</td> 

                              <td><?php  
																	$borroweddate=$row['borroweddate'];
    $diff = (date('d') - date('d',strtotime($borroweddate)));
    echo $diff; ?>&nbsp;&nbsp;</td> 

                              <td><?php echo $row['amount'] ; ?>&nbsp;&nbsp;</td> 

                              

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

            <h1>&quot;Apart from education, you need good health, and for that, you need to play sports.&quot;</h1>

            <p>Kapil Dev </p>

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