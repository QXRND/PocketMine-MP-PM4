<?php
declare(strict_types=1);
namespace pmmp\thread;
/**
 * PM4 compatibility shim for the modern pmmp/thread API.
 * PM4 uses pthreads directly, so Threaded is the correct shared base.
 */
abstract class ThreadSafe extends \Threaded{
}
