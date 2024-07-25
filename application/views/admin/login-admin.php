<body style="display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0;">
  <div class="login-box" style="width: 100%; max-width: 400px; padding: 20px; border: 1px solid #ccc; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,.1);">
    <div class="page-signin-header text-sm-center bg-white" style="margin-bottom: 20px;">
      <a class="px-demo-brand px-demo-brand-lg text-default" href="index.html"><span class="px-demo-logo bg-primary"><span class="px-demo-logo-1"></span><span class="px-demo-logo-2"></span><span class="px-demo-logo-3"></span><span class="px-demo-logo-4"></span><span class="px-demo-logo-5"></span><span class="px-demo-logo-6"></span><span class="px-demo-logo-7"></span><span class="px-demo-logo-8"></span><span class="px-demo-logo-9"></span></span>Admin AirBnb</a>
      
    </div>

    <!-- Sign In form -->
    <div class="page-signin-container" id="page-signin-form">
      <h2 class="m-t-0 m-b-4 text-xs-center font-weight-semibold font-size-20">Entre na sua conta</h2>

      <form action="<?php echo site_url('admin/login_admin'); ?>" method="post" class="panel p-a-4">
        <fieldset class="form-group form-group-lg">
          <input type="text" name="txt-username" class="form-control" placeholder="Username">
        </fieldset> 

        <fieldset class="form-group form-group-lg">
          <input type="password" name="txt-password" class="form-control" placeholder="Password">
        </fieldset>

        <div class="clearfix">
          <label class="custom-control custom-checkbox pull-xs-left">
            <input type="checkbox" class="custom-control-input">
            <span class="custom-control-indicator"></span>
            Lembrar de mim
          </label>
          <a href="#" class="font-size-12 text-muted pull-xs-right" id="page-signin-forgot-link">Esqueceu a senha?</a>
        </div>

        <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">Entrar</button>
      </form>
    </div>
  </div>




 
