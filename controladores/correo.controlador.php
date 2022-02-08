<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "extensiones/PHPMailer/Exception.php";
require_once "extensiones/PHPMailer/PHPMailer.php";
require_once "extensiones/PHPMailer/SMTP.php";

class ControladorCorreo {

    /*========================
	CORREO ENVIO DE CODIGO VERFICACION
	========================*/
	public static function ctrCorreoCodigoVerificacion($correo, $codigoContrasena){

		$mensaje = '';
		$correoEnvia = 'mantenimientoags@agsamericas.com';
		$contrasenaEnvia = '@ags2021*';

		$mail = new PHPMailer(true);

		try {

			$mail->SMTPOptions = array(

				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);

			$mensaje .= '<body style="background-color: #F5F5F5; height: 440px;">
				<br>
			
				<center>
				
					<div style="float: center; background-color: white; width: 600px; height: 400px; border-radius: 20px; border: 1px solid #929292;">
						<br>
						<center><b><h2 style="color: #e0e65e">RESTABLECER CONTRASEÑA DE SOFTWARE SOFT <h4>http://54.39.49.44/soft/</h4></h2></b></center>
						<hr>
						<h3>El Código de Verificación para el restablecimiento de contraseña es:</h3><br>
						<center><div style="background-color: #e0e65e;"><h2><b>'.$codigoContrasena.'</b></h2></div></center>
						<br>
						<img src="http://54.39.49.44/ags.png" style="width: 130px; height: 70px;">
				
					</div>
				
				</center>
			
			</body>';
			
			
			$codigoContrasena;

		    $mail->SMTPDebug = 0;
		    $mail->isSMTP();
		    $mail->Host       = 'smtp.agsamericas.com';              
		    $mail->SMTPAuth   = true;                                   
		    $mail->Username   = $correoEnvia;                    
		    $mail->Password   = $contrasenaEnvia;                    
		    $mail->SMTPSecure = 'tls';        
		    $mail->Port       = 25;
		    $mail->CharSet = 'UTF-8';
		    
		    $mail->setFrom($correoEnvia, 'Soft AGS');
		    $mail->addAddress($correo);

		    $mail->isHTML(true);
		    $mail->Subject = '¡Código de Verificación para Restaurar tu Contraseña!';
		    $mail->Body = $mensaje;

		    $mail->send();

            return "ok";

		} catch (Exception $e) {
    		echo "Message could not be sent. Mailer Error: <br>{$mail->ErrorInfo}";
		}


	}

    /*========================
	CORREO ENVIO DE NUEVA CONTRASEÑA
	========================*/
	public static function ctrCorreoNuevaContrasena($idUsuario, $cadenaContrasenia){

        $item = "id_usuario";
        $valor = $idUsuario;

        $infoUsuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
        $correo = $infoUsuario["correo"];


		$correoEnvia = 'mantenimientoags@agsamericas.com';
		$contrasenaEnvia = '@ags2021*';

		$mensaje = '';

		$mail = new PHPMailer(true);

		try {

			$mail->SMTPOptions = array(

				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);

			$mensaje .= '<body style="background-color: #F5F5F5; height: 440px;">
				<br>
			
				<center>
				
					<div style="float: center; background-color: white; width: 600px; height: 400px; border-radius: 20px; border: 1px solid #929292;">
						<br>
						<center><b><h2 style="color: #e0e65e">NUEVA CONTRASEÑA ASIGNADA A SOFTWARE <h4>http://54.39.49.44/soft/</h4></h2></b></center>
						<hr>
						<h3>La nueva contraseña generada para su usuario es:</h3><br>
						<center><div style="background-color: #e0e65e;"><h2><b>'.$cadenaContrasenia.'</b></h2></div></center>
						<br>
						<img src="http://54.39.49.44/ags.png" style="width: 130px; height: 70px;">
				
					</div>
				
				</center>
			
			</body>';

		    $mail->SMTPDebug = 0;
		    $mail->isSMTP();
		    $mail->Host       = 'smtp.agsamericas.com';              
		    $mail->SMTPAuth   = true;                                   
		    $mail->Username   = $correoEnvia;                    
		    $mail->Password   = $contrasenaEnvia;                    
		    $mail->SMTPSecure = 'tls';        
		    $mail->Port       = 25;
		    $mail->CharSet = 'UTF-8';
		    
		    $mail->setFrom($correoEnvia, 'Soft AGS');
		    $mail->addAddress($correo);

		    $mail->isHTML(true);
		    $mail->Subject = '¡Nueva Contraseña Asignada en Software AGS!';
		    $mail->Body = $mensaje;

		    $mail->send();

            return "ok";

		} catch (Exception $e) {
    		echo "Message could not be sent. Mailer Error: <br>{$mail->ErrorInfo}";
		}


	}

}