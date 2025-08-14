# CLAUDE.md

This file provides comprehensive guidance to Claude Code when working with Zola static site generated websites.

## Core Development Philosophy

### KISS (Keep It Simple, Stupid)

Simplicity should be a key goal in design. Choose straightforward solutions over complex ones whenever possible. Simple solutions are easier to understand, maintain, and debug.

### YAGNI (You Aren't Gonna Need It)

Avoid building functionality on speculation. Implement features only when they are needed, not when you anticipate they might be useful in the future.

### Design Principles

* **Islands Architecture**: Ship minimal JavaScript, hydrate only what needs interactivity.
* **Performance by Default**: Static-first with selective hydration for optimal performance.
* **Framework Agnostic**: Do not expect a certain framework to be used; support multiple frameworks if any.
* **Content-Driven**: Optimized for content-heavy websites with type-safe content management.
* **Zero JavaScript by Default**: Only ship JavaScript when explicitly needed.

## 🤖 AI Assistant Guidelines

### Search Command Requirements

**CRITICAL**: Always use `rg` (ripgrep) instead of `grep` or `find`:

```bash
# ❌ Don't use grep
grep -r "pattern" .

# ✅ Use rg instead
rg "pattern"

# ❌ Don't use find with name
find . -name "*.ts"

# ✅ Use rg with file filtering
rg --files | rg "\\.ts$"
# or
rg --files -g "*.ts"
```

**Enforcement Rules:**

```text
(
    r"^grep\\b(?!.*\\|)",
    "Use 'rg' (ripgrep) instead of 'grep' for better performance and features",
),
(
    r"^find\\s+\\S+\\s+-name\\b",
    "Use 'rg --files | rg pattern' or 'rg --files -g pattern' instead of 'find -name' for better performance",
),
```

## 🏗️ Project Structure

```text
src/
├── content/                   # Zola Content (Markdown + Assets)
│   ├── _index.md              # Homepage (English only)
│   └── pages/                 # Static pages
│       └── sub/               # UI Component Library
├── templates/                 # Zola HTML Templates
│   ├── base.html              # Base template with navigation
│   ├── taxonomy_list.html     # Taxonomy list page
│   ├── taxonomy_single.html   # Taxonomy detail page
│   └── [more-templates]
├── static/                    # Static assets (images, CSS, JS)
│   ├── lib/                   # External libraries
│   │   └── bulma.min.css      # Locally hosted Bulma CSS
│   ├── styles.css             # Custom c-base styling
│   └── [more-assets]
├── scripts/                   # Build & validation scripts
│   ├── check-translations.sh  # Check translation state
│   ├── check-frontmatter.sh   # Frontmatter validation
│   ├── check-taxonomies.sh    # Taxonomy validation
│   ├── check-images.sh        # Image validation
│   ├── check-links.sh         # Link validation
│   ├── check-structure.sh     # Structure validation
│   └── zola-build.sh          # Build wrapper with performance monitoring
├── docs/                      # Project documentation
│   ├── ai_docs/               # AI-specific docs for context
│   │   └── [docs]
│   └── specs/                 # Product requirements (PRDs)
│       └── [specs]
├── docker/                    # Docker deployment configuration
│   ├── Dockerfile             # Multi-stage build for production
│   ├── docker-compose.yml     # Container orchestration
│   └── nginx.conf             # Nginx configuration
├── config.toml                # Zola main config (multi-language)
├── Makefile                   # Development targets
├── README.md                  # Short project documentation
└── CLAUDE.md                  # Detailed instructions for Claude Code
```

## Content Management

### Sections

[Zola Section Documentation](https://www.getzola.org/documentation/content/section/)

* Each directory in `content/` can be a section.
* `_index.md` defines section metadata (title, description, taxonomies).
* Use `weight` in frontmatter to order items.
* Use `paginate_by` in `_index.md` to enable pagination per section.

### Translations

[Zola Multilingual Documentation](https://www.getzola.org/documentation/content/multilingual/)

* Confirm with the user before adding multi-language support.
* Store translations in separate language directories (e.g., `content/en/`, `content/de/`).
* Ensure all templates check for `lang` in context.

## Feeds

[Zola Feed Documentation](https://www.getzola.org/documentation/templates/feeds/)

* Provide RSS/Atom feeds when requested.
* Use `generate_feed = true` in `config.toml` or `_index.md`.
* Validate feed output with online validators before deployment.

## Pagination

[Zola Pagination Documentation](https://www.getzola.org/documentation/templates/pagination/)

**Rules:**

* No pagination if only one page.
* First page: no link to previous.
* Last page: no link to next.
* All pages visible in navigation, current page highlighted.

## Deployment

### GitHub Pages

[Zola GitHub Pages Deployment Guide](https://www.getzola.org/documentation/deployment/github-pages/)

**Checklist:**

* Use GitHub Actions or manual deployment.
* Ensure `base_url` in `config.toml` matches GitHub Pages URL.
* For project pages (not user/organization pages), set `base_url` to `/repo-name/`.

## 🔗 JavaScript Features

### Automatic External Link Handling

```javascript
document.querySelectorAll('a[href^="http"]').forEach(link => {
    if (!link.href.includes(window.location.hostname)) {
        link.target = '_blank';
        link.rel = 'noopener noreferrer';
    }
});
```

**Security**: Uses `rel="noopener noreferrer"` to prevent `window.opener` exploits.

**Usage**: Write normal Markdown links; detection is automatic.

## ⚠️ CRITICAL GUIDELINES

1. **Max 500 lines per file** – split large templates/content files.
2. **Address all build warnings** – never ignore them.
3. **No npm or yarn** – include all dependencies in `static/lib/`.

## 📋 Pre-commit Checklist

* [ ] SEO metadata is correctly set in frontmatter.
* [ ] No unused images or CSS.
* [ ] All internal links verified by `check-links.sh`.
* [ ] Translations up to date (if enabled).
* [ ] No template exceeds 500 lines.

*This guide is optimized for Zola and modern web performance.*
*Last updated: August 2025*
