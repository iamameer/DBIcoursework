
<html> 
    <head>
        <link rel="stylesheet" type="text/css" href="mycss.css">
        <script src="myjava.js"></script>
        
    </head>
      
    <body onload="hideEdit()">   
        
        <div id ="top">
            <h1 id="title">Artist</h1>
                 <ul class="nav">
                    <li><a href="Home.php">Home</a></li>    
                    <li class="current"><a href="#">Artist</a></li>
                    <li><a href="CD.php">CD</a></li>
                    <li><a href="Track.php">Track</a></li>
                </ul>
        </div>
        
        <hr> 
        
        <div id="content">
            <div id="displayArtist">
                
                <form method="get" action="searchart.php" id="search">
                    Search Artist: <input type="search" name="search" onsearch="searchartist()"placeholder="Search..">
                      
                </form>
                
                <table id="tabA">
                    <tr>
                        <th>Artist ID</th>
                        <th>Artist Title</th>
                        <th colspan="2"> </th>
                    </tr>
                    

<?php
            $search = $_GET['search'];
            
       
                if (strlen($search)<=0){
                    echo "No input received!";
                    echo "</table><br>";
                    echo "<a href=\"Artist.php\" onclick=\"#\">&#8610 Return to Artist index</a>";
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
                    
                    
                    $query = "Select * from artist where artName like '%".$search."%' order by artID";
                    $searchquery = mysqli_query($conn,$query);
                    
                    $countrow = mysqli_num_rows($searchquery);
                    
                    if ($countrow==0){
                        echo "<br><br>Your query returns 0 result";
                        echo "</table><br>";
                        echo "<script>document.getElementById(\"tabA\").style.visibility = 'hidden';</script>";
                        echo "<a href=\"Artist.php\" onclick=\"#\">&#8610 Return to Artist index</a>";                                            
                    }else{
                        echo "<br><br>$countrow result(s) found";
                         
                        while($row = $searchquery->fetch_assoc()) {
                            echo "<tr><td> " . $row["artID"]. " </td><td id=\"". $row["artID"]."\"> " . $row["artName"]. "</td><td><a href=\"#\" onclick=\"showEdit(".$row["artID"].")\">Edit</a>  &#8226  <a href=\"searchCD.php?search=".$row["artName"]."\">CDs</a></td></tr>";  
                        }
                            echo "</table><br>";
                            echo "<a href=\"Artist.php\" onclick=\"#\">&#8610 Return to Artist index</a>";
                    }
                                                        
                     mysqli_free_result($searchquery);
                     mysqli_close($conn);
                }                
                
      


           
        ?>

 </div>
            
             <div id="editArtist">
                
               <form method="post" id="update" action="<?php $_SERVER["PHP_SELF"]; ?>">
                   
                   Name:<input type="text" id="edit" name="nama"> <span id="errName"></span> <input id="artid" name="artid"> 
                   <br>
                   <br>
                   <button type="submit" name="action" value="Save" onclick="save()">Save</button>
                   <button type="submit" name="action" value="Delete">Delete</button>
                   <br>
                   <br>
                   <a href="#" onclick="hideEdit()" class="r">&#8610 Return to Artist index</a>
                  
                        
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
                                    if ($_POST['action'] == 'Save') {
                                    $nama = $_POST['nama'];
                                    $artid = $_POST['artid'];
                                    $save = "update artist set artName=\"".$nama."\" where artID=\"".$artid."\"";
                                } else if ($_POST['action'] == 'Delete') {
                                    $artid = $_POST['artid'];
                                    $save = "delete from artist where artID = '$artid'";
                                } 
                                
                                
                                if (mysqli_query($conn, $save)) {
                                    echo "Record updated successfully";
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
