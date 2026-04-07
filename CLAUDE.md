# Plamek — Claude Code Instructions

## Stack
- **WordPress theme**: PHP (`functions.php`, `*.php` templates, `inc/meta-boxes.php`)
- **Local dev**: Docker (WordPress on localhost:8080, phpMyAdmin on localhost:8081)
- **Deploy**: SFTP to host via GitHub Actions on push to `main`

## Branching & Deploy Policy
- `main` = production → auto-deploys via SFTP on push

## Local Development
```bash
docker compose up -d    # start WordPress at http://localhost:8080
docker compose down     # stop
docker compose down -v  # wipe everything (DB + uploads) and start fresh
```
- Theme folder is mounted live — edits are instantly reflected without restart

## Content model
- All editable page content lives in `inc/meta-boxes.php` using native WP `add_meta_box` + `update_post_meta`
- Templates read with `get_post_meta($pid, 'pl_*', true)` and fall back to defaults
- Site-wide options (logo, phone, email, address) live under **Settings → Plamek** (`inc/options.php`)
- Gutenberg is disabled for pages — clean title → meta box layout
