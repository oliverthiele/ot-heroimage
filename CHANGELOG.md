# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

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