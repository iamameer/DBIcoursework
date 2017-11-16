<html> 
    <head>
        <link rel="stylesheet" type="text/css" href="mycss.css">
        <script src="myjava.js"></script>
    </head>
      
    <body> 
        
        
        <div id ="top">
            <h1>Home</h1>
                 <ul class="nav">
                    <li class="current"><a href="#">Home</a></li>    
                    <li><a href="Artist.php">Artist</a></li>
                    <li><a href="CD.php">CD</a></li>
                    <li><a href="Track.php">Track</a></li>
                </ul>
        </div>
        
        <hr> 
        
        <div id="content">
            <h2>Database Metrics</h2>
             <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "lab 5";
  
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                              
            if(!$conn) {
                 die ("Connection failed");
            }
      
            $sqlart = "SELECT artName FROM artist";
            $artquery = mysqli_query($conn, $sqlart);
            $artNum = mysqli_num_rows($artquery);
            
            $sqlcd = "SELECT cdTitle FROM cd";
            $cdquery = mysqli_query($conn, $sqlcd);
            $cdNum = mysqli_num_rows($cdquery);
            
            $sqltr = "SELECT trTitle FROM track";
            $trquery = mysqli_query($conn, $sqltr);
            $trNum = mysqli_num_rows($trquery);
            
           
                echo  "<ul><li>Number of Artists: ".$artNum."</li>";
                echo  "<li>Number of CDs: ".$cdNum."</li>";
                echo  "<li>Number of Tracks: ".$trNum."</li></ul>";

            mysqli_close($conn);
             
              
            ?>
           <br>
           
            
        </div>
        
        
        
        
        <div id="footer">
            
            <hr>
            Ameer Sorne<br>
            023423<br>
            khcy5mas<br>
            G51DBI Coursework
        </div>
        
        
        
 
        
        
    </body>   
</html>