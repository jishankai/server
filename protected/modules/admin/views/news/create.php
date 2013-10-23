
<div id="SecuredActionBarForSearchAndListView" class="ActionBarForSearchAndListView ConfigurableMetadataView MetadataView">
<div class="view-toolbar-container clearfix">
<div class="view-toolbar">
<a class="icon-create" href="<?php echo $this->createUrl("admin");?>">管理公告</a>
</div></div></div>

<center><h1>创建公告</h1></center>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
