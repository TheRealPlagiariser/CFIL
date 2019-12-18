
<?php
  $selectStatus= "SELECT  * FROM config";
  $selectStatus= $conn->query($selectStatus);
  $selectStatus=$selectStatus->fetchAll(PDO::FETCH_ASSOC);
  
?>

<form id="frmCreateActionItem">
  <div class="container-fluid">
    <?php if ($where=="homewip"){
      echo '  <div class="chooseExisting">
                <div class="form-group">
                  <label for="drpActionItem" class="col-sm-2 control-label">Action Item</label>
                  <div class="col-sm-10">
                    <div class="input-group select2-bootstrap-append">
                      <div class="input-group-btn">
                        <select class="form-control" id="drpActionItem"  name="drpActionItem" required>
                          <option value="" ></option>
                        </select>
                        <span  id="btnAddNew" title="Create New Action" class="btn btn-default"><i  class="fas fa-plus"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>';
    }?>
    <div class="addNew Add-New-Action-Item" <?php if($where=="homewip") echo 'style="display:none;"'; ?>>

        <!-- Pain Point -->
        <div class="form-group-inner">
            <div class="row">
                <div class="col-sm-3">
                    <label for="txtPainPoint" class="login2" >Pain Point*</label>
                </div>
                <div class="col-sm-9">
                  <input id="txtPainPoint" name="txtPainPoint" type="text" class="form-control" required   <?php if($where=="homewip") echo 'disabled'; ?>>
                </div>
            </div>
        </div>

        <!-- Estimated mandays -->
        <div class="form-group-inner">
            <div class="row">
                <div class="col-sm-3">
                    <label for="txtEstimatedManDays" class="login2">Estimated Man Days*</label>
                </div>
                <div class="col-sm-9">
                  <input id="txtEstimatedManDays" type="text" value="" name="txtEstimatedManDays" required  <?php if($where=="homewip") echo 'disabled'; ?>>
                </div>
            </div>
        </div>

        <!-- Action -->
        <div class="form-group-inner">
          <div class="row">
              <div class="col-sm-3">
                  <label for="txaAction" class="login2">Action*</label>
              </div>
              <div class="col-sm-9">
                <textarea class="form-control" id="txaAction" required name="txaAction" rows="3" <?php if($where=="homewip") echo 'disabled'; ?>></textarea>
              </div>
          </div>
        </div>

        <!-- Resp -->
        <div class="form-group-inner">
            <div class="row">
                <div class="col-sm-3">
                    <label for="txtResp" class="login2">Responsible Team</label>
                </div>
                <div class="col-sm-9">
                  <input id="txtResp" name="txtResp" type="text" class="form-control" <?php if($where=="homewip") echo 'disabled'; ?> >
                </div>
            </div>
        </div>

        <!-- Owner -->
        <div class="form-group-inner">
          <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-3">
              <label for="txtOwner" class="login2">Owner*</label>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-9">
              <div class="input-group custom-go-button">
                <input id="txtOwner" name="txtOwner" type="text" class="form-control" placeholder="Enter Username ONLY" required <?php if($where=="homewip") echo 'disabled'; ?>>
                <span class="input-group-btn">
                  <button type="button" id="btnValidateUser" class="btn ">
                    <i class="fas fa-user-plus" title="Check Username">
                      <div id="loading-image" style="display: none;" class="loader"><img src="images\ajax-loader.gif" alt="Loading..." class="img-responsive center-block"></div>
                    </i>
                  </button>
                </span>
              </div>
            </div>
          </div>
        </div>

        <!-- Backup -->
        <div class="form-group-inner">
            <div class="row">
                <div class="col-sm-3">
                    <label for="txtBackup" class="login2">Alternate</label>
                </div>
                <div class="col-sm-9">
                  <input id="txtBackup" name="txtBackup" type="text" class="form-control" <?php if($where=="homewip") echo 'disabled'; ?>>
                </div>
            </div>
        </div>



        <!-- Tentative Completion -->
        <div class="form-group-inner">
          <div class="row">
            <label for="txtTentativeCompletionDate" class="col-sm-3 control-label">Tentative End Date</label>
            <div class="col-sm-9 ">
              <div class='input-group date' id='datetimepickerEnd'>
                <input style="background-color:white;" type="text" class="form-control" readonly="readonly" id="txtTentativeCompletionDate" name="txtTentativeCompletionDate" placeholder="" <?php if($where=="homewip") echo 'disabled'; ?>>

                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
            </div>
          </div>

        </div>

        <!-- Status -->
        <div class="form-group-inner">
            <div class="row">
                <div class="col-sm-3">
                    <label for="drpStatus" class="login2">Status*</label>
                </div>
                <div class="col-sm-9">
                    <div class="form-select-list">
                        <select id="drpStatus" class="form-control custom-select-value" name="drpStatus" required <?php if($where=="homewip") echo 'disabled'; ?>>
                          <option value=""></option>
                          <?php
                              $arrstatus=explode("|",$selectStatus[0]['actionItemStatus']);
                              foreach ($arrstatus as $key => $value) {

                                  echo "<option value='". $value."'>".$value."</option>";

                              }
                           ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comment -->
        <div class="form-group-inner divComment">
          <div class="row">
              <div class="col-sm-3">
                  <label for="txaComment" class="login2 ">Comment</label>
              </div>
              <div class="col-sm-9">
                <textarea class="form-control" id="txaComment"name="txaComment" rows="3"></textarea>
              </div>
          </div>
        </div>

    </div>
  </div>
</form>
