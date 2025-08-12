# Berlin PHP Jekyll to Zola Migration Specification

## Project Overview

This specification outlines the migration of the Berlin PHP Usergroup website from Jekyll to Zola. The current site (bephpug.de) is hosted on GitHub Pages using Jekyll and needs to be modernized using Zola static site generator while preserving all existing functionality and content.

## Current Jekyll Website Analysis

### Repository Structure
- **Repository**: `berlinphp/berlinphp.github.com`
- **Live URL**: https://www.bephpug.de/ (redirects from berlinphp.github.io)
- **Framework**: Jekyll with GitHub Pages

### Existing Pages & Content
1. **Homepage** (`index.html`)
   - Next meetup information with event schema
   - Upcoming talks and speakers
   - Location details (Co-Up coworking)
   - Social media links

2. **Archive** (`archive.html`)
   - Historical meetup records
   - Past events and presentations

3. **Contact** (`contact.html`)
   - Group contact information
   - Meeting location details

4. **Code of Conduct** (`code-of-conduct.html`)
   - Community guidelines
   - Behavioral expectations

5. **Imprint**
   - Legal information
   - Required compliance page

### Technical Features
- Jekyll blog posts in `_posts/` directory
- Jekyll layouts in `_layouts/`
- Jekyll includes in `_includes/`
- RSS feed generation (`feed.xml`)
- Assets in `assets/` directory
- Slides storage in `folien/` directory
- Calendar integration (`calendar.ics`)

## Migration Priority & Phases

### Phase 1: Core Infrastructure (High Priority)
1. **Zola Project Initialization**
   - Set up basic Zola structure according to `docs/ai_docs/CLAUDE-ZOLA.md`
   - Configure `config.toml` with proper settings
   - Create base template structure

2. **Essential Pages Migration**
   - Homepage with meetup information
   - Contact page
   - Code of Conduct
   - Imprint (legal requirement)

3. **Basic Styling & Layout**
   - Convert Jekyll layouts to Zola templates
   - Implement responsive design
   - Preserve existing visual identity

### Phase 2: Content & Features (Medium Priority)
1. **Archive System**
   - Create archive template for meetup event `_index.md` files
   - Configure `slugify.paths_keep_dates = true` for date-in-URL
   - Create individual folders for each meetup event in `archive/`
   - Each event gets its own `_index.md` with 1-3 talks metadata
   - Co-locate slide files for multiple talks when available
   - Implement archive listing and individual event pages
   - Preserve chronological organization

2. **RSS Feed**
   - Configure Zola RSS generation
   - Ensure feed compatibility
   - Test feed readers

### Phase 3: Advanced Features (Lower Priority)
1. **Event Schema Integration**
   - Implement structured data for meetups
   - SEO optimization
   - Calendar integration

2. **Social Media Integration**
   - Maintain existing social links
   - Optimize social media cards
   - Consider automation features

3. **Performance Optimization**
   - Image optimization
   - Asset bundling
   - CDN considerations

## Zola Structure Design

Based on the existing CLAUDE-ZOLA.md guidelines, the new structure will be:

```
src/
├── content/
│   ├── _index.md              # Homepage
│   ├── archive/
│   │   ├── _index.md          # Archive listing page
│   │   ├── 2024-01-15-php-8-features/
│   │   │   ├── _index.md      # Talk details
│   │   │   └── slides.pdf     # Talk slides (if available)
│   │   ├── 2024-02-20-symfony-best-practices/
│   │   │   ├── _index.md      # Talk details
│   │   │   └── slides.pdf     # Talk slides (if available)
│   │   └── [weitere-talks]/   # Additional talks with same structure
│   └── pages/
│       ├── contact.md         # Contact page
│       ├── code-of-conduct.md # Code of Conduct
│       └── imprint.md         # Legal imprint
├── templates/
│   ├── base.html              # Base template with Bulma
│   ├── index.html             # Homepage template
│   ├── page.html              # Standard page template
│   ├── archive.html           # Archive listing template
│   └── talk.html              # Individual talk template
├── static/
│   ├── lib/
│   │   └── bulma.min.css      # Bulma CSS framework
│   ├── styles.css             # Custom styling
│   └── images/                # Site images
└── config.toml                # Zola configuration
```

## Archive Talk Template Structure

### Template for `archive/Y-m-d-title/_index.md`

````markdown
+++
title = "Berlin PHP Meetup - Event Title"
date = YYYY-MM-DD
description = "Brief description of the meetup event"

[extra]
speakers = [
  { name = "Speaker 1", twitter = "@handle1", github = "user1" },
  { name = "Speaker 2", twitter = "@handle2", github = "user2" }
]
meetup_id = ""                       # optional meetup.com ID (can be empty)
location = "Co-Up Berlin"            # or other location
slides = [
  { title = "Talk 1 Title", file = "talk1-slides.pdf" },
  { title = "Talk 2 Title", file = "talk2-slides.pdf" }
]
tags = ["php", "symfony", "testing"] # topic tags
+++

## Meetup Event

Detailed description of the meetup event, theme, and what was covered.

## Talks

### Talk 1: Title
**Speaker:** Speaker Name

Description of the first talk, key points, technologies covered.

### Talk 2: Title  
**Speaker:** Speaker Name

Description of the second talk, key points, technologies covered.

### Talk 3: Title (if applicable)
**Speaker:** Speaker Name

Description of the third talk, key points, technologies covered.

## About the Speakers

Information about the speakers, their backgrounds, projects, etc.

## Resources

- Links to related resources
- GitHub repositories mentioned
- Documentation links
- Follow-up reading

<!-- Slides should be co-located with title and file reference for each talk -->
````

### Frontmatter Fields Specification

- **title**: Meetup event title (required)
- **date**: Event date in YYYY-MM-DD format (required) 
- **description**: SEO-friendly description of the event (required)
- **speakers**: Array of speaker objects with name, twitter, github (required)
- **meetup_id**: Meetup.com event ID (optional, can be empty string)
- **location**: Venue name (required)
- **slides**: Array of slide objects with title and file reference (optional)
- **tags**: Topic/technology tags (required)

## Content Migration Strategy

### Jekyll to Zola Mapping
- **Jekyll `_posts/`** → **Zola `content/blog/`**
- **Jekyll `_layouts/`** → **Zola `templates/`**
- **Jekyll `_includes/`** → **Zola template includes**
- **Jekyll `assets/`** → **Zola `static/`**
- **Jekyll pages** → **Zola `content/pages/`**

### Template Conversion
- Convert Liquid templates to Tera templates
- Maintain existing HTML structure
- Preserve CSS classes and styling
- Update asset references

### Content Processing
- Create standardized template for archive meetup event `_index.md` files
- Convert Jekyll front matter to Zola format following template
- Create individual event folders with `Y-m-d-title` naming convention
- Co-locate slide files for multiple talks per event when identifiable
- Update internal links
- Process image references
- Maintain SEO metadata
- Generate talk listing for archive page

## Technical Requirements

### Configuration
- Single language setup (English only)
- RSS feed generation
- Sitemap generation
- SEO-friendly URLs with dates: `slugify.paths_keep_dates = true`
- Archive section configuration for talks

### Dependencies
- No external build dependencies (per CLAUDE-ZOLA.md guidelines)
- Bulma CSS framework in `static/lib/bulma.min.css`
- All CSS/JS dependencies in `static/lib/`
- Self-hosted assets only

### Performance Targets
- Static file generation under 5 seconds
- Lighthouse performance score > 90
- Mobile-first responsive design
- Minimal JavaScript usage

## Deployment Strategy

### GitHub Pages Migration
- Maintain current GitHub Pages hosting
- Configure Zola GitHub Actions workflow
- Preserve existing domain configuration
- Ensure zero-downtime transition

### Testing & Validation
- Content accuracy verification
- Link integrity checks
- RSS feed validation
- Cross-browser testing
- Mobile responsiveness testing

## Success Criteria

### Functional Requirements
- [ ] All existing pages accessible
- [ ] Archive browsing works correctly
- [ ] RSS feed functional
- [ ] Contact information accurate
- [ ] Social media links working
- [ ] Pages in /pages/ subfolder structure

### Technical Requirements
- [ ] Build time under 5 seconds
- [ ] Mobile responsive design
- [ ] SEO metadata preserved
- [ ] Schema markup functional
- [ ] Performance benchmarks met

### Content Requirements
- [ ] All historical content migrated
- [ ] Archive chronology maintained
- [ ] Legal pages compliance
- [ ] Single language structure (English) configured
- [ ] Bulma CSS framework integrated

## Timeline Estimation

- **Phase 1**: 1-2 days (core infrastructure)
- **Phase 2**: 1-2 days (content migration, simplified without slides)  
- **Phase 3**: 1-2 days (advanced features)
- **Testing & Polish**: 1 day

**Total Estimated Time**: 4-7 days

## Risk Mitigation

### Content Loss Prevention
- Full backup of existing Jekyll repository
- Incremental migration with verification
- Rollback plan to Jekyll if needed

### Functionality Preservation
- Feature parity checklist
- User acceptance testing
- Community feedback integration

### Technical Challenges
- Template syntax differences (Liquid → Tera)
- Asset path updates
- RSS feed compatibility
- GitHub Pages Zola configuration

## Next Steps

1. Initialize Zola project structure
2. Set up development environment
3. Begin Phase 1 migration
4. Establish testing procedures
5. Create deployment pipeline

## Notes

- Preserve existing URLs where possible for SEO
- Maintain Berlin PHP branding and visual identity
- Consider future expansion needs
- Document migration process for future reference
- Follow KISS and YAGNI principles throughout