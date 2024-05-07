<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\bootstrap4\Modal;

$this->title = 'SENARAI PEMAIN';
Modal::begin([
    'id' => 'myModal',
    'title' => '<h4></h4>',
    'size' => 'modal-lg'
]);

Modal::end();
?>
<div class="card card-primary card-outline heavy">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-list-alt"></i>&nbsp;
            MAKLUMAT SUKAN</small>
        </h3>
    </div>
    <div class="card-body">
        <?=
        DetailView::widget([
            'model' => $sukan,
            'attributes' => [         
                [                      
                    'label' => 'NAMA SUKAN',
                    'attribute' => 'fullname',
                ],
                [                      
                    'label' => 'PEMAIN MAKSIMUM (BILANGAN)',
                    'attribute' => 'yuran',
                ],
                [                      
                    'label' => 'PEMAIN MINIMUM (BILANGAN)',
                    'attribute' => 'yuran',
                ],
                [                      
                    'label' => 'COACH',
                    'attribute' => 'yuran',
                ],
            ],
        ]);
        ?>
    </div>
</div>


