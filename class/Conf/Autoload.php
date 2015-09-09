<?php

/**
 * Clase Autoload
 *
 * PHP version 5.2.17
 *
 * @category PHP
 * @package  Class
 * @author   Alvaro José Agámez Licha 
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  SVN: $Id: Autoload.php 2231 2012-10-09 20:27:02Z  $
 * @link     
 *
 */

/**
 * Carga de manera automática las clases que son requeridas en el código. Se
 * hace uso de la nueva funcionalidad "namespace" de php 5.3, por tal motivo es
 * muy probable que no funcione en php 5.2.
 *
 * @category  PHP
 * @package   Class
 * @author    Alvaro José Agámez Licha 
 * @copyright 
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   Release: $Id: Autoload.php 2231 2012-10-09 20:27:02Z  $
 * @link      
 */
class Autoload
{

    /**
     * rutas de las clases a cargar
     * @var array
     */
    protected $paths = null;

    /**
     * Función constructora
     *
     * @param array $arrPaths ruta de las carpetas a incluir
     *
     * @author Alvaro Jose Agamez Licha
     * @version SVN:$Id: Autoload.php 2231 2012-10-09 20:27:02Z  $
     * @copyright 
     * @access private
     */
    private function __construct($arrPaths)
    {
        $this->paths = $arrPaths;
        spl_autoload_register(array($this, 'loader'));
    }

    /**
     * Función que registra las rutas de los archivos
     *
     * @param array $arrPaths Parametros de entrada
     *
     * @return \self
     * @author Alvaro Jose Agamez Licha
     * @version SVN:$Id: Autoload.php 2231 2012-10-09 20:27:02Z  $
     * @copyright 
     */
    static public function register(array $arrPaths)
    {
        return new self($arrPaths);
    }

    /**
     * Función que automaticamente carga los archivos
     *
     * @param string $strClassName Nombre de la clase
     *
     * @author Alvaro Jose Agamez Licha
     * @version SVN:$Id: Autoload.php 2225 2012-10-09 19:28:42Z
     * @copyright 
     * @return void
     */
    protected function loader($strClassName)
    {
        foreach ($this->paths as $strPath) {
            $strFile = $strPath . DIRECTORY_SEPARATOR
                . $strClassName . '.php';
            if (file_exists($strFile)) {
                include_once $strFile;
                break;
            }
        }
    }

}
