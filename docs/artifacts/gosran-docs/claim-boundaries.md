# Claim Boundary Review

Date: 2026-07-30

## Verified Product Facts Used

- The repository is a fork of `coollabsio/coolify`.
- `origin` is `joonheeu/gosran`; `upstream` is `coollabsio/coolify`.
- The checked-out branch is `v4.x`.
- The current codebase inherits Coolify's application, database, service, and server management
  foundation.
- The repository uses Laravel 12, Livewire 3, Tailwind CSS v4, Pest 4, PostgreSQL 15, Redis 7, Vite 8,
  and `npm` according to local manifests, lockfiles, Docker Compose files, and project instructions.
- The source now contains a read-only Dashboard `Operations` slice for current-team server attention
  signals and recent failed application deployments.

## In Progress, Not Yet Available

The Action Dashboard slice is labeled `In progress · Needs verification`. Source inspection confirms
the implementation and test contract, but no PHP test run or browser render has been completed in
this checkout.

## Direction, Not Current Capability

The following remain consistently labeled as `Direction`, candidate experience, or future work:

- Release Center
- Deployment Receipt
- Quick Ops
- Environment Variable Diff
- Server Guardrails

No document presents these items as implemented or production-verified.

## Explicit Non-Claims

- No GOSRAN production image or installer is available.
- Running the Coolify installer does not install GOSRAN.
- No GOSRAN managed cloud is offered.
- No production-readiness, uptime, security-response SLA, or official Coolify endorsement is claimed.
- The retained `RELEASE.md` is clearly marked as an upstream reference and not a GOSRAN release
  procedure.
- The inherited PR workflow is disclosed as not yet adapted to GOSRAN's branch policy.

## Open Operational Gaps

- GOSRAN-specific release, signing, upgrade, rollback, and artifact registry policy are undefined.
- A dedicated private security and conduct contact channel is not confirmed; the documents provide
  conditional GitHub/private-contact routing without inventing an address.
- The first UI milestone still needs PHP test and browser evidence before it can be called available.
