function lessAlumnus() {
    var dots = document.getElementById("dotss");
    var moreText = document.getElementById("more");
    var btnText = document.getElementById("form_alumnus_student");


    if (btnText.checked == true) {


            dots.style.display = "inline";
            moreText.style.display = "none";
    } else {


            dots.style.display = "none";
            moreText.style.display = "inline";

    }
}

