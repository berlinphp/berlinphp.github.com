# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is the **Berlin PHP Usergroup** website built with **Zola** static site generator. The site was migrated from Jekyll and focuses on showcasing meetup events, talks, and community information.

**Key Architecture Decisions:**
- **Zola SSG**: Uses Zola for fast static site generation
- **Bulma CSS**: All styling uses Bulma framework (NEVER use Tailwind CSS)
- **Event-Centric**: Content is organized around meetup events with rich metadata
- **English Content**: Events and pages support only English

## Essential Commands

```bash
# Development server
zola serve --port 8082

# Build for production
zola build

# Check internal links
zola check
```

## Content Structure & Architecture

### Events Architecture
Events are the core content type with a specific structure:

**Directory Structure:**
```
content/events/
├── _index.md              # Events listing page (paginated, 20 per page)
└── YYYY-MM-DD-topic1-topic2-topic3/
    └── index.md           # Individual event page
```

**Event Frontmatter Schema:**
```toml
+++
title = "Event Title"
description = "SEO description"
date = "YYYY-MM-DD"

[taxonomies]
speaker = ["Speaker Name 1", "Speaker Name 2"]
topic = ["Topic1", "Topic2"]

[extra]
location = "Venue Name"
+++
```

### Taxonomies System
The site uses two main taxonomies defined in `config.toml`:
- `speaker`: Links events by speakers (generates `/speaker/` pages)  
- `topic`: Links events by topics (generates `/topic/` pages)

### Template Architecture
- `base.html`: Main layout with Bulma navbar, footer, meta tags
- `events.html`: Event listing with pagination and sidebar
- `event.html`: Individual event page template
- `taxonomy_list.html`: Lists all speakers/tags
- `taxonomy_single.html`: Shows all events for a specific speaker/topic

## CSS Framework: Bulma Only

**CRITICAL**: This site uses **Bulma CSS framework exclusively**. 

**Bulma Classes to Use:**
- Layout: `container`, `columns`, `column`, `section`
- Components: `box`, `tag`, `button`, `pagination`
- Typography: `title is-1`, `subtitle`, `content`
- Styling: `is-primary`, `is-light`, `is-php` (custom), `is-magenta` (custom)

**Color System:**
All colors are defined in `static/styles.css` as CSS custom properties based on the Berlin PHP brand palette:

```css
:root {
    --dark-charcoal: #333333;      /* Dark gray/black */
    --dark-blue: #4F5B93;          /* Primary brand blue */
    --php-blue: #8892BF;           /* Light PHP blue */
    --orange-red: #F75900;         /* Bright orange accent */
    --warning-yellow: #FFAA00;     /* Warning/highlight yellow */
    --light-gray: #F2F2F2;         /* Background gray */
    --dark-magenta-color: #793862; /* Speaker tags magenta */
}
```

**Tag Color Usage:**
- `.tag.is-php` - Light blue (`--php-blue`) for topic/technology tags
- `.tag.is-magenta` - Magenta (`--dark-magenta-color`) for speaker tags
- `.tag.is-warning` - Yellow (`--warning-yellow`) for warnings/important items
- `.tag.is-highlight` - Orange (`--orange-red`) for special highlights
- `.tag.is-dark` - Dark (`--dark-charcoal`) for secondary elements

**Assets:**
- CSS: `static/lib/bulma.min.css` + `static/styles.css`
- Branding: `static/logo.svg`, `static/social-banner.png`

## Event Migration Process

When migrating events from old Jekyll site (`/home/dazz/Code/berlinphp/berlinphp.github.com.git/_posts/`):

1. Convert Jekyll frontmatter (YAML) to Zola (TOML)
2. Transform speaker list to `[taxonomies]` format
3. Move `date` from `[extra]` to main frontmatter for pages
4. **Event Slug Pattern**: Create SEO-friendly directory structure: `content/events/YYYY-MM-DD-topic1-topic2-topic3/index.md`
   - Use main topics/technologies from the event talks
   - Lowercase with hyphens instead of spaces  
   - Examples: `2012-03-06-e-commerce-shop-systems/`, `2012-04-03-pimcore-zend-php54-createjs/`
5. Preserve bilingual content (English + German sections), but in most cases the site will only display English content.
6. **Link Replacements**: Replace `[co.up](http://www.bephpug.de/location.html)` links with plain text "co.up" - these external links are outdated and should be simplified to just the venue name.
7. **Location Format**: Use full venue details in frontmatter: `location = "co.up Coworking Space, Adalbertstr. 7-8, 10999 Berlin"` instead of just "co.up" for better SEO and user information.

## Configuration Notes

**config.toml Key Settings:**
- Taxonomies: `speaker` and `topic` with RSS feeds enabled
- Pagination: Events paginated at 20 per page
- Feeds: RSS enabled for main content and taxonomies
- Social: Mastodon, GitHub, Flickr integration configured

**Build Settings:**
- SASS compilation enabled
- HTML minification enabled
- Search index generation enabled
- Syntax highlighting with "base16-ocean-dark" theme

## Development Workflow

1. **Local Development**: Use `zola serve --port 8082` for live reload
2. **Content Creation**: Follow event directory structure exactly
3. **Styling**: Only use Bulma classes, extend with `static/styles.css` if needed
4. **Templates**: Maintain Bulma compatibility across all templates
5. **Testing**: Check with `zola check` before deployment

## Site Structure

**Content Sections:**
- `/`: Homepage with hero and recent events
- `/events/`: Paginated archive of all meetups
- `/speaker/`: Taxonomy pages for speakers
- `/topic/`: Taxonomy pages for topics
- `/pages/`: Static pages (contact, imprint, etc.)

**Static Assets in `/static/`:**
- Bulma CSS framework
- Custom site styles
- Brand assets (logos, social banner)
- Favicon and icons