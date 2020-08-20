<!DOCTYPE html>
<html lang="en" dir="ltr">
          <head>
            <meta charset="utf-8">
                <title></title>
            <!-- Latest compiled and minified CSS -->
                          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

                          <!-- jQuery library -->
                          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

                          <!-- Popper JS -->
                          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

                          <!-- Latest compiled JavaScript -->
                          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
          </head>
      <body>
        <div class="container">
          <h1 class="text-center text-white bg-dark">Registered Name with Profile </h1>
            <br>
                <div class="table-responsive">
                      <table class="table table-bordered table-striped table-hover">
                            <thead>
                              <th>Id</th>
                              <th>Username </th>
                              <th>Profile Pic</th>
                            </thead>

                                    <tbody>
                                      <?php
                                    // Connecting database
                                      $con = mysqli_connect('localhost','root');

                                  //Selecting database with connection variable ($con) and database name(displayupload)
                                      mysqli_select_db($con,'displayupload');
                                // when if only user clicks submit it chks the attribute(name=submit) in this particular button
                                      if (isset($_POST['submit'])) {
                                        $username = $_POST['username'];
                                        $files = $_FILES['file'];
                                  //      print_r($username);   to chk the values stored in the variable $username by $_POST['username'] method
                                        echo "<br>";
                                //        print_r($files);       to chk the values stored in the variable $files by $_POST['$files'] method
                                        $filename = $files['name'];    // to assign file name from variable $files stored from above $_FILES['file'] method
                                        $fileerror = $files['error'];  // chk error if any will be collected in $fileerror
                                        $filetmp = $files['tmp_name'];  // saving the file at temporary place to chk the error and extension before it is saved in folder
                                        $fileext = explode('.',$filename);  //explode function separates the string from(.) the file extension string to variable $fileext
                                        print_r($fileext);
                                        echo "<br>";
                                        $filecheck = strtolower(end($fileext));//converts the end of string after (.) to lowercase
                                        print_r($filecheck);
                                        $fileextstored = array('png','jpg','jpeg','jfif'); // extension to be allowed are to be stored

                                              if (in_array($filecheck,$fileextstored)) { //if extension mathched than true
                                                $destinationfile = 'upload/' .$filename;   // if true than saved in variable to be saved in folder [upload]
                                                move_uploaded_file($filetmp,$destinationfile); // save the file from temporary file
                                                $q = "INSERT INTO `imgupload`( `username`, `image`) VALUES ('$username','$destinationfile')";//insert query assigen to variable
                                                $query = mysqli_query($con,$q); //inserted in database

                                                $displayquery = " select * from imgupload";//variable assigned with values from table named imgupload
                                                $querydisplay = mysqli_query($con,$displayquery); //firing the query for storing the result in variable $querydisplay

                                              //  $row = mysqli_num_rows($querydisplay);
                                                  while ($result = mysqli_fetch_array($querydisplay)) { // while loop to populate rows matching the query it depend on the result
                                                    ?>                                              <!-- php stoped when html invoked-->
                                                      <tr>                                      <!--html rows inserted to display the query -->
                                                        <td><?php echo $result['id']; ?></td>
                                                        <td><?php echo $result['username']; ?></td>
                                                        <td> <img src="<?php echo $result['image']; ?>" height="70px" width="auto"</td>
                                                      </tr>



                                                    <?php                               //php started after it comes out of loop populating the rows
                                                }




                                              }else {
                                                echo "Extension is not Matched";
                                              }

                                            }



                                       ?>
                                    </tbody>

                    </div>

                    </table>
              </div>

      </body>
</html>
