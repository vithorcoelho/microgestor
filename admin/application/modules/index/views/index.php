<!DOCTYPE html>
<html>
<?php echo modules::run('head'); ?>
<?php echo modules::run('header'); ?>

<?php body_open($titulo_header); ?>
<div class="body">
    <div class="row">

        <div class="col-lg-3">
            <div class="card ks-widget-simple-weather-only ks-widget-payment-price-ratio card-shadow widget-receita" style="background: #ffffff;border: 1px solid #dee0e1;">
                <span class="ks-icon la la-arrow-up"></span>
                <div class="ks-widget-simple-weather-only-body">
                    <div class="ks-widget-simple-weather-only-block-amount">
                        R$<?php echo number_format($receitamensal, 2, ',', '.');   ?>
                    </div>
                    <div class="ks-widget-simple-weather-only-location">
                        Receita mensal
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card ks-widget-simple-weather-only card-shadow widget-despesa" style="background: #ffffff;border: 1px solid #dee0e1;">
                <span class="ks-icon la la-arrow-down"></span>
                <div class="ks-widget-simple-weather-only-body">
                    <div class="ks-widget-simple-weather-only-block-amount">
                        R$<?php echo number_format($customensal, 2, ',', '.'); ?>
                    </div>
                    <div class="ks-widget-simple-weather-only-location">
                        Despesa mensal
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card ks-widget-simple-weather-only card-shadow widget-vendas" style="background: #ffffff;border: 1px solid #dee0e1;">
                <span class="ks-icon la la-cart-arrow-down"></span>
                <div class="ks-widget-simple-weather-only-body">
                    <div class="ks-widget-simple-weather-only-block-amount">
                        <?php echo $qtdvendas ?>
                    </div>
                    <div class="ks-widget-simple-weather-only-location">
                        Vendas mensal
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card ks-widget-simple-weather-only card-shadow widget-saldo" style="background: #ffffff;border: 1px solid #dee0e1;">
                <span class="ks-icon la la-money"></span>
                <div class="ks-widget-simple-weather-only-body">
                    <div class="ks-widget-simple-weather-only-block-amount">
                        R$<?php echo number_format(($receitamensal - $customensal), 2, ',', '.') ?>
                    </div>
                    <div class="ks-widget-simple-weather-only-location">
                        Saldo atual
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-md-6">
            <div class="card ks-card-widget ks-widget-table scroll card-shadow" style="height: 350px; overflow-y: scroll;">
                <h5 class="card-header">Pedidos em espera</h5>
                
                <div class="card-block">
                    <table class="table ks-payment-card-rate-details-table">
                        <tbody>
                            <?php if($pedidos): ?>
                            <?php foreach ($pedidos as $c): ?>
                            <tr>
                                <td width="10"><?php echo date('d/m/Y', strtotime($c['data'])) ?></td>
                                <td><a href="<?php echo base_url('vendas/dadosvenda/'.$c['chave']) ?>"><?php echo $c['cliente'] ?></a></td>
                                <td width="15"><strong>R$<?php echo number_format($c['total'], 2, ',', '.')  ?></strong></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

       <div class="col-md-6">
            <div class="card ks-card-widget ks-widget-table scroll card-shadow" style="height: 350px; overflow-y: scroll;">
                <h5 class="card-header">Mais vendidos</h5>
                
                <div class="card-block">
                   
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card ks-card-widget ks-widget-table scroll card-shadow">
                <h5 class="card-header">Lucro Bruto</h5>
                
                <div class="card-block">
                    <canvas class="grafico_fluxo" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>
<?php body_close(); ?>
<?php echo modules::run('footer'); ?>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
<script type="text/javascript">
    var ctx = $('.grafico_fluxo');

    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: [ <?php foreach(array_reverse($grafico) as $mes): echo '"' . $mes['nome_mes'] . '",' ; endforeach; ?> ],
            datasets: 
            [{
                label: "Lucro",
                lineTension: 0,
                backgroundColor: 'transparent',
                borderColor: '#0ec569',
                data: [<?php foreach(array_reverse($grafico) as $mes): echo $mes['receita'] - $mes['despesa'] . ','; endforeach; ?>],
            }]
        },

        // Configuration options go here
        options: {}
    });

</script>

</html>     