<?php

define('MPDF_PATH', 'MPDF53/');
require_once(MPDF_PATH.'mpdf.php');

class Impressao {   
    
    private $html;
    private $footerName;
    private $stylesheetAddress;
    private $archiveName;
    
    public function __construct($html = null, $footerName = null, $stylesheetAddress = null, $archiveName = null) {
        $this->html = $html;
        $this->footerName = $footerName;
        $this->stylesheetAddress = $stylesheetAddress;
        $this->archiveName = $archiveName;
    }
    
    public function setHtml($html) {
        $this->html = $html;
    }
    
    public function getHtml() {
        return $this->html;
    }
    
    public function setFooterName($footerName) {
        $this->footerName = $footerName;
    }
    
    public function getFooterName() {
        return $this->footerName;
    }
    
    public function setStyleSheetAddress($stylesheetAddress) {
        $this->stylesheetAddress = $stylesheetAddress;
    }
    
    public function getStyleSheetAddress() {
        return $this->stylesheetAddress;
    }
    
    public function setArchiveName($archiveName) {
        $this->archiveName = $archiveName;
    }
    
    public function getArchiveName() {
        return $this->archiveName;
    }
    
    public function gerarPDF() {

        $mpdf=new mPDF('pt','A4',3,'',8,8,5,14,9,9,'P');
        $mpdf->allow_charset_conversion=true;
        $mpdf->charset_in='UTF-8';
        //$mpdf->SetDisplayMode('fullpage');
        $mpdf->SetFooter("{DATE j/m/Y H:i}|{PAGENO}/{nb}|".$this->getFooterName());
        $stylesheet = file_get_contents($this->getStyleSheetAddress());

        $mpdf->WriteHTML($stylesheet,1);    
        
        $mpdf->WriteHTML($this->getHtml(),2);

        $arquivo = $this->getArchiveName().".pdf";
        
        try {
            $mpdf->Output($arquivo,'D');
        } catch (Exception $e) {
            $e->getMessage();
            $e->getTrace();
        }
        
        
    }
    
    
    
}