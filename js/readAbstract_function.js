// This abstract function is for read more and read less

function readAbstract(rsid) {
  var dots = document.getElementById("dots_"+rsid);
  var moreText = document.getElementById("readMore_"+rsid);
  var btnText = document.getElementById("readBtn_"+rsid);

  if (btnText.innerHTML === "Read more") { 
    btnText.innerHTML = "See full details";
    moreText.style.display = "inline";
    dots.style.display = "none";
  }
  else {
      $("#cModalContent_"+rsid).modal('show');   
      btnText.innerHTML = "Read more";
      moreText.style.display = "none";
      dots.style.display = "inline";
  }
} 