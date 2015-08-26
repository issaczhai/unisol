/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function check(id){
    var fd = new FormData(document.getElementById("addProductForm"));
    $.ajax({
        type: 'post',
        url: 'check_photo.php?photo='+id+'_input',
        data: fd,
        dataType: 'json',
        contentType: false,
        processData: false,
        error: function(data){
            console.log(data.responseText);
            document.getElementById(id+'_close').style.display="block";
            document.getElementById(id+'_check').style.display="none";
        },
        success: function(data){
            document.getElementById(id+'_check').style.display="block";
            document.getElementById(id+'_close').style.display="none";

        }
    });
}

function show_update_cutoff_input(){
    $('#confirm_cutoff_change').css('display','');
    $('#current_cutoff_entry').css('display','');
    $('#current_cutoff').css('display','none');
}

function update_cutoff(){
    var new_cutoff_priceStr = "";
    var  new_cutoff;
    if($( "#current_cutoff_entry" ).val()!==null){
        new_cutoff_priceStr = $('#current_cutoff_entry').val();
    }
    var valid = true;
    
    if(isNaN(new_cutoff_priceStr)){
        valid = false;

    }else{ 
        if(new_cutoff_priceStr.length>0){
            new_cutoff = parseFloat(new_cutoff_priceStr);	
        }else{
            valid = false;

        }
    }
    $('#confirm_current_cutoff_entry_change').css('display','none');
    $('#current_cutoff_entry').css('display','none');
    $('#current_cutoff').css('display','');
    if(valid){
        var operation = 'updateCutoff';
        var redirect_path= './process_free_delivery_price.php?operation='+operation+'&new_cutoff='+new_cutoff;
        
        document.location.href =redirect_path;
    }
    
}

function show_update_charge_input(){
    $('#confirm_charge_change').css('display','');
    $('#charge_entry').css('display','');
    $('#current_charge').css('display','none');
}

function update_charge(){
    var new_charge_priceStr = "";
    var  new_charge;
    if($( "#charge_entry" ).val()!==null){
        new_charge_priceStr = $('#charge_entry').val();
    }
    var valid = true;
    
    if(isNaN(new_charge_priceStr)){
        valid = false;

    }else{ 
        if(new_charge_priceStr.length>0){
            new_charge = parseFloat(new_charge_priceStr);	
        }else{
            valid = false;

        }
    }
    $('#confirm_charge_change').css('display','none');
    $('#charge_entry').css('display','none');
    $('#current_charge').css('display','');
    if(valid){
        var operation = 'updateCharge';
        var redirect_path= './process_free_delivery_price.php?operation='+operation+'&new_charge='+new_charge;
        
        document.location.href =redirect_path;
    }
    
}

function showEditTab(){
    document.getElementById("editProduct").className = "tab-pane fade active in";
    document.getElementById("viewProduct").className = "tab-pane fade";
}

function hideEditTab(){
    document.getElementById("editProduct").className = "tab-pane fade";
    document.getElementById("viewProduct").className = "tab-pane fade active in";
}

function populateEditField(product_id,p_name,p_symbol,p_price,p_color,p_stock,p_description,url1,url2){
    document.getElementById("edit_product_id").value = product_id;
    document.getElementById("edit_product_name").value = p_name;
    document.getElementById("edit_symbol_code").value = p_symbol;
    document.getElementById("edit_price").value = p_price;
    var color_arr = p_color.split(',');
    for(i=1;i<9;i++){
        if($.inArray(document.getElementById("edit_color"+i).value,color_arr) !== -1){
            document.getElementById("edit_color"+i).checked = true;
        }   
    }
    var photo_url_array = [url1,url2];
    
    for (i=0;i<2;i++){
        var angle = '';
        switch(i) {
            case 0:
                angle = '1';
                break;
            case 1:
                angle = '2';
                break;
        }
        if(photo_url_array[i]){
            document.getElementById("imgURL_"+angle+"_thumbnail").src =photo_url_array[i];
        }
        
    }
    
    document.getElementById("edit_product_stock").value = p_stock;
    document.getElementById("edit_product_description").value = p_description;
    var myEditor = nicEditors.findEditor('edit_product_description');
    myEditor.setContent($('#edit_product_description').val());
}

function removeRewardCode(code){
    var operation = "remove";
    document.location.href = 'process_reward.php?operation='+operation+'&code='+code;
        
}

function setGift(code){
    document.getElementById("gift_code").value = code;
}

function showOrder(o_id){
    $("#orderDetail"+o_id).css('display','');
    $("#viewButton"+o_id).css('display','none');
    $("#closeButton"+o_id).css('display','');
}

function closeOrderDetail(o_id){
    $("#orderDetail"+o_id).css('display','none');
    $("#viewButton"+o_id).css('display','');
    $("#closeButton"+o_id).css('display','none');
}

function populateAddJhtmlArea(){
    document.getElementById('addTextarea').value = nicEditors.findEditor('add_product_description').getContent();
    return true;
}

function populateEditJhtmlArea(){
    document.getElementById('editTextarea').value = nicEditors.findEditor('edit_product_description').getContent();
    return true;
}

