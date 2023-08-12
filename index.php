<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
    </style>
</head>
<body>

<?php
        include_once("db_connect.php");
?>

<div class="d-flex flex-column flex-lg-row col-md-12">

<?php
        if($_SERVER['REQUEST_METHOD'] == "GET"){
            if(isset($_GET['id']) && isset($_GET['update'])){
                $id = $_GET['id'];
                $sql = "select * from tasks where id=$id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
             
            ?>
              <div class="col-12 col-lg-6 p-4">
                <h2> Update Task </h2>
                <form action="handle_form.php" method="POST" encType="multipart/form-data">
                    <label class="form-label" for="task">Task Title</label>
                    <input class="form-control" value="<?php echo $row['task']; ?>" name="task" type="text" id="task">
    
                    <label class="form-label" for="description">Description</label>
                    <input class="form-control" value="<?php echo $row['description']; ?>" name="description" type="text" id="description">
    
                    <input type="hidden" name='id' value=<?php echo $row['id']; ?> >
    
                    <input class="btn btn-primary mt-4" type="submit" value="Update">
                </form>
            </div>
            
           <?php } else{ ?>
                <div class="col-12 col-lg-6 p-4">
                  <h2> Add A New Task </h2>
                  <form action="handle_form.php" method="POST" encType="multipart/form-data">
                      <label class="form-label" for="task">Task Title</label>
                      <input class="form-control" name="task" type="text" id="task">

                      <label class="form-label" for="description">Description</label>
                      <input class="form-control" name="description" type="text" id="description">

                      <input class="btn btn-primary mt-4" type="submit" value="Submit">
                  </form>
                </div>
           <?php } }?>


<!-- Render the Existing Data Into Tables -->
<?php 
  $sql2 = "select * from tasks";
  $result2 = mysqli_query($conn, $sql2);
    ?>
  
  <div class="col-12 col-lg-6 p-4">
   <h2>Task List </h2>
  <table class="table">
  <thead>
    <tr>
      <th scope="col"> Id </th>
      <th scope="col"> Task </th>
      <th scope="col"> Description </th>
      <th></th>
      <th></th>
    </tr>
  </thead>

  <tbody class="table-group-divider">
    <?php
      while($row = mysqli_fetch_assoc($result2)){
    ?>
     <tr>
        <td> <?php echo $row['id'] ?> </td>
        <td> <?php echo $row['task'] ?>  </td>
        <td> <?php echo $row['description'] ?> </td>
        <td> <a href="handle_form.php?id=<?php echo $row['id']; ?>"> <button class="btn btn-danger"> Delete </button> </a> </td>
        <td> <a href="index.php?update=true&id=<?php echo $row['id']; ?>"><button class="btn btn-info">Update </button> </a> </td>
      </tr>
    <?php
      }
    ?>
  </tbody>

</table>
  </div>

    </div>
</body>
</html>


