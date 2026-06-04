# DanaKarya (Koperasi App)

Laravel 12 + Breeze (Blade/Alpine) + Spatie Laravel Permission v6.  
Frontend-heavy prototype — most routes are Closure-based returning static views with mock data.

## Commands

```bash
composer run dev          # concurrently: artisan serve + queue:listen + pail + npm run dev
composer run setup        # full project bootstrap (composer install, .env, key:generate, migrate, npm, build)
composer run test         # config:clear && artisan test (Pest)
npm run build             # Vite prod build
vendor/bin/pint           # Laravel Pint (PHP CS fixer)
vendor/bin/pest           # Pest runner (direct)
php artisan test --filter=ExampleTest  # single test
```

## Architecture

- **4 roles:** `admin`, `anggota`, `pengurus`, `pengawas` — each with route prefix and view namespace
- **Role routes NOT yet auth-protected** (no `auth` middleware on role groups — only `/dashboard` and `/profile` use it)
- **`RoleRedirect` middleware is a stub** (`app/Http/Middleware/RoleRedirect.php` — returns `$next($request)` with no logic)
- **Queue/Cache/Session all use `database` driver** — run `php artisan queue:work` after schema:dump
- **Testing:** Pest PHP (Feature tests use `RefreshDatabase`), in-memory SQLite (`phpunit.xml`)
- **Entrypoints:** `public/index.php` (web), `artisan` (CLI)
- **No CI/CD, no Docker, no deployment config** in repo

## Conventions

- All routes in `routes/web.php` — role groups use `Route::prefix(...)->as(...)` with inline closures
- No controllers yet for role-specific routes (all `fn() => view(...)` or simple redirect helpers)
- Alpine.js `x-data`, `x-show`, `x-transition` used in dashboards
- `.env` still has `APP_NAME=Laravel` — views use `DanaKarya` branding
- Build artifacts in `public/build/` (gitignored) — always run `npm run build` after CSS/JS changes
- Spatie permissions tables migrated, `User` model has `HasRoles` trait

## Testing quirks

- `composer run test` runs `config:clear` first
- Feature tests: `Pest.php` applies `RefreshDatabase` to the Feature suite
- Always `npm run build` before running feature tests if views use Vite assets (Vite manifest errors otherwise)
