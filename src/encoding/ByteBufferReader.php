<?php
declare(strict_types=1);

namespace pmmp\encoding;

use pocketmine\utils\BinaryStream;

class ByteBufferReader extends BinaryStream{
    public function readByteArray(int $length) : string{
        return $this->get($length);
    }

    public function getData() : string{
        return $this->getBuffer();
    }

    public function getUnreadLength() : int{
        return strlen($this->getBuffer()) - $this->getOffset();
    }

    public function readByte() : int{
        return $this->getByte();
    }
}
