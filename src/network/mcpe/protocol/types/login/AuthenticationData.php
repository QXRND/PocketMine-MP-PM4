<?php
declare(strict_types=1);
namespace pocketmine\network\mcpe\protocol\types\login;
/** Compatibility model for legacy PM4 authentication extraData. */
final class AuthenticationData{
    public string $displayName = "";
    public string $identity = "";
    public string $XUID = "";
}
