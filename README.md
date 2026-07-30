<!-- Modified by the GOSRAN project from Coolify documentation. -->

<h1 align="center">고스란 · GOSRAN</h1>

<p align="center"><strong>코드부터 운영까지, 상태와 근거가 고스란히.</strong></p>

<p align="center">
Coolify를 기반으로 운영 판단의 맥락을 더 선명하게 만드는<br>
operator-first, open-source, self-hosted PaaS
</p>

<p align="center">
<a href="./docs/PRODUCT.md">제품 방향</a> ·
<a href="./docs/UPSTREAM.md">Upstream 관계</a> ·
<a href="./DEVELOPMENT.md">개발 시작</a> ·
<a href="./CONTRIBUTING.md">기여하기</a>
</p>

---

## 운영에는 결과보다 맥락이 필요합니다

배포가 끝났다는 사실만으로는 부족합니다.

무엇이 바뀌었는지, 누가 실행했는지, 지금 정상인지, 문제가 생겼다면 어디서부터
확인해야 하는지까지 이어져야 운영자가 다음 판단을 내릴 수 있습니다.

고스란은 자주 쓰는 운영 상태와 action을 전면에 두고, 드문 기능은 필요할 때 펼쳐
보이도록 설계합니다. 기존 capability를 성급히 없애지 않으면서 코드, 배포, server
상태와 그 근거가 하나의 흐름으로 읽히는 경험을 지향합니다.

## 현재 상태

> [!IMPORTANT]
> 고스란은 현재 **제품 기반을 세우는 초기 단계**입니다. 이 repository는 동작하는
> Coolify v4 codebase를 상속합니다. 첫 GOSRAN 전용 UI slice는 source에 추가됐지만
> runtime과 browser 검증 전이며, production 제공 기능이나 release로 안내하지 않습니다.

| 영역 | 현재 상태 |
| --- | --- |
| Self-hosted PaaS 기반 | **Inherited** — application, database, service, server 관리 기능을 Coolify에서 상속 |
| GOSRAN operator UX | **In progress · Needs verification** — read-only Action Dashboard 첫 slice를 source에 추가 |
| GOSRAN installer/image | **Not available** — 독립 production release channel 미구성 |
| Upstream compatibility | **Active constraint** — route와 capability 보존, 작은 divergence 지향 |

지금은 Coolify 설치 script를 실행해도 GOSRAN이 설치되지 않습니다. GOSRAN 전용
installer와 image가 검증되어 공개되기 전까지 production 설치를 안내하지 않습니다.

## 만들고 싶은 운영 경험

| Direction | 운영자가 얻는 답 |
| --- | --- |
| **Action Dashboard** | 지금 가장 먼저 확인하고 처리할 것은 무엇인가 |
| **Release Center** | 어떤 revision이 누구에 의해 언제 배포되었고 결과는 어땠는가 |
| **Deployment Receipt** | 이번 배포의 source, 변경, 검증 근거를 한 장에서 볼 수 있는가 |
| **Quick Ops** | 반복 action을 짧고 안전하게 실행할 수 있는가 |
| **Environment Variable Diff** | secret을 노출하지 않고 환경 간 key drift를 알 수 있는가 |
| **Server Guardrails** | 실행 전에 위험, 영향 범위와 다음 확인을 알 수 있는가 |

세부 방향과 milestone 선택 기준은 [GOSRAN Product Direction](./docs/PRODUCT.md)에
정리합니다.

Action Dashboard의 첫 slice는 현재 team의 server attention signal과 최근 24시간의 실패한
application deployment를 read-only로 요약합니다. Source와 test contract는 추가됐지만,
local runtime과 browser 검증이 끝나기 전에는 `Available`로 표시하지 않습니다.

## 제품 원칙

- **Evidence before assurance** — 막연한 성공 표시보다 revision, time, diff, log,
  health result를 먼저 보여줍니다.
- **Common actions first** — 자주 쓰는 운영 흐름은 짧게, 드문 설정은 필요할 때
  드러냅니다.
- **Guardrails over friction** — 모든 action을 막는 대신 위험과 복구 비용에 비례해
  보호합니다.
- **Compatibility is a feature** — upstream sync와 기존 capability 보존을 제품 품질로
  다룹니다.
- **No invisible automation** — 자동화의 trigger, 대상, 결과와 실패 지점을 추적할 수
  있어야 합니다.

## Built on Coolify

고스란은 [Coolify](https://github.com/coollabsio/coolify)의 독립적인 community fork입니다.
Coolify의 개발자와 contributor가 구축한 self-hosted PaaS 기반을 존중하며, 일반적으로
유용한 fix는 upstream으로 돌아갈 수 있도록 compatibility와 작은 diff를 중요하게
다룹니다.

고스란은 Coolify 또는 coolLabs의 공식 배포판이 아니며, 공식 지원이나 보증을 받는다고
표현하지 않습니다. Coolify를 사용하거나 지원하려면 아래 공식 channel을 이용해 주세요.

- [Coolify repository](https://github.com/coollabsio/coolify)
- [Coolify documentation](https://coolify.io/docs)
- [Coolify sponsorships](https://coolify.io/sponsorships)
- [GOSRAN과 upstream의 관계](./docs/UPSTREAM.md)

## 개발 시작

현재 GOSRAN은 contributor용 local development만 안내합니다.

```bash
git clone https://github.com/joonheeu/gosran.git
cd gosran
spin up
```

Docker, Spin, local environment 준비와 test command는
[DEVELOPMENT.md](./DEVELOPMENT.md)를 먼저 확인하세요. Repository는 upstream 표준에
맞춰 frontend package manager로 `npm`을 유지합니다.

## 문서 지도

| 문서 | 역할 |
| --- | --- |
| [PRODUCT.md](./docs/PRODUCT.md) | 문제 정의, 경험 방향, 첫 milestone 기준 |
| [BRAND.md](./docs/BRAND.md) | 이름, 핵심 메시지, status와 copy 원칙 |
| [UPSTREAM.md](./docs/UPSTREAM.md) | Coolify attribution, compatibility, issue routing |
| [DEVELOPMENT.md](./DEVELOPMENT.md) | local development와 검증 |
| [CONTRIBUTING.md](./CONTRIBUTING.md) | issue, PR, upstream contribution 원칙 |
| [SECURITY.md](./SECURITY.md) | 취약점 범위와 비공개 신고 경로 |
| [TECH_STACK.md](./TECH_STACK.md) | 현재 기술 기반 |
| [RELEASE.md](./RELEASE.md) | upstream Coolify release 참고 자료 |

## 기여와 보안

GOSRAN-specific issue와 pull request는 언제나 환영합니다. 큰 UI/UX 변경은 구현 전에
issue에서 운영 문제와 가장 작은 검증 범위를 먼저 맞춥니다.

- 기여: [CONTRIBUTING.md](./CONTRIBUTING.md)
- 보안: [SECURITY.md](./SECURITY.md)
- 행동 강령: [CODE_OF_CONDUCT.md](./CODE_OF_CONDUCT.md)

Security issue와 secret은 공개 issue에 올리지 마세요.

## License

Apache License 2.0을 따릅니다. 원본 Coolify의 copyright, license, attribution과 repository
history를 유지합니다. 자세한 내용은 [LICENSE](./LICENSE), [NOTICE](./NOTICE)와
[UPSTREAM.md](./docs/UPSTREAM.md)를 확인하세요.
