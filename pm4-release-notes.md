# QXRND - PocketMine-MP PM4 — Minecraft Bedrock 1.26.44

This release updates the PM4 distribution to **Minecraft Bedrock 1.26.44** using **Bedrock protocol 2168**, while retaining the PM4 API line.

## Included changes

- Updated Bedrock network version to `1.26.44`.
- Updated the Bedrock protocol to `2168`.
- Added the modern Bedrock protocol compatibility layer required by PM4.
- Updated Bedrock item data and the item type dictionary format.
- Added compatibility handling for modern level sound event identifiers.
- Preserved the QXRND branding: `QXRND - PocketMine-MP`, author `DevPapo`.
- Preserved the configurable `/say` prefix with `QXRND` as the default, producing `[QXRND] message`.
- Preserved the PM4 QXRND command customizations and minimal PHAR build process.
- The PHAR asset is named exactly `PocketMine-MP.phar` for Pterodactyl Egg compatibility.

## Requirements

- PHP 8.1 with the PM4-compatible PocketMine-MP extensions.
- Minecraft Bedrock client 1.26.44.

## Installation

Download `PocketMine-MP.phar` below. For Pterodactyl, use the public QXRND PocketMine-MP Egg and perform a reinstall after importing the updated Egg.

Support: https://discord.gg/qhUXn72rGB

## Connection compatibility fix

This PHAR also includes the packet compatibility fix for PM4's `BinaryStream` and the modern Bedrock serializer, including safe disconnect packet handling. The server was verified to start successfully after this fix, and the serializer compatibility checks passed.

## Unified information commands

PM4 now uses the same QXRND presentation as PM5 and PM6 for `/ver`, `/about` and `/status`. The output is in English, uses the QXRND color layout without emojis or diamonds, includes the Discord support link in `/ver` and `/about`, and does not include Discord in `/status`.

The release also includes the QXRND quick gamemode shortcuts `/gma`, `/gmsp`, `/gmc` and `/gms`, using the normal `/gamemode` permissions.
