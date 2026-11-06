# CheckOff Elementor Child

Child theme of [Hello Elementor](https://wordpress.org/themes/hello-elementor/) for sites built around the [CheckOff](https://github.com/ennono/checkoff) plugin.

- Sets CheckOff's colour and font custom properties from the Elementor kit's global styles (`--e-global-color-primary`, `--e-global-color-accent`, the global text and primary fonts), with the plugin's defaults as fallback.
- Page template **CheckOff checklist** (`page-templates/checkoff-app.php`): shows the page's own content and adds `[cko_app]` below it unless the content already places a CheckOff shortcode. A single checklist (`?cko=…`) is shown without the page title and intro.
- `<meta name="referrer" content="same-origin">` on pages opened with a checklist ID, so the ID in the address is not passed on to other sites.
- Admin notice while the CheckOff plugin is not active.
- Translatable (text domain `checkoff-elementor-child`), German included.

## Setup

1. Install Hello Elementor and this theme, activate this theme.
2. Create a page, choose the template **CheckOff checklist**.
3. Select that page under CheckOff → Settings → General → Checklist page.
