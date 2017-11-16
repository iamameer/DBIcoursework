
/////////////////////////Artist/////////////////////////////////////////////
function hideEdit() {
   document.getElementById("editArtist").style.visibility = "hidden";
   showArtist();
   document.getElementById("title").innerHTML = "Artists";
   document.getElementById("artid").style.visibility="hidden";
   document.getElementById("addArtist").style.visibility = "hidden";
   document.getElementById("errName").innerHTML="";
} 

function showEdit(x) {
   document.getElementById("editArtist").style.visibility = "visible";
   hideArtist();
   document.getElementById("title").innerHTML = "Edit Artist";
   document.getElementById("edit").value = document.getElementById(x).innerHTML;
   document.getElementById("artid").value = x;
} 

function hideArtist() {
   document.getElementById("displayArtist").style.visibility = "hidden";
} 

function showArtist() {
   document.getElementById("displayArtist").style.visibility = "visible";
} 

function add(){
    document.getElementById("addArtist").style.visibility='hidden';
}


function showAdd() {
    document.getElementById("addArtist").style.visibility = "visible";
    hideArtist();
}

function hideAdd() {
    
}

////////////////////////////////CD//////////////////////////////////////////////

function hideEditCD() {
   document.getElementById("editCD").style.visibility = "hidden";
   showCD();
   document.getElementById("title").innerHTML = "CD";
   document.getElementById("cdid").style.visibility="hidden";
   document.getElementById("artid").style.visibility="hidden";
   document.getElementById("addCD").style.visibility="hidden";
} 

function showEditCD(x,y) {
  
   document.getElementById("editCD").style.visibility = "visible";
   hideCD();
   document.getElementById("title").innerHTML = "Edit CD";
   document.getElementById("cdedit").value = document.getElementById(x).innerHTML;
   document.getElementById("cdid").value = x;
   document.getElementById("artid").value=y;
   document.getElementById("select").selectedIndex = y-1 ;
 
} 

 function pgt(p,g,t){
      
   document.getElementById("price").value = document.getElementById(p).innerHTML;
   document.getElementById("genre").value = document.getElementById(g).innerText;
   document.getElementById("track").value = document.getElementById(t).innerText;
} 

function hideCD() {
   document.getElementById("displayCD").style.visibility = "hidden";
} 

function showCD() {
   document.getElementById("displayCD").style.visibility = "visible";
} 

function changecd() {
    document.getElementById("artid").value = document.getElementById("select").selectedIndex+1;
    document.getElementById("addartid").value = document.getElementById("addselect").selectedIndex+1;
}




function showAddcd() {
    document.getElementById("addCD").style.visibility = "visible";
    document.getElementById("addartid").value = 1;
    hideCD();
}

function hideAddcd() {
    document.getElementById("addCD").style.visibility = "hidden";
}
//////////////////////////////Track//////////////////////////////////////////////

function hideEditTrack() {
   document.getElementById("editTrack").style.visibility = "hidden";
   showTrack();
   document.getElementById("title").innerHTML = "Track";
   document.getElementById("trid").style.visibility="hidden";
   document.getElementById("trackf").style.position="relative";
   document.getElementById("trackf").style.bottom="0";
   document.getElementById("trackf").style.zIndex="0";
   document.getElementById("addTrack").style.visibility="hidden";
} 

function showEditTrack(x,y,z) { 
   scroll(0,0);
   document.getElementById("title").innerHTML = "Edit Track";
   hideTrack();
   document.getElementById("tredit").value = "";
   document.getElementById("tredit").value = document.getElementById(x).innerHTML;
   document.getElementById("trid").value = x;
   document.getElementById("editTrack").style.visibility = "visible";
   document.getElementById("trackf").style.position="fixed";
   document.getElementById("trackf").style.bottom="1%";
   document.getElementById("trackf").style.zIndex="-2";
   
   document.getElementById("selecttr").selectedIndex = y-1 ;
   document.getElementById("dur").value = z;
   document.getElementById("ecdid").value= y;
    
} 

function hideTrack() {
   document.getElementById("displayTrack").style.visibility = "hidden";
} 

function showTrack() {
   document.getElementById("displayTrack").style.visibility = "visible";
   document.getElementById("addTrack").style.visibility="hidden";
   document.getElementById("trackf").style.zIndex="0";
   document.getElementById("trackf").style.paddingTop="3%";
   document.getElementById("trackf").style.position="relative";
} 

function changetr() {
    document.getElementById("ecdid").value = document.getElementById("selecttr").selectedIndex+1;
    document.getElementById("cdidadd").value = document.getElementById("selecttradd").selectedIndex+1;
}

function showAddTrack() {
    document.getElementById("addTrack").style.visibility = "visible";
    document.getElementById("addTrack").style.positin="absolute";
    document.getElementById("addTrack").style.top="10%";
    document.getElementById("cdidadd").value = 1;
    hideTrack();
}


//////////////////////////////////ETC////////////////////////////////////////////

function save() {
    //alert('test');
    //window.location.href= "Artist.php";
    //location.reload();
    hideEdit();
    hideEditCD();
    hideEditTrack();
}



function search() {
    document.getElementById("search").submit();
}


function validArt() {
     var nama = document.getElementById("addnama");
     if (nama.checkValidity()==false){
         document.getElementById("errName").innerHTML=nama.validationMessage;
     }else{
         document.getElementById("errName").innerHTML="";
         add();
     }
}

function validCD() {
     var nama = document.getElementById("addnama");
     var price = document.getElementById("addprice");
     var genre = document.getElementById("addgenre");
     var track = document.getElementById("addtrack");
     if (nama.checkValidity()==false || price.checkValidity()==false || genre.checkValidity()==false || track.checkValidity()==false){
         document.getElementById("errCD").innerHTML=nama.validationMessage;
         document.getElementById("errPrice").innerHTML=price.validationMessage;
         document.getElementById("errGenre").innerHTML=Genre.validationMessage;
         document.getElementById("errTrack").innerHTML=Track.validationMessage;
         return false;
     }else{
         document.getElementById("errName").innerHTML="";
         document.getElementById("errPrice").innerHTML="";
         document.getElementById("errGenre").innerHTML="";
         document.getElementById("errTrack").innerHTML="";
         save();
     }
}

function validTrack() {
     var nama = document.getElementById("trEdit");
     var dur = document.getElementById("adddur");
     if (nama.checkValidity()==false || dur.checkValidity()==false){
         document.getElementById("errTr").innerHTML=nama.validationMessage;
         document.getElementById("errDur").innerHTML=nama.validationMessage;
         return false;
     }else{
         document.getElementById("errTr").innerHTML="";
         document.getElementById("errDur").innerHTML="";
         save();
     }
}

 /*

var r = confirm("Press a button");
if (r == true) {
    x = "You pressed OK!";
} else {
    x = "You pressed Cancel!";
}


*/