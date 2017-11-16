<html> 
    <head>
        <link rel="stylesheet" type="text/css" href="mycss.css">
        <script src="myjava.js"></script>
        
    </head>
       
    <body onload="hideEditCD();">   
        
        <div id ="top">
            <h1 id="title">CD</h1>
                 <ul class="nav">
                    <li><a href="Home.php">Home</a></li>    
                    <li><a href="Artist.php">Artist</a></li>
                    <li class="current"><a href="#">CD</a></li>
                    <li><a href="Track.php">Track</a></li>
                </ul>
        </div>
        
        <hr> 
        
        <div id="content">
            <div id="displayCD">
                
                <form method="get" action="searchcd.php" id="search">
                    Search CD: <input type="search" name="search" onsearch="searchartist()"placeholder="Search..">
                     
                </form>
                
                <table id="tabC">
                    <tr>
                       <th>CD ID</th>
                        <th width="340px">CD Title </th>
                        <th width="auto">Artist </th>
                        <th>Genre </th>
                        <th>Price </th>
                        <th>Track</th>
                        <th colspan="2"> </th>
                    </tr>
                    

<?php
            $search = $_GET['search'];
            
       
                if (strlen($search)<=0){
                    echo "No input received!";
                    echo "</table><br>";
                    echo "<a href=\"CD.php\" onclick=\"#\">&#8610 Return to CD index</a>";
                }else{
                    echo "You searched for \"<b>$search</b>\" :";
                    
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "lab 5";
  
                    $conn = mysqli_connect($servername, $username, $password, $dbname);
                              
                    if(!$conn) {
                        die ("Connection failed");
                    }
                    
                    
                    $query = "Select * from cd NATURAL JOIN artist where cdTitle like '%".$search."%' or artName like '%".$search."%' order by artID"; 
                    $searchquery = mysqli_query($conn,$query);
                    
                    $countrow = mysqli_num_rows($searchquery);
                    
                    if ($countrow==0){
                        echo "<br><br>Your query returns 0 result";
                        echo "</table><br>";
                        echo "<script>document.getElementById(\"tabC\").style.visibility = 'hidden';</script>";
                        echo "<a href=\"CD.php\" onclick=\"#\">&#8610 Return to CD index</a>";                                            
                    }else{
                        echo "<br><br>$countrow result(s) found";
                        
                        while($row = $searchquery->fetch_assoc()) {
                            $pid= "p".$row["cdID"];
                            $gid= "g".$row["cdID"];
                            $tid= "t".$row["cdID"];
                            echo "<tr><td> " . $row["cdID"]. " </td><td id=\"". $row["cdID"]."\"> " . $row["cdTitle"]. " </td><td> " . $row["artName"] ." </td><td id=\"g".$row["cdID"]."\"> " . $row["cdGenre"] ." </td><td id=\"".$pid."\"> " . $row["cdPrice"] . "</td><td id=\"t".$row["cdID"]."\"><center>" .$row["cdNumTracks"] . "</center></td><td><a href=\"#\" onclick=\" pgt('".$pid."','".$gid."','".$tid."'); showEditCD(".$row["cdID"].",".$row["artID"]. ");\">Edit</a>  &#8226  <a href=\"searchtrack.php?searchtr=".$row["cdTitle"]."\">Tracks</a></td></tr>";
                }
                            echo "</table><br>";
                            echo "<a href=\"CD.php\" onclick=\"#\">&#8610 Return to CD index</a>";
                    }
                                                        
                    mysqli_free_result($searchquery);
                    mysqli_close($conn);
                }                
                
      

        ?>

 </div>
            
            <div id="editCD">
                
                <form method="post" id="update" action="<?php $_SERVER["PHP_SELF"]; ?>">
                   CD Title: <input type="text" id="cdedit" name="nama"> <input id="cdid" name="cdid"><input id="artid" name="artid">
                   <br>
                   <br>
                        Artsit: <select id="select" onchange="changecd()">
                   <?php 
                        
                         $servername = "localhost";
                         $username = "root";
                         $password = "";
                         $dbname = "lab 5";
  
                        $conn = mysqli_connect($servername, $username, $password, $dbname);
                              
                    if(!$conn) {
                        die ("Connection failed");
                    }
            
                        $query="SELECT artName,artID FROM artist ORDER BY artID";
                        $artquery=mysqli_query($conn,$query);
                        
                        if ($artquery->num_rows > 0) {
                        while($row = $artquery->fetch_assoc()) {
                             echo "<option value=\"" . $row["artName"] . "\" id=\"".$row["artName"]."\">". $row["artName"] ."</option>";
                          }
                            echo "</select>";        
                        } else {
                            echo "<option>0 results</option>";
                            echo "</select>";
                        }
            
            
                            mysqli_free_result($artquery);
                            mysqli_close($conn);
                        
                   ?>
                   <br><br>
                   Price : <input type="text" id="price" name="price"><br><br>
                   Genre : <input type="text" id="genre" name="genre"><br><br>
                   Tracks: <input type="text" id="track" name="track">
                   <br>
                   <br>
                   <button type="submit" name="action" value="Save" onclick="save()">Save</button>
                   <button type="submit" name="action" value="Delete">Delete</button>
                   <br>
                   <br>
                   <a href="CD.php" >&#8610 Return to CD index</a>
               </form>
                <?php
                        
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "lab 5";

 
                            $conn = new mysqli($servername, $username, $password, $dbname);
 
                            if ($conn->connect_error) {
                                 die("Connection failed: " . $conn->connect_error);
                            } 
                            
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        if (isset($_POST['action']) && $_POST['action'] == 'Save') {
                                            if (isset($_POST['nama'])){
                                             $nama = $_POST['nama'];
                                             $cdid = $_POST['cdid'];
                                             $art = $_POST['artid'];
                                             $genre = $_POST['genre'];
                                             $price = $_POST['price'];
                                             $track = $_POST['track'];
                                             
                                              $save = "update cd set cdTitle='$nama',artID='$art',cdGenre='$genre',cdPrice='$price',cdNumTracks='$track' where cdID='$cdid'";
   
                                          }
                                        } else if (isset($_POST['action']) && $_POST['action'] == 'Delete') {
                                             $cdid = $_POST['cdid'];
                                             $save = "delete from cd where cdID = '$cdid'";
   
                                        }
                                          if (mysqli_query($conn, $save)) {
                                                header("Refresh:0");
                                             } else {
                                             echo "Error updating record: " . mysqli_error($conn);
                                             }
                                                                                  
                                        }
                            
                     mysqli_close($conn);
                     
                     ?>
             </div>
            
            
        </div>
        
             
        
        <div id="footer">
          
            
            Ameer Sorne<br>
            023423<br>
            khcy5mas<br>
            G51DBI Coursework
        </div>
        
        
        
 
        
        
    </body>   
</html>
