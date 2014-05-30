<?= $menuBreadcrumb; ?>

<section class="panel panel-default">
    <div class="panel-heading">
        Menu
    </div>

    <div class="panel-body">
        <?php if(empty($menus)): ?>
        	<p><?= __('menu.none'); ?></p>
        <?php else: ?>
        	<div id="alerts"></div>

        	<div class="table-responsive">
                <table class="table table-striped table-bordered table-hover <?php if(isset($menuParent)) echo 'sortable'; ?>" data-toggle="datatable" id="table-menu">
                    <thead>
                        <tr>
        	                <th></th>
                            <th><?= __('menu.table.id'); ?></th>
                            <th><?= __('menu.table.text'); ?></th>
                            <th><?= __('menu.table.slug'); ?></th>
                            <th><?= __('menu.table.submenu'); ?></th>
                            <th><?= __('menu.table.links'); ?></th>
                            <th><?= __('menu.table.actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php foreach($menus as $menu): ?>
                        <?php $menuLang = \LbMenu\Helper_Menu::getLang($menu); ?>
        				<tr id="object-<?= $menu->id; ?>" data-id="<?= $menu->id; ?>">
        					<td>
                                <?php if($menu->nbLink > 0 || $menu->nbSub > 0): ?>
                                    <span class="fa fa-list-ul fa-lg fa-fw"></span>
                                <?php else: ?>
                                    <span class="fa fa-link fa-lg fa-fw"></span>
                                <?php endif; ?>
                            </td>
        					<td><?= $menu->id; ?></td>
                            <td><?= $menuLang->text; ?></td>
        					<td><?= $menu->slug; ?></td>
        					<td><?= $menu->nbSub ?></td>
        					<td><?= $menu->nbLink ?></td>
        					<td>
        						<a href="<?= \Router::get('menu_backend_delete', array('id' => $menu->id)); ?>" class="btn btn-danger btn-circle"><i class="fa fa-trash-o fa-lg"></i></a>
        						<a href="<?= \Router::get('menu_backend_edit', array('id' => $menu->id)); ?>" class="btn btn-info btn-circle"><i class="fa fa-pencil fa-lg"></i></a>
                                <a href="<?= \Router::get('menu_backend_submenu', array('id' => $menu->id)); ?>" class="btn btn-warning btn-circle"><i class="fa fa-level-down fa-lg"></i></a>
                            </td>
        				</tr>
                    	<?php endforeach; ?>
        			</tbody>
        		</table>
        	</div>
        <?php endif; ?>

        <a href="<?= \Router::get('menu_backend_add'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> <?= __('menu.action.create'); ?></a>

        <?php if(isset($menuParent)): ?>
        	<a href="<?= \Router::get('menu_backend_add_to_parent', array('parent' => $menuParent->id)); ?>" class="btn btn-info"><i class="fa fa-plus"></i> <?= __('menu.action.add_link'); ?></a>
        <?php endif; ?>
    </div>
</section>

<script type="text/javascript">
    // Sortable row
    var fixHelper = function(e, ui) {
        ui.children().each(function() {
            $(this).width($(this).width());
        });
        return ui;
    };
    // Sortable
    $(function() {
	    $('#table-menu.sortable tbody').sortable({
	        helper: fixHelper,
	        update: function(event, ui) {
	            updatePosition(event, ui);
	        }
	    });
    });

    function updatePosition(event, ui)
    {
        var objectMove = $('#' + ui.item.context.id);
        var objectNext = objectMove.next();
        var objectPrevious = objectMove.prev();

        if (objectNext.attr('id') !== undefined)
        {
            var dataForRequest = {idCurrent: objectMove.attr('data-id'), idNext: objectNext.attr('data-id')};
        }
        else if (objectPrevious.attr('id') !== undefined)
        {
            var dataForRequest = {idCurrent: objectMove.attr('data-id'), idPrev: objectPrevious.attr('data-id')};
        }
        else
        {
            return false;
        }

        var request = $.ajax({
            url: '/menu/backend/index/api/move_menu.json',
            type: 'GET',
            data: dataForRequest,
            dataType: "json"
        });

        request.done(function(data) {
            addAlert("<?= __('menu.message.position'); ?>");
        });
    }

    function addAlert(message) {
    	if ($('#alerts:empty').length == 0)
    	{
    		$('#alerts').fadeOut(50).html('');
    	}
    	
        $('#alerts').append(
                '<div class="alert alert-success">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button>' + message + '</div>').fadeIn(500);
    }
</script>

