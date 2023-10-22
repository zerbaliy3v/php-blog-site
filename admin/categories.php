<?php include ("includes/admin_header.php"); ?>
<div id="wrapper">

  <?php include ("includes/admin_sidebar.php")?>


  <div id="content-wrapper">
    <div class="container-fluid">
      <h1>Welcome to Admin Page</h1>
      <hr>

      <table class="table table-bordered">
        <thead class="thead-dark">
          <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th>Add - Edit - Delete</th>
          </tr>
        </thead>
        <tbody>

          <?php
          //? add category
          if (isset($_POST['add_category'])) {
            if (!empty($_POST['category_name'])) {
              $add_text = $_POST['category_name'];
              $sql = "INSERT INTO  categories(category_name) VALUES('$add_text')"; //! sql injection!!!
              $result = mysqli_query($conn, $sql);
              if ($result) {
                header("Location: categories.php");
                die();
              }else {
                header("Location: categories.php");
                echo"<div class='alert alert-danger' role='alert'>
                        Not added! 
                    </div>";
                die();

              }

            }else{
              header("Location: categories.php");
              die();
            }
          }

          //? Delete Category 
          if (isset($_GET['delete'])) {
            if (!empty($_GET['delete'])) {
              $delete_id = (int) $_GET['delete'];
              $sql = "DELETE FROM categories WHERE category_id={$delete_id}"; //! sql injection!!!
              $result = mysqli_query($conn, $sql); 
              if ($result) {
                header("Location: categories.php");
                die();
              }

            }else{
              header("Location: categories.php");
              die();
            }
          
          }

          //? Edit Category



          if (isset($_POST['edit_category'])) {
            if (!empty($_POST['category_namex'])) {
              $category_text = $_POST['category_namex'];
              $id = $_POST['category_id'];
              $sql1 = "UPDATE categories  SET category_name='$category_text' WHERE category_id='$id'"; //! sql injection!!!
              $result = mysqli_query($conn, $sql1); 
              if ($result) {
                header("Location: categories.php");
                die();
              }

            }else{
              header("Location: categories.php");
              die();
            }
          
          }


          ?>
          <?php
          //? Get categories list
          $sql = "SELECT * FROM categories ORDER BY category_id DESC";  //? en son evvele
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
            $k =1;
              while ($row = mysqli_fetch_assoc($result)) {
                $category_id = $row['category_id'];
                $category_name = $row['category_name'];
                echo "<tr>
                          <td>{$category_id}</td>
                          <td>{$category_name}</td>
                          <td>
                          <div class='dropdown'>
                            <button class='btn btn-primary dropdown-toggle' type='button' id='dropdownMenuButton'
                              data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                              Actions
                            </button>
                            <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                              <a class='dropdown-item' data-toggle='modal' data-target='#edit_modal$k' href='#'>Edit</a>
                              <div class='dropdown-divider'></div>
                              <a class='dropdown-item' href='categories.php?delete={$category_id}'>Delete</a>
                              <div class='dropdown-divider'></div>
                              <a class='dropdown-item' data-toggle='modal' data-target='#add_modal'>Add</a>
                            </div>
                          </div>
                        </td>
                      </tr>";

           ?>
          <div id="edit_modal<?php echo $k;?>" class="modal fade">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="" method="post">
                    <div class="form-group">

                      <input value="<?php if(isset($category_name)){echo $category_name;} ?>" type="text" class="form-control" name="category_namex">
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="category_id" value="<?php echo $row['category_id']; ?>">
                      <input type="submit" class="btn btn-primary" name="edit_category" value="Edit Category">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
<?php  
$k++;
}
          } else {
            echo "<h1>You Are Not Categories</h1>";
          }
?>


        </tbody>
      </table>

      <div id="add_modal" class="modal fade">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="post">
                <div class="form-group">
                  <input type="text" class="form-control" name="category_name">
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-primary" name="add_category" value="Add Category">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php mysqli_close($conn); ?>
      <?php include ("includes/admin_footer.php"); ?>
      