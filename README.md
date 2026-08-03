# XBackBone on Railway

Deploy XBackBone 3.8.2 with a generated administrator and persistent ShareX-compatible uploads.

The Deploy on Railway button is added after the published route is verified.

## Sign in

Use `XBACKBONE_ADMIN_USER` and the generated `XBACKBONE_ADMIN_PASSWORD`. Public registration remains disabled by default.

## Topology

The pinned LinuxServer image stores SQLite, uploads, logs, sessions, and application config under `/config` on a daily-backed-up volume. The adapter runs upstream migrations and creates the admin before Nginx starts. This is a one-replica SQLite topology; do not scale horizontally.

After login, download a ShareX or ScreenCloud client configuration from the dashboard. Uploaded links are public to anyone with their unguessable URL unless you enable per-upload protection.

## Updating

Back up the volume, update the pinned image digest deliberately, then repeat login, token upload, byte-for-byte download, delete, persistence, and redeploy soak tests.

## Upstream

- Source: https://github.com/SergiX44/XBackBone/tree/3.8.2
- Release: https://github.com/SergiX44/XBackBone/releases/tag/3.8.2
- Container: https://hub.docker.com/r/linuxserver/xbackbone
- License: AGPL-3.0-only

This repository contains Railway adapters and documentation. XBackBone remains copyright its upstream contributors and is not affiliated with Railway or LinuxServer.io.
