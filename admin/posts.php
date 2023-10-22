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
                        <th>Post Title</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Date</th>
                        <th>Comments</th>
                        <th>Image</th>
                        <th>Text</th>
                        <th>Tags</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                
                <?php 
                        //* Edit post

                        if (isset($_POST['edit_post'])) {
                            $post_id_edit = $_POST['post_id'];
                            $post_title_edit = $_POST['post_title'];
                            $post_category_edit = $_POST['post_category'];
                            $post_author_edit = $_POST['post_author'];
                            $post_comment_number_edit = 8;
                            $post_text_edit = htmlentities($_POST['post_text']);
                            $post_tags_edit = $_POST['post_tags'];
                            $post_image_edit = $_FILES['post_image']['name'];
                            $post_date_edit = (string) date('d-m-y');
                            
                            if (!empty($post_image_edit)) {
                                move_uploaded_file($_FILES['post_image']['tmp_name'], __DIR__."../img/$post_image_edit"); //! file upload and lfi and RCE ...
                            }else{
                                $sql_3 = "SELECT * FROM posts WHERE post_id='$post_id_edit'"; //! sqli image name
                                $img_query1 = mysqli_query($conn,$sql_3);
                                while ($row1 = mysqli_fetch_array($img_query1)) {
                                    $post_image_edit = $row1['post_image'];
                                }
                            }
                            $sql_edit = "UPDATE  posts SET post_title='$post_title_edit', post_category='$post_category_edit', 
                                        post_author='$post_author_edit', post_text='$post_text_edit', 
                                        post_tags='$post_tags_edit', post_image='$post_image_edit', 
                                        post_date='$post_date_edit', post_comment_number= '$post_comment_number_edit' WHERE post_id='$post_id_edit'" ; //! sqli
                            $result_edit= mysqli_query($conn,$sql_edit);

                            if ($result_edit) {
                                header("Location: posts.php");
                                exit;
                            }else{
                                header("Location: posts.php");
                                exit;
                            }

                        }
                    
                    ?>
<?php
$sql_comment_show = "SELECT * FROM comments WHERE comment_post_id = '$post_id' AND comment_status = 'yes' order by comment_id DESC";
$result_comment_show = mysqli_query($conn, $sql_comment_show);

if(!$result_comment_show){
	die("Query Failed");
}
if (mysqli_num_rows($result_comment_show) > 0) {
	$post_comment_number = mysqli_num_rows($result_comment_show);}
else {
	$post_comment_number=0;
}
?>
                
                <?php 
                   
                   $sql = 'SELECT * FROM posts';
                   $result = mysqli_query($conn,$sql);
                   if(mysqli_num_rows($result) > 0){
                       $k=0;
                       while ($row = mysqli_fetch_assoc($result)) {
                           $post_id = $row['post_id'];
                           $post_category = $row['post_category'];
                           $post_title = $row['post_title'];
                           $post_author = $row['post_author'];
                           $post_text = substr($row['post_text'],0,20);
                           $post_tags = $row['post_tags'];
                           $post_date = $row['post_date'];
                           $post_image = $row['post_image'];
                     
                    ?>

                    <tr>
                        <td><?= $post_id ?></td>
                        <td><?= $post_title ?></td>
                        <td><?= $post_category ?></td>
                        <td><?= $post_author ?></td>
                        <td><?= $post_date ?></td>
                        <td><?= $post_comment_number ?></td>
                        <td><img src='../img/<?= $post_image ?>' width='100px' height='100px'></td>
                        <td><?= htmlentities($post_text) ?></td>
                        <td><?= $post_tags ?></td>
                        <td>
                            <div class='dropdown'>
                                <button class='btn btn-primary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    Actions
                                </button>
                                <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                    <a class='dropdown-item' data-toggle='modal' data-target='#edit_modal<?=$k?>' href='#'>Edit</a>
                                    <div class='dropdown-divider'></div>
                                    <a class='dropdown-item' href='posts.php?delete=<?=$post_id ?>'>Delete</a>
                                    <div class='dropdown-divider'></div>
                                    <a class='dropdown-item' data-toggle='modal' data-target='#add_modal'>Add</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    

                    <div id="edit_modal<?=$k?>" class="modal fade">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Portfolio</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <form action="posts.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="post_title">Post Title</label>
                                            <input type="text" class="form-control" name="post_title" value="<?= $post_title ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="post_category">Post Category</label>
                                            <select class="form-group" name="post_category">
                                                    <?php
                                                        $sql = "SELECT * FROM categories ORDER BY category_id ASC";
                                                        $result_cat = mysqli_query($conn, $sql);
                                                        while ($row_cat = mysqli_fetch_assoc($result_cat)) {
                                                            $category_name = $row_cat['category_name'];
                                                            
                                                            if (strtoupper($category_name) == strtoupper($post_category)) {
                                                               echo "<option selected>$category_name</option>";
                                                            }else{
                                                               echo "<option >$category_name</option>";
                                                            }
                                                        }
                                                    ?>
                                                    </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="post_author">Post Author</label>
                                            <input type="text" class="form-control" name="post_author" value="<?= $post_author ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="post_image">Post Image</label>
                                            <br>
                                            <img src="../img/<?= $post_image ?>" alt="x" width="100px" height="100px">
                                            <input type="file" class="form-control" name="post_image">
                                        </div>
                                        <div class="form-group">
                                            <label for="post_tags">Post Tags</label>
                                            <input type="text" class="form-control" name="post_tags" value="<?= $post_tags ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="post_text">Post Text</label>
                                            <textarea class="form-control" name="post_text" cols="20" rows="5"><?= $row['post_text'] ?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <input type="hidden" name="post_id" value="<?= $post_id ?>">
                                            <input type="submit" class="btn btn-primary" name="edit_post" value="Edit Post">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>



                    <?php 
                    //* get post list end 
                    $k++;
                        } 
                    };
                    ?>

                    <?php 
                            // * add post
                            function addPost($post_title, $post_category, $post_author, $post_comment_number, $post_text, $post_tags, $post_image,$post_date) {
                                $sql_add  = "INSERT INTO posts(post_title, post_category, post_author, post_comment_number, post_text, post_tags, post_image,post_date)";
                                $sql_add .= "VALUES ('$post_title', '$post_category', '$post_author', '$post_comment_number', '$post_text', '$post_tags', '$post_image','$post_date')"; //! sqli
                                $result_add= mysqli_query($GLOBALS['conn'],$sql_add); 
                                return $result_add;
                                // return $sql_add;
                            };

                            if (isset($_POST['add_post'])) {
                                $post_title_add = $_POST['post_title'];
                                $post_category_add = $_POST['post_category'];
                                $post_author_add = $_POST['post_author'];
                                $post_comment_number_add = 8;
                                $post_text_add = $_POST['post_text'];
                                $post_tags_add = $_POST['post_tags'];
                                $post_image_add = $_FILES['post_image']['name'];
                                $post_date_add = date('d-m-y');
                                
                                move_uploaded_file($_FILES['post_image']['tmp_name'], __DIR__."../img/$post_image_add"); //! file upload and lfi and RCE ...

                                $result_add = addPost($post_title_add, $post_category_add, $post_author_add, 
                                        $post_comment_number_add, $post_text_add, 
                                        $post_tags_add, $post_image_add, $post_date_add);
                                
                                if ($result_add) {
                                    header("Location: posts.php");
                                    exit;
                                }else{
                                    header("Location: posts.php");
                                    exit;
                                }

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
                            <form action="posts.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="post_title">Post Title</label>
                                    <input type="text" class="form-control" name="post_title">
                                </div>
                                <div class="form-group">
                                    <label for="post_category">Post Category</label><br>    

                                    <select class="form-group" name="post_category">
                                                    <?php
                                                        $sql = "SELECT * FROM categories ORDER BY category_id ASC";
                                                        $result_cat = mysqli_query($conn, $sql);
                                                        while ($row_cat = mysqli_fetch_assoc($result_cat)) {
                                                            $category_name = $row_cat['category_name'];
                                                            
                                                           
                                                               echo "<option >$category_name</option>";
                                                        
                                                        }
                                                    ?>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="post_author">Post Author</label>
                                    <input type="text" class="form-control" name="post_author">
                                </div>

                                <div class="form-group">
                                    <label for="post_image">Post Image</label>
                                    <input type="file" class="form-control" name="post_image">
                                </div>
                                <div class="form-group">
                                    <label for="post_tags">Post Tags</label>
                                    <input type="text" class="form-control" name="post_tags">
                                </div>
                                <div class="form-group">
                                    <label for="post_text">Post Text</label>
                                    <textarea class="form-control" name="post_text" id="" cols="20" rows="5"></textarea>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="post_id" value="">
                                    <input type="submit" class="btn btn-primary" name="add_post" value="Add Post">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
            if(isset($_GET['delete'])){
                $delete_id = $_GET['delete'];
                $sql_delete = "DELETE FROM posts WHERE post_id = '$delete_id'"; //! sqli
                $result_delete = mysqli_query($conn, $sql_delete);
                if ($result_delete) {
                    header("Location: posts.php");
                    exit;
                }else{
                    header("Location: posts.php");
                    exit;
                }
            }

            ?>

            <?php mysqli_close($conn); ?>
            <?php include "includes/admin_footer.php"; ?>