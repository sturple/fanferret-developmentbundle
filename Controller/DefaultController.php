<?php

namespace FanFerret\DevelopmentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Parser;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FanFerretDevelopmentBundle:Default:index.html.twig');
    }

    public function templateAction($twigname="index")
    {
        $param = $this->getYaml(__DIR__ ."/../Tests/data-sample.yml");
		$param =  ($param === null) ? array() : $param;
        return $this->render('FanFerretDevelopmentBundle:Default:'. $twigname .'.html.twig',$param);
    }

    /**
	 * reads yaml files
	 *
	 * @param string filename
	 */
	private function getYaml($filename)
	{
		$yaml = new Parser();
		$param = array();
		if (!file_exists($filename)){
			$error_str = 'Yaml Config file "' . $filename .'" does not exists';
			throw $this->createNotFoundException($error_str);
			return array();
		}
		try {
			$param = $yaml->parse(file_get_contents($filename));
		}catch (ParseException $e) {
			$error_str = 'Yaml Parse error '.print_R($e->getMessage(),true);
            throw $this->createNotFoundException($error_str);
			return array();
		}

		return $param;

	}
}
