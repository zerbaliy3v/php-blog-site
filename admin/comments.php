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
                        <th>Author</th>
                        <th>Email</th>
                        <th>Comment</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Response</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // edit 
                        if (isset($_POST['view_post'])) {
                            $comment_author_edit = $_POST['comment_author'];
                            $comment_email_edit = $_POST['comment_email'];
                            $comment_text_edit = $_POST['comment_text'];
                            $comment_status_edit = $_POST['select_status'];
                            $comment_id_edit = $_POST['comment_id'];

                            $sql_edit = "UPDATE comments SET comment_author = '$comment_author_edit', comment_email = '$comment_email_edit', comment_text = '$comment_text_edit', comment_status = '$comment_status_edit' WHERE comment_id = '$comment_id_edit'";
                            $result_edit = mysqli_query($conn, $sql_edit);
                            if (!$result_edit) {
                                die("Query Failed" . mysqli_error($conn));
                            }
                            header("Location: comments.php");
                            exit;
                        }

                    ?>


                    <?php
                    // Get lists
                    $sql = 'SELECT * FROM comments order by comment_id desc';
                    $result = mysqli_query($conn, $sql);

                    if (!$result) {
                        die("Query Failed" . mysqli_error($conn));
                    }
                    $k = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $comment_id = $row['comment_id'];
                        $comment_author = $row['comment_author'];
                        $comment_email = $row['comment_email'];
                        $comment_text = $row['comment_text'];
                        $comment_date = $row['comment_date'];
                        $comment_status = $row['comment_status'];
                        $comment_post_id = $row['comment_post_id'];

                        $sql_post = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                        $result_post = mysqli_query($conn, $sql_post);
                        if (!$result_post) {
                            die("Query Failed" . mysqli_error($conn));
                        }
                        while ($row = mysqli_fetch_array($result_post)) {
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            $post_image = $row['post_image'];
                        }

                    ?>
                        <tr>
                            <td><?= $comment_id ?></td>
                            <td><?= $comment_author ?></td>
                            <td><?= $comment_email ?></td>
                            <td><?= $comment_text ?></td>
                            <td><?= $comment_date ?></td>
                            <td><?= $comment_status ?></td>
                            <td><?= substr($post_title,0, 20) ?> - <b>[<?= $comment_post_id ?>]</b></span></td>
                            <td>
                                <div class='dropdown'>
                                    <button class='btn btn-primary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                        Actions
                                    </button>
                                    <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                        <a class='dropdown-item' data-toggle='modal' data-target='#view_modal<?= $k ?>' href='#'>View-Edit</a>
                                        <div class='dropdown-divider'></div>
                                        <a class='dropdown-item' href='comments.php?delete=<?= $comment_id ?>'>Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>


                        <div id="view_modal<?php echo $k; ?>" class="modal fade">
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
                                                <label for="comment_author">Comment Author</label>
                                                <input type="text" class="form-control" name="comment_author" value="<?= $comment_author ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="comment_email">Comment Email</label>
                                                <input type="text" class="form-control" name="comment_email" value="<?= $comment_email ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="comment_text">Comment Text</label>
                                                <textarea class="form-control" name="comment_text" id="" cols="20" rows="5"><?= $comment_text ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="comment_status">Comment Status</label>
                                                <!-- <input type="text" class="form-control" name="comment_status" value="<?= $comment_status ?>"> -->
                                                <select name="select_status">
                                                    <?php
                                                    if ($comment_status == 'yes') {
                                                        echo "<option value='yes' selected>Yes</option>";
                                                        echo "<option value='no'>No</option>";
                                                    } else {
                                                        echo "<option value='yes'>Yes</option>";
                                                        echo "<option value='no' selected>No</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="commented_post">Commented Post</label>
                                                <input type="text" class="form-control" name="commented_post" value="<?= $post_title ?>" disabled>

                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" name="comment_id" value="<?= $comment_id ?>">
                                                <input type="submit" class="btn btn-primary" name="view_post" value="View Post">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php $k++;
                    } ?>
                    <?php

                    if (isset($_GET['delete'])) {
                        $delete_id = $_GET['delete'];
                        $sql_delete = "DELETE FROM comments WHERE comment_id = '$delete_id'"; //! sqli
                        $result_delete = mysqli_query($conn, $sql_delete);
                        if ($result_delete) {
                            header("Location: comments.php");
                            exit;
                        } else {
                            header("Location: comments.php");
                            exit;
                        }
                    }

                    ?>



                </tbody>
            </table>

            <?php include "includes/admin_footer.php"; ?>