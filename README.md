# QXRND - PocketMine-MP PM4

![Platform](https://img.shields.io/badge/platform-Minecraft%20Bedrock-55C2E6)
![API](https://img.shields.io/badge/API-4.26.0-2F81F7)
![Protocol](https://img.shields.io/badge/protocol-2168-6F42C1)
![Runtime](https://img.shields.io/badge/PHP-8.1-777BB4)

QXRND - PocketMine-MP PM4 is a downstream distribution of [PocketMine-MP](https://github.com/pmmp/PocketMine-MP) that preserves the PM4 application and plugin API line while carrying a Bedrock 1.26.44 compatibility port. It is not an upstream PocketMine-MP release and is not affiliated with Mojang, Microsoft, or the PocketMine-MP maintainers.

The branch targets operators and developers who require a legacy PM4-compatible server API while servicing the Bedrock network protocol used by this distribution.

## Release profile

| Component | Value |
|---|---|
| Distribution | QXRND - PocketMine-MP PM4 |
| PocketMine-MP API line | 4.26.0 |
| Bedrock network version | 1.26.44 |
| Bedrock protocol | 2168 |
| PHP runtime | PHP 8.1, x86_64 |
| Stable release | [`v4.26.0-qxrnd.3`](https://github.com/QXRND/PocketMine-MP-PM4/releases/tag/v4.26.0-qxrnd.3) |
| Distribution asset | [`PocketMine-MP.phar`](https://github.com/QXRND/PocketMine-MP-PM4/releases/download/v4.26.0-qxrnd.3/PocketMine-MP.phar) |
| Author and maintainer | **DevPapo** |

## Upstream lineage and compatibility model

The application layer remains PM4-oriented: command dispatch, plugin loading, permissions, scheduling, world management, server lifecycle, and the public PM4 API are derived from the PM4 code line. Bedrock support is supplied by updated protocol and data dependencies together with a compatibility layer bridging PM4's `BinaryStream` serializer model and the modern Bedrock packet implementation.

This is a downstream backport rather than a native PM4 upstream release. Plugins that depend on undocumented internals, historical packet layouts, or exact legacy Bedrock tables must be tested independently. API compatibility does not imply binary compatibility for arbitrary packet hooks.

## QXRND modifications

The distribution includes the following downstream changes:

- Bedrock 1.26.44 and protocol 2168 support in the PM4 branch.
- Reproducible Composer integration for the Bedrock protocol and data packages.
- Compatibility adapters for `ByteBufferReader`, `ByteBufferWriter`, and modern `VarInt` operations.
- Packet-batch, packet-serializer, item-dictionary, sound-event, and disconnect-signature compatibility fixes.
- QXRND branding in server metadata, crash dumps, and information commands.
- English QXRND output for `/ver`, `/about`, and `/status`.
- Discord support shown by `/ver` and `/about`; `/status` intentionally does not display the Discord link.
- Configurable `/say` prefix through `settings.say-prefix`, defaulting to `QXRND`.
- Minimal PHAR packaging to reduce temporary disk usage during Pterodactyl extraction.

## Runtime requirements

The published PM4 distribution requires a 64-bit Linux runtime with PHP 8.1. The supplied Pterodactyl runtime is recommended. The server requires write access to its data, worlds, plugins, resource-pack, and temporary extraction paths.

Online-mode deployments require outbound connectivity for Xbox Live authentication and Bedrock key retrieval. UDP port exposure, DNS, firewall rules, and host-level resource limits remain operator responsibilities.

## Installation

Download the stable PHAR and execute it with PHP 8.1:

```bash
curl -fL -o PocketMine-MP.phar \
  https://github.com/QXRND/PocketMine-MP-PM4/releases/download/v4.26.0-qxrnd.3/PocketMine-MP.phar
php8.1 PocketMine-MP.phar --no-wizard
```

For Pterodactyl, import [`egg-pmmp.json`](https://github.com/QXRND/PocketMine-MP-Egg/blob/main/egg-pmmp.json), select `PM4` in the `VERSION` variable, and use **Reinstall Server** when replacing an existing installation. The egg installs the PHP runtime and downloads the asset named `PocketMine-MP.phar`.

## Configuration

The generated `pocketmine.yml` contains:

```yaml
settings:
  say-prefix: "QXRND"
```

This setting controls the prefix emitted by `/say`. Existing installations may require the key to be added manually under `settings`.

## Build and packaging

The repository contains the Composer lockfile and the Bedrock compatibility patch used by the distribution build. A reproducible build can be invoked with:

```bash
composer install --no-interaction
RYXMC_MINIMAL_PHAR=1 composer run make-server --no-interaction
```

The build produces `PocketMine-MP.phar`. The minimal packaging flag is a disk-usage optimization; it does not replace protocol, plugin, world, or client compatibility testing.

## Operational guidance

Because this branch combines a legacy API line with modern Bedrock data, stage upgrades against disposable worlds and retain backups. Validate authentication, resource-pack negotiation, inventory serialization, block-state translation, and plugins that directly interact with network packets.

Small source and configuration changes are consolidated into the existing stable release asset. Operators troubleshooting stale behavior should verify the downloaded PHAR and its release timestamp rather than relying only on the repository source view.

## Support and distribution links

| Resource | Link |
|---|---|
| Source repository | [QXRND/PocketMine-MP-PM4](https://github.com/QXRND/PocketMine-MP-PM4) |
| Stable release | [`v4.26.0-qxrnd.3`](https://github.com/QXRND/PocketMine-MP-PM4/releases/tag/v4.26.0-qxrnd.3) |
| Direct PHAR download | [`PocketMine-MP.phar`](https://github.com/QXRND/PocketMine-MP-PM4/releases/download/v4.26.0-qxrnd.3/PocketMine-MP.phar) |
| Pterodactyl Egg | [QXRND/PocketMine-MP-Egg](https://github.com/QXRND/PocketMine-MP-Egg) |
| Technical support and invitation | [QXRND Discord](https://discord.gg/qhUXn72rGB) |
| Upstream project | [pmmp/PocketMine-MP](https://github.com/pmmp/PocketMine-MP) |

## Credits and legal notice

The QXRND downstream distribution, its branding, release engineering, and compatibility work are maintained and published by **DevPapo**. PocketMine-MP is the upstream project from which this distribution is derived. Minecraft, Minecraft Bedrock, and related marks belong to their respective owners. This project is neither affiliated with nor endorsed by Mojang or Microsoft.
