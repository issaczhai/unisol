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
			showError(tasks[index].errorMsg);
			status = false;
		}
	} 

	return status;
};

Validation.prototype.addTest = function(task, msg){
	this.tasks.push({test : task, errorMsg : msg});
};

// Test Cases

var comparePassword = function(pwd1, pwd2){
	console.log(pwd1 + ',' + pwd2 + ',' + pwd1 === pwd2);
	return pwd1 === pwd2;
};

var checkEmail = function(email){
	var regex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
	return regex.test(email);
};