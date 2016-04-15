<?php

namespace FanFerret\DevelopmentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Parser;

class DefaultController extends Controller
{
	/**
	 * @Route("/", name="fan_ferret_development_homepage" )
	 *
	 **/
    public function indexAction()
    {
        return $this->render('FanFerretDevelopmentBundle:Default:index.html.twig');
    }
	
	/**
	 * @Route("/template/{twigname}", name="fan_ferret_development_template" )
	 *
	 **/
    public function templateAction($twigname="index")
    {
        $param = $this->getYaml(__DIR__ ."/../Tests/data-sample.yml");
		$param =  ($param === null) ? array() : $param;
		
		// flatten out configurations
		if (is_array($param['configuration'])) {
			$count = 1;
			foreach ($param['configuration'] as $config){
				if (isset($config['type']) && isset($config['name']) && isset($config['value'])){
					$typeFlag = preg_match('/(css|image|template)$/', $config['type'], $mtype);
					$nameFlag = preg_match('/^[a-z]\w+$/', $config['name'], $mname);
					if( $typeFlag  && $nameFlag ){
						$param['config'][$config['type']][$config['name']] = $config['value'];
					}
					else {
						$message = 'Item: '. $count .' Error parsing configuration. ';
						$message .= $typeFlag ? '' : 'Property type can only be {css|image|template}. ';
						$message .= $nameFlag ? '' : 'Property name has to start with lowercase, and can only be alphanumeric. ';
						$param['errors'][] = $message . json_encode($config);
					}
					
				}
				else {
					$message = 'Item: '. $count . ' Error parsing configuration.  Require fields type, name, and value';
					$param['errors'][] = $message;
				}
				++$count;
				
			}
		}
		
        return $this->render('FanFerretDevelopmentBundle:Default:'. $twigname .'.html.twig',$param);
    }

    /**
	 * reads yaml files
	 *
	 * @param string filename
	 * 
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
