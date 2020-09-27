<?php


namespace chapter04\code12;


class XmlException extends \Exception
{
    private $error;

    public function __construct(\LibXMLError $error)
    {
        $shortfile = basename($error->file);
        $msg = "[{$shortfile}, line {$error->line}, col {$error->column}] {$error->message}";
        $this->error = $error;
        parent::__construct($msg, $error->code);
    }

    public function getLibXmlError()
    {
        return $this->error;
    }
}


class FileException extends \Exception{}


class ConfException extends \Exception{}


class Conf
{
    private $file;
    private $xml;
    private $lastmatch;


    public function __construct(string $file)
    {
        $this->file = $file;

        if (!file_exists($file)) {
            throw new FileException("file '$file' does not exist");
        }

        $this->xml = simplexml_load_file($file, null, LIBXML_NOERROR);

        if (!is_object($this->xml)) {
            throw new XmlException(libxml_get_last_error());
        }

        $matches = $this->xml->xpath("/conf");

        if (!count($matches)) {
            throw new ConfException("could not find root element: conf");
        }
    }

    public function write()
    {
        if (!is_writable($this->file)) {
            throw new \Exception("file '$this->file' does not writeable");
        }

        file_put_contents($this->file, $this->xml->asXML());
    }

    public function get(string $str)
    {
        $matchs = $this->xml->xpath("/conf/item[@name=\"$str\"]");

        if (count($matchs)) {
            $this->lastmatch = $matchs[0];
            return (string)$matchs[0];
        }

        return null;
    }

    public function set(string $key, string $value)
    {
        if (!is_null($this->get($key))) {
            $this->lastmatch[0] = $value;
            return;
        }

        $conf = $this->xml->conf;
        $this->xml->addChild('item', $value)->addAttribute('name', $key);
    }

    public static function init()
    {
        try {
            $fh = fopen(__DIR__."/log.txt", 'a');
            fputs($fh, "start\n");

            $conf = new Conf(__DIR__."/conf.wrong.xml");
            print "user: ".$conf->get('user').PHP_EOL;
            print "host: ".$conf->get('host').PHP_EOL;
            $conf->set("pass", "newpass");
            $conf->write();
        } catch (FileException $e) {
            fputs($fh, "file exception\n");
            throw $e;
        } catch (XmlException $e) {
            fputs($fh, "xml exception\n");
            throw $e;
        } catch (ConfException $e) {
            fputs($fh, "conf exception\n");
            throw $e;
        } catch (\Exception $e) {
            fputs($fh, "general exception\n");
            throw $e;
        } finally {
            fputs($fh, "end\n");
            fclose($fh);
        }
    }
}


Conf::init();