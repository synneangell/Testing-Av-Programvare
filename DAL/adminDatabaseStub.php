<?php
include_once "../Model/domeneModell.php";

//hentAlleKunder

function hentAlleKunder()
    {
      $alleKunder =array();
      $kunde1->Personnummer="01010110523";
      $kunde1->Fornavn="Lene";
      $kunde1->Etternavn="Jensen";
      $kunde1->Adresse="Askerveien 22";
      $kunde1->Postnr="3270";
      $kunde1->Telefonnr="22224444";
      $kunde1->Passord="HeiHei";
      
      $alleKunder[]=$kunde1;
      
      
      $kunde2->Personnummer="12345678901";
      $kunde2->Fornavn="Per";
      $kunde2->Etternavn="Hansen";
      $kunde2->Adresse="Osloveien 82";
      $kunde2->Postnr="1234";
      $kunde2->Telefonnr="12345678";
      $kunde2->Passord="HeiHei";
      
      $alleKunder[]=$kunde2;
      
      return $alleKunder;
    }
    
    function endreKundeInfo($kunde)
    {
        if($kunde->Personnummer=="-1"){
            return "Feil";
        }
        return "OK";
        
       
    }
    
    function registrerKunde($kunde)
    {
        if($kunde->Personnummer=="01010110523"){ //Hva skal vi ha her?
            return "OK";
        }
        
        return "Feil";
            
            
    }
    
   
    
    function slettKunde($personnummer)
    {
        if($personnummer=="-1"){
            return "Feil";
        }   
        return "Ok";
    }
    
    function registerKonto($konto)
    {
        if($konto->kontonummer==""){ //Hva skal vi ha her?
            return "OK";
        }
        return "Feil";
    }
    
    function endreKonto($konto)
    {
        if($konto->Kontonummer==-1){
            return "Feil";
        }
        return "OK";
    }
    
    function hentAlleKonti()
    {
        $kontoListe= array();
        
        $konto1->Kontonummer="105010123456";
        $konto1->Personnummer="01010110523";
        $konto1->Saldo=720;
        $konto1->Type="Lonnskonto";//brukt o istedenfor ø
        $konto1->Valuta="NOK";
        
        $kontoListe[]=$konto1;
        
        $konto2->Kontonummer="22334412345";
        $konto2->Personnummer="01010110523";
        $konto2->Saldo=10234.5;
        $konto2->Type="Brukskonto";//brukt o istedenfor ø
        $konto2->Valuta="NOK";
        
        $kontoListe[]=$konto2;
        
        $konto3->Kontonummer="105020123456";
        $konto3->Personnummer="01010110523";
        $konto3->Saldo=100500;
        $konto3->Type="Sparekonto";//brukt o istedenfor ø
        $konto3->Valuta="NOK";
        
        $kontoListe[]=$konto3;
        
        return $kontoListe;
    }
    function slettKonto($kontonummer)
    {
        if($kontonummer==-1){
            return "Feil";
        }
        return "OK";
    }

//endreKundeInfo
//registrerKunde
//slettKunde
//registrerKonto
//endreKonto
//hentAlleKonti
//slettKonto
?>
