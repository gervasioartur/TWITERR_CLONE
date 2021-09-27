<?php

namespace App\Controllers;

use App\Models\Usuario;
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {
    
    public function timeline (){
        if($this->validaAutenticacao()){
            $tweet =  Container::getModel('Tweet');
            $tweet->__set('id_usuario',$_SESSION['id']);
            $tweets =  $tweet->getAll();
            $this->view->tweets = $tweets;
            $this->carregarUsuarioDados();
            $this->render('timeline');
        }  
    }

    public function carregarUsuarioDados(){
        $usuario = Container::getModel('Usuario');
        $usuario->__set('id', $_SESSION['id']);            $this->view->info_usuario = $usuario->getInfoUsuario();
        $this->view->total_tweets = $usuario->getTotalTweets();
        $this->view->total_seguidores = $usuario->getTotalSeguindo();
        $this->view->total_seguindo = $usuario->getTotalSeguidores();
    }

    public function tweet(){       
        if($this->validaAutenticacao()){
            $tweet =  Container::getModel('Tweet');
            $tweet->__set('tweet',$_POST['tweet']);
            $tweet->__set('id_usuario',$_SESSION['id']);
            $tweet->salvar();
            header('Location: /timeline'); 
        }    
    }

    public function validaAutenticacao(){
        session_start();
        return (isset($_SESSION['id'])|| $_SESSION['id'] != '' ) || (isset($_SESSION['nome'])|| $_SESSION['nome'] != '' )  ? true :  header('Location: /?login=erro');
    }

    public function quemSeguir(){
        if($this->validaAutenticacao()){
            $this->carregarUsuarioDados();
            $pesquisarPor = isset($_GET['pesquisarPor']) ? $_GET['pesquisarPor'] : '';
            $usuarios = array();
            if($pesquisarPor != ''){
                 $usuario = Container::getModel('Usuario');
                 $usuario->__set('nome', $pesquisarPor);
                 $usuario->__set('id', $_SESSION['id']);
                 $usuarios = $usuario->getAll();
            }
            $this->view->usuarios = $usuarios;
            $this->render('quemSeguir');
        }
    }

    public function  accao(){

        if($this->validaAutenticacao()){
          $accao = isset($_GET['accao']) ? $_GET['accao'] : '';
          $id_usuario_seguindo = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : '';
          $usuario = Container::getModel('Usuario');
          $usuario->__set('id', $_SESSION['id']);

          if($accao == 'seguir'){
            $usuario->seguir($id_usuario_seguindo);
          }else if($accao == 'deixar_de_seguir'){
            $usuario->deixarSeguir($id_usuario_seguindo);
          }
         
          header('Location: /quemSeguir');

        }
    }

    public function removerTweet(){
        if($this->validaAutenticacao()){
            $tweet_id = isset($_GET['tweet_id']) ? $_GET['tweet_id'] : 'nada' ;
            $tweet = Container::getModel('Tweet');
            $tweet->__set('id', $tweet_id);
            $tweet->__set('id_usuario', $_SESSION['id']);
            $tweet->apagar();
            header('Location: /timeline');
        }
        return false;
    }
}
