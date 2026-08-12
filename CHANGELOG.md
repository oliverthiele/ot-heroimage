# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

---

## [6.1.0] — 2026-08-12

### Added

- Bundled fallback partial `Header/All`, so the content element renders in
  projects without `ot_ceheader` and without `ot_sitekitbase`. It uses core
  `tt_content` fields only and is registered with the lowest
  `partialRootPaths` index, so both extensions still take precedence

### Fixed

- `tt_content.ot_heroimage` referenced `lib.sitekitContentElement`
  unconditionally, which is only defined by `ot_sitekitbase`. Without that
  extension the content element rendered no output at all. The base definition
  now falls back to `lib.contentElement`
- The site set did not import the extension constants, leaving
  `{$projectSettings.framework.directory}` unresolved in projects without
  `ot_sitekitbase` and pointing every resource path into the void

---

## [6.0.0] — 2026-07-31

### Changed

- **Breaking:** Drop TYPO3 v13 support, require TYPO3 `^14.3`
- **Breaking:** Raise the PHP minimum to `>=8.4`
- **Breaking:** Require `oliverthiele/ot-irrebuttons ^5.0`
- Migrate the language files from XLIFF 1.2 to XLIFF 2.0. Unit identifiers and
  all translations are unchanged, so no label reference needs adjusting
- Reference labels via translation domain mapping instead of full file paths:
  `ot_heroimage.be:` replaces
  `LLL:EXT:ot_heroimage/Resources/Private/Language/locallang_be.xlf:`, and the
  two core references now use `frontend.ttc:`

### Fixed

- The `original` attribute of both site set label files pointed at
  `Configuration/Sets/OtHeroimage/labels.xlf`, a path that does not exist —
  the directory is `Configuration/Sets/HeroImage/`. TYPO3 uses this attribute
  to resolve the translation fallback chain

---

## [5.0.2] — 2026-05-22

### Fixed

- Remove obsolete `addPlugin()` arguments (`'CType'`, `'ot_heroimage'`) that were misinterpreted as `$flexForm` parameter in TYPO3 v14, causing "Data structure identifier must be set" error when opening the content element in the backend

---

## [5.0.1] — 2026-04-25

### Changed

- Raise `ot-irrebuttons` constraint to `^4.0`

---

## [5.0.0] — 2026-04-25

### Added

- TYPO3 v14.3 support (`^13.4||^14.3`)
- `oliverthiele/ot-irrebuttons ^3.2.9` as required dependency

### Changed

- Raise PHP minimum constraint to `>=8.3`
- Replace `DatabaseQueryProcessor` with `ot-irrebuttons-processor` in TypoScript

---

## [4.1.4] — 2026-03-14

### Fixed

- CSS: `.ot-heroimage-text-overlay-desktop` was hidden via a selector nested inside `.text-overlay-container`, which never matched the actual `.image-container` location — desktop image was visible on mobile. Moved `display: none` to root level for correct mobile-first cascade.

---

## [4.1.3]

### Fixed

- Prevent empty overlay containers in hero image template

---

## [4.1.2]

### Added

- SiteKit configuration for CE Heroimage element

---

## [4.1.1]

### Added

- SiteKit configuration for CE Heroimage element (initial)

---

## [4.1.0]

### Added

- Support for formatted headings via `ot-ceheader` extension as text overlay
- Support for icon buttons via `ot-irrebuttons` extension
- SiteKit integration: dynamic template path updated automatically when SiteKit is installed
- `isLoaded` condition: TypoScript includes are only active when the respective extension is installed

---

## [4.0.0]

### Changed (Breaking)

- Crop variant names changed: now uses `heroMobile` and `heroDesktop` (old names no longer supported)
- Image dimensions moved from TypoScript to Extension Manager configuration

### Added

- Extension Configuration for mobile/desktop width and height (used for CLS optimization and image processing)
- `HeroImageConfigurationProcessor` DataProcessor to read Extension Configuration
- Device-specific srcset breakpoints: mobile (480w, 768w with `heroMobile` crop), desktop (1280w, 1920w, 2560w with `heroDesktop` crop)
- CLS optimization via `width`/`height` attributes from Extension Configuration
- LCP optimization via `fetchpriority="high"` and `loading="eager"`
- Breakpoint filtering: srcset entries only generated when original image ≥ breakpoint (no upscaling)

### Migration

1. Configure image dimensions in Extension Manager (Admin Tools > Settings > Extension Configuration > ot_heroimage)
2. Open each hero image content element and re-save to re-assign crop variants
3. Reconfigure crop areas for `heroMobile` and `heroDesktop`

---

## [3.1.0]

### Added

- TYPO3 SiteSet support
- New constant `{$sitekit.frameworks.frontend.directory}` replaces old template root constant

---

## [3.0.0]

### Changed

- Headings are no longer included in the image output (separate content elements)
- Bitmap images use `srcset` for responsive loading
- SVG images output without `srcset`
- New `ot_layout` field for optional container padding (avoids conflict with TYPO3's built-in `layout` field)

### Added

- Optional separate mobile image (hidden at `md` breakpoint and above)