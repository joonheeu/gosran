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
- PHP 8.5.8 local verification passed Composer validate/install/dump-autoload and package discovery;
  isolated Pint made no changes.
- `DashboardOperationsTest` passed with 7 tests and 35 assertions;
  `DeploymentShowAuthorizationTest` passed with 3 tests and 8 assertions.
- A real `npm ci` and Vite build passed, using loopback Redis for the focused runtime checks.
- `pr-quality.yaml` alone passed actionlint 1.7.12. All 15 workflows parse, and the branch contract
  check passed.
- The npm dependency lane reported 0 vulnerabilities and passed its Vite build.
- Local application browser proof passed on PHP 8.5.8 with Pest Browser 4.3.1, Playwright 1.59.1,
  matching Chromium 147.0.7727.0, loopback Redis, and a temporary SQLite file runtime.
- The focused Dashboard smoke passed with 1 test and 2 assertions against real Dashboard copy and
  generated `tests/Browser/Screenshots/it_shows_dashboard_after_skipping_onboarding.png`.
- The complete `tests/v4/Browser/DashboardTest.php` passed with 5 tests and 20 assertions and
  generated 5 screenshots.

## In Progress, Not Yet Available

The Action Dashboard slice is labeled `In progress · Needs verification`. Focused local Pest and
frontend build evidence and real local application browser evidence now exist on PHP 8.5.8. The
previous Pest Browser to Playwright client blocker is resolved. The static README render in this
artifact is separate documentation evidence; the Dashboard browser tests and their screenshots are
the application browser evidence.

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
- Local PHP 8.5 and application browser verification are not presented as actual PR or GitHub
  Actions, deployment, or production proof.
- Whole-repository actionlint is not clean because of pre-existing SC2086 warnings in seven unrelated
  workflows; only `pr-quality.yaml` is claimed to pass actionlint.
- The retained `RELEASE.md` is clearly marked as an upstream reference and not a GOSRAN release
  procedure.
- A pending local workflow change targets `v4.x` and passed its scoped static checks, but no actual PR
  or GitHub Actions run verifies it. Public contribution documents remain conservative until the
  parent integrates that separate lane.

## Open Operational Gaps

- GOSRAN-specific release, signing, upgrade, rollback, and artifact registry policy are undefined.
- A dedicated private security and conduct contact channel is not confirmed; the documents provide
  conditional GitHub/private-contact routing without inventing an address.
- The first UI milestone has local application browser evidence; PR, deployment, and production
  proof remain separate release gates.
