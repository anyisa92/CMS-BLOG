<?php require_once("includes/db.php"); ?>
<?php
if(isset($_POST["Submit"])){
  $UserName    = $_POST["Username"];
  $Name        = $_POST["Name"];
  $Password    = $_POST["Password"];
  $ConfirmPassword = $_POST["ConfirmPassword"];
  $Admin = "Anyisa";
  date_default_timezone_set("America/New_York");
  $CurrentTime=time();
  $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
    global $ConnectingDB;
    $sql = "INSERT INTO admins(datetime,username,password,aname,addedby)";
    $sql .= "VALUES(:dateTime,:userName,:password,:aName,:adminName)";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':dateTime',$DateTime);
    $stmt->bindValue(':userName',$UserName);
    $stmt->bindValue(':password',$Password);
    $stmt->bindValue(':aName',$Name);
    $stmt->bindValue(':adminName',$Admin);
    $Execute = $stmt->execute();
}
 ?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="stylesheet" href="css/blog.css">
    <title>Admin Page</title>
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
         <h1>Manage Admins</h1>
     </header>
    <!-- End Header -->
    <!-- Main -->
    <form class="" action="admins.php" method="post">
            <h1>Manage Admins</h1>
          </div>
              <label for="username">  Username:</label>
               <input type="text" name="Username" id="username" value="">
               <label for="Name">  Name:</label>
                <input type="text" name="Name" id="Name" value="">
               <label for="Password">  Password: </label>
                <input type="password" name="Password" id="Password"  value="">
                <label for="ConfirmPassword">  Confirm Password:</label>
                 <input type="password" name="ConfirmPassword" id="ConfirmPassword" >
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
