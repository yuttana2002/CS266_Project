
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
      xmlhttp.open("GET","show_movie.php?FilmID="+FilmName+"&TheatreID="+TheatreName,true);
      xmlhttp.send();
  }
  }

  function nextpage(SelectTime) {
    window.location.href='Book.php?Time='+SelectTime;
  }

