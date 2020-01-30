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
        
        $kontoer=array();
        $konto1 = new konto();
        $konto1->Kontonummer="105010123456";
        $konto1->Personnummer="01010110523";
        $konto1->Saldo=720;
        $konto1->Type="Lønnskonto";
        $konto1->Valuta="NOK";
        $konto[]=$konto1;
                    
        $konto2 = new konto();
        $konto2->Kontonummer="22334412345";
        $konto2->Personnummer="01010110523";
        $konto2->Saldo=10234.5;
        $konto2->Type="Brukskonto";
        $konto2->Valuta="NOK";
        $konto[]=$konto2;
        
       
        $konto3 = new konto();
        $konto3->Kontonummer="105020123456";
        $konto3->Personnummer="01010110523";
        $konto3->Saldo=100500;
        $konto3->Type="Sparekonto";
        $konto3->Valuta="NOK";
        $konto[]=$konto3;
        
        return $kontoer;
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
        $betalinger= array();
        if($personnummer=="11111111111"){
            return "Feil";
        }
        $transaksjon1 = new transaksjon();
        $transaksjon1->FraTilKontonummer="20102012345";
        $transaksjon1->Avventer=0;
        $transaksjon1->Belop=-100.5;
        $transaksjon1->Dato="2015-03-15";
        $transaksjon1->Melding="Meny Storo";
        $betalinger[]=$transaksjon1;
        
        $transaksjon2 = new transaksjon();
        $transaksjon2->FraTilKontonummer="20102012345";
        $transaksjon2->Avventer=0;
        $transaksjon2->Belop=400.4;
        $transaksjon2->Dato="2015-03-20";
        $transaksjon2->Melding="Innebtaling";
        $betalinger[]=$transaksjon2;
        
        $transaksjon3 = new transaksjon();
        $transaksjon3->FraTilKontonummer="20102012345";
        $transaksjon3->Avventer=1;
        $transaksjon3->Belop=-1400.7;
        $transaksjon3->Dato="2015-03-13";
        $transaksjon3->Melding="Husleie";
        $betalinger[]=$transaksjon3;
         
        $transaksjon4 = new transaksjon();
        $transaksjon4->FraTilKontonummer="20102012347";
        $transaksjon4->Avventer=0;
        $transaksjon4->Belop=-5000.5;
        $transaksjon4->Dato="2015-03-30";
        $transaksjon4->Melding="Skatt";
        $betalinger[]=$transaksjon4;
        
        $transaksjon5 = new transaksjon();
        $transaksjon5->FraTilKontonummer="20102012345";
        $transaksjon5->Avventer=0;
        $transaksjon5->Belop=345.56;
        $transaksjon5->Dato="2015-03-13";
        $transaksjon5->Melding="Test";
        $betalinger[]=$transaksjon5;
        
        $transaksjon6 = new transaksjon();
        $transaksjon6->FraTilKontonummer="12312345";
        $transaksjon6->Avventer=1;
        $transaksjon6->Belop=1234;
        $transaksjon6->Dato="2012-12-12";
        $transaksjon6->Melding="Melding";
        $betalinger[]=$transaksjon6;

        $transaksjon7 = new transaksjon();
        $transaksjon7->FraTilKontonummer="345678908";
        $transaksjon7->Avventer=0;
        $transaksjon7->Belop=3000;
        $transaksjon7->Dato="2012-12-12";
        $transaksjon7->Melding="";
        $betalinger[]=$transaksjon7;
        
        $transaksjon8 = new transaksjon();
        $transaksjon8->FraTilKontonummer="234534678";
        $transaksjon8->Avventer=0;
        $transaksjon8->Belop=15;
        $transaksjon8->Dato="2012-12-12";
        $transaksjon8->Melding="Hei";
        $betalinger[]=$transaksjon8;
        
        $transaksjon9 = new transaksjon();
        $transaksjon9->FraTilKontonummer="1234254365";
        $transaksjon9->Avventer=0;
        $transaksjon9->Belop=125;
        $transaksjon9->Dato="2012-12-12";
        $transaksjon9->Melding="Hopp";
        $betalinger[]=$transaksjon9;
        
        return $betalinger;
               
    }
    
    function utforBetaling($TxID){
        if($TxID=="-1"){
            return "Feil";
        }
        return "OK";
    }
    
}