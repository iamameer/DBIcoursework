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
                                          if (isset($save)){
                                              if (mysqli_query($conn, $save)) {
                                                header("Refresh:0");
                                             } else {
                                             echo "Error updating record: " . mysqli_error($conn);
                                             }
                                          }
                                                                                  
                                        }
                                                           
                     mysqli_close($conn);
                     
                     ?>
                     
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
                                
                                        if (isset($_POST['addnama'])){
                                            $nama = $_POST['addnama'];
                                            $art = $_POST['addartid'];
                                            $genre = $_POST['addgenre'];
                                            $price = $_POST['addprice'];
                                            $track = $_POST['addtrack'];
                                
                                            $add = "insert into cd (cdTitle,artID,cdGenre,cdPrice,cdNumTracks) values ('$nama','$art','$genre','$price','$track')";
                     
                                
                                            if (mysqli_query($conn, $add)) {
                                                header("Refresh:0");
                                            } else {
                                            echo "Error updating record: " . mysqli_error($conn);
                                            }
                                            
                                        }
                                            
                            }
                                            
                                       mysqli_close($conn);
                                     ?>
                 
 
        
<html> 
    <head>
        <link rel="stylesheet" type="text/css" href="mycss.css">
        <script type="text/javascript" src="myjava.js"></script>
        
        
       
    </head>
      
    <body onload="hideEditCD()"> 
       
        
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
                
                <form method="get" action="searchcd.php" id="search" >
                    Search CD: <input type="search" name="search" onsearch="search()"placeholder="Search..">  
                </form>
                
               
                <table>
                    <tr>
                        <th>CD ID</th>
                        <th >CD Title </th>
                        <th width="auto">Artist </th>
                        <th>Genre </th>
                        <th>Price </th>
                        <th>Track</th>
                        <th colspan="2"> </th>
                    </tr>
                                 
             <?php
              
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "lab 5";
  
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                              
            if(!$conn) {
                 die ("Connection failed");
            }
            
            $query="SELECT * FROM cd NATURAL JOIN artist ORDER BY cdID";
            $cdquery=mysqli_query($conn,$query);
            
                   
            if ($cdquery->num_rows > 0) {
     
                while($row = $cdquery->fetch_assoc()) {
                            $pid= "p".$row["cdID"];
                            $gid= "g".$row["cdID"];
                            $tid= "t".$row["cdID"];
                            echo "<tr><td> " . $row["cdID"]. " </td><td id=\"". $row["cdID"]."\"> " . $row["cdTitle"]. " </td><td> " . $row["artName"] ." </td><td id=\"g".$row["cdID"]."\"> " . $row["cdGenre"] ." </td><td id=\"".$pid."\"> " . $row["cdPrice"] . "</td><td id=\"t".$row["cdID"]."\"><center>" .$row["cdNumTracks"] . "</center></td><td><a href=\"#\" onclick=\" pgt('".$pid."','".$gid."','".$tid."'); showEditCD(".$row["cdID"].",".$row["artID"]. ");\">Edit</a>  &#8226  <a href=\"searchtrack.php?searchtr=".$row["cdTitle"]."\">Tracks</a></td></tr>";
                }
                echo "</table>";
                echo "<a href=\"#\" onclick=\"showAddcd()\">Add CD</a>";
                
            } else {
                echo "0 results";
            }
            
            
            mysqli_free_result($cdquery);
            mysqli_close($conn);

            ?>
                    
            </div>
            
              <div id="editCD">
                
                <form method="post" id="update" action="<?php $_SERVER["PHP_SELF"]; $edit=1; ?>">
                   CD Title: <input type="text" id="cdedit" name="nama"> <input id="cdid" name="cdid"><input id="artid" name="artid">
                   <br>
                   <br>
                        Artist: <select id="select" onChange="changecd()">
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
                   <a href="#" onclick="hideEditCD()">&#8610 Return to CD index</a>
               </form>
               
             </div>
           
                     
             <div id="addCD">
                 <form method="post"  action="<?php $_SERVER["PHP_SELF"]; $edit=0; ?>" onsubmit="return validCD();">
                   CD Title: <input type="text" id="addnama" name="addnama"><span id="errCD"></span> <input id="addartid" name="addartid">
                   <br>
                   <br>
                        Artist: <select id="addselect" onChange="changecd()">
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
                   Price : <input type="text"  name="addprice"><span id="errPrice"></span><br><br>
                   Genre : <input type="text"  name="addgenre"><span id="errGenre"></span><br><br>
                   Tracks: <input type="text"  name="addtrack"><span id="errTrack"></span>
                   <br>
                   <br>
                   <button type="submit" onclick="validCD()">Add</button>
                   <br>
                   <br>
                   <a href="#" onclick="hideEditCD()">&#8610 Cancel</a>
               </form>
                
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