<?php require_once("includes/db.php"); ?>
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
            $sql  = "SELECT * FROM posts ORDER BY id desc ";
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
           <p> <?php 
           if (strlen($PostDescription>150)){
            $PostDescription = substr($PostDescription,0,150)."...";
           }
           echo htmlentities ($PostDescription); 
           ?></p>
           <span>Comments 20</span>
           <a href="fullpost.php?id=<?php echo $PostId;?>>"
              <span>Read More >> </span>
           </a>
           <?php } ?>
                <!-- End Main-->
                <!--FOOTER-->
    <footer>
        <p>Theme By | Anyisa S | &copy; ----All right Reserved.</p>
    </footer>
              <!-- End FOOTER-->
</body>
</html>