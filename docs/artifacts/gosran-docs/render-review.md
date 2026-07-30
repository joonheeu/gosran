# README Render Review

Date: 2026-07-30

## Desktop

- Renderer: Python Markdown 3.8 with `fenced_code`, `tables`, and `toc`
- Browser viewport request: 1440 × 1000 CSS px
- Reported page width: 1440 CSS px
- Content width: 980 CSS px
- Document horizontal overflow: none (`scrollWidth` 1440, `clientWidth` 1440)
- H1: `고스란 · GOSRAN`
- H2 sections: 9
- Tables: 3
- Links: 25
- Raw Markdown in hero: none
- Evidence: `readme-render.png`

## Mobile

- Browser viewport request: 390 × 844 CSS px
- Reported page width: 390 CSS px
- Content width: 362 CSS px
- Document horizontal overflow: none (`scrollWidth` 390, `clientWidth` 390)
- All three tables fit their 362 CSS px containers without page overflow
- Hero, navigation links, first narrative section, and status callout remain readable
- Evidence: `readme-render-mobile.png`

## Visual Decision

Pass. The hierarchy reads in the intended order: product name, promise, product boundary, experience
directions, principles, upstream relationship, development, and governance. Long tables remain legible
without clipping at the inspected desktop and mobile widths. The updated `In progress · Needs
verification` boundary and its PHP 8.5 local test/build and application browser evidence remain
visible in both renders. The static documentation browser render reported no page or console errors.
It is separate from the application browser proof recorded in `claim-boundaries.md`.

The local renderer preserves GitHub callout text but does not reproduce GitHub's native
`[!IMPORTANT]` styling. The content remains readable, and the source uses valid GitHub callout syntax.
