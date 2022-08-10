<?php require_once("includes/db.php"); ?>
<?php $SearchQueryParameter = $_GET["id"]; ?>
<?php
if(isset($_POST["Submit"])){
  $Name = $_POST["CommenterName"];
  $Email = $_POST["CommenterEmail"];
  $Comment = $_POST["CommenterThoughts"];
  date_default_timezone_set("America/New_York");
  $CurrentTime=time();
  $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
  global $ConnectingDB;
  $sql  = "INSERT INTO comments(datetime,name,email,comment)";
  $sql .= "VALUES(:dateTime,:name,:email,:comment)";
  $stmt = $ConnectingDB->prepare($sql);
  $stmt -> bindValue(':dateTime',$DateTime);
  $stmt -> bindValue(':name',$Name);
  $stmt -> bindValue(':email',$Email);
  $stmt -> bindValue(':comment',$Comment);
  $Execute = $stmt -> execute();
}
 ?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="stylesheet" href="css/blog.css">
    <title>BLOG Page</title>
</head>
<body>
    <!--Navigation-->
    <nav>
        <div>
            <a href="#">anyisas.com</a>
            <ul>
                <li>
                    <a href="blog.php">Home</a>
                </li>
                <li>
                    <a href="#">About Us</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>
            <ul>
            <form  action="blog.php">
          <input  type="text" name="Search" placeholder="Search here"value="">
          <button  name="SearchButton">Go</button>
          </div>
        </form>
            </ul>
        </div>
    </nav>
    <!-- End Navigation-->
     <header>
         <h1>Basic</h1>
     </header>
    <!--Main-->
    <?php
          global $ConnectingDB;
          // SQL query when Searh button is active
          if(isset($_GET["SearchButton"])){
            $Search = $_GET["Search"];
            $sql = "SELECT * FROM posts
            WHERE datetime LIKE :search
            OR title LIKE :search
            OR category LIKE :search
            OR post LIKE :search";
            $stmt = $ConnectingDB->prepare($sql);
            $stmt->bindValue(':search','%'.$Search.'%');
            $stmt->execute();
          } else { 
            $PostIdFromUrl = $_GET["id"];
            $sql  = "SELECT * FROM posts WHERE id = '$PostIdFromUrl' ORDER BY id desc";
            $stmt =$ConnectingDB->query($sql);
         }
         while ($DataRows = $stmt->fetch()) {
            $PostId          = $DataRows["id"];
            $DateTime        = $DataRows["datetime"];
            $PostTitle       = $DataRows["title"];
            $Category        = $DataRows["category"];
            $Admin           = $DataRows["author"];
            $Image           = $DataRows["image"];
            $PostDescription = $DataRows["post"];
          ?>
    <img src="Uploads/<?php echo htmlentities($Image); ?>"
        <h4><?php echo htmlentities ($PostTitle); ?></h4>
           <small>Written By <?php echo htmlentities ($Admin); ?> ON <?php echo htmlentities ($DateTime);  ?></small>
           <p><?php echo htmlentities ($PostDescription); ?></p>
           <span>Comments 20</span>
          <?php } ?>
                <!-- Comments -->
             
            <form class="" action="fullpost.php?id=<?php echo $SearchQueryParameter ?>" method="post">
                    <input type="text" name="CommenterName" placeholder="Name" value="">
                    <input  type="text" name="CommenterEmail" placeholder="Email" value="">
                    <textarea name="CommenterThoughts"  rows="6" cols="80"></textarea>
                    <button type="submit" name="Submit" >Submit</button>
            </form>
                <!-- End Main-->
                <!--FOOTER-->
    <footer>
        <p>Theme By | Anyisa S | &copy; ----All right Reserved.</p>
    </footer>
              <!-- End FOOTER-->
</body>
</html>