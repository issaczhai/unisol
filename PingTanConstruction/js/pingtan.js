var cloneComponent = function(className, childrenBool, eventBool){
	
	var component = $('.' + className);
	var copy = $('.' + className).clone(childrenBool, eventBool);
	copy.removeClass(className);

	return copy;
};

var gotoPage = function(url){
	window.location = url;
};

function $_GET(param) {
	var vars = {};
	window.location.href.replace( 
		/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
		function( m, key, value ) { // callback
			vars[key] = value !== undefined ? value : '';
		}
	);

	if ( param ) {
		return vars[param] ? vars[param] : null;	
	}
	return vars;
}

var buildUrl = function(baseUrl, data){
    
    return baseUrl + '?' + data;
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

var bindEvent = function(object, event, callback){
	object.on(event, callback);
};

var getFileName = function(pathname){
	return pathname.split(/\.|\//)[pathname.split(/\.|\//).length - 2];
};

var convertJsonToValueArray = function(json){
	return $.map(json, function(value, key) { 
						return value;
			});
};