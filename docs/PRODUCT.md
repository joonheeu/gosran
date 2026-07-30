# GOSRAN Product Direction

> 이 문서는 release 약속이 아니다. 고스란이 어떤 운영 문제를 어떤 원칙으로 풀 것인지,
> 그리고 검증 전인 첫 milestone의 경계를 정리한다.

## The Operator's Question

배포 도구에는 정보가 많다. 문제는 운영자가 결정을 내려야 할 순간에 그 정보가 여러
화면과 log에 흩어진다는 점이다.

고스란은 다음 질문에 더 빨리 답하는 경험을 만든다.

- 지금 정상인가?
- 마지막으로 무엇이 바뀌었나?
- 누가, 언제, 어떤 source를 배포했나?
- 실패했다면 어디서부터 확인해야 하나?
- 지금 눌러도 안전한 action은 무엇인가?

## Product Promise

**코드부터 운영까지, 상태와 근거가 고스란히.**

고스란은 자주 쓰는 운영 기능과 판단 근거를 전면에 둔다. 드문 기능은 없애지 않고
progressive disclosure로 낮춘다. 기존 route와 capability를 성급히 삭제하지 않으며,
Coolify upstream과 다시 합칠 수 있는 구조를 중요한 제품 제약으로 다룬다.

## Experience Directions

Action Dashboard의 첫 read-only slice는 구현 중이다. 나머지 항목은 구현 후보이며 아직
제공을 약속하지 않는다.

### Action Dashboard

project, application, database, server의 중요한 상태와 다음 action을 한곳에서 읽는다.
정보량을 늘리는 dashboard가 아니라, 운영 우선순위를 정리하는 화면을 목표로 한다.

### Release Center & Deployment Receipt

배포마다 source revision, trigger, actor, 시작과 종료 시각, 결과, 주요 변경과 검증 근거를
한 장의 receipt로 남긴다. “배포됨”에서 끝나지 않고 무엇이 배포되었는지 설명한다.

### Quick Ops

restart, redeploy, log 확인처럼 반복되는 작업은 짧은 경로로 제공한다. 빠르게 실행하되
대상과 영향 범위를 분명히 보여주고, 위험한 action에는 guardrail을 둔다.

### Environment Variable Diff

secret value를 노출하지 않으면서 key의 추가, 제거, 변경 여부를 비교한다. 환경 간 drift와
배포 전 변경 범위를 이해하는 데 집중한다.

### Server Guardrails

disk, connectivity, proxy, deployment capacity처럼 사고로 이어지기 쉬운 상태를 action
직전에 확인한다. 경고는 막연한 불안을 만들지 않고 원인, 영향, 다음 확인을 함께 제시한다.

## Decision Principles

1. **Evidence before assurance**
   초록색 badge보다 revision, time, diff, log, health result가 먼저다.

2. **Common actions first**
   자주 쓰는 운영 흐름을 짧게 만들고, 드문 설정은 필요할 때 펼친다.

3. **Guardrails over friction**
   모든 action을 modal로 막지 않는다. 위험과 복구 비용에 비례해 확인과 보호를 둔다.

4. **Compatibility is a feature**
   upstream sync와 기존 capability 보존을 제품 품질로 취급한다.

5. **No invisible automation**
   자동화가 실행되면 trigger, 대상, 결과와 실패 지점을 운영자가 추적할 수 있어야 한다.

## First Milestone Gate

첫 UI milestone은 저장소와 현재 navigation, component, route, data flow를 조사한 뒤
다음 조건을 만족하는 가장 작은 vertical slice로 선택한다.

- 기존 capability와 route를 삭제하지 않는다.
- 한 가지 운영 질문에 처음부터 끝까지 답한다.
- read-only 상태에서 시작할 수 있으면 먼저 read-only로 검증한다.
- 실제 화면과 task-relevant viewport에서 확인할 수 있다.
- upstream 변경과 충돌 면적이 작고 되돌리기 쉽다.

선택한 첫 slice는 기존 Dashboard 상단의 `Operations` 영역이다.

- 현재 team server의 `unreachable`, `not usable`, `force-disabled` signal을 보여준다.
- 현재 team의 server와 application에 모두 속한 최근 24시간의 실패 deployment를 최대
  5개까지 보여준다.
- read-only query만 사용하고 log, configuration, secret, deployment URL을 노출하지 않는다.
- 실패 deployment 상세 link는 resource association과 authorization boundary를 독립적으로
  검증하기 전까지 제공하지 않는다.

Source와 test contract는 추가됐지만 PHP dependency와 local runtime이 준비되지 않아
실제 test와 browser 검증은 아직 수행하지 못했다. 현재 상태는 `Needs verification`이다.
