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
                'group' => 'extras',
            ],
            'CType',
            'ot_heroimage',
        );

        // Basis configuration of the field `ot_layouts` (used in other extensions)
        $tempColumns = [
            'ot_layout' => [
                'exclude' => true,
                'l10n_mode' => 'exclude',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [
                            'label' => 'Default',
                            'value' => '',
                        ],
                    ],
                    'size' => 1,
                    'maxitems' => 1,
                ],
            ],
        ];

        ExtensionManagementUtility::addTCAcolumns('tt_content', $tempColumns);

        ExtensionManagementUtility::addToAllTCAtypes(
            'tt_content',
            '--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.media,assets,image,ot_layout,',
            'ot_heroimage',
            'after:image'
        );

        /************************
         * Configure element type
         ************************/
        $GLOBALS['TCA']['tt_content']['types']['ot_heroimage'] = array_replace_recursive(
            $GLOBALS['TCA']['tt_content']['types']['ot_heroimage'],
            [
                'columnsOverrides' => [
                    'header' => [
                        'description' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header.description.ALT',
                    ],
                    'assets' => [
                        'label' => $ll . 'tt_content.assets.label',
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
                        'label' => $ll . 'tt_content.ot_layout.label',
                        'description' => $ll . 'tt_content.ot_layout.description',
                        'config' => [
                            'items' => [
                                [
                                    'label' => $ll . 'tt_content.ot_layout.withoutSpacing',
                                    'value' => '',
                                ],
                                [
                                    'label' => $ll . 'tt_content.ot_layout.withSpacing',
                                    'value' => 'withSpacing',
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );
    }
);
