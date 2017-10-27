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
                  <div class="alert alert-success alert-dismissible fade in" role="alert" style="display: none;" id="successSave">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>Success!</strong> Data saved successfully.
                    </div>
                    
                    <div class="alert alert-danger alert-dismissible fade in" role="alert" style="display: none;" id="errorSave">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>Error!</strong> There is some technical error. Please try again.
                    </div>
                <div class="x_panel">
                    <div class="fa-hover col-md-3 col-sm-4 col-xs-6">
                        <a href="javascript:void(0)" onclick="ResetCountryForm()"><i class="fa fa-plus-square"></i> Add New Country</a>                        
                    </div>
                    <div class="x_content">

                      <form class="form-horizontal form-label-left" id="country-form" novalidate>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Country Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="country_name" class="form-control col-md-7 col-xs-12" name="country_name"/>
                        </div>
                          
                          <div style="color: red;" id="errorCountry"></div>
                      </div>
                      
                      <input type="hidden" name="country_slug" id="country_slug" value="" /> 
                      <input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}" />  
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">                            
                            <button id="saveCountry" type="button" class="btn btn-success">Submit</button>
                            <span id="loader" style="display: none;"><img src="assets/build/images/loading_image.gif" style="width: 60px"/></span>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            
            
            <div class="row">
              
                <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    
                  <div class="x_title">
                    <h2>Countries</h2>
                    
                    <div class="clearfix"></div>
                    <span class="section" id="itemLink"><a href="javascript:void(0)" onclick="GetAllTrashedCountries()"><i class="fa fa-trash"></i> Trashed Item</a></span>
                    <div class="clearfix"></div>
                    
                    <div class="alert alert-success alert-dismissible fade in" role="alert" style="display: none;" id="success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                        <div id="message"></div>
                    </div>
                    
                    <div class="alert alert-danger alert-dismissible fade in" role="alert" style="display: none;" id="error">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                        <div id="message"></div>
                    </div>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      
                    <p class="text-muted font-13 m-b-30" id="success">
                     
                    </p>
                    <p class="text-muted font-13 m-b-30" id="error">
                     
                    </p>
                    <table id="datatable-checkbox-country" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>Sr. No</th>
                          <th>Country</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                        <tr>
                          <td></td>   
                          <td></td>  
                          <td></td>
                        </tr>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
             <input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}" /> 
              
            </div>
          </div>
        </div>
        <!-- /page content -->

<?php echo View::make('common.footer'); ?>