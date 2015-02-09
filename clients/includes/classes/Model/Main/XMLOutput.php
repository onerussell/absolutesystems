<?php
/**
 * XML Output Class
 * @package   Engine37 catalog 3.1
 * @version   0.1a
 * @since     20.10.2007
 * @copyright 2004-2007 Engine37 Team
 * @link      http://Engine37.com
*/

//error_reporting(0);
class XmlOutput_Model
{
    private $mRep = array('"' => '&quot;', '&' => '&amp;', '>' => '&gt;', '<' => '&lt;', "'" => '&apos;', '®'=>'(R)');
	
	public function __construct()
    {

    }

    
    public function GetError($type, $msg = "")
    {
    	$s = '<result type="'.$type.'" success="false">
    	          <msg>'.$msg.'</msg> 
    	      </result>
    	     '; 
    	return $s; 	
    }/** GetError */

    
    public function RetResult($type, $msg = "", $adimsg = '')
    {
    	$s = '<result type="'.$type.'" success="true">
    	          '.$msg.'
    	          '.($adimsg ? '<msg>'.$adimsg.'</msg>' : '').' 
    	      </result>
    	     '; 
    	return $s; 	
    }/** GetError */ 

    
    public function GetCommentsList($li)
    {
    	$s = '<comments>'."\n";
    	for ($i = 0; $i < count($li); $i++)
    	{
    		$s .= '<comment>'."\n";
    		$s .= '    <comment_id>'.$li[$i]['id'].'</comment_id>'."\n";
    		$s .= '    <avatar>'.( (!empty($li[$i]['image'])) ? 'http://'.DOMEN.PATH_ROOT.DIR_NAME_IMAGE.'/'.$li[$i]['image'] : 'http://'.DOMEN.PATH_ROOT.'includes/templates/imgs/i-client_default.png').'</avatar>'."\n";
			$s .= '    <date>'.$li[$i]['date'].'</date>'."\n";
			$s .= '    <time>'.$li[$i]['time'].'</time>'."\n";
    		$s .= '</comment>'."\n";
    	}
    	$s .= '</comments>'."\n";
    	return $s; 	
    }/** GetCommentsList */
    
    
    public function GetComment($ci)
    {
        $s = '<comment>'."\n".'<xml_descr><![CDATA['.$ci['val'].']]></xml_descr>'."\n".'</comment>';	
        return $s; 	
    }/** GetComment */
    
    
}/** XmlOutput_Model */