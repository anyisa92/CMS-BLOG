<?php require_once("includes/db.php"); ?>
<?php
if(isset($_POST["Submit"])){
  $Category = $_POST["CategoryTitle"];
  $Admin = "Anyisa";
  date_default_timezone_set("America/New_York");
  $CurrentTime=time();
  $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
    global $ConnectingDB;
    $sql = "INSERT INTO category(title,author,datetime)";
    $sql .= "VALUES(:categoryName,:adminName,:dateTime)";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':categoryName',$Category);
    $stmt->bindValue(':adminName',$Admin);
    $stmt->bindValue(':dateTime',$DateTime);
    $Execute = $stmt->execute();
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
         <h1>Manage Categories</h1>
     </header>
    <!-- End Header -->
    <!-- Main -->
    <form class="" action="categories.php" method="post">
            <h1>Add New Category</h1>
          </div>
              <label for="title">  Category Title:</label>
               <input type="text" name="CategoryTitle" id="title" placeholder="Type title here" value="">
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