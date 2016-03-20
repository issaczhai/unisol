<?php
$admin = $_SESSION['admin'];
?>
<header class="header dark-bg">
            <div class="toggle-nav">
                <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
            </div>

            <!--logo start-->
            <a href="index.php" class="logo">PingTan <span class="lite">Admin</span></a>
            <!--logo end-->
            <div class="top-nav notification-row">                
                <!-- notificatoin dropdown start-->
                <ul class="nav pull-right top-menu">
                    
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
                                <img alt="" src="<?=$admin['profilePic']?>" style="width:30px;height:30px">
                            </span>
                            <span class="username"><?=$admin['username']?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li>
                                <a hre="#" data-toggle="modal" data-target="#editAdmin"> Edit Password</a>
                            </li>
                            <li>
                                <a href="login.php"><i class="icon_key_alt"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!-- notificatoin dropdown end-->
            </div>
      </header>   

<div class="modal fade" id="editAdmin" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editAdminForm" method="post" action="../process_admin.php">
                <input type="hidden" name="operation" value="edit">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="modalLabel">Edit Password</h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="currentPwd">Current Password</label>
                            <div class="controls">
                                <input id="currentPwd" onchange="checkCurrentPwd()" name="currentPwd" type="password" class="form-control" class="input-medium">
                                <i class="icon_check" id="currentPwd_check" style="display:none"></i>
                                <i class="icon-remove" id="currentPwd_cross" style="display:none"></i>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="newPwd">New Password</label>
                            <div class="controls">
                                <input id="newPwd" name="newPwd" type="password" class="form-control" class="input-medium" disabled>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="cfm_newPwd">Confirm New Password</label>
                            <div class="controls">
                                <input id="cfm_newPwd" name="cfm_newPwd" onchange="checkNewPwd()" type="password" class="form-control" class="input-medium" disabled>
                                <i class="icon_check" id="cfm_newPwd_check" style="display:none"></i>
                                <i class="icon-remove" id="cfm_newPwd_cross" style="display:none"></i>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-edit-pwd" disabled>Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
      <!--header end-->
      <script>

        function checkCurrentPwd(){
            var operation = 'checkCurrentPwd';
            var currentPwd = $('#currentPwd').val();
            var postData = {'operation':operation,'pwd': currentPwd};
            $.ajax({ //Process the form using $.ajax()
                type      : 'POST', //Method type
                url       : '../process_admin.php', //Your form processing file URL
                data      : postData, //Forms name
                success   : function(data) {
                    var pos = data.indexOf("{");
                    var dataValid = data.substring(pos);
                    var jsonData = eval("("+dataValid+")");
                    if(jsonData.status === "true"){
                        $('#currentPwd_check').css('display','block');
                        $('#currentPwd_cross').css('display','none');
                        $('#newPwd').removeAttr('disabled');
                        $('#cfm_newPwd').removeAttr('disabled');
                    }else{
                        $('#currentPwd_check').css('display','none');
                        $('#currentPwd_cross').css('display','block');
                        $('#newPwd').attr('disabled','disabled');
                        $('#cfm_newPwd').attr('disabled','disabled');
                    }
                }
            });
        }
        

        
        function checkNewPwd(){
            var operation = 'checkNewPwd';
            var postData = {'operation':operation,'newPwd': $('#newPwd').val(),'cfm_newPwd': $('#cfm_newPwd').val()};
            $.ajax({ //Process the form using $.ajax()
                type      : 'POST', //Method type
                url       : '../process_admin.php', //Your form processing file URL
                data      : postData, //Forms name
                success   : function(data) {
                    var pos = data.indexOf("{");
                    var dataValid = data.substring(pos);
                    var jsonData = eval("("+dataValid+")");
                    if(jsonData.status === "true"){
                        $('#cfm_newPwd_check').css('display','block');
                        $('#cfm_newPwd_cross').css('display','none');
                        $('.btn-edit-pwd').removeAttr('disabled');
                    }else{
                        $('#cfm_newPwd_cross').css('display','none');
                        $('#cfm_newPwd_check').css('display','block');
                        $('.btn-edit-pwd').attr('disabled','disabled');
                    }
                }
            });
            event.preventDefault();
        }

</script>