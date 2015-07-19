<style>
    #path,#redirection{
        font-family: "Century Gothic";
        color: #ffffff;
    }
</style>

<div class="container-fluid" style="position:relative;margin-bottom:0px;margin-top: 20px; background-color: #DEDEDC;">
    <div class="row" style="position:relative;margin-top:0px;background-color:#0087A0;">
        
        <div id="path" class='col-md-2 col-md-offset-2 col-xs-6 col-xs-offset-0' style="margin-top:10px;margin-bottom:10px">
            <i class="fa fa-gift fa-lg" style="color: #ffffff"></i>
            <?php if($currentPage !== ""){ ?>
            <span> webshop > <?php echo $currentPage ?></span>
            <?php }else{ ?>
            <span> webshop</span>
            <?php } ?>
        </div>
        <div id="redirection" class='col-md-3 col-md-offset-3 col-xs-6 col-xs-offset-0' style="margin-top:10px;margin-bottom:10px">
            <span>Go to main site &nbsp;</span>
            <select style="background-color: #ffffff;width:60%;border: none;outline: none;padding: 0;" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                <option selected value="http://allocacoc.sg">Singapore</option>
                <option value="http://www.allocacoc.com">Europe</option>
            </select>
            
        </div>
    </div>
    
    <div class="row">
        <div class='col-md-8 col-md-offset-2' style="padding-top:20px;padding-bottom:20px;font-family: Century Gothic;">
            <div class="row">
                <div class='col-md-2'>
                    <span><a href="./disclaimer.php" style="color: #333">disclaimer</a></span>
                </div>
                <div class='col-md-3'>
                    <span><a href="./termAndConditions.php" style="color: #333">terms & conditions</a></span>
                </div>
            </div>
            
            <div class="row" style="padding-top:20px;font-size: 12px;">
                <div class='col-md-10'>
                    <span>This webshop only delivers within Singapore, for other countries please go to <a href="www.allocacoc.com">www.allocacoc.com</a></span>
                </div>
            </div>
        </div>
    </div>
    
</div>