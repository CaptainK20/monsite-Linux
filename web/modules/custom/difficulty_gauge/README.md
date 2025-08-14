# Difficulty Gauge

**Difficulty Gauge** is a Drupal field formatter that displays a taxonomy reference field as a visual difficulty indicator using round dots or horizontal bars.

## Features

- Works with taxonomy terms (e.g., Beginner, Intermediate, Advanced)
- Automatically uses the term's weight to define its level
- Configurable number of levels
- Two symbol styles: dots or bars
- Fully themeable via CSS
- Tooltip shows the difficulty label

## Installation

Place the `difficulty_gauge` folder in your `/modules/custom/` directory, then enable the module from the Drupal admin interface.

## Usage

1. Create a taxonomy vocabulary for difficulty (e.g., "Difficulty Level").
2. Create a reference field in your content type that links to this vocabulary.
3. Go to **Manage display** for that field.
4. Choose the formatter: `Difficulty Gauge`.
5. Configure number of levels and symbol type.

## Customization

Edit the CSS file at:

You can customize the gauge color, size, spacing, and animation.

## License

GPL-2.0-or-later