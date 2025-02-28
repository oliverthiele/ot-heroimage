<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

call_user_func(
    static function () {

        $ll = 'LLL:EXT:ot_heroimage/Resources/Private/Language/locallang_be.xlf:';

        ExtensionManagementUtility::addPlugin(
            [
                'label' => $ll . 'wizard.title',
                'description' => $ll . 'wizard.description',
                'value' => 'ot_heroimage',
                'icon' => 'ot-heroimage',
                'group' => 'extras'
            ],
            'CType',
            'ot_heroimage',
        );

        $tempColumns = [
            'ot_layout' => [
                'exclude' => true,
                'label' => 'Layout',
                'l10n_mode' => 'exclude',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [
                            'label' => 'Default',
                            'value' => ''
                        ],
                    ],
                    'size' => 1,
                    'maxitems' => 1,
                ]
            ],
        ];



        /************************
         * Configure element type
         ************************/
        $GLOBALS['TCA']['tt_content']['types']['ot_heroimage'] = array_replace_recursive(
            $GLOBALS['TCA']['tt_content']['types']['ot_heroimage'],
            [
                'showitem' => '
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                    --palette--;;general,
                    --palette--;;headers,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.media,assets,image,ot_layout,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                    --palette--;;frames,
                    --palette--;;appearanceLinks,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                    --palette--;;language,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                    --palette--;;hidden,--palette--;;access,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                --div--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_category.tabs.category,categories,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,rowDescription,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended',
                'columnsOverrides' => [
                    'assets' => [
                        'config' => [
                            'maxitems' => 1,
                            'allowed' => 'jpg,jpeg,png,gif,svg',
                            'overrideChildTca' => [
                                'columns' => [
                                    'uid_local' => [
                                        'config' => [
                                            'appearance' => [
                                                'elementBrowserType' => 'file',
                                                'elementBrowserAllowed' => 'jpg,jpeg,png,gif,svg',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'image' => [
                        'label' => $ll . 'tt_content.image.label',
                        'config' => [
                            'maxitems' => 1,
                            'allowed' => 'jpg,jpeg,png,gif,svg',
                            'overrideChildTca' => [
                                'columns' => [
                                    'uid_local' => [
                                        'config' => [
                                            'appearance' => [
                                                'elementBrowserType' => 'file',
                                                'elementBrowserAllowed' => 'jpg,jpeg,png,gif,svg',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'ot_layout' => [
                        'description' => $ll . 'tt_content.ot_layout.description',
                        'config' => [
                            'type' => 'select',
                            'renderType' => 'selectSingle',
                            'items' => [
                                [
                                    'label' => $ll . 'tt_content.ot_layout.withoutSpacing',
                                    'value' => ''
                                ],
                                [
                                    'label' => $ll . 'tt_content.ot_layout.withSpacing',
                                    'value' => 'withSpacing'
                                ],
                            ],
                        ]
                    ]
                ],
            ]
        );
    }
);
//'ot_layout' => [
//        'config' => [
//            'type' => 'select',
//            'renderType' => 'selectSingle',
//            'items' => [
//                [
//                    'label' => 'Bild links (50% Bild - 50% Text)',
//                    'value' => '',
//                ],
//                [
//                    'label' => 'Bild rechts (50% Text - 50% Bild)',
//                    'value' => '50_text-50_image',
//                ],
//            ],
//            'size' => 1,
//            'maxitems' => 1,
//        ],
//    ],
