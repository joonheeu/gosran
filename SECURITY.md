<!-- Modified by the GOSRAN project from Coolify documentation. -->

# GOSRAN Security Policy

고스란은 Coolify를 기반으로 한 초기-stage community fork입니다. GOSRAN 전용
production release channel과 security response SLA는 아직 제공하지 않습니다.

## Supported Scope

| Scope | Status |
| --- | --- |
| GOSRAN `v4.x` source | Active development; response channel needs verification |
| Published GOSRAN image/installer | Not available |
| Upstream Coolify releases and cloud | Managed by the Coolify project |

현재 checkout이 production-safe하다는 보증으로 이 표를 해석하지 마세요. 실제 운영에는
사용 중인 revision, upstream security update, infrastructure와 deployment configuration을
함께 검토해야 합니다.

이 repository의 private vulnerability reporting 활성화 여부와 실제 응답 시간은 아직
검증되지 않았습니다. 아래 절차는 민감 정보를 공개하지 않기 위한 우선순위이며 response
SLA나 patch 제공을 약속하지 않습니다.

## Reporting a Vulnerability

Security issue를 공개 issue, discussion, PR 또는 log에 게시하지 마세요.

### GOSRAN-specific issue

1. Repository의 `Security` tab에서 **Report a vulnerability**가 제공되면 private report를
   사용합니다.
2. 해당 channel을 사용할 수 없다면 [repository owner](https://github.com/joonheeu)에게
   제공된 private contact channel로 연락합니다.
3. Private channel이 확인되지 않으면 공개 issue에는 취약점 내용을 쓰지 말고, 민감 정보
   없이 private contact가 필요하다는 사실만 알려주세요.

Report에는 가능한 범위에서 아래 내용을 포함합니다.

- 영향을 받는 GOSRAN commit 또는 version
- 대응하는 upstream Coolify revision
- 재현 조건과 최소 단계
- 예상 영향과 권한 경계
- secret과 개인 정보를 제거한 evidence

### Upstream-shared issue

수정하지 않은 Coolify에서도 재현되거나 upstream component에 직접 영향을 준다면
[Coolify Security Policy](https://github.com/coollabsio/coolify/security/policy)를 따라
`security@coollabs.io`로 신고하세요.

같은 취약점을 두 project에 보낼 때는 이미 신고한 대상과 시각을 알려 중복 대응과 조기
공개를 피합니다.

## Disclosure

재현과 영향 범위를 확인하고 patch와 release 경로가 준비될 때까지 공개를 미뤄 주세요.
GOSRAN maintainer는 fork-specific fix가 upstream에 영향을 주는지 확인하고, 필요한 경우
coordinated disclosure를 요청합니다.

Deployment command의 trust boundary는 [SECURITY_ADVISORY.md](./SECURITY_ADVISORY.md)를
확인하세요.
