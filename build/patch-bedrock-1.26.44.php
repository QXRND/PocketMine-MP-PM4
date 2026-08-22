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
