var createDivFlag = 0;
var deleteDivFlag = 0;
var editDivFlag = 0;
var nameFlag = 0;
var fullNameFlag = 0;
var fileFlag = 0;
var contactFlag = 0;
var passFlag = 0;
var errorFlag = 1;
var confPassFlag = 0;

function newUserForm() {
	var el = document.getElementById("createUserDiv");
	if (createDivFlag == 0) {
		el.style.display = "block";
		createDivFlag = 1;
	} else {
		el.style.display = "none";
		createDivFlag = 0;
	}
}

function deleteUser() {
	var el0 = document.getElementById("deleteUserDiv");
	if (deleteDivFlag == 0) {
		el0.style.display = "block";
		deleteDivFlag = 1;
	} else {
		el0.style.display = "none";
		deleteDivFlag = 0;
	}
}

function loadTableData() {
	xhttp = new XMLHttpRequest();
	var table = document.getElementById("showAllInfoTable");

	xhttp.onreadystatechange = function () {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			var rep = JSON.parse(xhttp.response);
			for (i = 0; i < rep.length; i++) {
				row = table.insertRow(i + 1);

				cell0 = row.insertCell(0);
				cell0.innerHTML = rep[i].id;
				cell0.className = "tStyles";

				cell1 = row.insertCell(1);
				cell1.innerHTML = rep[i].userName;
				cell1.className = "tStyles";

				cell2 = row.insertCell(2);
				cell2.innerHTML = rep[i].DOB;
				cell2.className = "tStyles";

				cell3 = row.insertCell(3);
				cell3.innerHTML = rep[i].contact;
				cell3.className = "tStyles";

				cell4 = row.insertCell(4);
				cell4.innerHTML = rep[i].userType;
				cell4.className = "tStyles";

				cell5 = row.insertCell(5);
				cell5.innerHTML = '<button onclick="edit(this)">Edit</button>';
				cell5.className = 'tStyles';
			}
		}
	}
	var url = "AdminPageDataOperation.php";
	xhttp.open("POST", url, true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("getAll=1");
}

function checkSameId() {
	xhttp = new XMLHttpRequest();
	var id = document.createUserForm.id;
	var getp = document.getElementById("idCheck");

	xhttp.onreadystatechange = function () {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			var rep = JSON.parse(xhttp.response);
			flag = 0;
			for (i = 0; i < rep.length; i++) {
				if (id.value.length == 0) {
					getp.style.color = "red";
					getp.innerHTML = "field must not be empty";
					flag = 1;
				}
				if (isNaN(id.value)) {
					getp.style.color = "red";
					getp.innerHTML = "enter integer";
					flag = 1;
				}
				if (id.value == rep[i].id) {
					getp.style.color = "red";
					getp.innerHTML = "invalid or ducplicate id";
					flag = 1;
				}
			}
			if (flag == 0) {
				getp.style.color = "green";
				getp.innerHTML = "id unique";
				idFlag = 1;
			} else
				idFlag = 0;
		}
	}
	var url = "AdminPageDataOperation.php";
	xhttp.open("POST", url, true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("getAll=1");
}

function checkName() {
	var getp = document.getElementById("nameCheck");
	var name = document.createUserForm.username;

	if (name.value.length == 0) {
		getp.style.color = "red";
		getp.style.display = "inline";
		getp.innerHTML = "name cannot be empty";
		nameFlag = 0;
	} else {
		getp.style.color = "green";
		getp.style.display = "inline";
		getp.innerHTML = "field okay";
		nameFlag = 1;
	}
}

function checkFullName() {
	var getp = document.getElementById("fullNameCheck");
	var name = document.createUserForm.fullname;

	if (name.value.length == 0) {
		getp.style.color = "red";
		getp.style.display = "inline";
		getp.innerHTML = "name cannot be empty";
		fullNameFlag = 0;
	} else {
		getp.style.color = "green";
		getp.style.display = "inline";
		getp.innerHTML = "field okay";
		fullNameFlag = 1;
	}
}

function passCheck() {
	var getp = document.getElementById("passCheck");
	var pass = document.createUserForm.password;

	if (pass.value.length < 7) {
		getp.style.color = "red";
		getp.style.display = "inline";
		getp.innerHTML = "password must not be less than 7 chars";
		passFlag = 0;
	} else {
		getp.style.color = "green";
		getp.style.display = "inline";
		getp.innerHTML = "field okay";
		passFlag = 1;
	}
}

function confPassCheck() {
	var getp = document.getElementById("confPassCheck");
	var pass = document.createUserForm.password;
	var cPass = document.createUserForm.confirmPassword;

	if (pass.value == cPass.value) {
		getp.style.color = "green";
		getp.style.display = "inline";
		getp.innerHTML = "password matches";
		confPassFlag = 1;
	} else {
		getp.style.color = "red";
		getp.style.display = "inline";
		getp.innerHTML = "password doesnt match";
		confPassFlag = 1;
	}
}

function create() 
{	
	if (nameFlag  + passFlag + confPassFlag + fullNameFlag== 4) {
		document.createUserForm.submit();
	} else
		alert("Please make sure all the fields are filled and verified");
}

function checkIfExists() {
	xhttp = new XMLHttpRequest();
	var getp = document.getElementById("errorP");
	var id = document.deleteUserForm.id.value;

	xhttp.onreadystatechange = function () {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			var rep = JSON.parse(xhttp.response);
			check = 0;
			for (i = 0; i < rep.length; i++) {
				if (id == rep[i].id) {
					getp.style.color = "green";
					getp.innerHTML = "id exists";
					check = 1;
					errorFlag = 0;
				}
			}
			if (check == 0) {
				getp.style.color = "red";
				getp.innerHTML = "id doesnt exist";
				errorFlag = 1;
			}
		}
	}
	var url = "AdminPageDataOperation.php";
	xhttp.open("POST", url, true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("getAll=1");
}

function remove() {
	if (errorFlag == 0) {
		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function () {
			if (xhttp.readyState == 4) {
				alert(xhttp.response);
				location.reload();
			}
		}
		var url = "AdminPageDataOperation.php";
		xhttp.open("POST", url, true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var id = document.deleteUserForm.id.value;
		xhttp.send("delete=1&id=" + id);
	} else
		alert("Enter id that exists in the list");
}

function edit(btn) // jquery for sending post data
{
	row = $(btn).closest("tr");
	$(row).find("td:eq(0)").text();

	arr = new Array(5);

	for (i = 0; i < arr.length; i++) {
		arr[i] = $(row).find("td:eq(" + i + ")").text();
	}

	params = new Array("id", "userName", "DOB", "Contact", "Type");
	var name = 0;
	var value = 0;

	formString = "<form action='editUser.php' method='post' display='none'>";
	for (i = 0; i < arr.length; i++) {
		formString += "<input type='hidden' name='" + params[i] + "' value='" + arr[i] + "'/>";
	}
	formString += "</form>";
	var form = $(formString);

	$("body").append(form);
	$(form).submit();
}
