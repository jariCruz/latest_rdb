
// Menu starts here...

// For showing tabs
$(document).ready(function(){

    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
    
});


// Menu ends here...
// For showing tabs
// Change dropdown text
function changeBtnTxt(id, txt){

    var btn = document.getElementById(id);

    btn.textContent = txt;

}

//Autocomplete
$(function() {
	      $("#rs-input").autocomplete({
	        source: "action.php",
          select: function(event, ui) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                document.getElementById("research-livesearch").innerHTML = this.responseText;
              }
            };
            var token = ui.item.value;
            console.log(token);
            xmlhttp.open("GET", "admin_research_search.php?query=" + token, true);
            xmlhttp.send();
          }
	      })
	    });
//End autocomplete