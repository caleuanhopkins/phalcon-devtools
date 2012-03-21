<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Framework                                                      |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2012 Phalcon Team (http://www.phalconphp.com)       |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file docs/LICENSE.txt.                        |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
  |          Eduar Carvajal <eduar@phalconphp.com>                         |
  +------------------------------------------------------------------------+
*/

if(isset($_SERVER['phToolsPath'])){
	chdir($_SERVER['phToolsPath']);
}

require_once 'Script/Script.php';
require_once 'Script/Color/ScriptColor.php';
require_once 'Builder/Builder.php';

use Phalcon_Builder as Builder;

/**
 * CreateApplication
 *
 * Create the skeleton of an application.
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright	Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
class CreateProject extends Phalcon_Script {

	public function __construct(){

		$posibleParameters = array(
			'directory=s'       => "--directory path Base path on which project will be created",
			'help'		=> "--help \t\t Show help"
		);

		$this->parseParameters($posibleParameters);
		if($this->isReceivedOption('help')){
			$this->showHelp($posibleParameters);
			return;
		}

    $parameters = $this->getParameters();
    if(isset($parameters[1])){
      $name = $parameters[1];
    } else {
      $name = "";
    }

		$modelBuilder = Builder::factory('Application', array(
      'name' => $name,
      'directory' => $this->getOption('directory')
    ));
		$modelBuilder->build();
  }
}

try {
	$script = new CreateProject();
}
catch(Phalcon_Exception $e){
	echo get_class($e), ' : ', $e->getMessage(), "\n";
}


