<head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href=<?php echo adminLTE_url("bootstrap/css/bootstrap.min.css");?> rel="stylesheet" type="text/css">
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Theme style -->
    <link href=<?php echo adminLTE_url("dist/css/AdminLTE.min.css");?> rel="stylesheet" type="text/css">
    <!-- iCheck -->
    <link href=<?php echo adminLTE_url("plugins/iCheck/square/blue.css");?> rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href= <?php echo '"'.base_url().'"'; ?> ><b>Rhuanny</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Logue-se no sistema para ter acesso.</p>
        <?php echo form_open('login/index') ?>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Usuario" name="usuarioNick">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Senha" name="usuarioSenha">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">            
            <div class="col-xs-4">
              <input type="submit" class="btn btn-primary btn-block btn-flat" value="Entrar">
            </div><!-- /.col -->
          </div>
          <div class="row">            
              <?php echo validation_errors(); ?>
              <?php if( isset($erro) ) echo '   <br/><div class="alert alert-danger alert-dismissable">
								                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								                    <h4><i class="icon fa fa-ban"></i>'. $erro .'.</h4>
								                </div>';
               ?>   
            </div><!-- /.col -->
          </div>
        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->    

    <script src=<?php echo adminLTE_url("plugins/jQuery/jQuery-2.1.4.min.js");?> type="text/javascript"></script>
    <script src=<?php echo adminLTE_url("bootstrap/js/bootstrap.min.js");?> type="text/javascript"></script>
    <script src=<?php echo adminLTE_url("plugins/iCheck/icheck.min.js");?> type="text/javascript"></script>
</body>
