<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Kohana Pjax
 * 
 * @author stmn
 * @see https://github.com/stmn/kohana-pjax 
 */

class Kohana_Controller_Pjax extends Controller_Template {
    
    public function after(){
        if($this->request->headers('X-PJAX')){
            $this->auto_render = FALSE;

            $html = $this->template->render();

            $body = $this->pjax_get_title($html).$this->pjax_get_body($html); 
            
            $this->response->body($body);
        }

        parent::after();  
    }
    
    /**
     * Returns the title from html code.
     * 
     * @param string $html
     * @return string
     */
    private function pjax_get_title($html){
        preg_match('@<title>([^<]+)</title>@', $html, $matches);
        
        return isset($matches[0]) ? $matches[0] : '<title></title>';     
    }
    
    /**
     * Returns the desired part of html.
     * Desired part should be given by query and it should be ID selector.
     * 
     * Example: domain.com/your-page?_pjax=#some-content
     * 
     * @param string $html
     * @return string
     * @throws Exception
     */
    private function pjax_get_body($html){
        $dom = new DOMDocument();
        $dom->preserveWhiteSpace = FALSE;
        
        @$dom->loadHTML($html);

        $selector = $this->request->query('_pjax');
        
        if($selector[0] == "#"){
            $element = $dom->getElementById(substr($selector, 1));
        } else {
            throw new Exception('Unsupported selector: '.$selector);
        }
        
        $body = '';
        
        foreach($element->childNodes as $child){
            $tmp = new DOMDocument();
            $tmp->appendChild($tmp->importNode($child, TRUE));
            $body .= $tmp->saveHTML();
        }   
        
        return $body;
    }

}
