<?php require_once("includes/db.php"); ?>
<?php
$SearchQueryParameter = $_GET['id'];
global $ConnectingDB;
$sql = "SELECT * FROM posts WHERE id ='$SearchQueryParameter'";
$stmt =$ConnectingDB->query($sql);
while($DataRows=$stmt->fetch()){
 $TitleToBeDeleted = $DataRows['title'];
 $CategoryToBeDeleted = $DataRows['category'];
 $ImageToBeDeleted = $DataRows['image'];
 $PostToBeDeleted = $DataRows['post'];
 }
echo $ImageToBeUpdated;

if(isset($_POST["Submit"])){
    global $ConnectingDB;
    $sql = "DELETE FROM posts WHERE id='$SearchQueryParameter'";
    $Execute= $ConnectingDB->query($sql);
    if($Execute){
        $Target_Path_To_DELETE_Image = "Uploads/$ImageToBeDeleted";
        unlink($Target_Path_To_DELETE_Image);
            }
          }
       ?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="stylesheet" href="css/blog.css">
    <title>Delete Post</title>
</head>
<body>
    <!--Navigation-->
    <nav>
        <div>
            <a href="#">anyisas.com</a>
            <ul>
                <li>
                    <a href="myprofile.php">My Profile</a>
                </li>
                <li>
                    <a href="dashboard.php">Dashboard</a>
                </li>
                <li>
                    <a href="posts.php">Posts</a>
                </li>
                <li>
                    <a href="categories.php">Categories</a>
                </li>
                <li>
                    <a href="admins.php">Manage Admins</a>
                </li>
                <li>
                    <a href="comments.php">Comments</a>
                </li>
                <li>
                    <a href="blog.php?page=1">Live Blog</a>
                </li>
            </ul>
            <ul>
                <li>
                    <a href="logout.php">LogOut</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navigation-->
    <!-- Header -->
     <header>
         <h1>Delete Post</h1>
     </header>
    <!-- End Header -->
    <!-- Main -->
    <form class="" action="deletepost.php?id=<?php echo $SearchQueryParameter; ?>" method="post" enctype="multipart/form-data">
          </div>
              <label  for="title">  Post Title: </label>
               <input disabled type="text" name="PostTitle" id="title" placeholder="Type title here" value="<?php echo $TitleToBeDeleted; ?>">
               <span>Existing Category:</span>
               <?php echo $CategoryToBeDeleted; ?>
                <span>Existing Image:</span>
                <img src="Uploads/"<?php echo $ImageToBeDeleted;?> width="170px;" height="70px;">
                <label for="Post">Post: </label>
                <textarea disabled name="PostDescription" id="Post" rows="8" cols="80">
                    <?php echo $PostToBeDeleted ?>
                </textarea>
                <a href="dashboard.php"> Back To Dashboard</a>
                <button type="submit" name="Submit" >Delete</button>
    </form>
    <!-- End Main -->
    <!--FOOTER-->
    <footer>
        <p>Theme By | Anyisa S | &copy; ----All right Reserved.</p>
    </footer>
     <!-- End FOOTER-->
</body>
</html>