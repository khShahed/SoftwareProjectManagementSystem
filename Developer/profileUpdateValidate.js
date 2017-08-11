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

$(document).ready(function()
{
	$("#updateSubmit").click(function()
	{
		if(fullNameFlag  == 1)
			document.updateProfileForm.submit();
		else 
			alert("Please make sure all fields are valid or filled");
	});
	
});

function checkFullName() {
	var getp = document.getElementById("nameCheck");
	var name = document.updateProfileForm.name;

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

function checkPass() {
	var getp = document.getElementById("pP");
	var pass = document.myForm.currentPassword;

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

function checkNewPass() {
	var getp = document.getElementById("nP");
	var pass = document.myForm.newPassword;

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
	var getp = document.getElementById("ncP");
	var pass = document.myForm.newPassword;
	var cPass = document.myForm.retypePassword;

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
	var file = document.createUserForm.photo.value;
	type = file.split(".");

	if(type[1] == 'jpg' || type[1] == 'jpeg' || type[1] == 'PNG')
		fileFlag = 1;
	else {
		alert("File invalid. Insert a doc(x) or pdf or txt file");
	}	
	if (nameFlag  + passFlag + confPassFlag + fullNameFlag + fileFlag == 5) {
		document.createUserForm.submit();
	} else
		alert("Please make sure all the fields are filled and verified");
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
