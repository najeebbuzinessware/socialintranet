<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class MemberController extends BWController
{

	//public $layout = 'common.views.layouts.column2';
	
      public function filters()
      {
	      return array(
	        array( 
	            'common.filters.UserAuthFilter',
	        ),		
			/* array(
				'common.filters.BWHttpFilter',						
			), */	      		
	      );
      }

      protected function _sendResponse($status = 200, $body = '', $content_type = 'text/html')
      {
      // set the status
      $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
      header($status_header);
      // and the content type
      header('Content-type: ' . $content_type);

      // pages with body are easy
      if($body != '')
      {
        // send the body
        echo $body;
        exit;
      }
      // we need to create the body if none is passed
      else
      {
        // create some body messages
        $message = '';

        // this is purely optional, but makes the pages a little nicer to read
        // for your users.  Since you won't likely send a lot of different status codes,
        // this also shouldn't be too ponderous to maintain
        switch($status)
        {
            case 401:
                $message = 'You must be authorized to view this page.';
                break;
            case 404:
                $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
                break;
            case 500:
                $message = 'The server encountered an error processing your request.';
                break;
            case 501:
                $message = 'The requested method is not implemented.';
                break;
        }

        // servers don't always have a signature turned on
        // (this is an apache directive "ServerSignature On")
        $signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];

        // this should be templated in a real-world solution
        $body = '
      <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
      <html>
      <head>
      <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
      <title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
      </head>
      <body>
      <h1>' . $this->_getStatusCodeMessage($status) . '</h1>
      <p>' . $message . '</p>
      <hr />
      <address>' . $signature . '</address>
      </body>
      </html>';

        echo $body;
        exit;
      }
      }

      protected function _getStatusCodeMessage($status)
      {
      // these could be stored in a .ini file and loaded
      // via parse_ini_file()... however, this will suffice
      // for an example
      $codes = Array(
        200 => 'OK',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
      );
      return (isset($codes[$status])) ? $codes[$status] : '';
      }

      protected function _checkAuth($task=null)
      {

        if($task == null)
        return true;

        if(Yii::app()->user->checkAccess($task))
        {
            return true;
        }else{
            throw new CHttpException(404,'The specified action cannot be found or not allowed to access.');
        }
      }

      protected function _checkAuthAdmin()
      {     

        $id=Yii::app()->user->Id;
        //Check in System User Table if User is admin
        $AdminUser = TblUsers::model()->findByAttributes(array('Userid'=>$id,'UserType'=>'Admin'));
        if(!is_null($AdminUser))
        {
            return true;
        }else{
            throw new CHttpException(404,'The specified action cannot be found or not allowed to access.');
        }
      }
		
}