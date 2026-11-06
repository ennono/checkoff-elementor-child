# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

A deliberately small child theme of **Hello Elementor** (`Template: hello-elementor`) for sites built around the CheckOff plugin (`ennono/checkoff`). Text domain `checkoff-elementor-child`; prefix `cko_child_` for PHP functions and constants, `cko-child` for asset handles, `cko-theme` / `cko-page` for body classes.

## Split of responsibilities

The plugin renders and computes; the theme only decides how it looks and where it stands — the same split as MixMyMeals and its child theme.

- **Styling goes through CheckOff's custom properties** (`--cko-accent`, `--cko-done`, `--cko-radius`, …), not by overriding the plugin's rules. They are set in `style.css` under `body.cko-theme …`: the plugin's stylesheet is enqueued by its shortcodes and printed after the theme's, so the body class is what lets the theme's values win.
- Colours and fonts come from the Elementor kit's global variables (`--e-global-color-*`, `--e-global-typography-*`) with the plugin's defaults as fallback, so a site restyles checklists in Elementor's Site Settings.
- Hello Elementor does not enqueue its own `style.css`; the child depends on the handle `hello-elementor-theme-style`.

## Files

- `functions.php` — text domain, child stylesheet, body classes, referrer meta on `?cko=` pages, admin notice without the plugin.
- `page-templates/checkoff-app.php` — template "CheckOff checklist": page content plus `[cko_app]` unless the content already has a `[cko_…]` shortcode; on a single checklist the title and intro are left out. Mirrors Hello Elementor's `template-parts/single.php` markup (`main#content.site-main`, `.page-header`, `.page-content`).
- `languages/` — `checkoff-elementor-child.pot`, `de_DE.po/.mo` (child themes use `<locale>.mo` file names).

`cko_child_is_checklist_view()` reads the query parameter name from `Checkoff_Checklist::QUERY_VAR` when the plugin is loaded, so a rename there is followed.
