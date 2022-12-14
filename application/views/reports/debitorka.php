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
            <table class="table table-bordered table-condensed table-responsive table-striped table-hover">
                <thead>
                    <th>Оборудование</th>
                    <th>Заявка</th>
                    <th>Заказчик</th>
                    <th>Сумма</th>
                </thead>
                <tbody>
                <?php
                    if (sizeof($result) > 0) {
                    foreach ($result as $rows) { ?>
                        <tr>
                            <td><?=$rows['equipment']?><br><span class="text-muted"><?=$rows['mark']?></span></td>
                            <td><a href="/request/edit/<?=$rows['requestId']?>"><?=$rows['request']?></a><br><span class="text-muted"><?=$rows['created']?></span></td>
                            <td><?=$rows['customer']?><br><span class="text-muted"><?=$rows['city']?></span></td>
                            <td><?=$currency->format($rows['sum'])?> ₽</td>
                        </tr>
                    <?php }} else { ?>
                        <tr><td colspan="4"><center>нет результатов</center></td></tr>
                <?php } ?>
                </tbody>
            </table>

            <a href="/report/debitorka/toFile" class="btn btn-info pull-right">В&nbsp;Excel</a>

        </div>
    </div>



    <div class="clearfix">&nbsp;</div>


</div>
</div>