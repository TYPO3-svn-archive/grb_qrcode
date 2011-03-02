<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2010 Juerg Langhard <langhard@greenbanana.ch>, GreenBanana GmbH
*  			
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * QrCode
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_GrbQrcode_Domain_Model_QrCode extends Tx_Extbase_DomainObject_AbstractEntity {
	
	public function getQrCodeByUrl($url = 'www.greenbanana.ch'){
		include (t3lib_extMgm::extPath('grb_qrcode').'Classes/Library/phpqrcode-1.1.4/qrlib.php');

    	//set it to writable location, a place for temp generated PNG files
    	$PNG_TEMP_DIR = 'typo3temp/grb_qrcode/';
    		
		//html PNG location prefix
    	$PNG_WEB_DIR = 'typo3temp/grb_qrcode/';
    	
    	//ofcourse we need rights to create temp dir
    	if (!file_exists($PNG_TEMP_DIR)){
   			mkdir($PNG_TEMP_DIR);    	
    	}
        
    	$filename = $PNG_TEMP_DIR.'grb_qrcode.png';
    	
		//Error Correction Level
		// L - smalest
		// M
		// Q
		// H - best
    	$errorCorrectionLevel = 'Q';

		$matrixPointSize = 3;
    	
		// user data
        $filename = $PNG_TEMP_DIR.'grb_qrcode_'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
            	
    	QRcode::png($url, $filename, $errorCorrectionLevel, $matrixPointSize, 2); 
		return $PNG_WEB_DIR.basename($filename);
	}
	
}
?>