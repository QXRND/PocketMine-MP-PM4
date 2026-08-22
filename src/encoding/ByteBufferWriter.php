<?php
declare(strict_types=1);

namespace pmmp\encoding;

class ByteBufferWriter extends ByteBufferReader{
    public function writeByteArray(string $data) : void{
        $this->put($data);
    }

    public function writeByte(int $value) : void{
        $this->putByte($value);
    }
}
