<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

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

        $extensionSettings = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('ot_heroimage');

        $mobileWidth = (int)($extensionSettings['mobileWidth'] ?? 768);
        $mobileHeight = (int)($extensionSettings['mobileHeight'] ?? 576);
        $desktopWidth = (int)($extensionSettings['desktopWidth'] ?? 2560);
        $desktopHeight = (int)($extensionSettings['desktopHeight'] ?? 450);

        $desktopRatio = $desktopWidth > 0 && $desktopHeight > 0 ? $desktopWidth / $desktopHeight : 0;
        $mobileRatio = $mobileWidth > 0 && $mobileHeight > 0 ? $mobileWidth / $mobileHeight : 0;

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
                                    'crop' => [
                                        'config' => [
                                            'cropVariants' => [
                                                'default' => [
                                                    'disabled' => true,
                                                ],
                                                'free' => [
                                                    'disabled' => true,
                                                ],
                                                '1:1' => [
                                                    'disabled' => true,
                                                ],
                                                '16:9' => [
                                                    'disabled' => true,
                                                ],
                                                '4:3' => [
                                                    'disabled' => true,
                                                ],
                                                '3:2' => [
                                                    'disabled' => true,
                                                ],
                                                '3:4' => [
                                                    'disabled' => true,
                                                ],
                                                '2:3' => [
                                                    'disabled' => true,
                                                ],
                                                'heroDesktop' => [
                                                    'title' => 'Hero Desktop',
                                                    'allowedAspectRatios' => [
                                                        'heroDesktop' => [
                                                            'title' => 'Hero Desktop (' . $desktopWidth . 'x' . $desktopHeight . ')',
                                                            'value' => $desktopRatio
                                                        ],
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
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
                                    'crop' => [
                                        'config' => [
                                            'cropVariants' => [
                                                'default' => [
                                                    'disabled' => true,
                                                ],
                                                'free' => [
                                                    'disabled' => true,
                                                ],
                                                '1:1' => [
                                                    'disabled' => true,
                                                ],
                                                '16:9' => [
                                                    'disabled' => true,
                                                ],
                                                '4:3' => [
                                                    'disabled' => true,
                                                ],
                                                '3:2' => [
                                                    'disabled' => true,
                                                ],
                                                '3:4' => [
                                                    'disabled' => true,
                                                ],
                                                '2:3' => [
                                                    'disabled' => true,
                                                ],
                                                'heroMobile' => [
                                                    'title' => 'Hero Mobile',
                                                    'allowedAspectRatios' => [
                                                        'heroMobile' => [
                                                            'title' => 'Hero Mobile (' . $mobileWidth . 'x' . $mobileHeight . ')',
                                                            'value' => $mobileRatio,
                                                        ],
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
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
