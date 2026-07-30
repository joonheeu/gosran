<!-- Modified by the GOSRAN project from Coolify documentation. -->

# GOSRAN Technology Stack

고스란은 현재 Coolify v4의 architecture와 runtime을 상속합니다. 아래 version은 이
repository의 manifest와 lockfile 기준이며 upstream sync에 따라 달라질 수 있습니다.

## Application

| Layer | Technology |
| --- | --- |
| Backend | Laravel 12 on the Laravel 10 directory structure |
| Reactive UI | Livewire 3 |
| Templates | Blade |
| Client interaction | Alpine.js |
| Styling | Tailwind CSS v4 |
| Authentication | Laravel Fortify, Sanctum, Socialite |
| Queue | Laravel Horizon |
| Tests | Pest 4, PHPUnit 12, Laravel Dusk 8 |

## Data & Realtime

| Role | Technology |
| --- | --- |
| Primary database | PostgreSQL 15 |
| Cache and queue | Redis 7 |
| WebSocket server | Soketi |

## Operations

- Docker and Docker Compose
- Nginx
- S6 Overlay
- SSH-based server management
- GitHub Actions

## Languages & Tooling

- PHP 8.4+ (`composer.json` constraint; project guidance targets PHP 8.5)
- JavaScript
- Shell/Bash
- Vite 8
- `npm`

Package manager는 upstream 표준에 맞춰 `npm`을 유지합니다. Dependency 또는 runtime
version은 이 문서보다 `composer.lock`, `package-lock.json`, Docker Compose file을 source
of truth로 봅니다.
