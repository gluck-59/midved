<?php
    //	prettyDump($result[0]);
    //	prettyDump($stopWords);

    $currency = new NumberFormatter( 'ru_RU', NumberFormatter::DECIMAL );
    $currency->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 0);
?>

<div class="container-fluid">
    <h3><?=$reportName?></h3>
    <div class="row">
        <div class="col-xs-12 col-md-4">
            <?php if (!empty($stopWords[0])) { ?>
                <h4>Низзя:</h4>
                <?php
                foreach ($stopWords[0] as $stopWord) { ?>
                    <h4><span class="label label-danger"><?=$stopWord?></span></h4>
                <?php } ?>
            <?php } ?>
            <table class="table table-bordered table-condensed table-responsive table-striped table-hover">
                <thead>
                    <th>Оборудование</th>
                    <th>Марка</th>
                    <th>Заказчик</th>
                    <th>Задолженность</th>
                </thead>
                <tbody>
                <?php
                    if (sizeof($result) > 0) {
                    foreach ($result as $rows) { ?>
                        <tr>
                            <td><?=$rows['equipment']?></td>
                            <td><?=$rows['mark']?></td>
                            <td><?=$rows['customer']?></td>
                            <td><?=$currency->format(-$rows['sum'])?> ₽</td>
                        </tr>
                    <?php }} else { ?>
                        <tr><td colspan="4"><center>нет результатов</center></td></tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>



    <div class="clearfix">&nbsp;</div>


</div>
</div>