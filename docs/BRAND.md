# GOSRAN Brand & Voice

이 문서는 고스란의 이름, 핵심 메시지, 문서와 UI copy의 판단 기준을 정의한다.
기능과 화면의 시각 규칙은 Coolify의 기존 design system을 우선하며, 이 문서는 그 위에
고스란의 제품 언어를 더한다.

## Identity

| 항목 | 기준 |
| --- | --- |
| 한국어 이름 | 고스란 |
| 영문 이름 | GOSRAN |
| 표기 | 첫 등장에서는 `고스란(GOSRAN)`, 이후 문맥에 맞춰 하나만 사용 |
| Category | operator-first, open-source, self-hosted PaaS |
| Primary line | 코드부터 운영까지, 상태와 근거가 고스란히. |
| Short description | Coolify를 기반으로 운영 판단의 맥락을 더 선명하게 만드는 self-hosted PaaS |

`GOSRAN`을 억지로 풀어 쓴 acronym으로 설명하지 않는다. 이름 자체가 약속이다. 운영자가
필요한 상태, 변화, 실행 결과와 근거를 감추거나 흩뜨리지 않고 온전히 보여준다는 뜻이다.

## Product Truth

- 고스란은 [Coolify](https://github.com/coollabsio/coolify)의 독립적인 community fork다.
- 현재 기능 기반과 runtime 대부분은 Coolify v4에서 상속한다.
- GOSRAN 전용 production image, installer, managed cloud는 아직 제공하지 않는다.
- Action Dashboard의 첫 read-only slice는 source와 focused local Pest test/frontend
  build를 PHP 8.5에서 확인했고 실제 local application browser test도 Dashboard 문구와
  screenshots까지 통과했다. PR, deployment, production은 미검증이므로
  `In progress · Needs verification`으로 표현한다.
- Release Center, deployment receipt, quick ops, environment variable diff, server guardrail은
  제품 방향이며 현재 제공 기능으로 표현하지 않는다.
- Coolify 또는 coolLabs가 고스란을 공식 지원하거나 보증한다고 표현하지 않는다.

## Message Hierarchy

문서와 화면은 다음 순서로 말한다.

1. **지금 어떤 상태인가**
2. **무엇이 달라졌는가**
3. **무엇을 할 수 있는가**
4. **그 판단의 근거는 무엇인가**
5. **드문 설정은 어디에서 찾을 수 있는가**

기능 목록보다 운영자의 다음 판단을 먼저 설명한다.

## Voice

- 담백하고 구체적으로 쓴다.
- 자신감은 형용사가 아니라 상태, 시간, revision, diff, log 같은 근거에서 만든다.
- 개발자에게는 정확하게, 운영자에게는 빠르게 읽히는 문장을 쓴다.
- 한국어 prose를 기본으로 하고 code, command, identifier, protocol 이름은 원문을 유지한다.
- “마법처럼”, “완벽한”, “무중단 보장”, “한 번에 모든 것”처럼 검증할 수 없는 표현은 쓰지 않는다.

## Status Language

| 상태 | 의미 |
| --- | --- |
| Available | 현재 checkout에서 실제로 제공되고 검증 가능한 기능 |
| Inherited | Coolify 기반에서 유지되는 기능 또는 구조 |
| In progress | 구현 중이며 완료를 주장할 수 없는 작업 |
| Direction | 탐색 중인 제품 방향. 일정이나 제공을 약속하지 않음 |
| Locally verified | 이름을 밝힌 focused test 또는 build가 명시한 local 환경에서 통과함 |
| Needs verification | target runtime, 실제 browser, PR 또는 production 등 남은 증거가 있음 |

`Direction`을 `Available`처럼 쓰지 않는다. build 성공을 production 배포 증거로 쓰지 않는다.
로컬 검증을 실제 server, provider, browser 또는 migration 검증과 혼동하지 않는다.

## Upstream Language

Coolify를 언급할 때는 “기반”, “upstream”, “상속”, “호환”처럼 관계가 분명한 단어를 쓴다.
“Coolify보다 낫다”는 비교 대신 고스란이 우선하는 운영 경험을 구체적으로 설명한다.

Upstream에 감사를 표할 때는 개발자, contributor, sponsor의 작업을 고스란의 성과로
가져오지 않는다. 자세한 관계와 기여 경계는 [UPSTREAM.md](./UPSTREAM.md)를 따른다.
