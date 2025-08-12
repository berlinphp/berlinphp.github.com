# CLAUDE.md

This file provides comprehensive guidance to Claude Code when working with Zola static site generated websites.

## Core Development Philosophy

### KISS (Keep It Simple, Stupid)

Simplicity should be a key goal in design. Choose straightforward solutions over complex ones whenever possible. Simple solutions are easier to understand, maintain, and debug.

### YAGNI (You Aren't Gonna Need It)

Avoid building functionality on speculation. Implement features only when they are needed, not when you anticipate they might be useful in the future.

### Design Principles

- **Islands Architecture**: Ship minimal JavaScript, hydrate only what needs interactivity
- **Performance by Default**: Static-first with selective hydration for optimal performance
- **Framework Agnostic**: Do not expect a certain Framework to be used; support multiple frameworks if any
- **Content-Driven**: Optimized for content-heavy websites with type-safe content management
- **Zero JavaScript by Default**: Only ship JavaScript when explicitly needed

## 🤖 AI Assistant Guidelines

### Search Command Requirements

**CRITICAL**: Always use `rg` (ripgrep) instead of traditional `grep` and `find` commands:

```bash
# ❌ Don't use grep
grep -r "pattern" .

# ✅ Use rg instead
rg "pattern"

# ❌ Don't use find with name
find . -name "*.ts"

# ✅ Use rg with file filtering
rg --files | rg "\.ts$"
# or
rg --files -g "*.ts"
```

**Enforcement Rules:**

```
(
    r"^grep\b(?!.*\|)",
    "Use 'rg' (ripgrep) instead of 'grep' for better performance and features",
),
(
    r"^find\s+\S+\s+-name\b",
    "Use 'rg --files | rg pattern' or 'rg --files -g pattern' instead of 'find -name' for better performance",
),
```

## 🏗️ Project Structure

```
src/
├── content/                   # Zola Content (Markdown + Assets)
│   ├── _index.md              # Mainpage (default language)
│   ├── _index.de.md           # Mainpage Deutsche Version  
│   ├── _index.en.md           # Mainpage Englische Version
│   └── pages/                 # Static pages
│       └── sub/               # UI Component Library
├── templates/                 # Zola HTML Templates
│   ├── base.html              # Basis-Template with Navigation
│   ├── taxonomy_list.html     # Taxonomie-Browse-Page
│   ├── taxonomy_single.html   # Taxonomie-Single-Page
│   └── [weitere-templates]
├── static/                   # Statische Assets (Bilder, CSS, JS)
│   ├── lib/                  # Externe Bibliotheken
│   │   └── bulma.min.css     # Lokal gehostetes Bulma CSS
│   ├── styles.css            # Custom c-base Styling
│   └── [more-assets]
├── scripts/                  # Build- und Validierungsskripte
│   ├── check-translations.sh # Translation-State check
│   ├── check-frontmatter.sh  # Frontmatter-Validation
│   ├── check-taxonomies.sh   # Taxonomie-Check
│   ├── check-images.sh       # Image-Validation  
│   ├── check-links.sh        # Link-Validation
│   ├── check-structure.sh    # Structure-Validation
│   └── zola-build.sh         # Build-Wrapper mit Performance-Monitoring
├── docs/                     # Projektdokumentation
│   ├── ai_docs/              # KI-Docs for building context
│   │   └── [docs]
│   └── specs/                # Produktanforderungen (PRDs)
│       └── [specs]
├── docker/                   # Docker Deployment Configuration  
│   ├── Dockerfile            # Multi-stage Build for production
│   ├── docker-compose.yml    # Container Orchestration
│   └── nginx.conf            # Nginx-Configuration
├── config.toml               # Zola Mainkonfiguration (multi-language support)
├── Makefile                  # Development-Targets
├── README.md                 # Short Projekt Documentation
└── CLAUDE.md                 # Long Projekt Documentation for Claude Code
```

## Features and Requirements

### Sections
https://www.getzola.org/documentation/content/section/

### Translations
https://www.getzola.org/documentation/content/multilingual/

### Pagination
- If there is only one page, there should be no pagination.
- If it is the first page, there should be no link to the previous page.
- If it is the last page, there should be no link to the next page.
- If there are multiple pages, the first page should have a link to the next page, and the last page should have a link to the previous page.
- All pages should be visible in the pagination, with the current page highlighted.

## ⚠️ CRITICAL GUIDELINES (MUST FOLLOW ALL)

1. **MAXIMUM 500 lines per file** - Split large pages into smaller components

## 📋 Pre-commit Checklist (MUST COMPLETE ALL)

- [ ] SEO metadata properly configured

### FORBIDDEN Practices

- **NEVER use npm or yarn** - MUST include all dependencies in `static/lib/`
- **NEVER ignore build warnings** - address all build issues

---

_This guide is optimized for Zola and modern web performance._
_Last updated: August 2025_
