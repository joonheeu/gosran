<!-- Modified by the GOSRAN project from Coolify documentation. -->

# GOSRAN Local Development

고스란은 Coolify v4의 개발 환경과 내부 identifier를 상속합니다. 따라서 local
container 이름, command, seed account에는 아직 `coolify`가 남아 있습니다. 브랜딩만을
위해 이 compatibility identifier를 바꾸지 않습니다.

기여 원칙은 [CONTRIBUTING.md](./CONTRIBUTING.md), 기술 기반은
[TECH_STACK.md](./TECH_STACK.md)를 먼저 확인하세요.

## Prerequisites

- Git
- Docker Engine, Docker Desktop 또는 OrbStack
- [Spin](https://serversideup.net/open-source/spin/)
- Node.js와 `npm`

OS별 Docker와 Spin 설치는 각 project의 공식 documentation을 따릅니다.

## Clone

```bash
git clone https://github.com/joonheeu/gosran.git
cd gosran
git remote add upstream https://github.com/coollabsio/coolify.git
git remote -v
```

이미 `upstream` remote가 있다면 다시 추가하지 마세요. Remote를 바꾸기 전에는 현재
fetch/push URL을 먼저 확인합니다.

## Environment

Development template으로 local env file을 만듭니다.

```bash
cp .env.development.example .env
```

`.env`는 local-only secret-bearing file입니다. commit하거나 issue, PR, log에 내용을
붙이지 마세요. 필요한 key 구조는 `.env.development.example`과 `.env.example`에서
확인합니다.

## Start

```bash
spin up
```

기본 endpoint:

| Tool | URL | Note |
| --- | --- | --- |
| GOSRAN application | `http://localhost:8000` | 현재 UI 일부에는 Coolify naming이 남아 있음 |
| Vite | `http://localhost:5173` | frontend asset development |
| Mailpit | `http://localhost:8025` | local email catcher |
| Horizon | `http://localhost:8000/horizon` | root login 필요 |

기본 seed account:

```text
Email: test@example.com
Password: password
```

이 credential은 local development seed에만 사용합니다.

## Common Commands

### Tests

```bash
php artisan test --compact
php artisan test --compact tests/Feature/SomeTest.php
php artisan test --compact --filter='descriptive test name'
```

새 browser test는 `tests/v4/Browser/`에 작성합니다.

```bash
php artisan test --compact tests/v4/Browser/
php artisan test --compact tests/v4/Browser/LoginTest.php
```

Browser test는 마지막에 `screenshot()`을 호출해 실패를 재현할 evidence를 남깁니다.

### Formatting

PHP file을 수정했다면 final verification 전에 실행합니다.

```bash
vendor/bin/pint --dirty --format agent
```

### Frontend

이 repository는 upstream 표준에 맞춰 `npm`을 사용합니다.

```bash
npm run dev
npm run build
```

Package manager 전환은 별도 architecture decision 없이 진행하지 않습니다.

### Database

Branch 전환이나 migration 변경 후:

```bash
docker exec -it coolify php artisan migrate
```

Local database를 완전히 초기화해야 할 때만:

```bash
docker exec -it coolify php artisan migrate:fresh --seed
```

`migrate:fresh`는 local development data를 삭제합니다. Production 또는 보존해야 하는
database에 실행하지 마세요.

## Development Rules

- Laravel 12를 Laravel 10 directory structure로 사용합니다.
- UI는 Livewire 3, Blade, Alpine.js, Tailwind CSS v4 기반입니다.
- 기존 Action, Service, Livewire component와 helper를 먼저 찾습니다.
- Eloquent relationship을 사용하고 raw `DB::` query는 피합니다.
- 모든 behavior change에는 test가 필요합니다.
- bug fix는 재현 test를 먼저 작성합니다.
- GOSRAN UI change 전에 기존 token, component, navigation, sibling screen을 조사합니다.
- `.env`, credential, production server, deployment setting은 작업 범위 밖에서 건드리지
  않습니다.

## Upstream Sync

```bash
git fetch upstream
git status --short --branch
git log --oneline --decorate --max-count=12 upstream/v4.x
```

Merge 또는 rebase는 divergence와 local change를 검토한 뒤 선택합니다. 자동 sync나 clean
merge만으로 compatibility를 주장하지 말고 관련 test와 UI flow를 다시 확인합니다.

자세한 원칙은 [docs/UPSTREAM.md](./docs/UPSTREAM.md)를 따릅니다.

## Pull Request

현재 GOSRAN source 기준은 `v4.x`입니다. 다만 inherited PR Quality workflow는 아직
`next`만 허용하므로 external PR target은 needs verification 상태입니다. Issue에서 target
branch를 확인한 뒤 관련 test, formatting, build와 필요한 browser evidence를 PR template에
기록하세요.
