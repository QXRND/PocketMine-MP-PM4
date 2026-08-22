<?php
declare(strict_types=1);
namespace pmmp\encoding;
final class Byte{
    public static function readUnsigned(ByteBufferReader $in) : int{ return $in->readByte(); }
    public static function readSigned(ByteBufferReader $in) : int{ $v = $in->readByte(); return $v >= 128 ? $v - 256 : $v; }
    public static function writeUnsigned(ByteBufferWriter $out, int $value) : void{ if($value < 0 || $value > 255){ throw new \InvalidArgumentException('Unsigned byte out of range'); } $out->writeByte($value); }
    public static function writeSigned(ByteBufferWriter $out, int $value) : void{ if($value < -128 || $value > 127){ throw new \InvalidArgumentException('Signed byte out of range'); } $out->writeByte($value & 0xff); }
}
