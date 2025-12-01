<?php

declare(strict_types=1);

/**
 * Copyright notice
 *
 * (c) 2025 Oliver Thiele <mail@oliver-thiele.de>, Web Development Oliver Thiele
 * All rights reserved
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * This copyright notice MUST APPEAR in all copies of the script!
 */

namespace OliverThiele\OtHeroimage\DataProcessing;

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * DataProcessor to provide hero image configuration from ext_conf_template.txt
 *
 * Example TypoScript configuration:
 *
 * 1764280745 = OliverThiele\OtHeroimage\DataProcessing\HeroImageConfigurationProcessor
 * 1764280745 {
 *   as = heroImageSettings
 * }
 */
class HeroImageConfigurationProcessor implements DataProcessorInterface
{
    /**
     * Process data to add hero image configuration settings
     *
     * @param ContentObjectRenderer $cObj The data of the content element or page
     * @param array<int|string, mixed> $contentObjectConfiguration The configuration of Content Object
     * @param array<int|string, mixed> $processorConfiguration The configuration of this processor
     * @param array<int|string, mixed> $processedData Key/value store of processed data
     *                                                 (e.g. to be passed to a Fluid View)
     * @return array<int|string, mixed> the processed data as key/value store
     */
    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData,
    ): array {
        $targetVariableName = $cObj->stdWrapValue('as', $processorConfiguration, 'heroImageSettings');

        try {
            $extensionSettings = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('ot_heroimage');

            $processedData[$targetVariableName] = [
                'mobile' => [
                    'width' => (int)($extensionSettings['mobileWidth'] ?? 768),
                    'height' => (int)($extensionSettings['mobileHeight'] ?? 576),
                ],
                'desktop' => [
                    'width' => (int)($extensionSettings['desktopWidth'] ?? 2560),
                    'height' => (int)($extensionSettings['desktopHeight'] ?? 450),
                ],
            ];
        } catch (\Exception $e) {
            // Fallback to default values if extension configuration cannot be read
            $processedData[$targetVariableName] = [
                'mobile' => [
                    'width' => 768,
                    'height' => 576,
                ],
                'desktop' => [
                    'width' => 2560,
                    'height' => 450,
                ],
            ];
        }

        return $processedData;
    }
}
