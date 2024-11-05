<?php 

namespace App\Controllers;
use App\Controllers\BaseController;

class Login extends BaseController {

      protected $session, $usuario, $password1;

      public function __construct() {

            $this->session = session();

      }

            public function index(): string
            {
                return view('sign_in');
            }

      public function autorizar_login(){

                  $usuario = $this->request->getPost('usuario');
                  $contrasena = $this->request->getPost('password1');
           
                  if($usuario != 'evega') {
                
                        $data['error'] = "Usuario incorrecto.";  
                        echo view('login', $data);
                
                  }
                
                elseif($contrasena != 'evega1983' ) {

                        $data['error'] = "Contraseña incorrecta.";  
                        echo view('login', $data);

                  }

                  else {

                  
                    return redirect()->to(base_url('home'));
                  }
                                 
      }

      public function logout(){
          
            $this->session->destroy();
            return redirect()->to(base_url());
      }
  
    }

