# Upstream Relationship

고스란은 [Coolify](https://github.com/coollabsio/coolify)를 기반으로 한 독립적인
community fork다. Coolify의 개발자, contributor, translator, sponsor가 만든 기반이
없었다면 고스란도 존재하지 않는다.

## Repository Relationship

| Remote | Repository | Role |
| --- | --- | --- |
| `origin` | [joonheeu/gosran](https://github.com/joonheeu/gosran) | GOSRAN 제품 작업과 release의 기준 |
| `upstream` | [coollabsio/coolify](https://github.com/coollabsio/coolify) | 기능 기반, security fix, compatibility 기준 |

고스란은 Coolify 또는 coolLabs의 공식 배포판이 아니며, 공식 지원이나 보증을 받는다고
표현하지 않는다. `Coolify` 이름과 관련 trademark는 출처와 호환성을 설명하는 범위에서만
사용한다.

## What We Preserve

- Apache License 2.0과 기존 attribution
- Coolify의 핵심 deployment capability와 route
- upstream naming이 protocol, container, image, environment compatibility에 필요한 부분
- 일반적인 bug fix와 security fix를 upstream으로 돌려보낼 수 있는 작은 diff
- 기존 contributor의 commit history

브랜딩만을 위해 내부 identifier, container 이름, image 경로를 일괄 변경하지 않는다.
보이는 이름과 기술적 compatibility identifier를 구분한다.

## How GOSRAN Diverges

고스란은 기능 개수보다 운영 판단의 순서를 다르게 설계한다.

- 자주 쓰는 상태와 action을 먼저 보여준다.
- 드문 설정은 삭제하지 않고 progressive disclosure로 낮춘다.
- 배포 결과를 revision, actor, time, diff, health evidence와 함께 설명한다.
- 위험한 server action에는 영향 범위와 guardrail을 붙인다.

이 방향은 Coolify의 성과를 고스란의 성과로 재표기하는 것이 아니다. 같은 기반 위에서
다른 제품 우선순위를 실험하고 유지하는 일이다.

## Issue Routing

| 상황 | 먼저 갈 곳 |
| --- | --- |
| GOSRAN에서만 재현되는 UI, copy, workflow 문제 | [GOSRAN Issues](https://github.com/joonheeu/gosran/issues) |
| 수정하지 않은 Coolify에서도 재현되는 일반 bug | [Coolify Issues](https://github.com/coollabsio/coolify/issues) |
| Coolify 사용법과 공식 support | [Coolify documentation](https://coolify.io/docs) |
| GOSRAN-specific security issue | [GOSRAN Security Policy](../SECURITY.md) |
| upstream에도 영향을 주는 security issue | [Coolify Security Policy](https://github.com/coollabsio/coolify/security/policy) |

재현 위치가 불분명하면 GOSRAN issue에 fork revision, upstream revision, 재현 절차를 함께
남긴다. Security issue는 공개 issue에 작성하지 않는다.

## Sync Principles

1. sync 전 `origin`과 `upstream`의 branch, tag, working tree 상태를 확인한다.
2. upstream 변경을 먼저 읽고 GOSRAN-specific diff와 충돌 지점을 분리한다.
3. route 삭제, schema change, dependency update, release workflow 변경은 별도 검토한다.
4. sync 후에는 관련 test, build, UI flow를 실제 변경 범위에 맞춰 검증한다.
5. 일반적으로 유용한 fix는 가능하면 upstream에도 작은 PR로 제안한다.

구체적인 merge 또는 rebase 전략은 변경 규모와 upstream release line을 확인한 뒤
결정한다. 자동 sync 성공만으로 compatibility를 주장하지 않는다.

## Supporting Coolify

이 repository의 `.github/FUNDING.yaml`은 의도적으로 Coolify의 funding channel을
유지한다. 기반 프로젝트를 직접 지원하려면
[Coolify sponsorships](https://coolify.io/sponsorships)를 이용할 수 있다.

License 전문은 [LICENSE](../LICENSE), attribution notice는 [NOTICE](../NOTICE)에 있다.
