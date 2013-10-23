
<div id="SecuredActionBarForSearchAndListView" class="ActionBarForSearchAndListView ConfigurableMetadataView MetadataView">
<div class="view-toolbar-container clearfix">
<div class="view-toolbar">
<a class="icon-create" href="<?php echo $this->createUrl("create");?>">创建公告</a>

</div></div></div>

<center><h1>公告管理</h1></center>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'notice-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
                
		'title_jp',
		 array(            // display 'create_time' using an expression
            'name'=>'content_jp',
            'value'=>'mb_substr($data->content_jp, 0, 100, "UTF-8") ',
			'type' => 'html',
        ),

	    'title_en',
		 array(            // display 'create_time' using an expression
            'name'=>'content_en',
            'value'=>'mb_substr($data->content_en, 0, 100, "UTF-8") ',
			'type' => 'html',
        ),

        'title_zh',
		 array(            // display 'create_time' using an expression
            'name'=>'content_zh',
            'value'=>'mb_substr($data->content_zh, 0, 100, "UTF-8") ',
			'type' => 'html',
        ),
		    
       array('name'=>'startTime','value'=>'date("Y-m-d H:i:s",$data->startTime)'),
       array('name'=>'endTime','value'=>'date("Y-m-d H:i:s",$data->endTime)'),
                //'endTime',
		'isTop',
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
