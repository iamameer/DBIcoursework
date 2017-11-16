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
                                        $trid = $_POST['trid'];
                                        $cd = $_POST['ecdid'];
                                        $dur = $_POST['dur'];
                                
                                        $save = "update track set trTitle='$nama',cdID='$cd',trDuration='$dur' where trID='$trid'";
  
                          
                                            }
                                        } else if ($_POST['action'] == 'Delete') {
                                                $trid = $_POST['trid'];
                                                $save = "delete from track where trID='$trid'";
                                         }
                                         
                                     if (mysqli_query($conn, $save)) {
                                             header("Refresh:0");
                                        } else {
                                             echo "Error updating record: " . mysqli_error($conn);
                                        }
                                      
                            }
                            
                     mysqli_close($conn);
                     
                    ?>
<html> 
    <head>
        <link rel="stylesheet" type="text/css" href="mycss.css">
        <script src="myjava.js"></script>
        
    </head>
      
    <body onload="hideEditTrack();">   
        
        <div id ="top">
            <h1 id="title">Track</h1>
                 <ul class="nav">
                    <li><a href="Home.php">Home</a></li>    
                    <li><a href="Artist.php">Artist</a></li>
                    <li><a href="CD.php">CD</a></li>
                    <li  class="current"><a href="#">Track</a></li>
                </ul>
        </div>
        
        <hr> 
        
        <div id="content">
            <div id="displayTrack">
                
                <form method="get" action="searchtrack.php" id="search">
                    Search Track: <input type="search" name="searchtr" onsearch="searchtrack()"placeholder="Search..">
                      
                </form>
                
                <table id="tabT">
                    <tr>
                        <th>Track ID</th>
                        <th>Track Title</th>
                        <th>Track Duration</th>
                        <th>CD ID</th>
                        <th colspan="2"> </th>
                    </tr>
                    

<?php
            $search = $_GET['searchtr'];
            
       
                if (strlen($search)<=0){
                    echo "No input received!";
                    echo "</table><br>";
                    echo "<a href=\"Track.php\" onclick=\"#\">&#8610 Return to Track index</a>";
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
                    
                    
                    $query = "Select * from track NATURAL JOIN cd where trTitle like '%".$search."%' or cdTitle like '%".$search."%' order by trID,cdID"; 
                    $searchquery = mysqli_query($conn,$query);
                    
                    $countrow = mysqli_num_rows($searchquery);
                    
                    if ($countrow==0){
                        echo "<br><br>Your query returns 0 result";
                        echo "</table><br>";
                        echo "<script>document.getElementById(\"tabT\").style.visibility = 'hidden';</script>";
                        echo "<a href=\"Track.php\" onclick=\"#\">&#8610 Return to Track index</a>";                                            
                    }else{
                        echo "<br><br>$countrow result(s) found";
                        
                        while($row = $searchquery->fetch_assoc()) {
                            $minu = floor($row["trDuration"] / 60);
                            $sec = fmod($row["trDuration"],60);
                            if (strlen($sec)==1){
                                $sec = "0".$sec;
                            }
                            echo "<tr><td> " . $row["trID"]. " </td><td id=\"". $row["trID"]."\"> " . $row["trTitle"]. " </td><td><center> " . $minu.":" .$sec."</center> </td><td> " . $row["cdID"]. "</td><td><a href=\"#\" onclick=\"showEditTrack(".$row["trID"].")\">Edit</a></td></tr>";
                   }
                            echo "</table><br>";
                            echo "<a href=\"Track.php\" onclick=\"#\">&#8610 Return to Track index</a>";
                    }
                                                        
                    mysqli_free_result($searchquery);
                    mysqli_close($conn);
                }                
                
      
            
        ?>

 </div>
            
           <div id="editTrack">
                 <form method="post" id="update" action="<?php $_SERVER["PHP_SELF"]; ?>">
                   Track title : <input type="text" id="tredit" name="nama"> <input id="trid" name="trid"><input id="cdid" name="cdid" style="visibility: hidden;"> 
                   <br><br> 
                   Album :  <select id="selecttr" name="selecttr" onchange="changetr()">
                   <?php 
                        
                         $servername = "localhost";
                         $username = "root";
                         $password = "";
                         $dbname = "lab 5";
  
                        $conn = mysqli_connect($servername, $username, $password, $dbname);
                              
                    if(!$conn) {
                        die ("Connection failed");
                    }
            
                        $query="SELECT cdTitle FROM cd ORDER BY cdID";
                        $cdquery=mysqli_query($conn,$query);
                        
                        if ($cdquery->num_rows > 0) {
                        while($row = $cdquery->fetch_assoc()) {
                             echo "<option value=\"" . $row["cdTitle"] . "\" id=\"".$row["cdID"]."\">". $row["cdTitle"] ."</option>";
                          }
                            echo "</select>";        
                        } else {
                            echo "<option>0 results</option>";
                            echo "</select>";
                        }
            
            
                            mysqli_free_result($cdquery);
                            mysqli_close($conn);
                        
                        
                        ?>
                   <br>
                   <br>
                   Duration : <input id="dur" name="dur"> second(s)
                   <br><br>
                   <button type="submit" name="action" value="Save" onclick="save()">Save</button>
                   <button type="submit" name="action" value="Delete">Delete</button>
                   <br>
                   <br>
                   <a href="Track.php">&#8610 Return to Track index</a>
               </form>
              
               
            </div>
            
  
            
        </div>
        
             
        
        <div id="trackf">
            <hr>
            
            Ameer Sorne<br>
            023423<br>
            khcy5mas<br>
            G51DBI Coursework
        </div>
        
        
        
 
        
        
    </body>   
</html>
