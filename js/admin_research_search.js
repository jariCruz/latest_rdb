//search research studies

//enter function
// Get the input field
var input = document.getElementById("rs-input");

// Execute a function when the user releases a key on the keyboard
input.addEventListener("keyup", function(event) {
  // Number 13 is the "Enter" key on the keyboard
  if (event.keyCode === 13) {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("research-search-button").click();
  }
});

//button function
function researchBtn() {
      $(document).ready(function() {
      function loadData(page) {
        $.ajax({
          url: "admin_research_search.php",
          type: "POST",
          cache: false,
          data: {
            page_no: page,
            query: $('#rs-input').val()
          },
          success: function(response) {
            console.log(page);
            $("#research-content").html(response);
          }
        });
      }
      loadData();

      // Pagination code
      $(document).on("click", ".pagination li a", function(e) {
        e.preventDefault();
        var pageId = $(this).attr("id");
        loadData(pageId);
      });
    });
}
//end of search research studies