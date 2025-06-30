# Custom Meta Plugin For WordPress

A lightweight WordPress plugin by **Dumidu Neeshan** that makes it easy to manage and override meta details and custom HTML snippets on a global or per-post/page basis.

---

## Introduction

Search engines rely on well-structured meta tags to understand and index your content effectively. While many themes and SEO plugins allow basic meta management, **Custom Meta Plugin** empowers you to:

- Define **global** keywords, description and footer HTML that apply site-wide.
- Override those settings on individual posts and pages via a simple meta box.
- Seamlessly inject custom `<meta>` tags into the `<head>` and arbitrary HTML into the footer.

Whether you’re building a brochure site, blog or online portfolio, this plugin ensures you retain full control over your page-specific SEO metadata and site-wide footer snippets — all from a clean, intuitive admin interface.

---

## Key Features

1. **Global Settings**  
   - **Keywords**: Set site-wide default `<meta name="keywords">`.  
   - **Description**: Configure the default `<meta name="description">`.  
   - **Footer HTML**: Add any global HTML snippet to be output before `</body>`.

2. **Per-Post/Page Overrides**  
   - Adds a “Custom Meta Details” meta box on posts and pages.  
   - Override global keywords, description and footer HTML on a per-item basis.

3. **Automatic Output**  
   - Injects `<meta>` tags into the document `<head>` on all singular views.  
   - Echoes custom footer HTML in the `wp_footer` hook.

4. **Simple Admin UI**  
   - Clean settings page under **Settings → Custom Meta Plugin**.  
   - Standard WordPress Settings API fields for easy configuration.

5. **Lightweight & Compatible**  
   - No external dependencies.  
   - Compatible with any theme and other SEO plugins.

---

## Installation

1. Upload the `custom-meta-plugin.php` file to your `/wp-content/plugins/` directory.  
2. Activate the plugin via **Plugins → Installed Plugins** in your WordPress admin.  
3. Go to **Settings → Custom Meta Plugin** to configure your global defaults.  
4. Edit any post or page to see and fill the “Custom Meta Details” meta box.

---

## Usage

1. **Global Defaults**  
   - Navigate to **Settings → Custom Meta Plugin**.  
   - Enter your site-wide keywords, description and any footer HTML snippet.  
   - Click **Save Changes**.

2. **Item-Specific Overrides**  
   - Open a post or page in the editor.  
   - Scroll to the **Custom Meta Details** box.  
   - Enter override values or leave blank to fall back to your global settings.  
   - Update or publish as usual.

---

## Changelog

- **1.1**  
  - Fixed sanitisation on settings page.  
  - Improved meta box styling.  
- **1.0**  
  - Initial release: global and per-post/page meta management.

---

## Support & Contribution

If you encounter any issues or have feature requests, feel free to open an issue on the GitHub repository or contact me directly via the WordPress.org plugin support forum.

---

*© 2025 Dumidu Neeshan*  

