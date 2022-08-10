<?php require_once("includes/db.php"); ?>
<?php
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
    $sql = "INSERT INTO posts(datetime,title,category,author,image,post)";
    $sql .= "VALUES(:dateTime,:postTitle,:categoryName,:adminName,:imageName,:postDescription)";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':dateTime',$DateTime);
    $stmt->bindValue(':postTitle',$PostTitle);
    $stmt->bindValue(':categoryName',$Category);
    $stmt->bindValue(':adminName',$Admin);
    $stmt->bindValue(':imageName',$Image);
    $stmt->bindValue(':postDescription',$PostText);
    $Execute = $stmt->execute();
    move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
}
 ?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="stylesheet" href="css/blog.css">
    <title>Categories</title>
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
         <h1>Add New Post</h1>
     </header>
    <!-- End Header -->
    <!-- Main -->
  
    <form class="" action="addnewpost.php" method="post" enctype="multipart/form-data">
          </div>
              <label for="title">  Post Title: </label>
               <input type="text" name="PostTitle" id="title" placeholder="Type title here" value="">
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
                <input type="File" name="Image" id="imageSelect" value="">
                <label for="image">Select Image</label>
                <label for="Post">Post: </label>
                <textarea name="PostDescription" id="Post" rows="8" cols="80"></textarea>
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