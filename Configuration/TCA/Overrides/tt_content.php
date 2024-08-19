<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Frontend\Preview\TextmediaPreviewRenderer;

defined('TYPO3') or die();

call_user_func(
    static function () {
        if (!isset($GLOBALS['TCA']['tt_content']['types']['ot_heroimage']) ||
            !is_array($GLOBALS['TCA']['tt_content']['types']['ot_heroimage'])
        ) {
            $GLOBALS['TCA']['tt_content']['types']['ot_heroimage'] = [];
        }

        /*********************
         * Add Content Element
         *********************/
        ExtensionManagementUtility::addTcaSelectItem(
            'tt_content',
            'CType',
            [
                'LLL:EXT:ot_heroimage/Resources/Private/Language/locallang_be.xlf:wizard.title',
                'ot_heroimage',
                'ot-heroimage',
            ],
            'html',
            'after'
        );

        /*************
         * Assign Icon
         *************/
        $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['ot_heroimage'] = 'ot-heroimage';

        /************************
         * Configure element type
         ************************/
        $GLOBALS['TCA']['tt_content']['types']['ot_heroimage'] = array_replace_recursive(
            $GLOBALS['TCA']['tt_content']['types']['ot_heroimage'],
            [
                'previewRenderer' => TextmediaPreviewRenderer::class,
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
