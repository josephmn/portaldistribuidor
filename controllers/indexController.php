<?php

class indexController extends Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->_view->setCss_Specific(
			array(
				'plugins/vendors/css/extensions/sweetalert2.min',
				'dist/css/bootstrap',
				'dist/css/colors',
				'dist/css/components',
				'dist/css/pages/page-auth',
				'plugins/vendors/css/extensions/ext-component-sweet-alerts'
			)
		);

		$this->_view->setJs_Specific(
			array(
				'plugins/vendors/js/jquery/jquery.min',
				'plugins/vendors/js/vendors.min',
				'plugins/vendors/js/extensions/sweetalert2.all.min',
				'dist/js/core/app-menu',
				'dist/js/core/app',
				'plugins/vendors/js/extensions/ext-component-sweet-alerts',
			)
		);

		$this->_view->setJs(array('index'));
		$this->_view->renderizar('index', true);
	}

	public function registro()
	{
		$this->_view->setCss_Specific(
			array(
				'plugins/vendors/css/extensions/sweetalert2.min',
				'dist/css/bootstrap',
				'dist/css/colors',
				'dist/css/components',
				'dist/css/pages/page-auth',
				'plugins/vendors/css/extensions/ext-component-sweet-alerts'
			)
		);

		$this->_view->setJs_Specific(
			array(
				'plugins/vendors/js/jquery/jquery.min',
				'plugins/vendors/js/vendors.min',
				'plugins/vendors/js/extensions/sweetalert2.all.min',
				'dist/js/core/app-menu',
				'dist/js/core/app',
				'plugins/vendors/js/extensions/ext-component-sweet-alerts',
			)
		);

		$this->_view->setJs(array('registro'));
		$this->_view->renderizar('registro', true);
	}

	public function recuperarclave()
	{
		$this->_view->setCss_Specific(
			array(
				'plugins/vendors/css/extensions/sweetalert2.min',
				'dist/css/bootstrap',
				'dist/css/colors',
				'dist/css/components',
				'dist/css/pages/page-auth',
				'plugins/vendors/css/extensions/ext-component-sweet-alerts'
			)
		);

		$this->_view->setJs_Specific(
			array(
				'plugins/vendors/js/jquery/jquery.min',
				'plugins/vendors/js/vendors.min',
				'plugins/vendors/js/extensions/sweetalert2.all.min',
				'dist/js/core/app-menu',
				'dist/js/core/app',
				'plugins/vendors/js/extensions/ext-component-sweet-alerts',
			)
		);

		$this->_view->setJs(array('recuperarclave'));
		$this->_view->renderizar('recuperarclave', true);
	}

	public function validarcorreo()
	{
		$this->_view->setCss_Specific(
			array(
				'plugins/vendors/css/extensions/sweetalert2.min',
				'dist/css/bootstrap',
				'dist/css/colors',
				'dist/css/components',
				'dist/css/pages/page-auth',
				'plugins/vendors/css/extensions/ext-component-sweet-alerts'
			)
		);

		$this->_view->setJs_Specific(
			array(
				'plugins/vendors/js/jquery/jquery.min',
				'plugins/vendors/js/vendors.min',
				'plugins/vendors/js/extensions/sweetalert2.all.min',
				'dist/js/core/app-menu',
				'dist/js/core/app',
				'plugins/vendors/js/extensions/ext-component-sweet-alerts',
			)
		);

		$this->_view->setJs(array('validarcorreo'));
		$this->_view->renderizar('validarcorreo', true);
	}

	public function enviarcorreo(){

		putenv("NLS_LANG=SPANISH_SPAIN.AL32UTF8");
		putenv("NLS_CHARACTERSET=AL32UTF8");

		$this->getLibrary('json_php/JSON');
		$json = new Services_JSON();

		$correo = $_POST['correo'];

		if (!empty($correo)){
			
			$wsdl = 'http://localhost:81/VDWEB/WSDistribuidor.asmx?WSDL';

			$options = array(
				"uri" => $wsdl,
				"style" => SOAP_RPC,
				"use" => SOAP_ENCODED,
				"soap_version" => SOAP_1_1,
				"connection_timeout" => 60,
				"trace" => false,
				"encoding" => "UTF-8",
				"exceptions" => false,
			);

			$param = array(
				"post" => 1, //reset correo
				"correo" => $correo,
			);

			$soap = new SoapClient($wsdl, $options);
			$result = $soap->RecuperarClave($param);
			$recuperacorreo = json_decode($result->RecuperarClaveResult, true);

			if (!empty($recuperacorreo)){
				
				$result2 = $soap->ConfiguracionCorreo();
				$conficorreo = json_decode($result2->ConfiguracionCorreoResult, true);

				$this->getLibrary('phpmailer/PHPMailer');
				$this->getLibrary('phpmailer/SMTP');
				
				$mail = new PHPMailer;
				
				$mail->isSMTP();
				$mail->SMTPDebug = 0;
				$mail->SMTPAuth = true;
				$mail->Mailer = 'smtp';
				$mail->Host = $conficorreo[0]['v_servidor_entrante']; //mail.cafealtomayo.com.pe
				$mail->Username = $conficorreo[0]['v_correo_salida']; //reportes@cafealtomayo.com.pe
				$mail->Password = $conficorreo[0]['v_password']; //rpt4m2020
				$mail->Port = $conficorreo[0]['i_puerto']; //25

				$mail->From = ($conficorreo[0]['v_correo_salida']); //reportes@cafealtomayo.com.pe
				$mail->FromName = $conficorreo[0]['v_nombre_salida']; // VERDUM PERÚ SAC
				//$mail->addReplyTo('reportes@cafealtomayo.com.pe', 'reportes');
				$mail->addAddress($recuperacorreo[0]['v_correo'],$recuperacorreo[0]['v_nombres']);
				$mail->Subject = 'SOLICITUD DE RECUPERACION DE CLAVE';
				
				$mail->isHTML(true);
				$mail->CharSet = "utf-8";
				$mail->Subject = 'PORTAL DISTRIBUIDOR - RECUPERACION DE CLAVE';
				$mail->Body = "
				Hola <b>".$recuperacorreo[0]['v_nombres']."</b>,
				<br>
				<br>
				Te enviamos la clave automática generada para el ingreso al portal web de reclutamiento.<br>
				<br>
				Clave: <b>".$recuperacorreo[0]['v_reset_clave']."</b>
				<br>
				<br>
				Favor de cuando ingrese cambiar la clave por seguridad.
				<br>
				<br>
				Saludo,<br>
				VERDUM PERU SAC.";
				
				if (!$mail->send()) {
					$output = 3; //	ERROR AL ENVIAR CORREO
				} else {
					$output = 1; // SE ENVIO CORRECTAMENTE
				}

			}else{
				$output = 2; //NO SE ENCONTRO CORREO EN LA BASE DE DATOS
			}

		}else{
			$output = 0; // NO HA INGRESADO CORREO
		}

		header('Content-type: application/json; charset=utf-8');
    
		echo $json->encode(
			array(
				"dato"	=>	$output,
			)
		);

	}

	public function correoexiste()
	{

		putenv("NLS_LANG=SPANISH_SPAIN.AL32UTF8");
		putenv("NLS_CHARACTERSET=AL32UTF8");

		$this->getLibrary('json_php/JSON');
		$json = new Services_JSON();
		
		$correo = $_POST['correo'];

		if (!empty($correo)){
			
			$wsdl = 'http://localhost:81/VDWEB/WSDistribuidor.asmx?WSDL';

			$options = array(
				"uri" => $wsdl,
				"style" => SOAP_RPC,
				"use" => SOAP_ENCODED,
				"soap_version" => SOAP_1_1,
				"connection_timeout" => 60,
				"trace" => false,
				"encoding" => "UTF-8",
				"exceptions" => false,
			);

			$param = array(
				'post'		=> 2, //para consultar
				"correo" 	=> $correo,
			);

			$soap = new SoapClient($wsdl, $options);
			$result = $soap->RecuperarClave($param);
			$recuperacorreo = json_decode($result->RecuperarClaveResult, true);

			if (!empty($recuperacorreo)){

				$params2 = array(
					'post'		=> 2, //reset y consulta
					'correo' 	=> $correo,
				);
	
				$result = $soap->RegistroConsulta($params2);
				$registroconsulta = json_decode($result->RegistroConsultaResult, true);

				$result2 = $soap->ConfiguracionCorreo();
				$conficorreo = json_decode($result2->ConfiguracionCorreoResult, true);
		
				// envio de correo automatico de validacion de correo
				$this->getLibrary('phpmailer/PHPMailer');
				$this->getLibrary('phpmailer/SMTP');
	
				$mail = new PHPMailer;
	
				$mail->isSMTP();
				$mail->SMTPDebug = false;
				$mail->SMTPAuth = true; //Habilita uso de usuario y contraseña
				//$mail->SMTPSecure = 'tls'; //tls o ssl, configuracion de correo personalizado Ejem: gmail (ssl)
				$mail->Mailer = 'smtp';
				$mail->Host = $conficorreo[0]['v_servidor_entrante']; //mail.cafealtomayo.com.pe
				$mail->Username = $conficorreo[0]['v_correo_salida']; //reportes@cafealtomayo.com.pe
				$mail->Password = $conficorreo[0]['v_password']; //rpt4m2020
				$mail->Port = $conficorreo[0]['i_puerto']; //25
	
				// $mail->From = ('reportes@cafealtomayo.com.pe');
				$mail->From = ($conficorreo[0]['v_correo_salida']); //reportes@cafealtomayo.com.pe
				$mail->FromName = $conficorreo[0]['v_nombre_salida']; // VERDUM PERÚ SAC
				// $mail->addReplyTo('reportes@cafealtomayo.com.pe', 'noreplay verdum');
				$mail->addAddress($registroconsulta[0]['v_correo'], ($registroconsulta[0]['v_nombres'] . ' ' . $registroconsulta[0]['v_apellidos']));
				$mail->Subject = 'VALIDACIÓN DE CORREO ELECTRÓNICO';
	
				$mail->isHTML(true);
				$mail->CharSet = "utf-8";
				$mail->Subject = 'VALIDACIÓN DE CORREO ELECTRÓNICO';
				$mail->Body = "
				Hola <b>" . ($registroconsulta[0]['v_nombres'] . ' ' . $registroconsulta[0]['v_apellidos']) . ",</b>
				<br>
				<br>
				Te enviamos la clave de confirmación para poder válidar sus datos y correo.
				<br>
				<br>
				Clave: <b>" . $registroconsulta[0]['i_clave_confirmacion'] . "</b>
				<br>
				<br>
				Saludo,<br>
				Verdum Perú S.A.C.";

				if (!$mail->send()) {
					$output = 4; //	ERROR AL ENVIAR CORREO
				} else {
					$output = 1; // SE ENVIO CORRECTAMENTE
				}

			}else{
				$output = 2; //NO SE ENCONTRO CORREO EN LA BASE DE DATOS
			}

		}else{
			$output = 3; // NO HA INGRESADO CORREO
		}

		header('Content-type: application/json; charset=utf-8');

		echo $json->encode(
			array(
				"dato" => $output,
			)
		);

	}

	public function nuevoregistro()
	{

		putenv("NLS_LANG=SPANISH_SPAIN.AL32UTF8");
		putenv("NLS_CHARACTERSET=AL32UTF8");

		$this->getLibrary('json_php/JSON');
		$json = new Services_JSON();

		$nombre = $_POST['nombre'];
		$apellidos = $_POST['apellidos'];
		$correo = $_POST['correo'];
		$password = $_POST['password'];
		$perfil = 3; //usuario normal

		$wsdl = 'http://localhost:81/VDWEB/WSDistribuidor.asmx?WSDL';

		$options = array(
			"uri" => $wsdl,
			"style" => SOAP_RPC,
			"use" => SOAP_ENCODED,
			"soap_version" => SOAP_1_1,
			"connection_timeout" => 60,
			"trace" => false,
			"encoding" => "UTF-8",
			"exceptions" => false,
		);

		$soap = new SoapClient($wsdl, $options);

		$params = array(
			'nombres'		=> $nombre,
			'apellidos' 	=> $apellidos,
			'correo' 		=> $correo,
			'clave' 		=> $password,
			'perfil' 		=> intval($perfil),
		);

		$result = $soap->RegistroLogin($params);
		$registro = json_decode($result->RegistroLoginResult, true);

		$output = 0;

		if ($registro[0]['v_respuesta'] == 2) {

			$params2 = array(
				'post'		=> 1, //consulta
				'correo' 	=> $correo,
			);

			$result = $soap->RegistroConsulta($params2);
			$registroconsulta = json_decode($result->RegistroConsultaResult, true);

			$result2 = $soap->ConfiguracionCorreo();
			$conficorreo = json_decode($result2->ConfiguracionCorreoResult, true);

			// envio de correo automatico de validacion de correo
			$this->getLibrary('phpmailer/PHPMailer');
			$this->getLibrary('phpmailer/SMTP');

			$mail = new PHPMailer;

			$mail->isSMTP();
			$mail->SMTPDebug = false;
			$mail->SMTPAuth = true; //Habilita uso de usuario y contraseña
			//$mail->SMTPSecure = 'tls'; //tls o ssl, configuracion de correo personalizado Ejem: gmail (ssl)
			$mail->Mailer = 'smtp';
			$mail->Host = $conficorreo[0]['v_servidor_entrante']; //mail.cafealtomayo.com.pe
			$mail->Username = $conficorreo[0]['v_correo_salida']; //reportes@cafealtomayo.com.pe
			$mail->Password = $conficorreo[0]['v_password']; //rpt4m2020
			$mail->Port = $conficorreo[0]['i_puerto']; //25

			// $mail->From = ('reportes@cafealtomayo.com.pe');
			$mail->From = ($conficorreo[0]['v_correo_salida']); //reportes@cafealtomayo.com.pe
			$mail->FromName = $conficorreo[0]['v_nombre_salida']; // VERDUM PERÚ SAC
			// $mail->addReplyTo('reportes@cafealtomayo.com.pe', 'noreplay verdum');
			$mail->addAddress($registroconsulta[0]['v_correo'], ($registroconsulta[0]['v_nombres'] . ' ' . $registroconsulta[0]['v_apellidos']));
			$mail->Subject = 'VALIDACIÓN DE CORREO ELECTRÓNICO';

			$mail->isHTML(true);
			$mail->CharSet = "utf-8";
			$mail->Subject = 'VALIDACIÓN DE CORREO ELECTRÓNICO';
			$mail->Body = "
			Hola <b>" . ($registroconsulta[0]['v_nombres'] . ' ' . $registroconsulta[0]['v_apellidos']) . ",</b>
			<br>
			<br>
			Te enviamos la clave de confirmacion para poder válidar sus datos y correo.<br>
			<br>
			Clave: <b>" . $registroconsulta[0]['i_clave_confirmacion'] . "</b>
			<br>
			<br>
			Saludo,<br>
			Verdum Perú S.A.C.";

			if (!$mail->send()) {
				$output = 0; //	ERROR AL ENVIAR CORREO
			} else {
				$output = 1; // SE ENVIO CORRECTAMENTE

				//creamos su carpeta para el almacenamiento de sus archivos CV
				$micarpeta = "public/doc/documentos/".$registroconsulta[0]['v_correo'];
				// $micarpeta = '/ruta/miserver/public_html/carpeta';
				if (!file_exists($micarpeta)) {
					mkdir($micarpeta, 0777, true);
				}
			}

			header('Content-type: application/json; charset=utf-8');

			echo $json->encode(
				array(
					"registro" => $registro[0]['v_respuesta'],
					"correo" => $output,
				)
			);
		} else {
			header('Content-type: application/json; charset=utf-8');

			echo $json->encode(
				array(
					"registro" => $registro[0]['v_respuesta'], // 0 ya se encuentra correo registrado
					"correo" => $output, // 0 no se envía correo
				)
			);
		}
	}

	public function validarcodigo()
	{
		putenv("NLS_LANG=SPANISH_SPAIN.AL32UTF8");
		putenv("NLS_CHARACTERSET=AL32UTF8");

		$this->getLibrary('json_php/JSON');
		$json = new Services_JSON();

		$codigo = $_POST['codigo'];
		$email = $_POST['email'];

		$wsdl = 'http://localhost:81/VDWEB/WSDistribuidor.asmx?WSDL';

		$options = array(
			"uri" => $wsdl,
			"style" => SOAP_RPC,
			"use" => SOAP_ENCODED,
			"soap_version" => SOAP_1_1,
			"connection_timeout" => 60,
			"trace" => false,
			"encoding" => "UTF-8",
			"exceptions" => false,
		);

		$soap = new SoapClient($wsdl, $options);

		$params = array(
			'codigo'	=> $codigo,
			'correo'	=> $email,
		);

		$result = $soap->ValidarCodigo($params);
		$validacion = json_decode($result->ValidarCodigoResult, true);

		header('Content-type: application/json; charset=utf-8');

		echo $json->encode(
			array(
				"validacion" => intval($validacion[0]['v_respuesta']),
			)
		);
	}

	public function login()
	{
		putenv("NLS_LANG=SPANISH_SPAIN.AL32UTF8");
		putenv("NLS_CHARACTERSET=AL32UTF8");

		$this->getLibrary('json_php/JSON');
		$json = new Services_JSON();

		$correo = trim($_POST['correo']);
		$clave = md5($_POST['clave']);

		// $correo = trim($_POST['josephcarlos.jcmn@gmail.com']);
		// $clave = md5($_POST['123456789']);

		// $correo = "josephcarlos.jcmn@gmail.com";
		// $clave = "25f9e794323b453885f5181f1b624d0b";

		$wsdl = 'http://localhost:81/VDWEB/WSDistribuidor.asmx?WSDL';

		$options = array(
			"uri" => $wsdl,
			"style" => SOAP_RPC,
			"use" => SOAP_ENCODED,
			"soap_version" => SOAP_1_1,
			"connection_timeout" => 60,
			"trace" => false,
			"encoding" => "UTF-8",
			"exceptions" => false,
		);

		$param = array(
			"correo" => $correo,
			"clave"	=> $clave,
		);

		$soap = new SoapClient($wsdl, $options);

		$result = $soap->Login($param);
		$login = json_decode($result->LoginResult, true);

		$estado = 2; //user no existe
		$url = ""; //url vacío

		// validamos que el logueo sea correcto
		if ($login[0]['v_existe'] == 1) {

			// PARA OBTENER LOS MENUS
			$param1 = array(
				"perfil" => $login[0]['i_perfil']
			);
			$result1 = $soap->Menu($param1);
			$menu = json_decode($result1->MenuResult, true);

			// PARA OBTENER LOS SUBMENUS
			$param2 = array(
				"perfil" => $login[0]['i_perfil']
			);
			$result2 = $soap->SubMenu($param2);
			$submenu = json_decode($result2->SubMenuResult, true);

			$estado = 1; // logueo exitoso
			$url = "/portaldistribuidor/" . $menu[0]['v_link'] . "/index";

			$_SESSION['id'] = $login[0]['i_id'];
			$_SESSION['usuario'] = $login[0]['v_nombres'] . ', ' . $login[0]['v_apellidos'];
			$_SESSION['correo'] = $login[0]['v_correo'];
			$_SESSION['perfil'] = $login[0]['v_perfil'];
			$_SESSION['ruc'] = $login[0]['v_ruc'];
			$_SESSION['menus'] = $menu;
			$_SESSION['submenus'] = $submenu;
			$_SESSION['selmenu'] = "perfil";
			$_SESSION['selsubmenu'] = "";
			$_SESSION['despliegue'] = "";
			$_SESSION['foto'] = $login[0]['v_foto'];
		} else if ($login[0]['v_existe'] == 0) {
			$estado = 0; //clave incorrecta
			$url = "";
		};

		header('Content-type: application/json; charset=utf-8');

		echo $json->encode(
			array(
				"estado" => intval($estado),
				"url" => $url,
			)
		);
	}

	public function logout()
	{
		if (isset($_SESSION['usuario'])) {
			session_destroy();
			unset($_SESSION['usuario']);
			$this->redireccionar('index');
		} else {
			session_destroy();
			unset($_SESSION['usuario']);
			$this->redireccionar('index');
		}
	}
}
?>