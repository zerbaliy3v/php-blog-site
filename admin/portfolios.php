<?php include "includes/admin_header.php"; ?>

<div id="wrapper">

<?php include "includes/admin_sidebar.php"; ?>


    <div id="content-wrapper">
        <div class="container-fluid">
            <h1>Welcome to Admin Page</h1>
            <hr>

            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Portfolio Name</th>
                        <th>Portfolio Category</th>
                        <th>Image</th>
                        <th>Add - Edit - Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //? ADD Portfolios
                    if (isset($_POST['add_portfolio'])) {
                        $portfolio_name = $_POST['portfolio_name'];
                        $portfolio_category = $_POST['portfolio_category'];

                        $image_sm = $_FILES['image']['name'];
                        $image_sm_tmp = $_FILES['image']['tmp_name'];

                        $image_bg = $_FILES['imagebg']['name'];
                        $image_bg_tmp = $_FILES['imagebg']['tmp_name'];

                        move_uploaded_file($image_sm_tmp, "../img/$image_bg");
                        move_uploaded_file($image_bg_tmp, "../img/$image_bg");

                        $sql = "INSERT INTO portfolio (portfolio_name, portfolio_category, portfolio_img_sm, portfolio_img_bg)";
                        $sql .= "VALUES('$portfolio_name', '$portfolio_category', '$image_sm', '$image_bg')"; //! sqli
                        $result = mysqli_query($conn, $sql);
                        if (!$result) {
                            header('Location: portfolios.php');
                            exit;
                        } else {
                            header('Location: portfolios.php');
                        }
                    }
                    ?>
                    <?php
                    //? Edit Portfolios
                    if (isset($_POST['edit_portfolio'])) {
                        $portfolio_id_edit = $_POST['portfolio_id'];
                        $portfolio_name_edit = $_POST['portfolio_name'];
                        $portfolio_category_edit = $_POST['portfolio_category'];

                        $image_sm_edit = $_FILES['image']['name'];
                        $image_sm_tmp_edit = $_FILES['image']['tmp_name'];

                        $image_bg_edit = $_FILES['imagebg']['name'];
                        $image_bg_tmp_edit = $_FILES['imagebg']['tmp_name'];
                        
                        if (!empty($image_sm_tmp_edit) && !empty($image_bg_tmp_edit)) {
                            move_uploaded_file($image_sm_tmp_edit, "../img/$image_sm_edit");
                            move_uploaded_file($image_bg_tmp_edit, "../img/$image_bg_edit");
    
                        }
                        
                        if (empty($image_sm_tmp_edit)) {
                            $sql_3 = "SELECT * FROM portfolio WHERE portfolio_id='$portfolio_id_edit'"; //! sqli image name
                            $img_query1 = mysqli_query($conn,$sql_3);
                            while ($row1 = mysqli_fetch_array($img_query1)) {
                                $image_sm_edit = $row1['portfolio_img_sm'];
                            }
                        }
                        if (empty($image_bg_tmp_edit)) {
                            $sql_4 = "SELECT * FROM portfolio WHERE portfolio_id='$portfolio_id_edit'"; //! sqli image name
                            $img_query2 = mysqli_query($conn,$sql_3);
                            while ($row2 = mysqli_fetch_array($img_query2)) {
                                $image_bg_edit = $row2['portfolio_img_bg'];
                            }
                        }
                        $sql_edit = "UPDATE  portfolio SET 
                                    portfolio_name='$portfolio_name_edit', 
                                    portfolio_category ='$portfolio_category_edit', 
                                    portfolio_img_sm='$image_sm_edit', 
                                    portfolio_img_bg= '$image_bg_edit' 
                                    WHERE portfolio_id='$portfolio_id_edit'";  //! sqli
                        
                        $result_edit = mysqli_query($conn, $sql_edit);
                        if (!$result_edit) {
                            header('Location: portfolios.php');
                            exit;
                        }else {
                            header('Location: portfolios.php');
                            exit;
                        }
                    }
                    ?>

                    <?php
                    //? Get Portfolios list
                    $sql = 'SELECT * FROM portfolio ORDER BY portfolio_id DESC';
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        $k = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $portfolio_id = $row['portfolio_id'];
                            $portfolio_name = $row['portfolio_name'];
                            $portfolio_category = $row['portfolio_category'];
                            $portfolio_img_sm = $row['portfolio_img_sm'];
                            $portfolio_img_bg = $row['portfolio_img_bg'];
                        //! xss 
                            echo"<tr>
                            <td>{$portfolio_id}</td>
                            <td>{$portfolio_name}</td>
                            <td>{$portfolio_category}</td>
                            <td><img src='../img/{$portfolio_img_sm}' width='100px' height='100px'></td>
                            <td>
                                <div class='dropdown'>
                                        <button class='btn btn-primary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                        Actions
                                        </button>
                                        <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                        <a class='dropdown-item' data-toggle='modal' data-target='#edit_modal$k' href='#'>Edit</a>
                                        <div class='dropdown-divider'></div>
                                        <a class='dropdown-item' href='portfolios.php?delete={$portfolio_id}'>Delete</a>
                                        <div class='dropdown-divider'></div>
                                        <a class='dropdown-item' data-toggle='modal' data-target='#add_modal'>Add</a>
                                        </div>
                                        </div>
                                    </td>
                                </tr>";
                            ?>


                            <div id="edit_modal<?= $k ?>" class="modal fade">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Portfolio</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="portfolio_name">Portfolio Name</label>
                                                    <input type="text" class="form-control" name="portfolio_name"
                                                        value="<?= $portfolio_name ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="portfolio_category">Portfolio Category</label>
                                                    <select class="form-group" name="portfolio_category">
                                                        <?php
                                                        $sql = "SELECT * FROM categories";
                                                        $result_cat = mysqli_query($conn, $sql);
                                                        while ($row_cat = mysqli_fetch_assoc($result_cat)) {
                                                            $category_name = $row_cat['category_name'];
                                                            echo "<option>$category_name</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <img src="../img/<?=$portfolio_img_sm?>" alt="x" width="50px" height="50px">
                                                    <input type="file" class="form-control" name="image">
                                                </div>

                                                <div class="form-group">
                                                    <img src="../img/<?=$portfolio_img_bg?>" alt="x" width="60px" height="60px">
                                                    <input type="file" class="form-control" name="imagebg" placeholder="salam">
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" name="portfolio_id" value="<?= $row['portfolio_id'] ?>">
                                                    <input type="submit" class="btn btn-primary" name="edit_portfolio"
                                                        value="Edit Portfolio">
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
                        echo "<h1>You Are Not Portfolios </h1>";
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
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="portfolio_name">Product Name</label>
                                    <input type="text" class="form-control" name="portfolio_name">
                                </div>

                                <div class="form-group">
                                    <label for="portfolio_category">Portfolio Category</label>


                                    <select class="form-group" name="portfolio_category">
                                        <?php
                                        $sql = "SELECT * FROM categories";
                                        $result_cat = mysqli_query($conn, $sql);
                                        while ($row_cat = mysqli_fetch_assoc($result_cat)) {
                                            $category_name = $row_cat['category_name'];
                                            echo "<option>$category_name</option>";
                                        }
                                        ?>
                                    </select>

                                </div>

                                <div class="form-group">
                                    <label for="portfolio_image_sm">Small Image</label>
                                    <input type="file" class="form-control" name="image">
                                </div>

                                <div class="form-group">
                                    <label for="portfolio_image_bg">Big Image</label>
                                    <input type="file" class="form-control" name="imagebg">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="add_portfolio"
                                        value="Add Portfolio">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <?php
            //? DELETE Portfolios
            if (isset($_GET['delete'])) {
                $portfolio_id = $_GET['delete'];

                $sql = "DELETE FROM portfolio WHERE portfolio_id = '$portfolio_id'";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    header('Location: portfolios.php');
                    exit;
                } else {
                    header('Location: portfolios.php');
                }
            }
            ?>

        <?php mysqli_close($conn); ?>
        <?php include "includes/admin_footer.php"; ?>