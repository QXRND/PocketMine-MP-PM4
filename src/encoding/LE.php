<?php
declare(strict_types=1);
namespace pmmp\encoding;
use pocketmine\utils\Binary;
final class LE{
    public static function readUnsignedShort(ByteBufferReader $in) : int{ return Binary::readLShort($in->readByteArray(2)); }
    public static function readSignedShort(ByteBufferReader $in) : int{ return Binary::readSignedLShort($in->readByteArray(2)); }
    public static function readUnsignedInt(ByteBufferReader $in) : int{ return Binary::readLInt($in->readByteArray(4)); }
    public static function readSignedInt(ByteBufferReader $in) : int{ return Binary::signInt(Binary::readLInt($in->readByteArray(4))); }
    public static function readUnsignedLong(ByteBufferReader $in) : int{ return Binary::readLLong($in->readByteArray(8)); }
    public static function readSignedLong(ByteBufferReader $in) : int{ return Binary::readLLong($in->readByteArray(8)); }
    public static function readFloat(ByteBufferReader $in) : float{ return Binary::readLFloat($in->readByteArray(4)); }
    public static function readDouble(ByteBufferReader $in) : float{ return Binary::readLDouble($in->readByteArray(8)); }
    public static function writeUnsignedShort(ByteBufferWriter $out, int $value) : void{ $out->writeByteArray(Binary::writeLShort($value)); }
    public static function writeSignedShort(ByteBufferWriter $out, int $value) : void{ $out->writeByteArray(Binary::writeLShort($value)); }
    public static function writeUnsignedInt(ByteBufferWriter $out, int $value) : void{ $out->writeByteArray(Binary::writeLInt($value)); }
    public static function writeSignedInt(ByteBufferWriter $out, int $value) : void{ $out->writeByteArray(Binary::writeLInt($value)); }
    public static function writeUnsignedLong(ByteBufferWriter $out, int $value) : void{ $out->writeByteArray(Binary::writeLLong($value)); }
    public static function writeSignedLong(ByteBufferWriter $out, int $value) : void{ $out->writeByteArray(Binary::writeLLong($value)); }
    public static function writeFloat(ByteBufferWriter $out, float $value) : void{ $out->writeByteArray(Binary::writeLFloat($value)); }
    public static function writeDouble(ByteBufferWriter $out, float $value) : void{ $out->writeByteArray(Binary::writeLDouble($value)); }
}
