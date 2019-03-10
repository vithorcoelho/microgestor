<script type="text/javascript">   
$('.arquivo').click(function(){
  $('.boxarquivo').toggle();
});
$('.filterproduto').click(function(){
  $('.filter-options').toggle();
});

$(document).mouseup(function(e) 
{
    var container = $(".filter-options");
    var boxarquivo = $(".boxarquivo");

    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        container.hide();
    }
    if (!boxarquivo.is(e.target) && boxarquivo.has(e.target).length === 0) 
    {
        boxarquivo.hide();
    }
});

// Busca produtos
$(document).ready(function()
  {
    $('.busca-produto').keyup(function()
    {
      $('#pb_loader').addClass('show');
      $('.pagination').hide();

        $.ajax({
          type: 'POST',
          url:  '<?php echo base_url('produtos/ajax_buscaprodutos') ?>',
          data: {
              nome: $(".busca-produto").val()
          },
          success: function(data) 
          {
            
            $('.listaprodutos').hide();
            $('#resultado').html(data);
            var textobusca = $(".busca-produto").val();
            $('h5').html('Resultados de: ' + textobusca);

            setTimeout(function() {
                $('#pb_loader').removeClass('show');
             }, 400);

            if(textobusca != '' && data == '')
            {
              $('#resultado').html('<h5 style="text-align:center; margin:20px 0; color: #c2c2c2"><i>Nenhum produto encontrado</i></h5>');
            }
            
             if($(".busca-produto").val() == '')
             {
                $('.listaprodutos').show();
                $('.pagination').hide();
             }
          }
        });
    });
});
</script>

<script type="text/javascript">
  function atualizaTabela()
{
  $('.table tbody').html('').append('<div class="loader-center"><div class="loader loader-sm"></div><div>');
  $.ajax({
    url: '<?php echo base_url(uri_string()) ?>',
    success: function(response){
      //forçando o parser
      var data = $( '<div>'+response+'</div>' ).find('.table tbody').html();
      //apenas atrasando a troca, para mostrarmos o loading
      window.setTimeout( function(){
        $('.table tbody').hide();
        $('.table tbody').html(data);
        $('.table tbody').fadeIn(600);
      }, 250 );
    }
  });
}
     $(".modaladdproduto").submit(function(){
        var dados = $(this).serialize();

        $('.modal-footer input').attr('disabled', true);
        $('.modal-footer input').attr('value', 'Adicionando');
        $('.form-control').attr('disabled', true);
        
        $.ajax({
         url: '<?php echo base_url('produtos/Ajax_CadastrarProduto') ?>',
         type: "POST",
         data: dados,
         dataType: 'json',
         success: function (response) {
          setTimeout(function()
            {
               $('.modal-footer input').attr('disabled', false);
               $('.modal-footer input').attr('value', 'Cadastrar');
               $('.form-control').attr('disabled', false);
               $('html').css('cursor', 'auto');
              
               if(response.error)
               {
                 msg_flutuante(response.error, 'error');
               }
               if(response.success)
               {
                 atualizaTabela();
                 $('#loading-modal input[type=text]').val('');
                 $('.modal').modal('hide');
                 window.setTimeout( function(){ msg_flutuante(response.success, 'success', 'topCenter')},500);
               }
            },350);
         },
      });
       return false;
     });
</script>