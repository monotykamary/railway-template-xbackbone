# Deploy and Host XBackBone on Railway

## About Hosting XBackBone

XBackBone is a lightweight file manager and ShareX-compatible upload backend for images, videos, text, and general files. This template deploys stable version 3.8.2 with a generated administrator and durable local storage.

Sign in with `XBACKBONE_ADMIN_USER` and the generated `XBACKBONE_ADMIN_PASSWORD` service variable.

## Common Use Cases

- Host ShareX and ScreenCloud uploads
- Share screenshots, recordings, snippets, and files
- Manage upload quotas, users, tags, and expiring links

## Dependencies for XBackBone Hosting

### Deployment Dependencies

- One XBackBone service with a daily-backed-up persistent volume
- Railway managed HTTPS

### Implementation Details

The adapter runs upstream SQLite migrations and creates the generated administrator before Nginx starts. Registration is closed by default. The database, uploads, config, sessions, and logs persist under `/config`.

This is a one-replica SQLite topology. Uploaded URLs are public unless protected in XBackBone.

## Why Deploy XBackBone on Railway?

Railway provides managed HTTPS, generated administrator credentials, persistent storage with backups, health checks, and Git-driven rollouts for a lightweight upload service.
