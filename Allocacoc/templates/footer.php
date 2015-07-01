<style>
    #path,#redirection{
        font-family: "Century Gothic";
        color: #ffffff;
    }
</style>

<div class="container-fluid" style="position:relative;margin-bottom:0px;margin-top: 20px; background-color: #DEDEDC; height: 150px">
    <div class="row" style="position:relative;margin-top:0px;background-color:#0087A0;height:40px;">
        <div class='col-md-2'></div>
        <div id="path" class='col-md-5' style="padding-top: 10px">
            <img src="#" width="20px" height="20px"/>
            <span>Webshop</span>
        </div>
        <div id="redirection" class='col-md-3' style="padding-top: 10px">
            <span>Go to main site &nbsp;</span>
            <select style="background-color: #ffffff;width:150px;border: none;outline: none;padding: 0;" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                <option value="http://allocacoc.sg">Singapore</option>
                <option value="http://www.allocacoc.com">Europe</option>
            </select>
            
        </div>
        <div class='col-md-2'></div>
    </div>
    
    <div class="row">
        <div class='col-md-2'></div>
        <div class='col-md-8' style="padding-top:20px;font-family: Century Gothic">
            <div class="row">
                <div class='col-md-2'>
                    <span><a href="#" style="color: #333">disclaimer</a></span>
                </div>
                <div class='col-md-3'>
                    <span><a href="#" style="color: #333">terms & conditions</a></span>
                </div>
            </div>
            
            <div class="row" style="padding-top:20px;font-size: 12px;">
                <div class='col-md-10'>
                    <span>This webshop only delivers within Singapore, for other countries please go to <a href="www.allocacoc.com">www.allocacoc.com</a></span>
                </div>
            </div>
        </div>
        <div class='col-md-2'></div>
    </div>
    
</div>