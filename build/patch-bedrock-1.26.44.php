<?php
declare(strict_types=1);

$root = dirname(__DIR__);
$protocol = $root . "/vendor/vapebw/bedrock-protocol/src";
$data = $root . "/vendor/nethergamesmc/bedrock-data";
$protocolInfo = $protocol . "/ProtocolInfo.php";
$compatSerializer = $protocol . "/serializer";
$sourceSerializer = $root . "/src/network/mcpe/protocol/serializer";

if(!is_dir($compatSerializer) || !is_dir($sourceSerializer)){
    throw new RuntimeException("Serializer compatibility directories are missing");
}
foreach(glob($sourceSerializer . "/*.php") as $file){
    copy($file, $compatSerializer . "/" . basename($file));
}
$levelSoundEvent = $protocol . "/types/LevelSoundEvent.php";
$soundMap = $data . "/level_sound_id_map.json";
if(!is_file($protocolInfo) || !is_file($levelSoundEvent) || !is_file($soundMap)){
    throw new RuntimeException("Required Bedrock 1.26.44 files were not installed");
}

$info = file_get_contents($protocolInfo);
$info = str_replace("MINECRAFT_VERSION = 'v26.40'", "MINECRAFT_VERSION = 'v26.44'", $info);
$info = str_replace("MINECRAFT_VERSION_NETWORK = '1.26.40'", "MINECRAFT_VERSION_NETWORK = '1.26.44'", $info);
file_put_contents($protocolInfo, $info);

$map = json_decode(file_get_contents($soundMap), true, 512, JSON_THROW_ON_ERROR);
$sounds = file_get_contents($levelSoundEvent);
$sounds = preg_replace_callback(
    '/public const ([A-Z0-9_]+) = "([^"]+)";/',
    static function(array $m) use ($map) : string{
        return isset($map[$m[2]]) ? "public const {$m[1]} = {$map[$m[2]]};" : $m[0];
    },
    $sounds
);
file_put_contents($levelSoundEvent, $sounds);

// PM4's legacy LoginPacketHandler expects chainDataJwt, while modern BedrockProtocol
// exposes authInfoJson containing the certificate chain. Add a compatibility view once.
$loginPacket = $protocol . "/LoginPacket.php";
$login = file_get_contents($loginPacket);
if(strpos($login, 'public JwtChain $chainDataJwt;') === false){
    $login = str_replace(
        "use pocketmine\\network\\mcpe\\protocol\\serializer\\CommonTypes;\nuse function strlen;",
        "use pocketmine\\network\\mcpe\\protocol\\serializer\\CommonTypes;\nuse pocketmine\\network\\mcpe\\protocol\\types\\login\\JwtChain;\nuse function json_decode;\nuse function strlen;\nuse const JSON_THROW_ON_ERROR;",
        $login
    );
    $login = str_replace(
        "\tpublic string $clientDataJwt;",
        "\tpublic string $clientDataJwt;\n\t/** @internal Compatibility view for the legacy PM4 login handler. */\n\tpublic JwtChain $chainDataJwt;",
        $login
    );
    $login = str_replace(
        "\t\t$this->clientDataJwt = $connRequestReader->readByteArray($clientDataJwtLength);",
        "\t\t$this->clientDataJwt = $connRequestReader->readByteArray($clientDataJwtLength);\n\n\t\t// Modern Bedrock stores the JWT chain in authInfoJson.Certificate.\n\t\t$authInfo = json_decode($this->authInfoJson, associative: false, flags: JSON_THROW_ON_ERROR);\n\t\t$this->chainDataJwt = new JwtChain();\n\t\tif(is_object($authInfo) && isset($authInfo->Certificate)){\n\t\t\t$certificate = json_decode((string) $authInfo->Certificate, associative: false, flags: JSON_THROW_ON_ERROR);\n\t\t\tif(is_object($certificate) && isset($certificate->chain) && is_array($certificate->chain)){\n\t\t\t\t$this->chainDataJwt->chain = array_values(array_map(static fn(mixed $jwt) : string => (string) $jwt, $certificate->chain));\n\t\t\t}\n\t\t}",
        $login
    );
    file_put_contents($loginPacket, $login);
}
