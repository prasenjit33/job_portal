<?php 
if(Session::get('admin_ID')!='') 
{
    echo "<script>window.location.href='http://localhost/german_caption/admin/dashboard'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Re & Re Again : Admin Panel</title>

    <!-- Bootstrap -->
    <link href="assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="assets/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="assets/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
              
              <form action="login" method="post">
              <h1>Login Form</h1>
              <?php 
                if(Session::get('login_msg')!='') 
                {
                    echo "<span class='error'>".Session::get('login_msg')."</span>";
                }
              ?>
              <div>
                  <input type="text" name="username" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                  <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}" />  
              <div>
                  <input type="submit" name="login" class="btn btn-default submit" value="Log In" />
<!--                <a class="btn btn-default submit" href="index.html">Log in</a>-->
<!--                <a class="reset_pass" href="#">Lost your password?</a>-->
              </div>

              <div class="clearfix"></div>

              <div class="separator">

                <div>
                  <h1><i class="fa fa-paw"></i> Re & Re Again : Admin Panel</h1>
                  <p>©2016 All Rights Reserved. Re & Re Again! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        
      </div>
    </div>
  </body>
</html>
