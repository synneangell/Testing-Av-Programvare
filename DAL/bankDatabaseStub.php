<?php
    include_once '../Model/domeneModell.php';
    class DBStub
    {
        function hentEnKunde($personnummer)
        {
           $enKunde = new kunde();
           $enKunde->personnummer =$personnummer;
           $enKunde->navn = "Per Olsen";
           $enKunde->adresse = "Osloveien 82, 0270 Oslo";
           $enKunde->telefonnr="12345678";
           return $enKunde;
        }
        
        function hentAlleKunder()
        {
           $alleKunder = array();
           $kunde1 = new kunde();
           $kunde1->personnummer ="01010122344";
           $kunde1->navn = "Per Olsen";
           $kunde1->adresse = "Osloveien 82 0270 Oslo";
           $kunde1->telefonnr="12345678";
           $alleKunder[]=$kunde1;
           
           $kunde2 = new kunde();
           $kunde2->personnummer ="01010122344";
           $kunde2->navn = "Line Jensen";
           $kunde2->adresse = "Askerveien 100, 1379 Asker";
           $kunde2->telefonnr="92876789";
           $alleKunder[]=$kunde2;
           
           $kunde3 = new kunde();
           $kunde3->personnummer ="02020233455";
           $kunde3->navn = "Ole Olsen";
           $kunde3->adresse = "Bærumsveien 23, 1234 Bærum";
           $kunde3->telefonnr="99889988";
           $alleKunder[]=$kunde3;
          
           return $alleKunder;
        }
        
        function hentTransaksjoner($kontoNr,$fraDato,$tilDato)
        {
            date_default_timezone_set("Europe/Oslo");
            $fraDato = strtotime($fraDato);
            $tilDato = strtotime($tilDato);
            if($fraDato>$tilDato)
            {
                return "Fra dato må være større enn tildato";
            }
            $konto = new konto();
            $konto->personnummer="010101234567";
            $konto->kontonummer=$kontoNr;
            $konto->type="Sparekonto";
            $konto->saldo =2300.34;
            $konto->valuta="NOK";
            if($tilDato < strtotime('2015-03-26'))
            {
                return $konto;
            }
            $dato = $fraDato;
            while ($dato<=$tilDato)
            {
                switch($dato)
                {
                    case strtotime('2015-03-26') :
                        $transaksjon1 = new transaksjon();
                        $transaksjon1->dato='2015-03-26';
                        $transaksjon1->transaksjonBelop=134.4;
                        $transaksjon1->fraTilKontonummer="22342344556";
                        $transaksjon1->melding="Meny Holtet";
                        $konto->transaksjoner[]=$transaksjon1;
                        break;
                    case strtotime('2015-03-27') :
                        $transaksjon2 = new transaksjon();
                        $transaksjon2->dato='2015-03-27';
                        $transaksjon2->transaksjonBelop=-2056.45;
                        $transaksjon2->fraTilKontonummer="114342344556";
                        $transaksjon2->melding="Husleie";
                        $konto->transaksjoner[]=$transaksjon2; 
                        break;
                    case strtotime('2015-03-29') :
                        $transaksjon3 = new transaksjon();
                        $transaksjon3->dato = '2015-03-29';
                        $transaksjon3->transaksjonBelop=1454.45;
                        $transaksjon3->fraTilKontonummer="114342344511";
                        $transaksjon3->melding="Lekeland";
                        $konto->transaksjoner[]=$transaksjon3;
                        break;
                }
                $dato +=(60*60*24); // en dag i tillegg i sekunder
            }
            return $konto;
        }
        
        //registrerKunde
        
    function registrerKunde($kunde)
    {
        if($kunde->Personnummer==""){ //Hva skal vi ha her?
            return "OK";
        }
        
        return "Feil";
            
            
    }
    
    function hentKundeInfo($personnummer) 
    {
        $enKunde = new kunde();
        $enKunde->Personnummer=$personnummer;
        //$enKunde->personnummer="01010110523";
        $enKunde->Fornavn = "Lene";
        $enKunde->Etternavn ="Jensen";
        $enKunde->Adresse = "Askerveien 22";
        $enKunde->Postnr = "3270";
        $enKunde->Telefonnr = "22224444";
        $enKunde->Passord="HeiHei";
        return $enKunde;
    }
        
        //endreKunde
    
    
    function endreKundeInfo($kunde)
    {
        if($kunde->Personnummer=="-1"){
            return "Feil";
        }
        return "OK";
    }
    
   
        //slettKunde
    
    function slettKunde($personnummer)
    {
        if($personnummer=="11111111111"){
            return "Feil";
        }   
        return "OK";
    }
    
    function sjekkLoggInn($personnummer, $passord){
        if($personnummer=="11111111111" and $passord=="HalloHallo"){
            return "Feil";
        }
        return "OK";
    }
    
    function hentKonti($personnummer){
        
        if($personnummer=="11111111111"){
            return "Feil";
        }
        return "OK";
    }
    
    function hentSaldi($personnummer){
        if($personnummer=="11111111111"){
            return "Feil";
        }
        return "OK";
    }
    
    //
    
    function registrerBetaling($kontoNr, $transaksjon){
        if($kontoNr=="11111111111"){
            return "Feil";
        }
        return "OK";
        
    }
     
    function hentBetalinger($personnummer){
        $betaling= array();
        if($personnummer=="11111111111"){
            return "Feil";
        }
        $betaling[0]->fraTilKontonummer="20102012345";
        $betaling[0]->avventer=0;
        $betaling[0]->belop=-100.5;
        $betaling[0]->dato="2015-03-15";
        $betaling[0]->melding="Meny Storo";
        
        $betaling[1]->fraTilKontonummer="20102012345";
        $betaling[1]->avventer=0;
        $betaling[1]->belop=-400.4;
        $betaling[1]->dato="2015-03-20";
        $betaling[1]->melding="Innebtaling";
        
        $betaling[2]->fraTilKontonummer="20102012345";
        $betaling[2]->avventer=1;
        $betaling[2]->belop=-1400.7;
        $betaling[2]->dato="2015-03-13";
        $betaling[2]->melding="Husleie";
         
        $betaling[3]->fraTilKontonummer="20102012347";
        $betaling[3]->avventer=0;
        $betaling[3]->belop=-5000.5;
        $betaling[3]->dato="2015-03-30";
        $betaling[3]->melding="Skatt";

        $betaling[4]->fraTilKontonummer="20102012345";
        $betaling[4]->avventer=0;
        $betaling[4]->belop=345.56;
        $betaling[4]->dato="2015-03-13";
        $betaling[4]->melding="Test";
        
        $betaling[5]->fraTilKontonummer="12312345";
        $betaling[5]->avventer=1;
        $betaling[5]->belop=1234;
        $betaling[5]->dato="2012-12-12";
        $betaling[5]->melding="Melding";

        $betaling[6]->fraTilKontonummer="345678908";
        $betaling[6]->avventer=0;
        $betaling[6]->belop=3000;
        $betaling[6]->dato="2012-12-12";
        $betaling[6]->melding="";
        
        $betaling[7]->fraTilKontonummer="234534678";
        $betaling[7]->avventer=0;
        $betaling[7]->belop=15;
        $betaling[7]->dato="2012-12-12";
        $betaling[7]->melding="Hei";
        
        $betaling[8]->fraTilKontonummer="1234254365";
        $betaling[8]->avventer=0;
        $betaling[8]->belop=125;
        $betaling[8]->dato="2012-12-12";
        $betaling[8]->melding="Hopp";
        
        return betaling;
               
    }
    
    function utforBetaling($TxID){
        if($TxID=="-1"){
            return "Feil";
        }
        return "OK";
    }
    
}