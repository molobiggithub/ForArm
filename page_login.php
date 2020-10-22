<?php 
session_start();
        if(isset($_POST['uname'])){
				//connection
                  include("connection.php");
				//รับค่า user & password
                  $Username = $_POST['uname'];
                  $Password = $_POST['psw'] ;
				//query
                  $sql="SELECT * FROM User Where Username='".$Username."' and Password='".$Password."' ";

                  $result = mysqli_query($con,$sql);

                  if(mysqli_num_rows($result)==1){

                      $row = mysqli_fetch_array($result);

                      $_SESSION["UserID"] = $row["ID"];
                      $_SESSION["User"] = $row["Firstname"]." ".$row["Lastname"];
                      $_SESSION["Userlevel"] = $row["Userlevel"];

                      if($_SESSION["Userlevel"]=="A"){ //ถ้าเป็น admin ให้กระโดดไปหน้า admin_page.php
                        ?>
                        <table style="border: 1px solid black;">
                        <tr>
                        <th>Status :</th>
                         <td><?Php echo "Admin Level" ; ?></td>
                        </tr>
                        <tr>
                        <th>Name and Lastname :</th>
                         <td><?Php echo $_SESSION["User"] ?></td>
                        </tr>
                       
                        </table>
                        

                        <?php
                      }

                      if ($_SESSION["Userlevel"]=="M"){  //ถ้าเป็น member ให้กระโดดไปหน้า user_page.php

                        Header("Location: user_page.php");

                      }

                  }else{
                    echo "<script>";
                        echo "alert(\" user หรือ  password ไม่ถูกต้อง\");"; 
                        echo "window.history.back()";
                    echo "</script>";

                  }

        }else{


             Header("Location: form_login.php"); //user & password incorrect back to login again

        }
?>