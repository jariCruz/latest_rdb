//Student
function verifyStudent(student_id) {
	swal({
		title: "Verify Account?",
		text: "Verifying account would allow the user to \ndownload"+
		" and view pdf.",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	}).
	then((ok)=>{
		if(ok){
			$.ajax({
				url: "student_account_pagination.php",
				type: 'post',
				data: {
					verify_id: student_id
				},
				success: function(response){
					updateStudent();
				}
			}).
			then((results)=>{
				swal({
					title: "Account Verified!",
					text: "Account had been sucessfully verified.",
					icon: "success",
					button: true,
				});
			});	
		}else{
			swal.stopLoading();
			swal.close();
		}
	});
}

function denyStudent(student_id) {
	swal({
		title: "Deny Account?",
		text: "Denying account would allow the user to \ndownload"+
		" and view pdf.",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	}).
	then((ok)=>{
		if(ok){
			$.ajax({
				url: "student_account_pagination.php",
				type: 'post',
				data: {
					deny_id: student_id
				},
				success: function(response){
					updateStudent();
				}
			}).
			then((results)=>{
				swal({
					title: "Account Denied!",
					text: "Account had been sucessfully denied.",
					icon: "success",
					button: true,
				});
			});	
		}else{
			swal.stopLoading();
			swal.close();
		}
	});
}

//Professor
function verifyProfessor(professor_id) {
	console.log(professor_id);
	swal({
		title: "Verify Account?",
		text: "Verifying account would allow the user to \ndownload"+
		" and view pdf.",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	}).
	then((ok)=>{
		if(ok){
			$.ajax({
				url: "professor_account_pagination.php",
				type: 'post',
				data: {
					verify_id_professor: professor_id
				},
				success: function(response){
					updateProfessor();
				}
			}).
			then((results)=>{
				swal({
					title: "Account Verified!",
					text: "Account had been sucessfully verified.",
					icon: "success",
					button: true,
				});
			});	
		}else{
			swal.stopLoading();
			swal.close();
		}
	});
}

function denyProfessor(professor_id) {
	console.log(professor_id);
	swal({
		title: "Deny Account?",
		text: "Denying account would allow the user to \ndownload"+
		" and view pdf.",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	}).
	then((ok)=>{
		if(ok){
			$.ajax({
				url: "professor_account_pagination.php",
				type: 'post',
				data: {
					deny_id_professor: professor_id
				},
				success: function(response){
					updateProfessor();
				}
			}).
			then((results)=>{
				swal({
					title: "Account Denied!",
					text: "Account had been sucessfully denied.",
					icon: "success",
					button: true,
				});
			});	
		}else{
			swal.stopLoading();
			swal.close();
		}
	});
}

//update student after verify or deny
function updateStudent() {
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
}
//update professor after verify or deny
function updateProfessor() {
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
}