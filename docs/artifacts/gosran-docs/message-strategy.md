# GOSRAN Documentation Message Strategy

Mode: `strategy`

## creative.product-brief/v1

### Facts

- GOSRAN is an independent fork of Coolify.
- The current codebase inherits Coolify v4 functionality.
- The first read-only Action Dashboard slice exists in source but still needs PHP and browser
  verification.
- No GOSRAN production image, installer, cloud, or release channel is available.

### Constraints

- Respect upstream authorship, support boundaries, license, and trademarks.
- Do not claim roadmap items as current capabilities.
- Preserve `npm` and inherited technical identifiers until separate decisions are made.
- Keep Korean prose direct and evidence-led.

## creative.audience-insight/v1

- Audience: a developer or small-team operator evaluating a self-hosted PaaS fork
- Situation: they need to understand why this fork exists before trusting or contributing to it
- Progress sought: distinguish inherited capability, GOSRAN direction, and current operational risk
- Objection: “Is this only a rename?” or “Can I install this in production now?”
- Decision criteria: product difference, honesty, upstream compatibility, maintainability, evidence

## creative.positioning-decision/v1

GOSRAN is an operator-first self-hosted PaaS fork that changes the order in which operational state,
actions, and evidence are presented. It does not compete by claiming more inherited features. It
competes by making the next operational decision clearer while preserving the Coolify foundation.

## creative.direction/v1

### Route A — Evidence-led operations

- Hook: `코드부터 운영까지, 상태와 근거가 고스란히.`
- Tension: a successful deployment indicator does not explain what changed or what to do next
- Proof plan: status, revision, actor, time, diff, log, health evidence
- Risk: could overstate implementation
- Control: label the Action Dashboard slice `In progress · Needs verification` and keep the other
  GOSRAN-specific experiences as `Direction`
- Decision: **Selected**

### Route B — Faster daily operations

- Hook: `매일 쓰는 운영은 더 짧게.`
- Tension: common actions are buried among rare configuration
- Strength: concrete progressive-disclosure benefit
- Risk: sounds like the quick-ops experience already exists
- Decision: Rejected as the primary route; retained as a future feature-level message

### Route C — A Korean operator's Coolify

- Hook: `Coolify의 기반 위에, 한국 운영자의 순서로.`
- Tension: global PaaS products do not always match local operator vocabulary and habits
- Strength: immediately explains the fork relationship
- Risk: unnecessarily limits the audience and makes localization sound like the whole product
- Decision: Rejected

## creative.hook-decision/v1

### Primary

`코드부터 운영까지, 상태와 근거가 고스란히.`

- Clear product memory hook tied to the Korean name
- Covers code, deployment, and operational evidence without claiming a completed feature
- Claim safety: pass when paired with the current-status boundary

### Test Alternative 1

`배포는 끝나도, 운영의 근거는 남아야 하니까.`

- Strong problem recognition
- Better for a Release Center or Deployment Receipt artifact than the repository homepage

### Test Alternative 2

`무엇이 바뀌었는지까지 보여주는 self-hosted PaaS.`

- Concrete and readable
- Too close to an implemented-capability claim for the current foundation stage

## workflow.production-brief/v1

- Artifact: repository README and supporting public Markdown
- Intended decision: understand the fork, current state, direction, and correct next link
- Message order: promise → problem → current boundary → directions → principles → upstream → action
- Required proof: local repository state, manifests, upstream links, license, rendered Markdown
- Prohibited: installation claim, production-readiness claim, official endorsement, invented support route

## quality.report/v1

- Product fact consistency: pass
- Claim-proof binding: pass
- Upstream attribution: pass
- Korean voice and readability: pass
- Desktop/mobile render: pass
- Internal link integrity: pass
- Remaining gap: no observed audience or conversion outcome; no performance claim made
