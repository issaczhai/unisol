/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    $('#payment').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            firstname: {
                validators: {
                    regexp: {
                        regexp: /^[a-z\s]+$/i,
                        message: 'The first name can only consist of alphabetical, space'
                    },
                    notEmpty: {
                        message: 'The first name is required and cannot be empty'
                    }
                }
            },
            lastname: {
                validators: {
                    regexp: {
                        regexp: /^[a-z\s]+$/i,
                        message: 'The last name can only consist of alphabetical, space'
                    },
                    notEmpty: {
                        message: 'The last name is required and cannot be empty'
                    }
                }
            },
            phone: {
                validators: {
                    notEmpty: {
                        message: 'The phone number is required and can\'t be empty'
                    },
                    digits: {
                        message: 'The phone number can contain digits only'
                    }
                }
            },
            address1:{
                validators:{
                    notEmpty : {
                        message : 'The address is required and can\'t be empty'
                    }
                }
            },
            postcode: {
                validators: {
                    notEmpty: {
                        message: 'Postal Code is required and can\'t be empty'
                    },
                    digits: {
                        message: 'Postal Code can contain digits only'
                    }
                }
            },
            shipping_country:{
                validators:{
                    notEmpty : {
                        message : 'Please select your country '
                    }
                }
            },
            receiptemail:{
                validators:{
                    notEmpty : {
                        message : 'The email address is required and can\'t be empty'
                    },
                    emailAddress : {
                        message : 'The input is not a valid email address'
                    }
                }
            }
        }
    });

});

$('#resetBtn').click(function() {
    $('#payment').data('bootstrapValidator').resetForm(true);
});
    
function disable(myId,id){
    var myField = document.getElementById(myId);
    if(myField.value !== ''){
        var field = document.getElementById(id);
        field.setAttribute("disabled","disabled");
    }
    if(myField.value === ''){
        var field = document.getElementById(id);
        field.removeAttribute("disabled");
    }

}

function checkRewardCode(){
    var code = document.getElementById("rewardCode").value;
    var postData = { //Fetch form data
        'code'     : code
    };
    if(code !== ''){
        $.ajax({
            type: 'post',
            url: 'process_reward.php?operation=check',
            data: postData,
            success: function(data){
                var pos = data.indexOf("{");
                var dataValid = data.substring(pos);
                var jsonData = eval("("+dataValid+")");
                if(jsonData.status){
                    document.getElementById('codeIncorrect').style.display="none";
                    document.getElementById('codeCorrect').style.display="block";
                    processReward(jsonData.code);
                }else{
                    document.getElementById('codeIncorrect').style.display="block";
                    document.getElementById('codeCorrect').style.display="none";
                    if ($('#giftRow').length > 0) { 
                        // it exists 
                        var giftRow = document.getElementById('giftRow');
                        giftRow.parentNode.removeChild(giftRow);
                    }

                }
            }
        });
    }else{
        document.getElementById('codeIncorrect').style.display="none";
        document.getElementById('codeCorrect').style.display="none";
        var giftRow = document.getElementById('giftRow');
        giftRow.parentNode.removeChild(giftRow);
    }
}

function processReward(code){
    var postData = { //Fetch form data
        'code'     : code
    };
    $.ajax({
        type: 'post',
        url: './process_reward.php?operation=reward',
        data: postData,
        success: function(data){
            var pos = data.indexOf("{");
            var dataValid = data.substring(pos);
            var gift = eval("("+dataValid+")");
            //add gift into order table
            var newTr = document.getElementById("orderTableBody").insertRow(); //插入新行
            newTr.setAttribute("id","giftRow");
            var newTd0 = newTr.insertCell();   //为行插入单元格
            var newTd1 = newTr.insertCell();   
            var newTd2 = newTr.insertCell();   
            var newTd3 = newTr.insertCell();  
            var newTd4 = newTr.insertCell();  
            newTd0.innerHTML="<div style='padding-left: 30px'><img width='80px' height='80px' src='"+gift.photo+"'><input type='hidden' name='gift' value='"+code+"'></div>";//为单元格加入内容
            newTd1.innerHTML=gift.product;
            newTd2.innerHTML="1";
            newTd3.innerHTML="$0 (worth $"+gift.worth+")";
            newTd4.innerHTML="0";
            newTd0.setAttribute("align","center");
            newTd1.setAttribute("align","left");
            newTd2.setAttribute("align","center");
            newTd3.setAttribute("align","center");
            newTd4.setAttribute("align","center");

            newTd0.setAttribute("width","15%");
            newTd1.setAttribute("width","15%");
            newTd4.setAttribute("width","15%");

            newTd1.style.verticalAlign="middle";
            newTd2.style.verticalAlign="middle";
            newTd3.style.verticalAlign="middle";
            newTd4.style.verticalAlign="middle";
        }
    });


}