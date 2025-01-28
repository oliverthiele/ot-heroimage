<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

call_user_func(
    static function () {

        ExtensionManagementUtility::addPlugin(
            [
                'label' => 'LLL:EXT:ot_heroimage/Resources/Private/Language/locallang_be.xlf:wizard.title',
                'description' => 'LLL:EXT:ot_heroimage/Resources/Private/Language/locallang_be.xlf:wizard.description',
                'value' => 'ot_heroimage',
                'icon' => 'ot-heroimage',
                'group' => 'extras'
            ],
            'CType',
            'ot_heroimage',
        );

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
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.media,assets,
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
                ],
            ]
        );
    }
);
