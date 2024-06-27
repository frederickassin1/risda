<?php

use app\models\TblKecerdasanEmosi;
use app\models\TblPersonaliti;
use app\models\TblResults;
use app\models\TblUsers;
use dosamigos\chartjs\ChartJs;
use yii\helpers\VarDumper;
use app\models\AverageCalculator;

/** @var yii\web\View $this */
/** @var app\models\TblUsersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pengguna (Aktif)</span>
                    <span class="info-box-number"><?= TblUsers::totalUsers(1); ?></span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pengguna (Belum Aktif)</span>
                    <span class="info-box-number"><?= TblUsers::totalUsers(0); ?></span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-purple elevation-1"><i class="fas fa-comments"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Penilaian Personaliti</span>
                    <span class="info-box-number">
                        <?= TblPersonaliti::totalSubmit(1); ?>
                        <small>Selesai</small>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-orange elevation-1"><i class="fas fa-smile-wink" style="color:white;"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Penilaian Kecerdasan Emosi</span>
                    <span class="info-box-number">
                        <?= TblKecerdasanEmosi::totalSubmit(1); ?>
                        <small>Selesai</small>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-purple heavy">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-bar"></i>&nbsp;Statistik Penilaian Personaliti</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <?php

                $labels = [];
                $dataL = []; // Dataset for 'L'
                $dataP = []; // Dataset for 'P'

                foreach ($data['domains'] as $domainId => $domainData) {
                    $labels[] = $domainData['label'];
                    $dataL[] = $domainData['values']['L'];
                    $dataP[] = $domainData['values']['P'];
                }

                echo ChartJs::widget([
                    'type' => 'bar',
                    'options' => [
                        'height' => 100,
                        // 'width' => 50,
                    ],
                    'clientOptions' => [
                        'title' => [
                            'display' => true,
                            'text' => 'PERBANDINGAN ANTARA JANTINA',
                            'fontSize' => 20, // You can set the title font size here
                        ],

                        'scales' => [
                            'yAxes' => [
                                ['ticks' => ['beginAtZero' => true]]
                            ],
                        ],
                        'tooltips' => [
                            'enabled' => true,
                            'mode' => 'index',
                            'intersect' => false,
                            'callbacks' => [
                                'label' => new \yii\web\JsExpression("function(tooltipItem, data) {
                                            let label = data.datasets[tooltipItem.datasetIndex].label || '';
                                            if (label) {
                                                label += ': ';
                                            }
                                            label += Math.round(tooltipItem.yLabel * 100) / 100;
                                            return label;
                                        }"),
                                'title' => new \yii\web\JsExpression("function(tooltipItem, data) {
                                            // Return the title for the tooltip based on the item index
                                            return data.labels[tooltipItem[0].index];
                                        }"),
                                // Here you can add more custom labels if needed
                            ],
                        ],
                    ],
                    'data' => [
                        'labels' => $labels,
                        'datasets' => [
                            [
                                'label' => 'Lelaki',
                                'backgroundColor' => "rgba(54, 162, 235, 1)", // Blue color
                                'borderColor' => "rgba(54, 162, 235, 1)",
                                'data' => $dataL
                            ],
                            [
                                'label' => 'Perempuan',
                                'backgroundColor' => "rgba(255, 99, 132, 1)", // Pink color
                                'borderColor' => "rgba(255, 99, 132, 1)",
                                'data' => $dataP
                            ],
                        ]
                    ]
                ]);
                ?>
                <hr>
                <?php

                // Service Group Chart
                $labelsServiceGroup = [];
                $dataServiceGroups = []; // Assuming you have multiple service groups

                // Loop through the domain data to set up labels and initialize service groups in $dataServiceGroups
                foreach ($data2['domains'] as $domainId => $domainData) {
                    $labelsServiceGroup[] = $domainData['label'];
                    foreach ($domainData['values'] as $serviceGroupKey => $value) {
                        if (!isset($dataServiceGroups[$serviceGroupKey])) {
                            $dataServiceGroups[$serviceGroupKey] = []; // Initialize the array if not already set
                        }
                        $dataServiceGroups[$serviceGroupKey][] = $value;
                    }
                }

                // Define a default color for service groups that are not predefined
                $defaultColor = "rgba(128, 128, 128, 1)"; // Grey color

                // Predefined colors for each service group
                $serviceGroupColors = [
                    'Pengurusan & Profesional' => "rgba(75, 192, 192, 1)",
                    'Pengurusan Tertinggi' => "rgba(153, 102, 255, 1)",
                    // Add all expected groups and their colors here
                    // 'Pengurusan & Profesional' => "rgba(0, 123, 255, 1)", // Example for your undefined group
                ];

                $datasetsServiceGroup = [];
                foreach ($dataServiceGroups as $groupKey => $data) {
                    // Use the predefined color or the default color if not set
                    $backgroundColor = $serviceGroupColors[$groupKey] ?? $defaultColor;
                    $borderColor = $serviceGroupColors[$groupKey] ?? $defaultColor;

                    $datasetsServiceGroup[] = [
                        'label' => $groupKey,
                        'backgroundColor' => $backgroundColor,
                        'borderColor' => $borderColor,
                        'data' => $data,
                    ];
                }
                echo ChartJs::widget([
                    'type' => 'bar',
                    'options' => [
                        'height' => 100,
                        // 'width' => 50,
                    ],
                    'clientOptions' => [
                        'height' => 50,
                        'scales' => [
                            'yAxes' => [
                                ['ticks' => ['beginAtZero' => true]]
                            ],
                        ],
                        'title' => [
                            'display' => true,
                            'text' => 'PERBANDINGAN ANTARA KUMPULAN KHIDMAT',
                            'fontSize' => 20, // You can set the title font size here
                        ],
                        'tooltips' => [
                            'enabled' => true,
                            'mode' => 'index',
                            'intersect' => false,
                            'callbacks' => [
                                'label' => new \yii\web\JsExpression("function(tooltipItem, data) {
                                            let label = data.datasets[tooltipItem.datasetIndex].label || '';
                                            if (label) {
                                                label += ': ';
                                            }
                                            label += Math.round(tooltipItem.yLabel * 100) / 100;
                                            return label;
                                        }"),
                                'title' => new \yii\web\JsExpression("function(tooltipItem, data) {
                                            // Return the title for the tooltip based on the item index
                                            return data.labels[tooltipItem[0].index];
                                        }"),
                                // Here you can add more custom labels if needed
                            ],
                        ],
                    ],
                    'data' => [
                        'labels' => $labelsServiceGroup,
                        'datasets' => $datasetsServiceGroup
                    ]
                ]);

                ?>
            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-orange heavy">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-bar"></i>&nbsp;Statistik Penilaian Kecerdasan Emosi</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <?php

                $labels = [];
                $dataL = []; // Dataset for 'L'
                $dataP = []; // Dataset for 'P'

                foreach ($data3['domains'] as $domainId => $domainData) {
                    $labels[] = $domainData['label'];
                    $dataL[] = $domainData['values']['L'];
                    $dataP[] = $domainData['values']['P'];
                }

                echo ChartJs::widget([
                    'type' => 'bar',
                    'options' => [
                        'height' => 100,
                        // 'width' => 50,
                    ],
                    'clientOptions' => [
                        'title' => [
                            'display' => true,
                            'text' => 'PERBANDINGAN ANTARA JANTINA',
                            'fontSize' => 20, // You can set the title font size here
                        ],

                        'scales' => [
                            'yAxes' => [
                                ['ticks' => ['beginAtZero' => true]]
                            ],
                        ],
                        'tooltips' => [
                            'enabled' => true,
                            'mode' => 'index',
                            'intersect' => false,
                            'callbacks' => [
                                'label' => new \yii\web\JsExpression("function(tooltipItem, data) {
                                            let label = data.datasets[tooltipItem.datasetIndex].label || '';
                                            if (label) {
                                                label += ': ';
                                            }
                                            label += Math.round(tooltipItem.yLabel * 100) / 100;
                                            return label;
                                        }"),
                                'title' => new \yii\web\JsExpression("function(tooltipItem, data) {
                                            // Return the title for the tooltip based on the item index
                                            return data.labels[tooltipItem[0].index];
                                        }"),
                                // Here you can add more custom labels if needed
                            ],
                        ],
                    ],
                    'data' => [
                        'labels' => $labels,
                        'datasets' => [
                            [
                                'label' => 'Lelaki',
                                'backgroundColor' => "rgba(54, 162, 235, 1)", // Blue color
                                'borderColor' => "rgba(54, 162, 235, 1)",
                                'data' => $dataL
                            ],
                            [
                                'label' => 'Perempuan',
                                'backgroundColor' => "rgba(255, 99, 132, 1)", // Pink color
                                'borderColor' => "rgba(255, 99, 132, 1)",
                                'data' => $dataP
                            ],
                        ]
                    ]
                ]);
                ?>
                <hr>
                <?php

                // Service Group Chart
                $labelsServiceGroup = [];
                $dataServiceGroups = []; // Assuming you have multiple service groups

                // Loop through the domain data to set up labels and initialize service groups in $dataServiceGroups
                foreach ($data4['domains'] as $domainId => $domainData) {
                    $labelsServiceGroup[] = $domainData['label'];
                    foreach ($domainData['values'] as $serviceGroupKey => $value) {
                        if (!isset($dataServiceGroups[$serviceGroupKey])) {
                            $dataServiceGroups[$serviceGroupKey] = []; // Initialize the array if not already set
                        }
                        $dataServiceGroups[$serviceGroupKey][] = $value;
                    }
                }

                // Define a default color for service groups that are not predefined
                $defaultColor = "rgba(128, 128, 128, 1)"; // Grey color

                // Predefined colors for each service group
                $serviceGroupColors = [
                    'Pengurusan & Profesional' => "rgba(75, 192, 192, 1)",
                    'Pengurusan Tertinggi' => "rgba(153, 102, 255, 1)",
                    // Add all expected groups and their colors here
                    // 'Pengurusan & Profesional' => "rgba(0, 123, 255, 1)", // Example for your undefined group
                ];

                $datasetsServiceGroup = [];
                foreach ($dataServiceGroups as $groupKey => $data) {
                    // Use the predefined color or the default color if not set
                    $backgroundColor = $serviceGroupColors[$groupKey] ?? $defaultColor;
                    $borderColor = $serviceGroupColors[$groupKey] ?? $defaultColor;

                    $datasetsServiceGroup[] = [
                        'label' => $groupKey,
                        'backgroundColor' => $backgroundColor,
                        'borderColor' => $borderColor,
                        'data' => $data,
                    ];
                }
                echo ChartJs::widget([
                    'type' => 'bar',
                    'options' => [
                        'height' => 100,
                        // 'width' => 50,
                    ],
                    'clientOptions' => [
                        'height' => 50,
                        'scales' => [
                            'yAxes' => [
                                ['ticks' => ['beginAtZero' => true]]
                            ],
                        ],
                        'title' => [
                            'display' => true,
                            'text' => 'PERBANDINGAN ANTARA KUMPULAN KHIDMAT',
                            'fontSize' => 20, // You can set the title font size here
                        ],
                        'tooltips' => [
                            'enabled' => true,
                            'mode' => 'index',
                            'intersect' => false,
                            'callbacks' => [
                                'label' => new \yii\web\JsExpression("function(tooltipItem, data) {
                                            let label = data.datasets[tooltipItem.datasetIndex].label || '';
                                            if (label) {
                                                label += ': ';
                                            }
                                            label += Math.round(tooltipItem.yLabel * 100) / 100;
                                            return label;
                                        }"),
                                'title' => new \yii\web\JsExpression("function(tooltipItem, data) {
                                            // Return the title for the tooltip based on the item index
                                            return data.labels[tooltipItem[0].index];
                                        }"),
                                // Here you can add more custom labels if needed
                            ],
                        ],
                    ],
                    'data' => [
                        'labels' => $labelsServiceGroup,
                        'datasets' => $datasetsServiceGroup
                    ]
                ]);

                ?>
            </div>
        </div>

    </div>
</div>

