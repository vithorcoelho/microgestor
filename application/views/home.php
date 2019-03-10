<!DOCTYPE html>
<html lang="pt-br">

<?php $this->load->view('head'); ?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container register">
                <div class="row">
                    <div class="col-md-3 register-left">
                        <img src="<?php echo base_url('assets/images/logo.png') ?>" alt=""/>
                        <h3>Bem vindo!</h3>
                        <p>O microgestor é um sistema de gestão simples e gratuito voltado para micro e pequenos empreendedores</p>
                        <a href="<?php echo URLBASE_ADMIN . 'login' ?>" class="btn form-control">Login</a>
                    </div>

                    <div class="col-md-1"></div>

                    <div class="col-md-8 register-right">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">Crie uma conta grátis</h3>
                                <form method="post" action="cadastro">
                                    <div class="row register-form">
                                        <?php echo get_message_cookie() ?>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Nome completo" name="nome">
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" placeholder="Email" name="email">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control" placeholder="Senha" name="senha">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control"  placeholder="Confirmar senha" name="senha2">
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Nome da empresa" name="nome_empresa">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="CPNJ/CPF (opcional)" name="cnpj">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" minlength="10" class="form-control" placeholder="Telefone" name="telefone">
                                            </div>

                                            <input type="submit" class="btnRegister"  value="Cadastrar"/>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

<?php $this->load->view('js'); ?>

</html>

<style type="text/css">

</style>