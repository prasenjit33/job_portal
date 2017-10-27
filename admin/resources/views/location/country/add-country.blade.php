<?php echo View::make('common.header'); ?>
      <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Location Section</h3>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" novalidate>
                        <p id="successSave" style="color: #008000;"></p>
                        <p id="errorSave" style="color: #802420;"></p>
                      <span class="section">Add Country</span>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Country Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="country_name" class="form-control col-md-7 col-xs-12" name="country_name"/>
                        </div>
                          <div class="alert" id="errorCountry"></div>
                      </div>
                      
                      <input type="hidden" name="country_slug" id="country_slug" value="" /> 
                      <input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}" />  
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button id="saveCountry" type="button" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

<?php echo View::make('common.footer'); ?>