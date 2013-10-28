<?php
namespace Atomic;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Config\Definition\Processor;

use Atomic\Configuration\Configuration;
use Atomic\Twig\CodeExtension;


class Atomic
{

    protected $configuration = array();
    protected $template = array();
    protected $datas = array();

    public function __construct(){

        $this->configure();
        $this->initTwig();
        $this->initDatas();

        return $this;
    }

    public function render(){
        echo $this->template->render($this->datas);
    }

    private function initTwig(){

        //\Twig_Autoloader::register();

        $loader = new \Twig_Loader_Filesystem($this->configuration['template_dir']);

        $twig = new \Twig_Environment($loader, array(
            'cache' => $this->configuration['cache_dir'],
            'debug' => $this->configuration['debug'],
            'auto_reload' => $this->configuration['auto_reload'],
        ));

        $twig->addExtension(new CodeExtension($loader));

        $this->template = $twig->loadTemplate('tplOne.twig');
    }

    private function initDatas(){
        $this->datas = Yaml::parse(dirname($_SERVER['SCRIPT_FILENAME']).'/datas.yml');
        print_r($this->datas);
    }

    private function configure(){
        $config              = Yaml::parse(dirname($_SERVER['SCRIPT_FILENAME']).'/config.yml');
        $processor           = new Processor();
        $configuration       = new Configuration;
        $this->configuration = $processor->processConfiguration(
            $configuration,
            $config)
        ;
    }

}

