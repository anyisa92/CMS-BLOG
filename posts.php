<?php require_once("includes/db.php"); ?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="stylesheet" href="css/blog.css">
    <title>Posts</title>
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
     <header>
         <h1>Blog Posts</h1>
         <a href="addnewpost.php">Add New Post</a>
         <a href="categories.php">Add New Category</a>
         <a href="admins.php">Add New Admin</a>
         <a href="comments.php">Approve Comments</a>
     </header>
      <!--Main-->
     <main>
        <table>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Date&Time</th>
                <th>Author</th>
                <th>Banner</th>
                <th>Comments</th>
                <th>Action</th>
                <th>Live Preview</th>
            </tr>
            <?php
            global $ConnectingDB;
            $sql = "SELECT * FROM posts";
            $stmt = $ConnectingDB->query($sql);
            while ($DataRows = $stmt->fetch()){
                $Id = $DataRows["id"];
                $DateTime = $DataRows["datetime"];
                $PostTitle = $DataRows["title"];
                $Category = $DataRows["category"];
                $Admin = $DataRows["author"];
                $Image = $DataRows["image"];
                $PostText = $DataRows["post"];
                $Sr++;
             
            ?>
             <tr>
               <td><?php echo $Sr; ?></td>
               <td>
                <?php 
                if (strlen($PostTitle)>20){$PostTitle = substr($PostTitle,0,18).'...';}
                echo $PostTitle; 
                ?>
               </td>
               <td>
                <?php 
               if (strlen($Category)>10){$Category = substr($Category,0,10).'...';}
               echo $Category; 
               ?>
               </td>
               <td><?php 
               if (strlen($DateTime)>10){$DateTime = substr($DateTime,0,10).'...';}
               echo $DateTime; 
               ?></td>
               <td>
                <?php 
               if (strlen($Admin)>10){$Admin = substr($Admin,0,10).'...';}
               echo $Admin; 
               ?>
               </td>
               <td><img src="Uploads/<?php echo $Image ; ?>" width="170px;" height="50px;" </td>
               <td>Comments</td>
               <td>
                <a href="editpost.php?id=<?php echo $Id; ?>">Edit</a>
                <a href="deletepost.php?id=<?php echo $Id; ?>">Delete</a>
               </td>
               <td>
                <a href="fullpost.php?id=<?php echo $Id; ?>">Live Preview</a>
               </td>
            </tr>
            <?php 
            } 
            ?>
        </table>
         
     </main>
          <!-- End Main-->
    <!--FOOTER-->
    <footer>
        <p>Theme By | Anyisa S | &copy; ----All right Reserved.</p>
    </footer>
     <!-- End FOOTER-->
</body>
</html>