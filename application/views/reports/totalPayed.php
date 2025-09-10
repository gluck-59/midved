<?php
//    	prettyDump($result[0]);
    //	prettyDump($stopWords);

    $currency = new NumberFormatter( 'ru_RU', NumberFormatter::DECIMAL );
    $currency->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 0);
?>

<div class="container-fluid">
    <h3><?=$reportName?></h3>
    <div class="clearfix">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 col-md-4">
            <div class="alert alert-info" role="alert">
                Здесь учитываются только актуальные заявки со статусами "<?=RequestModel::STATUSES[0]?>" и "<?=RequestModel::STATUSES[1]?>"
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-4">
            <table class="table table-bordered table-condensed table-responsive table-striped table-hover">
                <thead>
                    <th>Заказчик</th>
                    <th>Оборудование</th>
                    <th>Заявка</th>
                    <th>Сумма</th>
                </thead>
                <tbody>
                <?php
                    if (sizeof($result) > 0) {
                    foreach ($result as $rows) { ?>
                        <tr>
                            <td><?=$rows['customer']?><br><span class="text-muted"><?=$rows['city']?></span></td>
                            <td><?=$rows['equipment']?><br><span class="text-muted"><?=$rows['mark']?></span></td>
                            <td><a href="/request/edit/<?=$rows['requestId']?>"><?=$rows['request']?></a><br><span class="text-muted">от <?=$rows['created']?></span></td>
                            <td><?=$currency->format($rows['sum'])?> ₽<br><span class="text-muted">итого по этой заявке<span></span></td>
                        </tr>
                    <?php }} else { ?>
                        <tr><td colspan="4"><center>В незакрытых заявках оплат не было</center></td></tr>
                <?php } ?>
                </tbody>
            </table>

            <a href="/report/totalPayed/toFile" class="btn btn-info pull-right">В&nbsp;Excel</a>

        </div>
    </div>



    <div class="clearfix">&nbsp;</div>


</div>
</div>