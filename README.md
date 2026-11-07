# CheckOff Elementor Child

Child theme of [Hello Elementor](https://wordpress.org/themes/hello-elementor/) for sites built around the [CheckOff](https://github.com/ennono/checkoff) plugin.

- Sets CheckOff's colours and fonts from the Elementor kit's global styles — see [Colours and fonts](#colours-and-fonts-where-checkoff-gets-them) below.
- Page template **CheckOff checklist** (`page-templates/checkoff-app.php`): shows the page's own content and adds `[cko_app]` below it unless the content already places a CheckOff shortcode. A single checklist (`?cko=…`) is shown without the page title and intro.
- `<meta name="referrer" content="same-origin">` on pages opened with a checklist ID, so the ID in the address is not passed on to other sites.
- Admin notice while the CheckOff plugin is not active.
- Translatable (text domain `checkoff-elementor-child`), German included.

## Colours and fonts: where CheckOff gets them

CheckOff draws its checklists with its own design. This theme only tells it
which colours and fonts to use — and it takes them from **Elementor's global
styles** (Elementor → Site Settings → Global Colors / Global Fonts):

| In CheckOff | Comes from Elementor | Without Elementor |
|---|---|---|
| Accent: buttons, progress bars, chosen answers, the switch | Global colour **Primary** | `#2271b1` (blue) |
| Done: ticks, reached targets, values in range | Global colour **Accent** | `#2e9e4f` (green) |
| Text of the checklists | Global font **Text** | the theme's font |
| Headings | Global font **Primary** | the theme's font |

What that means in practice:

- **Change a colour in Site Settings, and the checklists follow** on every
  page, right away. Nothing is stored; the theme reads Elementor's values on
  every page view. The order of installation does not matter.
- **Elementor brings default colours.** Right after installing Elementor, its
  default Primary (a light blue) and Accent (a green) apply until you set your
  own.
- **Without the Elementor plugin** (Hello Elementor runs without it) the
  colours in the last column apply.
- **Red and orange always come from CheckOff** — overdue, deleting, due soon,
  outside a target range — so warnings stay recognisable whatever the kit's
  colours are.
- **Without this theme** CheckOff uses its own colours (`#2563eb` blue,
  `#16a34a` green) and the active theme's fonts. It works fully either way.

To set other colours without Elementor, put them in Appearance → Customize →
Additional CSS:

```css
body.cko-theme .cko-app,
body.cko-theme .cko-menu,
body.cko-theme .cko-dialog {
	--cko-accent: #7c3aed; /* buttons, progress */
	--cko-done: #059669;   /* ticks */
}
```

(Without this theme, leave out `body.cko-theme`.) The mapping itself is at the
top of `style.css`.

## Setup

1. Install Hello Elementor and this theme, activate this theme.
2. Create a page, choose the template **CheckOff checklist**.
3. Select that page under CheckOff → Settings → General → Checklist page.
