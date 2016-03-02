var Cookie = function() {
        var cookie = this;

};

Cookie.prototype.setCookie = function(cname, cvalue, exdays, path){

            var d = new Date(),
            expires;

            d.setTime(d.getTime() + (exdays*24*60*60*1000));
            exdays === "null" ? expires = null : expires = "expires="+d.toUTCString();

            document.cookie = cname + "=" + cvalue + "; " + expires;
};

Cookie.prototype.getCookie = function(cname){

            var name = cname + "=";
            var ca = document.cookie.split(';');
            for(var i=0; i<ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1);
                if (c.indexOf(name) === 0) return c.substring(name.length, c.length);
            }
            return null;
};
// set the cookie expire date to a date passed
Cookie.prototype.deleteCookie = function(cname){
    document.cookie = cname + "='';expires=Thu, 01 Jan 1970 00:00:00 UTC";
};

(function(){
    var c = new Cookie();
    console.log(c.getCookie('username'));
    if(c.getCookie('username') !== null){
        setUsername(c.getCookie('username'));
    }
   
})();

/*var setCookie = function(cname, cvalue, exdays, path) {
    var d = new Date(),
        expires;

    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    exdays === "null" ? expires = null : expires = "expires="+d.toUTCString();

    document.cookie = cname + "=" + cvalue + "; " + expires;
};

var getCookie = function(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) === 0) return c.substring(name.length, c.length);
    }
    return null;
};*/
function setUsername(username){
    $('.header-username a').text('Hi, ' + username);
    $('.header-username a').attr({
        href: './profile_student.php'
    });
    $('.nav li.header-logout').css('display', 'inline-block');
}

/*function setCookieJson(cName,cValue,exdays) {
    var arr = [],
        obj = {},
        expires;
 
    //add new cookie data
    obj.cName = cName;
    obj.cValue = cValue;
    arr.push(obj);
 
    //get old cookie data
    var temp = getCookie();
    if (temp !== null) {
        //concat new and old cookie data
        for (var i = 0; i < temp.length; i++) {
            var ob = {};
            ob.name = temp[i].name;
            ob.value = temp[i].value;
            arr.push(ob);
        }
    }
    var objWarp = {};
    objWarp.user = arr;
    var val = JSON.stringify(objWarp);
 
    //set cookie date expired
    var date = new Date();
    date.setTime(date.getTime()+(exdays*24*60*60*1000));
    exdays === "null" ? expires = null : expires = "expires="+d.toUTCString();

    //create cookie
    document.cookie = "user_cookie="+val+expires;
}
 
function getCookieJson(cName) {
    var key,val,res;
    //get all cookie
    var oldCookie = document.cookie.split(';');
    for (var i = 0; i < oldCookie.length; i++) {
        key = oldCookie[i].substr(0,oldCookie[i].indexOf("="));
        val = oldCookie[i].substr(oldCookie[i].indexOf("=")+1);
        key = key.replace(/^\s+|\s+$/g,"");
        //find "user_cookie"
        if(key === cName) {
            res = val;
        }
    }
    if (res === undefined) {
        return null;
    } else {
        res = JSON.parse(res);
        return res.user;
    }
}*/