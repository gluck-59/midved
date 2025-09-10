<?php
//		prettyDump($customers);
//	prettyDump($requests[0]);
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-4 col-xs-12">
			<h3>Клиенты <small class="text-muted">список</small></h3>
		</div>
	</div>
    <?php if (1 || empty($customers['parents'])) { ?>
        <div class="row">
            <div class="col-xs-12 col-md-4">
                <div class="alert alert-info" role="alert">
                    Создайте Клиента. К нему можно будет привязать принадлежащее ему Оборудование, на которое впоследствии создаются Заявки.<br><br>
                    Над Заявками производятся некие "наземные" операции, которые вы фиксируете в системе.<br><br>
                    Система учитывает произведенные над Заявками работы и (по желанию) приходы-расходы в разрезе созданных здесь Клиентов.
                </div>
            </div>
        </div>
    <?php } ?>

	<div class="row">
		<div class="col-lg-2 col-xs-12">
			<div class="btn-block">
				<button id="newCilent" class="btn btn-success btn-lg btn-block btn-open-modal"  data-toggle="modal" data-target="#modal-customer">Новый клиент</button>
			</div>
		</div>

		<div class="clearfix hidden-xs">&nbsp;</div>
		<div class="clearfix">&nbsp;</div>
	</div>
	<div class="row">
		<div class="col-lg-4 col-xs-12">
			<table id="customers" class="table table-condensed table-bordered table-condensed">
				<thead>
				<th>Название клиента</th>
				<th></th>
				</thead>
				<?php
                if (!empty($customers['parents']) || !empty($customers['childs'])) {
					foreach ($customers['parents'] as $parent) { ?>
						<tr>
                            <td>
								<a href="#" id="" data-toggle="modal" data-target="#modal-customer" data-customer_id="<?=$parent->id?>" data-name="<?=$parent->name?>" data-parent-id="<?=$parent->parentId?>" data-data="<?=$parent->data?>" ><b><?=$parent->name?></b></a>
							</td>
							<td><center><button type="button" class="close deleteCustomer" id="<?=$parent->id?>"><i class="glyphicon glyphicon-remove"></i></button></center></td>
						</tr>
                        <?php
                            foreach ($customers['childs'] as $child) {
                                if ($child->parentId == $parent->id) { ?>
                            <tr>
                                <td>
                                    &nbsp;&nbsp;&nbsp;<a href="#" id="" data-toggle="modal" data-target="#modal-customer" data-customer_id="<?=$child->id?>" data-name="<?=$child->name?>" data-parent-id="<?=$child->parentId?>" data-data="<?=$child->data?>" ><?=$child->name?></a>
                                    <span class="small"><?=$child->data?></span>
                                </td>
                                <td><center><button type="button" class="close deleteCustomer" id="<?=$child->id?>"><i class="glyphicon glyphicon-remove"></i></button></center></td>
                            </tr>
                        <?php }} ?>
					<?php }} else { ?>
                    <tfoot>
                    <tr>
                        <td>
                            <center>Нет клиентов</center>
                        </td>
                    </tr>
                    </tfoot>
                        <?php } ?>
			</table>

		</div>
	</div>
</div>

<?php
//    prettyDump($customers);