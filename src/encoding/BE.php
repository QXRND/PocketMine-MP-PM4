<?php
declare(strict_types=1);

namespace pmmp\encoding;

final class BE{
    public static function readUnsignedInt(ByteBufferReader $in) : int{
        $value = unpack('N', $in->readByteArray(4));
        if($value === false){
            throw new \UnexpectedValueException('Unable to decode big-endian unsigned int');
        }
        return (int) $value[1];
    }

    public static function writeUnsignedInt(ByteBufferWriter $out, int $value) : void{
        if($value < 0 || $value > 0xffffffff){
            throw new \InvalidArgumentException('Big-endian unsigned int out of range');
        }
        $out->writeByteArray(pack('N', $value));
    }
}
