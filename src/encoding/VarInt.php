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

    public static function writeUnsignedInt(ByteBufferWriter $out, int $value) : void{
        $out->putUnsignedVarInt($value);
    }

    public static function writeSignedInt(ByteBufferWriter $out, int $value) : void{
        $out->putVarInt($value);
    }
}
