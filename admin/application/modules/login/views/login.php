<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de gestão simples e gratuito">
    <meta name="author" content="Joao Vithor Coelho">
    <meta name="keywords" content="gestao, empresas, gratuito">

    <link rel="manifest" href=""  />
    <link rel="shortcut icon" href="<?php echo URLBASE . 'assets/images/logo.png' ?>" type="image/png">

    <title><?php echo @$titulo; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,400i,600|Montserrat:200,300,400" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLBASE ?>assets/theme.css">
</head>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container register">
                <div class="row">
                    <div class="col-md-4 register-left">
                        <img src="<?php echo URLBASE . 'assets/images/logo.png' ?>" alt=""/>
                        <h3>Bem vindo!</h3>
                        <p>O microgestor é um sistema de gestão simples e gratuito voltado para micro e pequenos empreendedores</p>
                        <a href="<?php echo URLBASE ?>" class="btn form-control">Cadastrar-se</a>
                    </div>

                    <div class="col-md-3"></div>

                    <div class="col-md-4 register-right">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">Entrar</h3>
                                <?php echo get_message_cookie() ?>
                                <form method="post" action="">
                                    <div class="row register-form">
                                        
                                        <div class="col">
                                              <div class="form-group">
                                                <?php echo form_label('E-mail'); ?>
                                                <?php echo form_input('email', set_value('email'), array('class'=>'form-control', 'placeholder'=>'E-mail')); ?>
                                              </div>
                                              <div class="form-group">
                                                <?php echo form_label('Senha'); ?>
                                                <?php echo form_input(array('name'=>'senha', 'type'=>'password'), '', array('class'=>'form-control', 'placeholder'=>'Senha')); ?>
                                              </div>

                                               <div class="form-group">
                                                <input type="submit" class="btn btn-primary btn-block" value="Entrar">
                                              </div>

                                               <div class="text-center">
                                                <a href="#">Esqueci minha senha</a>
                                              </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

</html>