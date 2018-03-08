function validation(){
	var count = document.forms["createBallot"]["idnum[]"].length;
	var idnumInput = document.forms["createBallot"]["idnum[]"];
	var firstnameInput = document.forms["createBallot"]["firstname[]"];
	var middleinitialInput = document.forms["createBallot"]["middleinitial[]"];
	var lastnameInput = document.forms["createBallot"]["lastname[]"];
	var courseSelect = document.forms["createBallot"]["course[]"];
	var yearSelect = document.forms["createBallot"]["year[]"];
	var partylistSelect = document.forms["createBallot"]["partylist[]"];
	for(var i = 0; i < count;i++){
		var letters = /^[a-zA-Z- ]+$/;
		var inputField1 = idnumInput;

		if(idnumInput[i].value == ""){
			idnumInput[i].focus();
			alert("please input all forms");
			return false;
		}else if (idnumInput[i].value.length < 7){
			idnumInput[i].focus();
			alert("ID number must have exactly 6 digits");
			return false;
		}

		
		if(firstnameInput[i].value == ""){
			firstnameInput[i].focus();
			alert("Please fill up firstname");
			return false;
		}else if (!firstnameInput[i].value.match(letters)){
			firstnameInput[i].focus();
			alert("first name must only contain letters");
			return false;
		}
		
		if(middleinitialInput[i].value == ""){
			middleinitialInput[i].focus();
			alert("Please fill up middle initial");
			return false;
		}else if (!middleinitialInput[i].value.match(letters)){
			middleinitialInput[i].focus();
			alert("middle initial must only contain a letter");
			return false;
		}

		if(lastnameInput[i].value == ""){
			lastnameInput[i].focus();
			alert("Please fill up last name");
			return false;
		}else if (!lastnameInput[i].value.match(var letters = /^[a-zA-Z- -]+$/)){
			lastnameInput[i].focus();
			alert("middle initial must only contain a letter");
			return false;
		}

		if(courseSelect[i].value == ""){
			courseSelect[i].focus();
			alert("Please select course");
			return false;
		}

		if(yearSelect[i].value == ""){
			yearSelect[i].focus();
			alert("Please select year level");
			return false;
		}

		if(partylistSelect[i].value == ""){
			partylistSelect[i].focus();
			alert("Please please fill up partylist");
			return false;
		}

	}
	return true;

}

$(document).ready(function() {
    $(document).delegate(".code","keydown",function(e) {
        if (
            $.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode == 65 && e.ctrlKey === true) ||
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                return;
        }

        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }

        if($(e.target).val().length == 2) {
            e.target.value = e.target.value + "-";
        }
    });
});

$(document).ready(function (){
 
    
    $('.add').on('click',function(){
        $('<div class="cc"><input type="text" name="idnum[]" class="code" placeholder="ID number" maxlength="7"><input type="text" name="firstname[]" placeholder="First Name"><input type="text" name="middleinitial[]" placeholder="Middle Initial" maxlength="1"><input type="text" name="lastname[]" placeholder="Last Name"><select name="course[]"><option selected="selected" disabled value="">Course</option><option value="BA">BA</option><option value="CRIM">CRIM</option><option value="CHM">CHM</option><option value="EDUC">EDUC</option><option value="ENGINEERING">ENGINEERING</option><option value="ICT">ICT</option><option value="NURSING">NURSING</option></select><select name="year[]"><option selected="selected" disabled value="">Year</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select><input type="text" name="partylist[]" placeholder="Partylist"><input type="text" name="position[]" value="Councilor"><button type="button" class="remove"><i class="fa fa-times fa-1x"></i>Remove</button><br></div>').appendTo('.Councilors');
    });
    
    $(document).on('click','.remove', function (){
        $(this).parent('.cc').remove();
    });
   
});