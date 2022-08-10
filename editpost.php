<?php require_once("includes/db.php"); ?>
<?php
$SearchQueryParameter = $_GET['id'];
if(isset($_POST["Submit"])){
  $PostTitle = $_POST["PostTitle"];
  $Category = $_POST["Category"];
  $Image = $_FILES["Image"]["name"];
  $Target = "Uploads/".basename($_FILES["Image"]["name"]);
  $PostText = $_POST["PostDescription"];
  $Admin = "Anyisa";
  date_default_timezone_set("America/New_York");
  $CurrentTime=time();
  $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);

    global $ConnectingDB;
    if (!empty($_FILES["Image"]["name"])) {
      $sql = "UPDATE posts
              SET title='$PostTitle', category='$Category', image='$Image', post='$PostText'
              WHERE id='$SearchQueryParameter'";
    }else {
      $sql = "UPDATE posts
              SET title='$PostTitle', category='$Category', post='$PostText'
              WHERE id='$SearchQueryParameter'";
    }
    $Execute= $ConnectingDB->query($sql);
    move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
          }
       
 ?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="stylesheet" href="css/blog.css">
    <title>Edit Post</title>
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
         <h1>Edit Post</h1>
     </header>
    <!-- End Header -->
    <!-- Main -->
    <?php 
    global $ConnectingDB;
    $sql = "SELECT * FROM posts WHERE id ='$SearchQueryParameter'";
    $stmt =$ConnectingDB->query($sql);
    while($DataRows=$stmt->fetch()){
     $TitleToBeUpdated = $DataRows['title'];
     $CategoryToBeUpdated = $DataRows['category'];
     $ImageToBeUpdated = $DataRows['image'];
     $PostToBeUpdated = $DataRows['post'];
     }
    ?>
    <form class="" action="editpost.php?id=<?php echo $SearchQueryParameter; ?>" method="post" enctype="multipart/form-data">
          </div>
              <label for="title">  Post Title: </label>
               <input type="text" name="PostTitle" id="title" placeholder="Type title here" value="<?php echo $TitleToBeUpdated; ?>">
               <span>Existing Category:</span>
               <?php echo $CategoryToBeUpdated; ?>
               <label for="CategoryTitle">Chose Category</label>
               <select id="CategoryTitle" name="Category">
                  <?php 
                  global $ConnectingDB;
                  $sql = "SELECT id, title FROM category";
                  $stmt = $ConnectingDB-> query($sql);
                  while ($DataRows = $stmt->fetch ()){
                    $Id = $DataRows["id"];
                    $CategoryName = $DataRows ['title'];

                  
                                    ?>
                                    <option><?php echo $CategoryName ?> </option>
                 <?php } ?>
               </select>
                <span>Existing Image:</span>
                <img src="Uploads/"<?php echo $ImageToBeUpdated;?> width="170px;" height="70px;">
                <input type="File" name="Image" id="imageSelect" value="">
                <label for="image">Select Image</label>
                <label for="Post">Post: </label>
                <textarea name="PostDescription" id="Post" rows="8" cols="80">
                    <?php echo $PostToBeUpdated ?>
                </textarea>
                <a href="dashboard.php"> Back To Dashboard</a>
                <button type="submit" name="Submit" >Publish</button>
    </form>
    <!-- End Main -->
    <!--FOOTER-->
    <footer>
        <p>Theme By | Anyisa S | &copy; ----All right Reserved.</p>
    </footer>
     <!-- End FOOTER-->
</body>
</html>