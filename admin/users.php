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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    //add user
                    if(isset($_POST['add_user'])) {
                        $user_name = $_POST['user_name'];
                        $user_email = $_POST['user_email'];
                        $user_password = $_POST['user_password'];
                        $user_reg_date = date('d-m-y');
                        $sql_add = "INSERT INTO users (username, email, password, reg_date) VALUES ('$user_name', '$user_email', '$user_password', '$user_reg_date')"; //! sqli
                        $result_add = mysqli_query($conn, $sql_add);
                        if ($result_add) {
                            header("Location: users.php");
                            exit;
                        }else{
                            header("Location: users.php");
                            exit;
                        }
                    }

                ?>

                <?php 
                //edit user
                if (isset($_POST['edit_user'])) {
                    # code...
                    $user_id = $_POST['user_id'];
                    $user_name = $_POST['user_name'];
                    $user_email = $_POST['user_email'];
                    $user_password = $_POST['user_password'];
                    $sql_edit = "UPDATE users SET username = '$user_name', email = '$user_email', password = '$user_password' WHERE id = '$user_id'"; //! sqli
                    $result_edit = mysqli_query($conn, $sql_edit);
                    if ($result_edit) {
                        header("Location: users.php");
                        exit;
                    }else{
                        header("Location: users.php");
                        exit;
                    }
                }
                ?>

                <?php
                    $sql = "SELECT * FROM users"; //! sqli
                    $result = mysqli_query($conn, $sql);
                    $k = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $user_id = $row['id'];
                        $user_name = $row['username'];
                        $user_email = $row['email'];
                        $user_password = $row['password'];
                        $user_reg_date = $row['reg_date'];
                    
                    ?>

                    <tr>
                        <td><?= $user_id ?></td>
                        <td><?= $user_name ?></td>
                        <td><?= $user_email ?></td>
                        <td><?= $user_password ?></td>
                        <td><?= $user_reg_date ?></td>
                        <td>
                            <div class='dropdown'>
                                <button class='btn btn-primary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    Actions
                                </button>
                                <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                    <a class='dropdown-item' data-toggle='modal' data-target='#edit_modal<?=$k ?>' href='#'>Edit</a>
                                    <div class='dropdown-divider'></div>
                                    <a class='dropdown-item' href='users.php?delete=<?=$user_id ?>'>Delete</a>
                                    <div class='dropdown-divider'></div>
                                    <a class='dropdown-item' data-toggle='modal' data-target='#add_modal'>Add</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                   
                    <div id="edit_modal<?=$k ?>" class="modal fade">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="user_name">User Name</label>
                                            <input type="text" class="form-control" name="user_name" value="<?= $user_name ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="user_email">User Email</label>
                                            <input type="email" class="form-control" name="user_email" value="<?= $user_email ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="user_password">User Password</label>
                                            <input type="text" class="form-control" name="user_password" value="<?= $user_password ?>">
                                        </div>

                                        <!-- <div class="form-group">
                                            <label for="user_role">User Role</label>
                                            <input type="text" class="form-control" name="user_role">
                                        </div> -->

                                        <div class="form-group">
                                            <input type="hidden" name="user_id" value="<?=$user_id ?>">
                                            <input type="submit" class="btn btn-primary" name="edit_user" value="Edit User">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $k++;
                    }?>
                </tbody>
            </table>

            <div id="add_modal" class="modal fade">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post">
                                        <div class="form-group">
                                            <label for="user_name">User Name</label>
                                            <input type="text" class="form-control" name="user_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="user_email">User Email</label>
                                            <input type="email" class="form-control" name="user_email">
                                        </div>
                                        <div class="form-group">
                                            <label for="user_password">User Password</label>
                                            <input type="text" class="form-control" name="user_password">
                                        </div>

                                <div class="form-group">
                                    <input type="hidden" name="user_id" value="">
                                    <input type="submit" class="btn btn-primary" name="add_user" value="Add User">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            if(isset($_GET['delete'])){
                $delete_id = $_GET['delete'];
                $sql_delete = "DELETE FROM users WHERE id = '$delete_id'"; //! sqli
                $result_delete = mysqli_query($conn, $sql_delete);
                if ($result_delete) {
                    header("Location: users.php");
                    exit;
                }else{
                    header("Location: users.php");
                    exit;
                }
            }
            ?>

            <?php include "includes/admin_footer.php"; ?>