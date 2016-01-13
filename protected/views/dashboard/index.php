<?php $this->beginWidget(
    'booster.widgets.TbJumbotron',
    array(
        'heading' => 'Hello, world!',
    )
); ?>
 
    <p>This is a simple hero unit, a simple jumbotron-style component for
        calling extra attention to featured
        content or information.</p>
 
    <p><?php $this->widget(
            'booster.widgets.TbButton',
            array(
                'context' => 'primary',
                'size' => 'large',
                'label' => 'Learn more',
            )
        ); ?></p>
 
<?php $this->endWidget(); ?>