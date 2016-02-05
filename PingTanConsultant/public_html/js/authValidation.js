var Validation = function(){
	var validation = this;

	validation.status = false;
	validation.tasks = [];

	return validation;
};

Validation.prototype.triggerValidation = function(){
	var tasks = this.tasks || [], 
		index = 0,
		status = true;

	for(index = 0; index < tasks.length; index++){
		if(!tasks[index].test){
			console.log(tasks[index].type);
			switch (tasks[index].type) {
				case 'auth':
					showError(tasks[index].errorMsg);
					break;
				case 'individual_registration':
					showRegistrationError(tasks[index].errorMsg);
					break;
				default:
					// statements_def
					break;
			}
			status = false;
		}
	} 

	return status;
};

Validation.prototype.addTest = function(type, task, msg){
	this.tasks.push({type : type, test : task, errorMsg : msg});
};

// Test Cases

var comparePassword = function(pwd1, pwd2){
	
	return pwd1 === pwd2;
};

var checkEmail = function(email){
	var regex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
	return regex.test(email);
};

var checkEmptyInput = function(input){
	return input.length !== 0;
};

// Individual Course Registration Test Cases
var checkCourseAvailability = function(time){
	return time !== 'Not Available';
};

var checkDOB = function(dob){
	return dob.length !== 0;
};

var checkNationality = function(nationality){
	return nationality.length !== 0;
};

var checkOccupation = function(occupation){
	return occupation.length !== 0;
};

var checkContactNo = function(contactNo){
	return contactNo.length !== 0;
};

var checkNRIC = function(nric){
	return nric.length !== 0;
};