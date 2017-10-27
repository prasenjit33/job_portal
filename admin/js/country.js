$(document).ready(function(){
    
    /*
     * Upload Top Slider Image in Home Page
     */
    $('#topSlider').click(function(){
        
        var top_slider_image = $('#top_slider_image')[0].files[0];
        var top_slider_content = $('#top_slider_content').val();
        var token=$('#_token').val();
        var formData = new FormData();

        if(top_slider_image == undefined)
        {
            $('#errorFile').html('');
            $('#errorFile').html('Please select a file to upload');
            return false;
        }
        else
        {
            $('#errorFile').html('');
        }
        
        formData.append('_token', token);
        formData.append('top_slider_image', top_slider_image);
        formData.append('top_slider_content', top_slider_content);
        
        // Ajax Script
        
         $.ajax({
                url: 'UploadTopSectionImage',
                type:'POST',
                data: formData,  
                processData: false,
                contentType: false,
                async:false,
                statusCode: {
                500: function(message) {
                                var errorMessage = message.responseJSON.message;
                                $('#errorUpload').html('');
                                $('#errorUpload').html(errorMessage);

                },
                200: function(data)
                {
                    if(data == 'error')
                    {
                        $('#errorUpload').html('');
                        $('#errorUpload').html('Sorry! The password entered by you is not your current password');
                    }
                    else if(data == 'invalidFile')
                    {
                        $('#errorUpload').html('');
                        $('#errorUpload').html('Invalid File Type Please Try Again.<br/> You file must be of type .jpg or .png');                                
                    }
                    else if(data == 'success')
                    {
                        $('#successUpload').html('');
                        $('#successUpload').html('Subtitle Uploaded Successfully');
                    }
                }
                }
           });
    });
    
    /*
     * Save Country
     */
    $('#saveCountry').click(function(){
        $('#loader').fadeIn();
        $('#saveCountry').addClass('.disabled');
        $('#saveCountry').attr('disabled',true);
        var country_name = $('#country_name').val();
        var country_slug = $('#country_slug').val();
        var token=$('#_token').val();
        var formData = new FormData();
        
        if(country_name == '')
        {
            $('#errorCountry').fadeIn();
            $('#errorCountry').html('');
            $('#errorCountry').html('This field cannot be blank');
            $('#loader').fadeOut();
            $('#saveCountry').removeClass('.disabled');
            $('#saveCountry').removeAttr('disabled');
            return false;
        }
        else
        {
            $('#errorCountry').fadeOut();
        }
        
        formData.append('_token', token);
        formData.append('country_name', country_name);
        formData.append('country_slug', country_slug);
        
        // Ajax Script
        
        $.ajax({
                url: 'AjaxSaveCountry',
                type:'POST',
                data: formData,  
                processData: false,
                contentType: false,
                async:false,
                statusCode: {
                500: function(message) {
                                var errorMessage = message.responseJSON.message;
                                $('#errorSave').html('');
                                $('#errorSave').html(errorMessage);
                                $('#loader').fadeOut();
                                $('#saveCountry').removeClass('.disabled');
                                $('#saveCountry').removeAttr('disabled');

                },
                200: function(data)
                {
                    if(data == 'error')
                    {
                        $('#errorSave').html('');
                        $('#errorSave').html('Sorry! There is some issue saving data. Please try again.');
                        $('#loader').fadeOut();
                        $('#saveCountry').removeClass('.disabled');
                        $('#saveCountry').removeAttr('disabled');
                    }
                    else if(data == 'success')
                    {
                        if(country_slug == '')
                        {
                            $('#successSave').fadeIn();
                            $('#errorSave').fadeOut();
                            $('#country-form')[0].reset();
                            GetAllCountries();
                            setInterval(function(){
                                $('#successSave').fadeOut();
                                $('#errorSave').fadeOut();
                            },2000);
                        }
                        else
                        {
                            $('#successSave').fadeIn();
                            $('#errorSave').fadeOut();
                            setInterval(function(){
                                $('#successSave').fadeOut();
                                $('#errorSave').fadeOut();
                            },2000);
                            GetAllCountries();
                        }
                        
                        $('#loader').fadeOut();
                        $('#saveCountry').removeClass('.disabled');
                        $('#saveCountry').removeAttr('disabled');
                    }
                }
                }
        });
        
    });
    
    GetAllCountries();
});
/*
 * Reset Form
 */

function ResetCountryForm()
{
    $('#successSave').html('');
    $('#country_name').val('');
    $('#country_slug').val('');
}
/*
 * Get All Countries
 */

function GetAllCountries()
{
    $('#itemLink').html('<a href=\"javascript:void(0)\" onclick=\"GetAllTrashedCountries()\"><i class=\"fa fa-trash\"></i> Trashed Item</a>');
    $('#datatable-checkbox-country').dataTable({ 
            'sAjaxSource':'AjaxGetAllCountries',
            "bDestroy": true,
            "fnDrawCallback": function () 
            {

            }
    }); 
}

/*
 * Get Country By ID
 */

function GetCountryByID(country_slug)
{
    var token=$('#_token').val();
    var formData = new FormData();
    formData.append('_token', token);
    formData.append('country_slug', country_slug);
    
    // Ajax Script
        
        $.ajax({
                url: 'AjaxGetCountryByID',
                type:'POST',
                data: formData,  
                processData: false,
                contentType: false,
                async:false,
                statusCode: {
                500: function(message) {
                                var errorMessage = message.responseJSON.message;
                                $('#errorSave').html('');
                                $('#errorSave').html(errorMessage);

                },
                200: function(data)
                {
                    $('#country_name').val(data.country_name);
                    $('#country_slug').val(data.country_slug);
                }
                }
        });
}

/*
 * Trash Country
 */

function TrashCountry(country_slug)
{
    var con = confirm('Do you want to trash the Country ?');
    var token = $('#_token').val();
    if(con == true)
    {

         $.ajax({
         url: "AjaxTrashCountry",
         type: 'POST',
         data: {'country_slug':country_slug,'_token':token},
         success: function (data)
         {
             //alert(data);
             if(data.msg == 1)
             {
                 $('#success').fadeIn();
                 $('#message').html(data.message);
                 $('#error').fadeOut();
                 GetAllCountries();
                 setInterval(function(){
                    $('#success').fadeOut();
                    $('#error').fadeOut();
                    },2000);
             }
             else if(data.msg == 0)
             {
                 $('#success').fadeOut();
                 $('#message').html(data.message);
                 $('#error').fadeIn();
                 GetAllCountries();
                 setInterval(function(){
                    $('#success').fadeOut();
                    $('#error').fadeOut();
                    },2000);

             }
         }
         });
    }
}

/*
 * Get All Trashed Item
 */

function GetAllTrashedCountries()
{
    $('#itemLink').html('<a href=\"javascript:void(0)\" onclick=\"GetAllCountries()\"><i class=\"fa fa-check-square\"></i> All Countries</a>');
    $('#datatable-checkbox-country').dataTable({ 
            'sAjaxSource':'AjaxGetAllTrashedCountries',
            "bDestroy": true,
            "fnDrawCallback": function () 
            {

            }
    }); 
}

/*
 * Delete Country by country slug
 */

function DeleteCountry(country_slug)
{
    var con = confirm('Do you want to Delete the Country ?');
    var token = $('#_token').val();
    if(con == true)
    {

         $.ajax({
         url: "AjaxDeleteCountryByCountrySlug",
         type: 'POST',
         data: {'country_slug':country_slug,'_token':token},
         success: function (data)
         {
             //alert(data);
             if(data.msg == 1)
             {
                 $('#success').fadeIn();
                 $('#message').html(data.message);
                 $('#error').fadeOut();
                 GetAllTrashedCountries()
                 setInterval(function(){
                    $('#success').fadeOut();
                    $('#error').fadeOut();
                    },2000);
             }
             else if(data.msg == 0)
             {
                 $('#success').fadeOut();
                 $('#message').html(data.message);
                 $('#error').fadeIn();
                 GetAllTrashedCountries()
                 setInterval(function(){
                    $('#success').fadeOut();
                    $('#error').fadeOut();
                    },2000);

             }
         }
         });
    }
}

/*
 * Restore Country by country slug
 */

function RestoreCountry(country_slug)
{
    var con = confirm('Do you want to Restore the Country ?');
    var token = $('#_token').val();
    if(con == true)
    {

         $.ajax({
         url: "AjaxRestoreCountryByCountrySlug",
         type: 'POST',
         data: {'country_slug':country_slug,'_token':token},
         success: function (data)
         {
             //alert(data);
             if(data.msg == 1)
             {
                 $('#success').fadeIn();
                 $('#message').html(data.message);
                 $('#error').fadeOut();
                 GetAllTrashedCountries()
                 setInterval(function(){
                    $('#success').fadeOut();
                    $('#error').fadeOut();
                    },2000);
             }
             else if(data.msg == 0)
             {
                 $('#success').fadeOut();
                 $('#message').html(data.message);
                 $('#error').fadeIn();
                 GetAllTrashedCountries()
                 setInterval(function(){
                    $('#success').fadeOut();
                    $('#error').fadeOut();
                    },2000);

             }
         }
         });
    }
}