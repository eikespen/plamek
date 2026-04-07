# Plamek WordPress Theme

Custom WordPress theme for Plamek AS, converted from the React/Databutton site at plamek.no.

All page content is editable from the WordPress admin via **native meta boxes** — no plugins required.

## Stack
- **WordPress theme**: PHP (`functions.php`, `*.php` templates, `inc/meta-boxes.php`)
- **Styling**: Tailwind CSS via the Play CDN (browser build) + small `assets/css/main.css` override layer
- **Local dev**: Docker (WordPress on `localhost:8080`, phpMyAdmin on `localhost:8081`)
- **Deploy**: SFTP to host via GitHub Actions on push to `main`

## Local development

```bash
docker compose up -d    # http://localhost:8080
docker compose down     # stop
docker compose down -v  # wipe DB + uploads, start fresh
```

The theme folder is mounted live — file edits are visible immediately, no restart needed.

### First-time WordPress setup

1. Open http://localhost:8080 and run the WordPress installer
2. Go to **Appearance → Themes** and activate **Plamek**
3. Go to **Settings → Permalinks** and click **Save** (flushes rewrite rules so the news/reference post types work)
4. Create the following pages and assign their templates (Page Attributes → Template):
   - **Forsiden** — slug `home` (set as front page in **Settings → Reading**)
   - **Tjenester** — slug `tjenester`
   - **Montering** — slug `montering`
   - **Vedlikehold** — slug `vedlikehold`
   - **Dukskift og isolering** — slug `dukskift-isolering`
   - **Flytting av hall** — slug `flytting-av-hall`
   - **Reparering av skader** — slug `reparering-av-skader`
   - **Referanser** — slug `referanser`
   - **Nyheter** — slug `nyheter`
   - **Om Plamek** — slug `om-plamek`
   - **Kontakt** — slug `kontakt`

Each page will then expose a custom meta box with all its editable content fields.

## Editing content

Open any page in **Pages → Edit**. The Gutenberg block editor is disabled — you'll see a clean title field followed by the relevant meta box for that page (Hero, sections, CTA, etc.). Sensible defaults match the original React site, so empty fields fall back gracefully.

Site-wide settings (logo, phone, email, address) live under **Settings → Plamek**.

## Deploy

Pushes to `main` deploy via `.github/workflows/deploy.yml`. Required GitHub Secrets:

- `FTP_SERVER`
- `FTP_USERNAME`
- `FTP_PASSWORD`
- `FTP_THEME_PATH` (e.g. `/wp-content/themes/plamek/`)

`docker-compose.yml`, `README.md`, `.github/` and git files are excluded from deploy.

## Production note on Tailwind

This theme loads Tailwind via the Play CDN (`cdn.tailwindcss.com`) for a frictionless first deploy. For production you should compile Tailwind to a static `assets/css/tailwind.css` file and swap the CDN script in `header.php` for a `wp_enqueue_style` of the compiled file.
