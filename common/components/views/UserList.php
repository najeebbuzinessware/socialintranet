     <div class="shareTo span12 m-t-20 m-l-0">
          <span class="s-To">To:</span>
          <?php
               $this->widget('bootstrap.widgets.TbSelect2', array(
                    'name' => 'ShareId[]',
					'data' => BWCFunctions::getMIdUsers(),
					'options'=>array(
					'placeholder'=>'Share to...',
					'allowClear'=>true,
					),
                    'htmlOptions'=>array(
						'multiple'=>'multiple',
					),
				));	
          ?>
     </div>
