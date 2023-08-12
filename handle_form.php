<?php
  include_once("db_connect.php");
 
  if($conn){
    if($_SERVER['REQUEST_METHOD'] == "POST"){
      $task = $_POST['task'];
      $desc = $_POST['description'];
      if(!empty($task) && !empty($desc)){
        if(!isset($_POST['id'])){
          $sql = "insert into tasks (`task`,  `description`) values ('{$task}', '{$desc}')";
          $result = mysqli_query($conn, $sql);
          if($result){
            header("Location:index.php");
          }
          else{
            echo '<div class="container col-md-6 alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Error Submitting Data!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
          }
        }
        else{
          $id = $_POST['id'];
          $sql = "update tasks set task='{$task}', description='{$desc}' where id=$id";
          echo $sql;
          $result = mysqli_query($conn, $sql);
          if($result){
            header("Location:index.php");
          }
          else{
            echo '<div class="container col-md-6 alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Error Submitting Data!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
          }
        }
     }
  }

   else if($_SERVER['REQUEST_METHOD'] == 'GET'){
      if(isset($_GET['id'])){
          $id = $_GET['id'];
          $sql = "delete from tasks where id=$id";
          $result = mysqli_query($conn, $sql);
          if($result){
            header("Location:index.php");
          }
          else{
            echo '<div class="container col-md-6 alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Error Deleting Data!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
          }
        }
      }
  }
  else{
    echo '<div class="container col-md-6 alert alert-warning alert-dismissible fade show" role="alert">
         <strong>Error Connecting Database!</strong>
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>';
  }
 


?>