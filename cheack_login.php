<?php 
// print_r($_POST);
session_start();
        if(isset($_POST['mem_username'])){
        //connection
                  include("condb.php");
        //รับค่า user & mem_password
                  $m_user = mysqli_real_escape_string($con,$_POST['mem_username']);
                  $m_pass = mysqli_real_escape_string($con,$_POST['mem_password']);

                
                    //query 
                              $sql="SELECT * FROM members 
                              WHERE mem_username='".$mem_username."' 
                              AND mem_password='".$mem_password."'";
                              $result = mysqli_query($con, $sql);

                               //echo $sql;

                              // echo mysqli_num_rows($result);

                              //exit;
                    
                              if(mysqli_num_rows($result)==1){

                                  $row = mysqli_fetch_array($result);

                                  $_SESSION["mem_id"] = $row["mem_id"];
                                  $_SESSION["mem_status"] = $row["mem_status"];
                                  $_SESSION["mem_fname"] = $row["mem_fname"];
                                  $_SESSION["mem_lname"] = $row["mem_lname"];   
                                       
                                      

                                      if($row['mem_status']=="admin"){                                     
                                          Header("Location: admin/");
                                          
                                      }elseif($row['m_level']=="Authorities"){
                                          Header("Location: authorities/");
                                      }elseif($row['m_level']=="Commission"){
                                          Header("Location: commission/");
                                      }elseif($row['m_level']=="Executive"){
                                          Header("Location: executive/");
                                      }elseif($row['m_level']=="DeputyExecutive"){
                                          Header("Location: DeputyExecutive/");
                                      }
                                
                                 
                                 


                              }else{
                                    echo "<script>";
                                    echo "alert(\" user หรือ  password ไม่ถูกต้อง\");"; 
                                    echo "window.history.back()";
                                    echo "</script>";
                              }


                    //close else chk trim

                    //exit();




        }else{


             Header("Location: index.php"); //user & mem_password incorrect back to login again

        }
?>