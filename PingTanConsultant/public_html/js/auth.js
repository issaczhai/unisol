
(function(){
	var actionUrl = $_GET('destUrl') ? $_GET('destUrl') : './index.php';

	var SignUp = {

		init : function(){
			this.button = $('#btn-signUp');
			this.bindEvent();
		},

		bindEvent : function(){
			this.button.on('click', $.proxy(this.register, this));
		},

		register : function(){

			var validation = new Validation(),
				validationStatus,
				urlBase = './process_signUp.php',
				postData = {},
				data,
				xhr,
				response,
				type = 'auth',
				destUrl = actionUrl;

		    if($("input[name*='individual']").prop('checked') === true){
		    	postData.registerType = 'individual';
		    	postData.fName = $("input[name*='fName']").val().trim();
		    	postData.lName = $("input[name*='lName']").val().trim();
		    	postData.email = $("input[name*='email']").val().trim();
		    	postData.passwordEncrypt = encryptAES($("input[name*='password']").val().trim());
		    	/*$("input[name*='password']").val();*/
		    	postData.rePasswordEncrypt = encryptAES($("input[name*='rePassword']").val().trim());
		    	/*$("input[name*='rePassword']").val();*/

		    	validation.addTest(type, checkEmail(postData.email), "Please enter the valid email address");
		    	validation.addTest(type, comparePassword($("input[name*='password']").val().trim(), $("input[name*='rePassword']").val().trim()), "Please re-enter the same password");

		    	validationStatus = validation.triggerValidation();

		    }else if($("input[name*='company']").prop('checked') === true){
		    	postData.registerType = 'company';
		    	postData.companyName = $("input[name*='companyName']").val().trim();
		    	postData.registrationId = $("input[name*='registrationId']").val().trim();
		    	postData.cPassword = $("input[name*='cPassword']").val().trim();
		    	postData.reCPassword = $("input[name*='reCPassword']").val().trim();
		    	postData.street = $("input[name*='street']").val().trim();
		    	postData.unitNo = $("input[name*='unitNo']").val().trim();
		    	postData.postal = $("input[name*='postal']").val().trim();
		    	postData.cFName = $("input[name*='cFName']").val().trim();
		    	postData.cLName = $("input[name*='cLName']").val().trim();
		    	postData.cEmail = $("input[name*='cEmail']").val().trim();
		    	postData.cLTel = $("input[name*='cLTel']").val().trim();
		    	postData.cLFax = $("input[name*='cLFax']").val().trim();
		    }
		    

		    data = buildXHRData(postData);

		    if(validationStatus){
			    xhr = new Request(false, urlBase, data, 'POST', function (result) {
			    	console.log(result.student);
			    	if(result.error){
			    		clearErrorMsg();
			    		showError(result.errorMsg);
			    		return;
			    	}

			    	// registered successfully
			    	var cookie = new Cookie();
			    	cookie.setCookie('email', postData.email, "null", "null");
			    	cookie.setCookie('username', postData.fName, "null", "null");
			    	cookie.setCookie('studentID', result.student.studentID, "null", "null");
			    	gotoPage(destUrl);	
			    });
			}
		}
	};
	
	var Login = {

		init : function(){
			this.btn = $('#btn-signIn');
			this.bindEvent();
		},

		bindEvent : function(){
			this.btn.on('click', this.signIn);
		},

		signIn : function(){
			var validation = new Validation(),
				validationStatus,
				urlBase = './process_login.php',
				postData = {},
				data,
				xhr,
				response,
				destUrl = actionUrl,
				type = 'auth',
				email = $("input[name*='email']").val().trim(),
				password = $("input[name*='password']").val().trim();

			validation.addTest(type, checkEmptyInput(email), 'Please enter the email address!');
			validation.addTest(type, checkEmptyInput(password), 'Please enter the password!');
			validationStatus = validation.triggerValidation();
			postData.email = email;
			postData.password = password;
			data = buildXHRData(postData);
			if(validationStatus){
				xhr = new Request(false, urlBase, data, 'POST', function(result){
					
					if(result.error){
						console.log(result.pwd);
						clearErrorMsg();
						showError(result.errorMsg);
						return;
					}

					// registered successfully
			    	var cookie = new Cookie();
			    	cookie.setCookie('email', email, "null", "null");
			    	cookie.setCookie('username', result.username, "null", "null");
			    	cookie.setCookie('userType', result.userType, "null", "null");
			    	cookie.setCookie('studentID', result.studentID, "null", "null");

			    	gotoPage(destUrl);
				});
			}
		}
	};

	var Logout = {
		init : function(){
			this.btn = $('.header-logout a');
			this.bindEvent();
		},

		bindEvent : function(){
			this.btn.on('click', this.logout);
		},

		logout : function(){
			var c = new Cookie();
			c.deleteCookie('username');
			c.deleteCookie('email');
			c.deleteCookie('targetCourse');
			c.deleteCookie('userType');
			c.deleteCookie('studentID');
			gotoPage('./index.php');
		}
	};

	Login.init();
	SignUp.init();
	Logout.init();

})();

var showError = function(msg){
	var errorMsg = document.createElement('h5');
	$(errorMsg).addClass('red-default');
	$(errorMsg).text(msg);
	$('#errorMsgAuth').append($(errorMsg));
};

var clearErrorMsg = function(){
	$('#errorMsgAuth h5').remove();
};

var encryptAES = function(string){
	return CryptoJS.AES.encrypt(string, "Secret Passphrase").toString();
};


