$(document).ready(function(){
    GetAllCities();
    $('#saveCity').click(function(){
       SaveCity(); 
    });
});

function ResetCityForm()
{
    $('#successSave').html('');
    $('#city_name').val('');
    $('#city_slug').val('');
}

function GetAllCities()
{
    $('#itemLinkCity').html('<a href=\"javascript:void(0)\" onclick=\"GetAllTrashedCities()\"><i class=\"fa fa-trash\"></i> Trashed Item</a>');
    $('#datatable-checkbox-city').dataTable({ 
            'sAjaxSource':'AjaxGetAllCities',
            "bDestroy": true,
            "fnDrawCallback": function () 
            {

            }
    }); 
}

/*
 * Save city
 */
function SaveCity()
{
    $('#loader').fadeIn();
    $('#saveCity').addClass('.disabled');
    $('#saveCity').attr('disabled',true);
    var city_name = $('#city_name').val();
    var country = $('#country').val();
    var city_slug = $('#city_slug').val();
    var token = $('#_token').val();
    var formData = new FormData();

    if(city_name == '')
    {
        $('#errorCity').fadeIn();
        $('#errorCity').html('');
        $('#errorCity').html('This field cannot be blank');
        $('#loader').fadeOut();
        $('#saveCity').removeClass('.disabled');
        $('#saveCity').removeAttr('disabled');
        return false;
    }
    else
    {
        $('#errorCountry').fadeOut();
    }

    formData.append('_token', token);
    formData.append('country_slug', country);
    formData.append('city_name', city_name);
    formData.append('city_slug', city_slug);
    // Ajax Script

    $.ajax({
            url: 'AjaxSaveCity',
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
                            $('#saveCity').removeClass('.disabled');
                            $('#saveCity').removeAttr('disabled');

            },
            200: function(data)
            {
                if(data.msg == 0)
                {
                    $('#errorSave').fadeIn();
                    $('#errorSave').html(data.message);
                    $('#loader').fadeOut();
                    $('#saveCity').removeClass('.disabled');
                    $('#saveCity').removeAttr('disabled');
                }
                else if(data.msg == 1)
                {
                    if(city_slug == '')
                    {
                        $('#successSave').fadeIn();
                        $('#successSave').html(data.message);
                        $('#errorSave').fadeOut();
                        $('#city-form')[0].reset();
                        GetAllCities();
                        setInterval(function(){
                            $('#successSave').fadeOut();
                            $('#errorSave').fadeOut();
                        },2000);
                    }
                    else
                    {
                        $('#successSave').fadeIn();
                        $('#successSave').html(data.message);
                        $('#errorSave').fadeOut();
                        setInterval(function(){
                            $('#successSave').fadeOut();
                            $('#errorSave').fadeOut();
                        },2000);
                        GetAllCities();
                    }

                    $('#loader').fadeOut();
                    $('#saveCity').removeClass('.disabled');
                    $('#saveCity').removeAttr('disabled');
                }
            }
            }
    });
}

/*
 * Get City by ID
 */

function GetCityByID(city_slug)
{
    var token=$('#_token').val();
    var formData = new FormData();
    formData.append('_token', token);
    formData.append('city_slug', city_slug);
    
    // Ajax Script
        
        $.ajax({
                url: 'AjaxGetCityByID',
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
                    $('#country').val(data.country_slug);
                    $('#city_name').val(data.city_name);
                    $('#city_slug').val(data.city_slug);
                }
                }
        });
}

/*
 * Trash City
 */

function TrashCity(city_slug)
{
    var con = confirm('Do you want to trash the City ?');
    var token = $('#_token').val();
    if(con == true)
    {

         $.ajax({
         url: "AjaxTrashCity",
         type: 'POST',
         data: {'city_slug':city_slug,'_token':token},
         success: function (data)
         {
             //alert(data);
             if(data.msg == 1)
             {
                $('#success').fadeIn();
                $('#message').html(data.message);
                $('#error').fadeOut();
                GetAllCities()
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
                GetAllCities()
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
 * Get All Trashed City
 */

function GetAllTrashedCities()
{
    $('#itemLinkCity').html('<a href=\"javascript:void(0)\" onclick=\"GetAllCities()\"><i class=\"fa fa-check-square\"></i> All Cities</a>');
    $('#datatable-checkbox-city').dataTable({ 
            'sAjaxSource':'AjaxGetAllTrashedCities',
            "bDestroy": true,
            "fnDrawCallback": function () 
            {

            }
    });
}

/*
 * Restore City by slug
 */

function RestoreCity(city_slug)
{
    var con = confirm('Do you want to Restore the City ?');
    var token = $('#_token').val();
    if(con == true)
    {

         $.ajax({
         url: "AjaxRestoreCityByCitySlug",
         type: 'POST',
         data: {'city_slug':city_slug,'_token':token},
         success: function (data)
         {
             //alert(data);
             if(data.msg == 1)
             {
                $('#success').fadeIn();
                $('#message').html(data.message);
                $('#error').fadeOut();
                GetAllTrashedCities();
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
                GetAllTrashedCities();
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
 * Delete City by city slug
 */

function DeleteCity(city_slug)
{
    var con = confirm('Do you want to delete the City ?');
    var token = $('#_token').val();
    if(con == true)
    {

         $.ajax({
         url: "AjaxDeleteCityByCitySlug",
         type: 'POST',
         data: {'city_slug':city_slug,'_token':token},
         success: function (data)
         {
             //alert(data);
             if(data.msg == 1)
             {
                $('#success').fadeIn();
                $('#message').html(data.message);
                $('#error').fadeOut();
                GetAllTrashedCities();
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
                GetAllTrashedCities();
                setInterval(function(){
                   $('#success').fadeOut();
                   $('#error').fadeOut();
                   },2000);

             }
         }
         });
    }
}