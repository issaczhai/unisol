(function(){
    $('.btn-editContact').on('click',function(){
        $('#editID').val('');
        $('#cName').val('');
        $('#cEmail').val('');
        $('#cTel').val('');
        $('#cFax').val('');
        var postData = {};
        var id = $(this).data('companyid');
        postData.companyID = $(this).data('companyid');
        postData.operation = "getContact";
        $.ajax({
            type: 'post',
            url: '../process_company.php',
            data: postData,
            success: function(data){
                var pos = data.indexOf("{");
                var dataValid = data.substring(pos);
                var jsonData = eval("("+dataValid+")");
                $('#editID').val(id);
                $('#cName').val(jsonData.contactPersonName);
                $('#cEmail').val(jsonData.contactPersonEmail);
                $('#cTel').val(jsonData.contactPersonTel);
                $('#cFax').val(jsonData.contactPersonFax);
            }
        });
    });
    
    $('.btn-editAddress').on('click',function(){
        $('#editAddressID').val('');
        $('#cAddress').val('');
        var postData = {};
        var id = $(this).data('companyid');
        postData.companyID = $(this).data('companyid');
        postData.operation = "getAddress";
        $.ajax({
            type: 'post',
            url: '../process_company.php',
            data: postData,
            success: function(data){
                var pos = data.indexOf("{");
                var dataValid = data.substring(pos);
                var jsonData = eval("("+dataValid+")");
                $('#editAddressID').val(id);
                $('#cAddress').val(jsonData.address);
            }
        });
    });
    
    $('.btn-reset').on('click',function(){
        var companyId = $(this).data('companyid');
        var operation = 'reset';
        var postData = {};
        postData.companyID = companyId;
        postData.operation = operation;
        $.ajax({ //Process the form using $.ajax()
            type      : 'POST', //Method type
            url       : '../process_company.php', //Your form processing file URL
            data      : postData, //Forms name
            success   : function(data) {
                window.location.reload();
            }
        });
        event.preventDefault(); //Prevent the default submit
    });
    
    
})();

