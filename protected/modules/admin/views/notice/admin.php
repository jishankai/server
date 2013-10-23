
<div id="SecuredActionBarForSearchAndListView" class="ActionBarForSearchAndListView ConfigurableMetadataView MetadataView">
<div class="view-toolbar-container clearfix">
<div class="view-toolbar">
<a class="icon-create" href="<?php echo $this->createUrl("create");?>">创建推送</a>

</div></div></div>

<center><h1>推送管理</h1></center>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'notice-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
                
		 array(            // display 'create_time' using an expression
            'name'=>'content',
            'value'=>'mb_substr($data->content, 0, 100, "UTF-8") ',
			'type' => 'html',
        ),
		    
       array('name'=>'time','value'=>'date("Y-m-d H:i:s",$data->time)'),
                //'endTime',
		/*'createTime',
		'updateTime',
		'deleteFlag',
		*/
		array(
			'class'=>'CButtonColumn',
                        //'template'=>'{view} {update}',  
                        //'viewButtonOptions'=>array('title'=>'查看'),  
                        //'updateButtonOptions'=>array('title'=>'修改'),  
		),
	),
));
?>
