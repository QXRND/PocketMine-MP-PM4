<?php
declare(strict_types=1);

namespace pmmp\encoding;

final class VarInt{
    public static function readUnsignedInt(ByteBufferReader $in) : int{
        return $in->getUnsignedVarInt();
    }

    public static function readSignedInt(ByteBufferReader $in) : int{
        return $in->getVarInt();
    }

    public static function readUnsignedLong(ByteBufferReader $in) : int{
        return $in->getUnsignedVarLong();
    }

    public static function readSignedLong(ByteBufferReader $in) : int{
        return $in->getVarLong();
    }

    public static function writeUnsignedInt(ByteBufferWriter $out, int $value) : void{
        $out->putUnsignedVarInt($value);
    }

    public static function writeSignedInt(ByteBufferWriter $out, int $value) : void{
        $out->putVarInt($value);
    }

    public static function writeUnsignedLong(ByteBufferWriter $out, int $value) : void{
        $out->putUnsignedVarLong($value);
    }

    public static function writeSignedLong(ByteBufferWriter $out, int $value) : void{
        $out->putVarLong($value);
    }

    public static function unpackUnsignedInt(string $buffer) : int{
        $value = 0;
        $shift = 0;
        $length = strlen($buffer);
        for($i = 0; $i < $length && $i < 5; ++$i){
            $byte = ord($buffer[$i]);
            $value |= ($byte & 0x7f) << $shift;
            if(($byte & 0x80) === 0){
                return $value;
            }
            $shift += 7;
        }
        throw new \UnexpectedValueException('Invalid unsigned varint');
    }
}
