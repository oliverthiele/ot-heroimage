
# EXT:ot_heroimage

## TYPO3 Extension for optimized hero images

This content element outputs optimized full-width hero images with:
- **CLS optimization** (Cumulative Layout Shift) via width/height attributes
- **LCP optimization** (Largest Contentful Paint) via fetchpriority and loading attributes
- **Responsive images** with device-specific srcset breakpoints
- **Accessibility** with proper alt-text handling
- **Separate mobile and desktop images** for optimal performance
- **Crop variants** for different aspect ratios (heroMobile, heroDesktop)

## Requirements

* TYPO3 v13.4 LTS
* PHP 8.3+

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

## Extension Configuration

Configure the image dimensions in the Extension Manager (Admin Tools > Settings > Extension Configuration > ot_heroimage):

- **mobileWidth** (default: 768): Maximum width for mobile images
- **mobileHeight** (default: 576): Height for mobile images (used for CLS optimization)
- **desktopWidth** (default: 2560): Maximum width for desktop images
- **desktopHeight** (default: 450): Height for desktop images (used for CLS optimization)

**Important:** These values are used for two purposes:
1. **CLS prevention**: Width and height attributes in the HTML prevent layout shifts during image loading
2. **Image processing**: Maximum dimensions for image processing (no upscaling beyond original size)
3. **Crop variants**: These dimensions should match your configured crop variants (heroMobile, heroDesktop) for optimal results

## Image Fields

The extension uses two separate image fields:

### Desktop Image (required)
- Field: `assets`
- Usage: Main hero image shown on desktop devices (≥ 768px)
- Crop variant: `heroDesktop`

### Mobile Image (optional)
- Field: `image`
- Usage: Alternative image for mobile devices (< 768px)
- Crop variant: `heroMobile`
- **Why optional?** On mobile devices, screen space is limited. Often there's text or other content overlaying the hero image. A separate mobile image with different cropping or composition can provide better readability and user experience by adjusting the image to work better with overlaid text.

**Use cases for separate mobile images:**
- Different crop for better mobile composition
- Less detailed image when text overlays are present
- Optimized file size for mobile connections
- Portrait vs. landscape orientation

If no mobile image is provided, the desktop image is used across all breakpoints.

## Responsive Image Strategy

### Mobile Images (< 768px)
- Breakpoints: 480w, 768w
- Crop variant: `heroMobile`
- Hidden on desktop with Bootstrap class `d-md-none`
- Smaller file sizes for faster mobile loading

### Desktop Images (≥ 768px)
- Breakpoints: 1280w, 1920w, 2560w
- Crop variant: `heroDesktop`
- Hidden on mobile with Bootstrap class `d-none d-md-block`
- Larger dimensions for high-resolution displays

### Full-width (when no mobile image is provided)
- Breakpoints: 480w, 768w, 1280w, 1920w, 2560w
- Crop variant: `heroDesktop`
- All breakpoints for responsive behavior across all devices

**Note:** srcset entries are only generated when the original image width is equal to or larger than the breakpoint (no upscaling).

## Performance Features

### Core Web Vitals Optimization
- **CLS (Cumulative Layout Shift)**: Width and height attributes prevent layout shifts
- **LCP (Largest Contentful Paint)**: `fetchpriority="high"` and `loading="eager"` for faster loading of above-the-fold images

### Responsive Image Loading
- Different srcset for mobile and desktop reduces unnecessary data transfer
- Automatic breakpoint filtering based on original image dimensions
- Browser chooses optimal image size based on viewport width and device pixel ratio (DPR)

### SVG Support
- SVG images are output without srcset
- Automatic detection via file extension
- Responsive sizing via CSS classes

## Usage

1. Create a new content element "Hero Image"
2. Add a desktop image (field: assets) - **required**
3. Optionally add a mobile image (field: image) for optimized mobile display
4. Configure crop areas for both variants (heroMobile, heroDesktop)
5. Set alt-text for accessibility
6. Choose layout option for optional padding

## Image Crop Variants

The extension requires two crop variants to be configured in your TCA:

- **heroMobile**: Used for mobile images (< 768px) - aspect ratio should match mobileWidth/mobileHeight
- **heroDesktop**: Used for desktop images (≥ 768px) - aspect ratio should match desktopWidth/desktopHeight

Example: With default settings (mobile: 768x576, desktop: 2560x450):
- heroMobile aspect ratio: 4:3
- heroDesktop aspect ratio: ~5.7:1

## Changelog

### Changes in v4.0.0 (Breaking Changes)

**Breaking Changes:**
- Crop variants changed: Now uses `heroMobile` and `heroDesktop` (old crop variant names no longer supported)
- Image dimensions now configured via Extension Manager instead of TypoScript
- Extension Configuration required for proper CLS optimization

**New Features:**
- Add Extension Configuration for image dimensions (mobile/desktop width and height)
- Add HeroImageConfigurationProcessor DataProcessor to read Extension Configuration
- Implement device-specific srcset breakpoints:
    - Mobile (< 768px): 480w, 768w with heroMobile crop variant
    - Desktop (≥ 768px): 1280w, 1920w, 2560w with heroDesktop crop variant
- Add CLS optimization via width/height attributes from Extension Configuration
- Add LCP optimization via fetchpriority="high" and loading="eager"
- Intelligent breakpoint filtering: srcset entries only generated when original image ≥ breakpoint (no upscaling)
- Improved accessibility with enhanced alt-text handling

**Migration Guide:**
1. Configure image dimensions in Extension Manager (Admin Tools > Settings > Extension Configuration > ot_heroimage)
2. Open each hero image and check/save the crop variant once to re-assign images to new crop variants `heroMobile` and `heroDesktop`
3. Configure crop areas if needed

### Changes in v3.1.0

- Site sets are now supported.
- The old constant for the template root directory is changed,
  if you use the site sets.
  The new constant is `{$sitekit.frameworks.frontend.directory}`

### Changes in v3.0.0

- Headings are no longer included in the output.
- Optionally, an additional image can be added for a smartphone. This is hidden at the breakpoint medium device.
- Bitmap images are generated in different sizes using srcset.
- If SVGs are used, no srcset is automatically output in the img tag.
- A new field layout (DB: `ot_layout`) is used to enable padding.
  Texts in images can be aligned flush with the content. The TYPO3 field layout already has layout 1-3 defined,
  so I did not use the TYPO3 field `layout`

