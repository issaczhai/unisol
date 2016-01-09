
(function(){
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
				destUrl = './index.php';

		    if($("input[name*='individual']").prop('checked') === true){
		    	postData.registerType = 'individual';
		    	postData.fName = $("input[name*='fName']").val();
		    	postData.lName = $("input[name*='lName']").val();
		    	postData.email = $("input[name*='email']").val();
		    	postData.passwordEncrypt = encryptAES($("input[name*='password']").val());
		    	/*$("input[name*='password']").val();*/
		    	postData.rePasswordEncrypt = encryptAES($("input[name*='rePassword']").val());
		    	/*$("input[name*='rePassword']").val();*/

		    	clearErrorMsg();

		    	validation.addTest(checkEmail(postData.email), "Please enter the valid email address");
		    	validation.addTest(comparePassword($("input[name*='password']").val(), $("input[name*='rePassword']").val()), "Please re-enter the same password");

		    	validationStatus = validation.triggerValidation();

		    }else if($("input[name*='company']").prop('checked') === true){
		    	postData.registerType = 'company';
		    	postData.companyName = $("input[name*='companyName']").val();
		    	postData.registrationId = $("input[name*='registrationId']").val();
		    	postData.cPassword = encryptAES($("input[name*='cPassword']").val());
		    	postData.reCPassword = encryptAES($("input[name*='reCPassword']").val());
		    	postData.street = $("input[name*='street']").val();
		    	postData.unitNo = $("input[name*='unitNo']").val();
		    	postData.postal = $("input[name*='postal']").val();
		    	postData.cFName = $("input[name*='cFName']").val();
		    	postData.cLName = $("input[name*='cLName']").val();
		    	postData.cEmail = $("input[name*='cEmail']").val();
		    	postData.cLTel = $("input[name*='cLTel']").val();
		    	postData.cLFax = $("input[name*='cLFax']").val();
		    }
		    

		    data = buildXHRData(postData);
		    xhr = new Request(urlBase, data, 'POST', function (result) {
		    	console.log(result.empty);
		    	if(result.error){
		    		showError(result.errorMsg);
		    		return;
		    	}

		    	// registered successfully
		    	var cookie = new Cookie();
		    	cookie.setCookie('email', postData.email, "null", "null");
		    	cookie.setCookie('username', postData.fName, "null", "null");

		    	gotoPage(destUrl);	
		    });

		}
	};

	SignUp.init();

})();

var login = function(){
	
};

var showError = function(msg){
	var errorMsg = document.createElement('h5');
	$(errorMsg).addClass('red-default');
	$(errorMsg).text(msg);
	$('#errorMsgSignUp').append($(errorMsg));
};

var clearErrorMsg = function(){
	$('#errorMsgSignUp h5').remove();
};

var buildXHRData = function(dataObject){
	var data = '';
	for(var eachData in dataObject){
		if(dataObject.hasOwnProperty(eachData)){
			data += (eachData + '=' + dataObject[eachData] + '&');
		}
	}

	return data;
};

var encryptAES =function(string){
	return CryptoJS.AES.encrypt(string, "Secret Passphrase").toString();
};

var gotoPage = function(url){
	window.location = url;
};
