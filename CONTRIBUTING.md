<!-- Modified by the GOSRAN project from Coolify documentation. -->

# Contributing to GOSRAN

고스란에 관심을 가져주셔서 감사합니다.

GOSRAN은 [Coolify](https://github.com/coollabsio/coolify)를 기반으로 운영자 경험을
다듬는 community fork입니다. 기여의 양보다 문제 정의, 검증 근거, upstream과의
compatibility를 중요하게 봅니다.

> [!IMPORTANT]
> 공개 contribution automation은 아직 GOSRAN 기준으로 정비되지 않았습니다. 상속한
> `PR Quality` workflow에는 upstream의 `next` branch 규칙이 남아 있습니다. Foundation
> 단계에서는 PR을 열기 전에 issue에서 target branch와 진행 여부를 확인해 주세요.

## 먼저 기여할 곳을 확인하세요

| 변경 | 권장 경로 |
| --- | --- |
| GOSRAN-specific UI, workflow, copy, operator experience | [GOSRAN issue](https://github.com/joonheeu/gosran/issues)와 이 repository의 PR |
| 수정하지 않은 Coolify에서도 재현되는 bug | [Coolify contribution guide](https://github.com/coollabsio/coolify/blob/v4.x/CONTRIBUTING.md)를 확인한 뒤 upstream |
| Coolify core의 일반 기능 또는 one-click service | upstream Coolify에서 먼저 논의 |
| 취약점 또는 secret 노출 | 공개 issue 대신 [SECURITY.md](./SECURITY.md) |

재현 위치가 불분명하면 fork revision과 upstream revision을 함께 적어 GOSRAN issue로
시작해도 됩니다.

## 좋은 기여의 기준

- 운영자가 겪는 문제와 기대 결과가 분명합니다.
- 한 PR은 하나의 논리적 변경만 다룹니다.
- 기존 route와 capability를 이유 없이 삭제하지 않습니다.
- sibling file과 기존 component, helper, pattern을 먼저 재사용합니다.
- UI change는 기존 token과 component를 따르고 task-relevant viewport에서 확인합니다.
- 동작 변경에는 test를 추가하고, 검증 범위와 남은 한계를 PR에 씁니다.
- 일반적으로 유용한 fix는 upstream으로 돌려보낼 수 있는 작은 diff를 지향합니다.

관련 없는 formatting, refactor, dead code 정리를 같은 PR에 섞지 마세요.

## 큰 변경은 issue부터 시작합니다

다음 작업은 구현 전에 issue에서 방향과 범위를 맞춥니다.

- 새로운 operator workflow
- navigation 또는 information architecture 변경
- 기본 동작 변경
- database schema 또는 migration
- dependency와 infrastructure 변경
- 여러 domain에 걸친 refactor
- 기존 Coolify route 또는 capability의 제거

Issue에는 다음을 포함해 주세요.

1. 운영자가 답해야 하는 질문
2. 현재 흐름과 불편
3. 가장 작은 검증 가능한 변경
4. upstream compatibility 영향
5. 성공을 확인할 evidence

## Development Flow

1. 작업 issue에서 확인한 target branch로부터 짧은 feature branch를 만듭니다.
2. [DEVELOPMENT.md](./DEVELOPMENT.md)에 따라 local environment를 준비합니다.
3. bug fix라면 실패하는 test를 먼저 작성합니다.
4. 가장 작은 shared boundary에서 원인을 수정합니다.
5. 관련 test와 build를 실행합니다.
6. UI change라면 실제 화면을 확인하고 screenshot 또는 짧은 recording을 첨부합니다.
7. 현재 source 기준은 `v4.x`지만 inherited PR Quality workflow는 `next`만 허용합니다.
   Fork의 branch policy가 정렬될 때까지 issue에서 실제 target branch를 확인한 뒤 PR을
   엽니다.

```bash
php artisan test --compact tests/Feature/RelevantTest.php
vendor/bin/pint --dirty --format agent
npm run build
```

변경 범위에 필요한 최소 command부터 실행하세요. 전체 test를 실행하지 못했다면 그 사실과
이유를 숨기지 않습니다.

## Commit과 PR

Commit과 PR title은 다음 형식을 사용합니다.

```text
<type>(<scope>): <subject>
```

예:

```text
feat(operations): add release evidence summary
fix(server): preserve selected quick action target
docs(readme): explain upstream relationship
```

권장 type은 `feat`, `fix`, `docs`, `refactor`, `test`, `perf`, `ci`, `chore`입니다.

PR에는 아래 내용을 포함합니다.

- 무엇을 왜 바꿨는지
- 관련 issue
- upstream 영향과 divergence
- 실행한 test, build, browser 검증
- screenshot 또는 recording이 필요한 UI evidence
- 알려진 한계와 추가 검증

## AI Assistance

AI 도구 사용은 허용합니다. 사용했다면 PR에 도구와 사용 범위를 밝히고, contributor가
모든 변경을 이해하고 검증해야 합니다. 생성된 설명이나 test 결과를 실제 실행 증거처럼
제출하지 마세요.

## Documentation

문서는 한국어 prose를 기본으로 하되 code, command, identifier는 원문을 유지합니다.
[GOSRAN Brand & Voice](./docs/BRAND.md)의 status와 claim 기준을 따릅니다.

제품 방향과 현재 제공 기능을 혼동하지 마세요. `Direction`, `Inherited`, `Available`,
`Needs verification`을 구분합니다.

## Community

[CODE_OF_CONDUCT.md](./CODE_OF_CONDUCT.md)를 따릅니다. 질문, 반대 의견, review는
사람이 아니라 코드와 제품 결정에 집중해 주세요.
