function delete_showtime(str){
    const array = str.split("/");
    if (str.length == 0) { 
        document.getElementById("showtime").innerHTML = "";
        return;
      } else {
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
          //document.getElementById("showtime").innerHTML = this.responseText;
          show_showtime1();
          alert("Delete showtime on FilmID="+array[0]+", theatreID="+array[1]+", showtime="+array[2]+ "successfully!");
        }
      xmlhttp.open("GET","delete_showtime.php?filmID="+array[0]+"&theatreID="+array[1]+"&showtime="+array[2], true);
      xmlhttp.send();
      }
}

function show_showtime1() {
TheatreName = document.getElementById("TheatreName").value;
FilmName = document.getElementById("FilmName").value;
if(TheatreName == "" || FilmName == "")
{
  return;
}
else{
  var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","get_showtime.php?FilmID="+FilmName+"&TheatreID="+TheatreName,true);
    xmlhttp.send();
}
}

function show_addshow() {
  var x = document.getElementById("form_addshow");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}

function show_addmovie() {
  var x = document.getElementById("form_addmovie");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}



function show_showtime2() {
  TheatreName = document.getElementById("TheatreName").value;
  FilmName = document.getElementById("FilmName").value;
 
  
  if(TheatreName == "" || FilmName == "")
  {
    return;
  }
  else{
    var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("txtHint").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET","show_movie.php?FilmID="+FilmName+"&TheatreID="+TheatreName,true);
      xmlhttp.send();
  }
  }



  function buy(str){
    const array = str.split("/");
    if (str.length == 0) { 
        document.getElementById("showtime").innerHTML = "";
        return;
      } else {
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
          //document.getElementById("showtime").innerHTML = this.responseText;
          show_showtime2();
          alert("Delete showtime on FilmID="+array[0]+", theatreID="+array[1]+", showtime="+array[2]+ "successfully!");
        }
        window.location.href="Book.php?FilmID="+array[0]+"&TheatreID="+array[1]+"&showtime="+array[2]+"&Price="+array[3]+"&RemainingSeat="+array[4]+"&FilmName="+array[5]+"&TheatreName="+array[6];
    //  xmlhttp.open("GET","Book.php?filmID="+array[0]+"&theatreID="+array[1]+"&showtime="+array[2]+"&price="+array[3]+"&RemainingSeat="+array[4]+"&FilmName="+array[5]+"&TheatreName="+array[6], true);
      //xmlhttp.send();
      }
}
