<?php
//    prettyDump($menu);
//    prettyDump($customers[0]);

?>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-4 col-xs-12">
			<h3>Клиенты <small class="text-muted">список</small></h3>
		</div>
	</div>
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
		<div class="col-lg-2 col-xs-12">
			<table id="customers" class="table table-condensed 1table-bordered">
            <?php
                foreach ($customers as $parent) { ?>
                    <tr>
                        <td>
                            <b><a href="#" id="" data-toggle="modal" data-target="#modal-customer" data-customer_id="<?=$parent->id?>" data-name="<?=$parent->name?>" data-parent-id="<?=$parent->parentId?>" data-data="<?=$parent->data?>" ><?=$parent->name?></a>:</b>
                            &nbsp;&nbsp;<button type="button" class="close deleteCustomer" id="<?=$parent->id?>"><i class="glyphicon glyphicon-remove"></i></button>
                        <?php 
                        //if ($parent->childs)
                        {
                            foreach ($parent->childs as $child) {?>
                            <br>&nbsp;&nbsp;- <a href="#" id="" data-toggle="modal" data-target="#modal-customer" data-customer_id="<?=$child->id?>" data-name="<?=$child->name?>" data-parent-id="<?=$child->parentId?>" data-data="<?=$child->data?>" ><?=$child->name?></a>
                                &nbsp;&nbsp;<button type="button" class="close deleteCustomer" id="<?=$child->id?>"><i class="glyphicon glyphicon-remove"></i></button>
                        <?php } ?>
                        </td>
                <?php }} ?>
                    </tr>
            </table>
		</div>
	</div>
</div>


