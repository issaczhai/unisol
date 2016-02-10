var Request = function (file, baseUrl, data, method, callback) {
    var request = this,
        xhr;

    request.tasks = [];
    request.response = '';
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xhr = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var result = JSON.parse(xhr.responseText);
            callback(result);
        }else{
            console.log("status: " + xhr.statusText);
            // print respective error msg
        }
    };

    if(method === 'POST'){

        xhr.open(method , baseUrl, true);
        //to post like HTML form
        if (!file) xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        xhr.send(data);

    }else{
        xhr.open(method , buildUrl(baseUrl, data), true);
        xhr.send();
    }
    
    return request;
};

Request.prototype.triggerTask = function(result){
    var tasks = this.tasks || [],
        index = 0;

    for(index = 0; index < tasks.length; index++){
        tasks[index].func.call(this);
    }
};

Request.prototype.addTask = function(func){
    
    this.tasks.push({func : func});

};
