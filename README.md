# OT Hero Image — TYPO3 Extension

Full-width hero image content element for TYPO3 v13, optimised for Core Web Vitals.

[![TYPO3](https://img.shields.io/badge/TYPO3-13.4-orange.svg)](https://typo3.org/)
[![Packagist Version](https://img.shields.io/packagist/v/oliverthiele/ot-heroimage.svg)](https://packagist.org/packages/oliverthiele/ot-heroimage)
[![PHP](https://img.shields.io/packagist/dependency-v/oliverthiele/ot-heroimage/php.svg)](https://php.net/)
[![License](https://img.shields.io/packagist/l/oliverthiele/ot-heroimage.svg)](LICENSE)
[![Changelog](https://img.shields.io/badge/Changelog-CHANGELOG.md-blue.svg)](CHANGELOG.md)

---

## Features

- **CLS optimisation** — `width`/`height` attributes prevent layout shifts during image load
- **LCP optimisation** — `fetchpriority="high"` and `loading="eager"` for above-the-fold images
- **Separate mobile and desktop images** — different crop variants and srcset breakpoints per device class
- **Responsive srcset** — breakpoints filtered by original image size (no upscaling)
- **SVG support** — SVGs are output as-is without srcset
- **Text overlay** — optional heading/button overlay via `ot-ceheader` and `ot-irrebuttons`
- **SiteKit integration** — dynamic template paths, `isLoaded` conditions

---

## Requirements

| Requirement | Version |
|---|---|
| TYPO3 | 13.4+ |
| PHP | 8.2+ |

---

## Installation

```bash
composer require oliverthiele/ot-heroimage
```

Then run the TYPO3 setup:

```bash
vendor/bin/typo3 extension:setup -e ot_heroimage
# or via DDEV:
ddev typo3 extension:setup -e ot_heroimage
```

---

## Configuration

### 1. Include SiteSet

Include the SiteSet in your site configuration (`config/sites/yoursite/config.yaml`):

```yaml
dependencies:
  - oliverthiele/ot-heroimage
```

### 2. Image dimensions (Extension Manager)

Configure dimensions in **Admin Tools > Settings > Extension Configuration > ot_heroimage**:

| Setting | Default | Description |
|---|---|---|
| `mobileWidth` | `768` | Maximum width for mobile images |
| `mobileHeight` | `576` | Height for mobile images (CLS) |
| `desktopWidth` | `2560` | Maximum width for desktop images |
| `desktopHeight` | `450` | Height for desktop images (CLS) |

These values serve two purposes: the `width`/`height` HTML attributes (CLS prevention) and the maximum processing dimensions (no upscaling beyond original size).

### 3. Crop variants

The extension requires two crop variants in your TCA (typically configured in your site package):

| Variant | Used for | Suggested aspect ratio |
|---|---|---|
| `heroMobile` | Mobile images (< 768px) | 4:3 (matches 768×576 default) |
| `heroDesktop` | Desktop images (≥ 768px) | ~5.7:1 (matches 2560×450 default) |

---

## Image fields

### Desktop image (`assets`) — required

Shown on screens ≥ 768px. Crop variant: `heroDesktop`.
Srcset breakpoints: 1280w, 1920w, 2560w.

### Mobile image (`image`) — optional

Shown on screens < 768px. Crop variant: `heroMobile`.
Srcset breakpoints: 480w, 768w.

If no mobile image is provided, the desktop image is used across all breakpoints (srcset: 480w, 768w, 1280w, 1920w, 2560w).

---

## Usage

1. Create a content element of type **Hero Image**
2. Upload a desktop image (`assets`) — required
3. Optionally upload a mobile image (`image`) for optimised mobile display
4. Configure crop areas for `heroMobile` and `heroDesktop`
5. Set alt text for accessibility
6. Choose layout option for optional padding

---

## License

GPL-2.0-or-later — see [LICENSE](LICENSE)

## Author

Oliver Thiele — [oliver-thiele.de](https://www.oliver-thiele.de)