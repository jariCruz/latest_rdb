// research studies pagination
$(document).ready(function() {
			function loadData(page) {
				$.ajax({
					url: "research_pagination.php",
					type: "POST",
					cache: false,
					data: {
						page_no: page
					},
					success: function(response) {
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

// student account pagination
$(document).ready(function() {
			function loadData(page) {
				$.ajax({
					url: "student_account_pagination.php",
					type: "POST",
					cache: false,
					data: {
						page_no: page
					},
					success: function(response) {
						$("#student-content").html(response);
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

// professor account pagination
$(document).ready(function() {
			function loadData(page) {
				$.ajax({
					url: "professor_account_pagination.php",
					type: "POST",
					cache: false,
					data: {
						page_no: page
					},
					success: function(response) {
						$("#professor-content").html(response);
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

// admin account pagination
$(document).ready(function() {
			function loadData(page) {
				$.ajax({
					url: "admin_account_pagination.php",
					type: "POST",
					cache: false,
					data: {
						page_no: page
					},
					success: function(response) {
						$("#admin-content").html(response);
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