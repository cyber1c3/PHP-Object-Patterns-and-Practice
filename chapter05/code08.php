<?php


namespace chapter05\code08 {
    class Debug
    {
        public static function helloWorld()
        {
            print "hello from Debug".PHP_EOL;
        }
    }
}


namespace other {
    use chapter05\code08\Debug;
    Debug::helloWorld();
}