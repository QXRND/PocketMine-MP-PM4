<?php
declare(strict_types=1);
namespace pocketmine\network\mcpe\protocol\types\login;
/** Compatibility model for the legacy PM4 login handler. */
final class JwtChain{
    /** @var string[] */
    public array $chain = [];
}
