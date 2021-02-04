    //add count for views
    function addView(RS_ID, url) {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("viewCounts_" + RS_ID).innerHTML = this.responseText;
        }
      }
      xmlhttp.open("GET", "action.php?addViews=" + RS_ID, true);
      xmlhttp.send();
      window.open(url+'#toolbar=0','_blank', 'location=no');
    }

    //add count for downloads
    function addDownload(RS_ID, url) {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("downloadCounts_" + RS_ID).innerHTML = this.responseText;
        }
      }
      xmlhttp.open("GET", "action.php?addDownloads=" + RS_ID, true);
      xmlhttp.send();
      window.open(url);
    }

    //add count for views (mini stats)
    function addViewMini(RS_ID, url) {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("miniStats_" + RS_ID).innerHTML = this.responseText;
        }
      }
      xmlhttp.open("GET", "action.php?addViewsMini=" + RS_ID, true);
      xmlhttp.send();
    }

    //add count for downloads
    function addDownloadMini(RS_ID, url) {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("miniStats_" + RS_ID).innerHTML = this.responseText;
        }
      }
      xmlhttp.open("GET", "action.php?addDownloadsMini=" + RS_ID, true);
      xmlhttp.send();
    }