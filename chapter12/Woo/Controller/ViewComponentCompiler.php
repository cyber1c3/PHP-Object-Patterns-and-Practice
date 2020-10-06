<?php


class ViewComponentCompiler
{
    private static string $defaultcmd = DefaultCommand::class;

    public function parseFile($file)
    {
        $options = simplexml_load_file($file);
        return $this->parse($options);
    }

    private function parse(SimpleXMLElement $options): Conf
    {
        $conf = new Conf();

        foreach ($options->control->command as $command) {
            $path = (string) $command['path'];
            $cmdstr = (string) $command['class'];
            $path = empty($path) ? '/' : $path;
            $cmdstr = empty($cmdstr) ? self::$defaultcmd : $cmdstr;
            $pathobj = new ComponentDescriptor($path, $cmdstr);

            $this->processView($pathobj, 0, $command);

            if (isset($command->status) && isset($command->status['value'])) {
                foreach ($command->status as $statusel) {
                    $status = (string) $statusel['value'];
                    $statusval = constant(Command::class."::".$status);

                    if (is_null($statusval))
                        throw new AppException("unknown status: $status");

                    $this->processView($pathobj, $statusval, $statusel);
                }
            }

            $conf->set($path, $pathobj);
        }

        return $conf;
    }

    // 在这停顿
}