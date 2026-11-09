# CheckOff Elementor Child

Child theme of [Hello Elementor](https://wordpress.org/themes/hello-elementor/) for sites built around the [CheckOff](https://github.com/ennono/checkoff) plugin.

- Keeps Hello Elementor's button styles (upper case, letter spacing) off the checklists. Colours and fonts come from CheckOff itself — see [Colours and fonts](#colours-and-fonts-where-checkoff-gets-them) below.
- Page template **CheckOff checklist** (`page-templates/checkoff-app.php`): shows the page's own content and adds `[cko_app]` below it unless the content already places a CheckOff shortcode. A single checklist (`?cko=…`) is shown without the page title and intro.
- `<meta name="referrer" content="same-origin">` on pages opened with a checklist ID, so the ID in the address is not passed on to other sites.
- Admin notice while the CheckOff plugin is not active.
- Translatable (text domain `checkoff-elementor-child`), German included.

## Colours and fonts: where CheckOff gets them

Since CheckOff 3.5.0 the plugin sets them itself, under **CheckOff →
Settings → Design**. With Elementor active it takes them from **Elementor's
global styles** (Elementor → Site Settings → Global Colors / Global Fonts) and
says so on that settings tab:

| In CheckOff | Comes from Elementor | Without a value in the kit |
|---|---|---|
| Accent: buttons, progress bars, chosen answers | Global colour **Primary** | CheckOff → Settings → Design, else blue |
| Done: ticks, reached targets, values in range | Global colour **Accent** | the same, else green |
| Text of the checklists | Global font **Text** | the Design tab's font |
| Headings | Global font **Primary** | the Design tab's font |

Corners, the size of buttons and fields and the warning colour have no
counterpart in Elementor and always come from the Design tab.

This theme sets none of these any more (up to 1.0.1 it did, with a stronger
selector, which would now override the plugin's settings). Its former look
was accent `#2271b1`, done `#2e9e4f` and corners of 10 px; enter those on the
Design tab to keep it on a site without Elementor colours.

## Setup

1. Install Hello Elementor and this theme, activate this theme.
2. Create a page, choose the template **CheckOff checklist**.
3. Select that page under CheckOff → Settings → General → Checklist page.
