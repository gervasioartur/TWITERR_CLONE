<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		$routes['home'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);
		
		$routes['inscreverse'] = array(
			'route' => '/inscreverse',
			'controller' => 'indexController',
			'action' => 'inscreverse'
		);

		$routes['registar'] = array(
			'route' => '/registrar',
			'controller' => 'indexController',
			'action' => 'registrar'
		);

		$routes['autenticar'] = array(
			'route' => '/autenticar',
			'controller' => 'AuthController',
			'action' => 'autenticar'
		);

		$routes['sair'] = array(
			'route' => '/sair',
			'controller' => 'AuthController',
			'action' => 'sair'
		);
		$routes['timeline'] = array(
			'route' => '/timeline',
			'controller' => 'AppController',
			'action' => 'timeline'
		);
		
		$routes['tweet'] = array(
			'route' => '/tweet',
			'controller' => 'AppController',
			'action' => 'tweet'
		);	
		$routes['quemSeguir'] = array(
			'route' => '/quemSeguir',
			'controller' => 'AppController',
			'action' => 'quemSeguir'
		);
		$routes['accao'] = array(
			'route' => '/accao',
			'controller' => 'AppController',
			'action' => 'accao'
		);

		$routes['removerTweet'] = array(
			'route' => '/removerTweet',
			'controller' => 'AppController',
			'action' => 'removerTweet'
		);

		$this->setRoutes($routes);
	}

}

?>