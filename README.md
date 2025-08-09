## Twilio SMS & WhatsApp Sender

A WordPress plugin scaffold to send SMS and WhatsApp messages using Twilio. This README explains the folder/file structure and what each piece is responsible for.

### Folder structure

```
twilio-sms-whatsapp/
  assets/
    css/
      mystyle.css
    js/
      myscript.js
  src/
    Api/
      Callbacks/
        AdminCallbacks.php
      SettingApi.php
    Base/
      Activate.php
      Deactivate.php
      Enqueue.php
      SettingsLinks.php
    Includes/
      Admin.php
    Init.php
  templates/
    admin.php
    cpt.php
    taxonomy.php
    widget.php
  vendor/ ... (Composer autoloader)
  composer.json
  twilio-sender.php
```

### What each file/folder does

- **twilio-sender.php**: Main plugin bootstrap.
  - Defines constants (`TSW_PLUGIN_DIR`, `TSW_PLUGIN_URL`, `PLUGIN`).
  - Loads Composer autoloader from `vendor/autoload.php`.
  - Registers activation/deactivation hooks via `TSW\Base\Activate` and `TSW\Base\Deactivate`.
  - Bootstraps the service container `TSW\Init::register_services()`.

- **src/Init.php**: Simple service container.
  - Lists service classes (admin UI, asset enqueue, settings link) and calls their `register()` methods on load.

- **src/Includes/Admin.php**: Admin menu/pages manager.
  - Uses `TSW\Api\SettingApi` to register an admin top‑level menu and several subpages.
  - Uses `TSW\Api\Callbacks\AdminCallbacks` to render those pages.

- **src/Api/SettingApi.php**: Helper for WordPress admin pages.
  - Collects page/subpage definitions and registers them with `add_menu_page()` / `add_submenu_page()`.
  - Provides `withSubPage()` to automatically add the first page as a subpage (Dashboard).

- **src/Api/Callbacks/AdminCallbacks.php**: View callbacks for admin pages.
  - Loads PHP templates from `templates/` to render the UI.

- **src/Base/Activate.php** and **src/Base/Deactivate.php**: Lifecycle handlers.
  - Flush WordPress rewrite rules on activation/deactivation.

- **src/Base/Enqueue.php**: Admin assets loader.
  - Hooks `admin_enqueue_scripts` to enqueue plugin CSS/JS.
  - By default, the code points to `assets/mystyle.css` and `assets/myscript.js`.

- **src/Base/SettingsLinks.php**: Adds a "Settings" link on the Plugins screen for quick access to the plugin page.

- **templates/**: PHP view files rendered in the WordPress admin.
  - `admin.php`: Main settings/dashboard layout.
  - `cpt.php`, `taxonomy.php`, `widget.php`: Placeholder views for additional admin sections.

- **assets/**: Static front-end resources used in the WordPress admin.
  - `css/mystyle.css`: Admin styles (currently empty).
  - `js/myscript.js`: Admin scripts (currently empty).

- **composer.json**: Configures PSR‑4 autoloading (`"TSW\\": "src/"`). Run Composer to build/update `vendor/`.

- **vendor/**: Composer autoloader and dependencies (generated).

### How it works (high level)

1. WordPress loads `twilio-sender.php` which pulls in Composer autoloading and defines constants.
2. On activation/deactivation, rewrite rules are flushed.
3. If `TSW\Init` exists, it registers services:
   - `Includes\Admin` defines admin menus and submenus.
   - `Base\Enqueue` enqueues admin CSS/JS.
   - `Base\SettingsLinks` adds a Settings link on the Plugins page.
4. Admin page callbacks load templates from `templates/` to render content.

### Notes for development

- To add new admin pages, extend `src/Includes/Admin.php` by appending to `$pages` or `$subpages`, or by using additional callback methods in `AdminCallbacks` and templates under `templates/`.
- Asset paths: the repo currently contains `assets/css/mystyle.css` and `assets/js/myscript.js`, while the enqueue code references `assets/mystyle.css` and `assets/myscript.js`. Update the paths in `src/Base/Enqueue.php` or move the files so they match.
- Autoloading follows PSR‑4; new classes under the `TSW` namespace should live in `src/` with matching paths.

