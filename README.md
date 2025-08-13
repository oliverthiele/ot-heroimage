
# EXT:ot_heroimage

## TYPO3 Extension for large hero images

This content element can output larger image widths than normal elements and
is therefore suitable for outputting images across the entire screen width.


## Requirements

* TYPO3 v13.4 LTS

## Installation

`composer require oliverthiele/ot-heroimage`

### Add TypoScript

TypoScript > Edit TypoScript Record > Edit the whole TypoScript record > Advanced Options > Include TypoScript sets

or import the TypoScript in your site package:

_constants.typoscript_
```typo3_typoscript
@import 'EXT:ot_heroimage/Configuration/TypoScript/setup.typoscript'
```
_setup.typoscript_
```typo3_typoscript
@import 'EXT:ot_heroimage/Configuration/TypoScript/setup.typoscript'
```

## Changes in v3.1.0

- Site sets are now supported.

- The old constant for the template root directory is changed,
  if you use the site sets.
  The new constant is `{$sitekit.frameworks.frontend.directory}`

## Changes in v3.0.0

- Headings are no longer included in the output.

- Optionally, an additional image can be added for a smartphone. This is hidden at the breakpoint medium device.

- Bitmap images are generated in different sizes using srcset.

- If SVGs are used, no srcset is automatically output in the img tag.

- A new field layout (DB: `ot_layout`) is used to enable padding.
  Texts in images can be aligned flush with the content. The TYPO3 field layout already has layout 1-3 defined,
  so I did not use the TYPO3 field `layout`

