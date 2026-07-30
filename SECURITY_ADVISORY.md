<!-- Modified by the GOSRAN project from Coolify documentation. -->

# Deployment Command Security Boundary

이 문서는 GOSRAN이 Coolify에서 상속한 deployment command의 security boundary를
설명합니다.

## User-Provided Deployment Commands

GOSRAN은 필요한 권한을 가진 authenticated user가 install, build, start, pre-deployment,
post-deployment command를 설정하고 실행할 수 있는 Coolify 동작을 상속합니다.

이 command가 해당 deployment environment에서 허용된 권한으로 실행되는 것은 의도된
동작입니다. 권한 있는 사용자가 자신이 설정한 deployment command를 실행할 수 있다는
사실만 입증한 report는 security vulnerability로 보지 않습니다.

정상 동작의 예:

- install 또는 build 단계에서 package manager command 실행
- deployment workflow를 위한 shell command 연결
- 배포 전후 framework 또는 database migration command 실행
- application owner의 deployment process에 필요한 shell feature 사용

다음 중 하나를 입증하면 security issue일 수 있습니다.

- GOSRAN authorization boundary 우회
- 다른 team 또는 tenant의 resource에 접근
- 필요한 deployment permission 없이 command 실행
- 다른 사용자의 secret 유출
- 문서화된 deployment trust boundary 밖의 unintended access

Report 방법과 upstream routing은 [SECURITY.md](./SECURITY.md)를 따릅니다.
