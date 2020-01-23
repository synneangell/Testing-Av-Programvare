<?php
include_once "/Applications/XAMPP/xamppfiles/htdocs/TestingBank/BLL/adminLogikk.php";
include_once "/Applications/XAMPP/xamppfiles/htdocs/TestingBank/BLL/bankLogikk.php";
include_once "/Applications/XAMPP/xamppfiles/htdocs/TestingBank/DAL/bankDatabaseStub.php";
include_once "/Applications/XAMPP/xamppfiles/htdocs/TestingBank/DAL/adminDatabaseStub.php";

/* Fra adminDatabasestub:
 * hentAlleKunder -
 * endreKundeInfo -
 * registrerKunde -
 * slettKunde -
 * registrerKonto -
 * endreKonto-
 * hentAlleKonti-
 * slettKonto -
 * 
 * Fra bankDBstud:
 * hentEnKunde -
 * hentAlleKunder- 
 * hentTransaksjoner-
 * 
 * Fra bankLogikk:
 * sjekkLoggInn -
 * hentKonti -
 * hentSaldi -
 * registrerBetaling -
 * hentBetalinger -
 * utforBetaling -
 * endreKundeInfo -
 * hentKundeInfo -
 */

//Når det er to hentAlleKunder, må vi lage en for adminLogikk og en for bankLogikk??



class KundeTest extends PHPUnit\Framework\TestCase
{ 

    //NB : Funksjonsnavnene under må starte med "test" !
    function test_hentAlleKunder()
    {   
        // arrange
        $adminLogikk=new adminLogikk(new DBStub());
        // act
        $kunder= $adminLogikk->hentAlleKunder();
        // assert
        $this->assertEquals("01010110523", $kunder[0]->Personnummer);
        $this->assertEquals("Lene",$kunder[0]->Fornavn); 
        $this->assertEquals("Jensen",$kunder[0]->Etternavn); 
        $this->assertEquals("Askerveien 22",$kunder[0]->Adresse); 
        $this->assertEquals("3270",$kunder[0]->Postnr); 
        $this->assertEquals("22224444",$kunder[0]->Telefonnr); 
        $this->assertEquals("Heihei",$kunder[0]->Passord); 
        
        $this->assertEquals("12345678901", $kunder[1]->Personnummer);
        $this->assertEquals("Per",$kunder[1]->Fornavn); 
        $this->assertEquals("Olsen",$kunder[1]->Etternavn); 
        $this->assertEquals("Osloveien 82",$kunder[1]->Adresse); 
        $this->assertEquals("1234",$kunder[1]->Postnr); 
        $this->assertEquals("12345678",$kunder[1]->Telefonnr); 
        $this->assertEquals("Heihei",$kunder[1]->Passord); 

    }
    
    function test_hentAlleKontoer()
    {   
        // arrange
        $adminLogikk=new adminLogikk(new DBStub());
        // act
        $kontoer= $adminLogikk->hentAlleKonti();
        // assert
        $this->assertEquals("105010123456",$kontoListe[0]->Kontonummer); 
        $this->assertEquals("01010110523",$kontoListe[0]->Personnummer); 
        $this->assertEquals("720",$kontoListe[0]->Saldo); 
        $this->assertEquals("Lonnskonto",$kontoListe[0]->Type); //Må man ha o for ø?
        $this->assertEquals("NOK",$kontoListe[0]->Valuta); 
        
        $this->assertEquals("22334412345",$kontoListe[0]->Kontonummer); 
        $this->assertEquals("01010110523",$kontoListe[0]->Personnummer); 
        $this->assertEquals("10234.5",$kontoListe[0]->Saldo); 
        $this->assertEquals("Brukskonto",$kontoListe[0]->Type); 
        $this->assertEquals("NOK",$kontoListe[0]->Valuta); 
        
        $this->assertEquals("01010110523",$kontoListe[0]->Kontonummer); 
        $this->assertEquals("01010110523",$kontoListe[0]->Personnummer); 
        $this->assertEquals("100500",$kontoListe[0]->Saldo); 
        $this->assertEquals("Sparekonto",$kontoListe[0]->Type); 
        $this->assertEquals("NOK",$kontoListe[0]->Valuta); 
        
    }
    
    function test_registerKunde_OK()
    {
        // arrange
        $adminLogikk=new adminLogikk(new DBStub());
        $kunde = new kunde();
        $kunde->personnummer = "01010110523"; //denne man tester på i stuben
        $kunde->fornavn = "Lene";
        $kunde->etternavn ="Jensen";
        $kunde->adresse = "Askerveien 22";
        $kunde->postnr = "3270";
        $kunde->telefonnr = "22224444";
        $kunde->passord = "HeiHei";
        // act
        $OK= $adminLogikk->registerKunde($kunde);
        // assert
        $this->assertEquals("OK",$OK); 
    }
    
    function test_registerKunde_DB_Feil()
    {
        // arrange
        $adminLogikk=new adminLogikk(new DBStub());
        $kunde = new kunde();
        $kunde->personnummer = "111111111"; 
        $kunde->fornavn = "Lene";
        $kunde->etternavn ="Jensen";
        $kunde->adresse = "Askerveien 22";
        $kunde->postnr = "3270";
        $kunde->telefonnr = "22224444";
        $kunde->passord = "HeiHei";
        // act
        $OK= $adminLogikk->registerKunde($kunde);
        // assert
        $this->assertEquals("Feil",$OK); 
    }
    
/*    function test_hentEnKunde_OK()
    {
        // arrange
        $bankLogikk = new bankLogikk(new DBStub());
        $personnummer= "01010110523";
        // act
        $kunde = $bankLogikk->hentEnKunde($personnummer);
       // assert
        $this->assertEquals("01010110523", $kunder[0]->Personnummer);
        $this->assertEquals("Lene",$kunder[0]->Fornavn); 
        $this->assertEquals("Jensen",$kunder[0]->Etternavn); 
        $this->assertEquals("Askerveien 22",$kunder[0]->Adresse); 
        $this->assertEquals("3270",$kunder[0]->Postnr); 
        $this->assertEquals("22224444",$kunder[0]->Telefonnr); 
        $this->assertEquals("Heihei",$kunder[0]->Passord);  
    }
    
    function test_hentEnKunde_Feil()
    {
        // arrange
        $bankLogikk = new bankLogikk(new DBStub());
        $personnummer= "111111111";
        // act
        $kunde = $bankLogikk->hentEnKunde($personnummer);
       // assert
        $this->assertEquals("Feil",$kunde); 
    }
 */
    
    function test_endreKundeInfo_Admin_OK()
    {
       // arrange
        $adminLogikk = new adminLogikk(new DBStub());
        $kunde = new kunde();
        $kunde->personnummer = "01010110523";
        $kunde->fornavn = "Lene";
        $kunde->etternavn ="Jensen";
        $kunde->adresse = "Askerveien 22";
        $kunde->postnr = "3270";
        $kunde->telefonnr = "22224444";
        $kunde->passord = "HeiHei";
        // act
        $OK = $adminLogikk->endreKunde($kunde);
       // assert
        $this->assertEquals("OK",$OK); 
    }
    
    function test_endreKundeInfo_Admin_Feil()
    {
        // arrange
        $adminLogikk = new adminLogikk(new DBStub());
        $kunde = new kunde();
        $kunde->personnummer = "111111111";
        $kunde->fornavn = "Lene";
        $kunde->etternavn ="Jensen";
        $kunde->adresse = "Askerveien 22";
        $kunde->postnr = "3270";
        $kunde->telefonnr = "22224444";
        $kunde->passord = "HeiHei";
        // act
        $OK = $adminLogikk->endreKunde($kunde);
       // assert
        $this->assertEquals("Feil",$OK); 
    }
    
    function test_slettKunde_OK()
    {
        // arrange
        $adminLogikk = new adminLogikk(new DBStub());
        $personnummer= "01010110523";
        // act
        $OK = $adminLogikk->slettKunde($personnummer);
       // assert
        $this->assertEquals("OK",$OK); 
    }
    
    function test_slettKunde_Feil()
    {
        // arrange
        $adminLogikk = new adminLogikk(new DBStub());
        $personnummer= "111111111";
        // act
        $OK = $adminLogikk->slettKunde($personnummer);
       // assert
        $this->assertEquals("Feil",$OK); 
    }
    
    function test_registrerKonto_OK()
    {
        
        // arrange
        $adminLogikk=new adminLogikk(new DBStub());
        $konto1 = new konto();
        $konto1->kontonummer = "105010123456";
        $konto1->personnummer = "01010110523";
        $konto1->saldo = "720";
        $konto1->type = "Lønnskonto"; //Kan vi ha ø?
        $konto1->valuta = "NOK";
        
        // act
        $OK= $adminLogikk->registerKonto($konto);
        // assert
        $this->assertEquals("OK",$OK); 
        
    }
    
    function test_registrerKonto_feil()
    {
        // arrange
        $adminLogikk=new adminLogikk(new DBStub());
        $konto1 = new konto();
        $konto1->kontonummer = "105010123456";
        $konto1->personnummer = "111111111";  //Blir det riktig å skrive feil personnummer her?
        $konto1->saldo = "720";
        $konto1->type = "Lønnskonto"; //Kan vi ha ø?
        $konto1->valuta = "NOK";
        // act
        $OK= $adminLogikk->registerKonto($konto);
        // assert
        $this->assertEquals("Feil",$OK); 
    }
    
    function test_slettKonto_OK()
    {
        // arrange
        $adminLogikk = new adminLogikk(new DBStub());
        $kontonummer= "105010123456";
        // act
        $OK = $adminLogikk->slettKonto($kontonummer);
       // assert
        $this->assertEquals("OK",$OK); 
    }
    
    function test_slettKonto_Feil()
    {
        // arrange
        $adminLogikk = new adminLogikk(new DBStub());
        $kontonummer= "111111111";
        // act
        $OK = $adminLogikk->slettKonto($kontonummer);
       // assert
        $this->assertEquals("Feil",$OK); 
    }
    
    function test_endreKonto_OK()
    {
        
          // arrange
        $adminLogikk = new adminLogikk(new DBStub());
        $konto1 = new konto();
        $konto1->kontonummer = "105010123456";
        $konto1->personnummer = "01010110523";  //Blir det riktig å skrive feil personnummer her?
        $konto1->saldo = "720";
        $konto1->type = "Lønnskonto"; //Kan vi ha ø?
        $konto1->valuta = "NOK";
        // act
        $OK = $adminLogikk->endreKonto($konto1);
       // assert
        $this->assertEquals("OK",$OK); 
        
    }
    
    function test_endreKonto_Feil()
    {
        // arrange
        $bankLogikk = new bankLogikk(new DBStub());
        $konto1 = new konto1();
        $konto1->kontonummer = "10";
        $konto1->personnummer = "01010110523";  //Blir det riktig å skrive feil personnummer her?
        $konto1->saldo = "720";
        $konto1->type = "Lønnskonto"; //Kan vi ha ø?
        $konto1->valuta = "NOK";    
        // act
        $OK = $bankLogikk->endreKonto($konto1);
       // assert
        $this->assertEquals("Feil",$OK); 
    }
    
    function hentAlleKonti_OK()
    {
        $adminLogikk=new adminLogikk(new DBStub());
        // act
        $kontoer[]= $adminLogikk->hentAlleKonti();
        // assert
        $this->assertEquals("105010123456", $kontoer[0]->kontonummer);
        $this->assertEquals("01010110523",$kontoer[0]->personnummer); 
        $this->assertEquals(720 ,$kontoer[0]->saldo); 
        $this->assertEquals("Lønnskonto",$kontoer[0]->type); 
        $this->assertEquals("NOK",$kontoer[0]->valuta); 
        
        $this->assertEquals("22334412345", $kontoer[1]->kontonummer);
        $this->assertEquals("01010110523",$kontoer[1]->personnummer); 
        $this->assertEquals(10234.5 ,$kontoer[1]->saldo); 
        $this->assertEquals("Brukskonto",$kontoer[1]->type); 
        $this->assertEquals("NOK",$kontoer[1]->valuta);
        
        $this->assertEquals("105020123456", $kontoer[2]->kontonummer);
        $this->assertEquals("01010110523",$kontoer[2]->personnummer); 
        $this->assertEquals(100500 ,$kontoer[2]->saldo); 
        $this->assertEquals("Sparekonto",$kontoer[2]->type); 
        $this->assertEquals("NOK",$kontoer[2]->valuta);
        
    }
    
     
    
    /*function test_hentAlleKunderBank()
    {   
        // arrange
        $bankLogikk=new bankLogikk(new DBStub());
        // act
        $kunder= $bankLogikk->hentAlleKunder();
        // assert
        $this->assertEquals("01010110523", $kunder[0]->Personnummer);
        $this->assertEquals("Lene",$kunder[0]->Fornavn); 
        $this->assertEquals("Jensen",$kunder[0]->Etternavn); 
        $this->assertEquals("Askerveien 22",$kunder[0]->Adresse); 
        $this->assertEquals("3270",$kunder[0]->Postnr); 
        $this->assertEquals("22224444",$kunder[0]->Telefonnr); 
        $this->assertEquals("Heihei",$kunder[0]->Passord); 
        $this->assertEquals("12345678901", $kunder[1]->Personnummer);
        $this->assertEquals("Per",$kunder[1]->Fornavn); 
        $this->assertEquals("Olsen",$kunder[1]->Etternavn); 
        $this->assertEquals("Osloveien 82",$kunder[1]->Adresse); 
        $this->assertEquals("1234",$kunder[1]->Postnr); 
        $this->assertEquals("12345678",$kunder[1]->Telefonnr); 
        $this->assertEquals("Heihei",$kunder[1]->Passord); 
        
    }*/
    
    
    function test_hentTransaksjoner()
    {
        
        $bankLogikk=new bankLogikk(new DBStub());
        // act
        $transaksjoner= $bankLogikk->hentTransaksjoner();
        
        $this->assertEquals("1", $transaksjoner[0]->txID);
        $this->assertEquals("20102012345", $transaksjoner[0]->fraTilKontonummer);
        $this->assertEquals(-100.5, $transaksjoner[0]->belop);
        $this->assertEquals("2015-03-15", $transaksjoner[0]->dato);
        $this->assertEquals("Meny Storo", $transaksjoner[0]->melding);
        $this->assertEquals("105010123456", $transaksjoner[0]->kontonummer);
        $this->assertEquals(0, $transaksjoner[0]->avventer);
        
        $this->assertEquals("2", $transaksjoner[1]->txID);
        $this->assertEquals("20102012345", $transaksjoner[1]->fraTilKontonummer);
        $this->assertEquals(400.4, $transaksjoner[1]->belop);
        $this->assertEquals("2015-03-20", $transaksjoner[1]->dato);
        $this->assertEquals("Innebtaling", $transaksjoner[1]->melding);
        $this->assertEquals("105010123456", $transaksjoner[1]->kontonummer);
        $this->assertEquals(0, $transaksjoner[1]->avventer);
        
        $this->assertEquals("3", $transaksjoner[1]->txID);
        $this->assertEquals("20102012345", $transaksjoner[1]->fraTilKontonummer);
        $this->assertEquals(-1400.7, $transaksjoner[1]->belop);
        $this->assertEquals("2015-03-13", $transaksjoner[1]->dato);
        $this->assertEquals("Husleie", $transaksjoner[1]->melding);
        $this->assertEquals("55551166677", $transaksjoner[1]->kontonummer);
        $this->assertEquals(1, $transaksjoner[1]->avventer);
        
        $this->assertEquals("4", $transaksjoner[1]->txID);
        $this->assertEquals("20102012347", $transaksjoner[1]->fraTilKontonummer);
        $this->assertEquals(-5000.5, $transaksjoner[1]->belop);
        $this->assertEquals("2015-03-30", $transaksjoner[1]->dato);
        $this->assertEquals("Skatt", $transaksjoner[1]->melding);
        $this->assertEquals("105010123456", $transaksjoner[1]->kontonummer);
        $this->assertEquals(0, $transaksjoner[1]->avventer);
        
        $this->assertEquals("5", $transaksjoner[1]->txID);
        $this->assertEquals("20102012345", $transaksjoner[1]->fraTilKontonummer);
        $this->assertEquals(345.56, $transaksjoner[1]->belop);
        $this->assertEquals("2015-03-13", $transaksjoner[1]->dato);
        $this->assertEquals("Test", $transaksjoner[1]->melding);
        $this->assertEquals("55551166677", $transaksjoner[1]->kontonummer);
        $this->assertEquals(0, $transaksjoner[1]->avventer);
        
        $this->assertEquals("6", $transaksjoner[1]->txID);
        $this->assertEquals("12312345", $transaksjoner[1]->fraTilKontonummer);
        $this->assertEquals(1234, $transaksjoner[1]->belop);
        $this->assertEquals("2012-12-12", $transaksjoner[1]->dato);
        $this->assertEquals("Melding", $transaksjoner[1]->melding);
        $this->assertEquals("234567", $transaksjoner[1]->kontonummer);
        $this->assertEquals(1, $transaksjoner[1]->avventer);
        
        $this->assertEquals("7", $transaksjoner[1]->txID);
        $this->assertEquals("345678908", $transaksjoner[1]->fraTilKontonummer);
        $this->assertEquals(3000, $transaksjoner[1]->belop);
        $this->assertEquals("2012-12-12", $transaksjoner[1]->dato);
        $this->assertEquals("", $transaksjoner[1]->melding);
        $this->assertEquals("105010123456", $transaksjoner[1]->kontonummer);
        $this->assertEquals(0, $transaksjoner[1]->avventer);
        
        $this->assertEquals("8", $transaksjoner[1]->txID);
        $this->assertEquals("234534678", $transaksjoner[1]->fraTilKontonummer);
        $this->assertEquals(15, $transaksjoner[1]->belop);
        $this->assertEquals("2012-12-12", $transaksjoner[1]->dato);
        $this->assertEquals("Hei", $transaksjoner[1]->melding);
        $this->assertEquals("105010123456", $transaksjoner[1]->kontonummer);
        $this->assertEquals(0, $transaksjoner[1]->avventer);
        
        $this->assertEquals("9", $transaksjoner[1]->txID);
        $this->assertEquals("1234254365", $transaksjoner[1]->fraTilKontonummer);
        $this->assertEquals(125, $transaksjoner[1]->belop);
        $this->assertEquals("2012-12-12", $transaksjoner[1]->dato);
        $this->assertEquals("Hopp", $transaksjoner[1]->melding);
        $this->assertEquals("105010123456", $transaksjoner[1]->kontonummer);
        $this->assertEquals(0, $transaksjoner[1]->avventer);
        
    }
    
    /*function test_sjekkLoggInn_RegEx_OK_Personnummer() //personnummer og passord
    { 
        // arrange
        $bankLogikk=new bankLogikk(new DBStub());
        // act
        $personnummer= $bankLogikk->sjekkLoggInn();
        // assert
        $this->assertEquals("01010110523", $kunde[0]->personnummer); 
        // act
        $OK= $bankLogikk->sjekkLoggInn($kunde);
        // assert
        $this->assertEquals("OK",$OK); 
    }*/
    
    function test_sjekkLoggInn_RegEx_Feil_Personnummer() //personnummer og passord
    { 
        // arrange
        $bankLogikk=new bankLogikk(new DBStub());
        // act
        $personnummer= "01010110523/";
        $passord= "HeiHei";
        $OK = $bankLogikk->sjekkLoggInn($personnummer, $passord);
       // assert
        $this->assertEquals("Feil i personnummer",$OK); 
    }
    
    function test_sjekkLoggInn_RegEx_Feil_Passord() //personnummer og passord
    { 
        // arrange
        $bankLogikk=new bankLogikk(new DBStub());
        // act
        $personnummer= "01010110523";
        $passord= "HeiHei/";
        $OK = $bankLogikk->sjekkLoggInn($personnummer, $passord);
       // assert
        $this->assertEquals("Feil i passord",$OK); 
    }
    
    function test_sjekkLoggInn_Feil()
    {
        //arrange
        $bankLogikk = bankLogikk (new DBStub());
        $personnummer = "11111111111";
        $passord = "HalloHallo";
        //act
        $OK = $bankLogikk->sjekkLoggInn($personnummer, $passord);
        //assert
        $this->assertEquals("Feil",$OK); 
    }
    
    function test_sjekkLoggInn_OK()
    {
        //arrange
        $bankLogikk = bankLogikk (new DBStub());
        $personnummer = "01010110523";
        $passord = "HeiHei";
        //act
        $OK = $bankLogikk->sjekkLoggInn($personnummer, $passord);
        //assert
        $this->assertEquals("OK",$OK); 
    }
    
    
    function test_hentKonti_OK() 
    { 
        // arrange
        $bankLogikk=new bankLogikk(new DBStub());
        $personnummer = "01010110523";
        // act
        $kontoer[]= $bankLogikk->hentKonti($personnummer);
        // assert
        $this->assertEquals("105010123456", $kontoer[0]->kontonummer);
        $this->assertEquals("01010110523",$kontoer[0]->personnummer); 
        $this->assertEquals(720 ,$kontoer[0]->saldo); 
        $this->assertEquals("Lønnskonto",$kontoer[0]->type); 
        $this->assertEquals("NOK",$kontoer[0]->valuta);       
                
        $this->assertEquals("22334412345", $kontoer[1]->kontonummer);
        $this->assertEquals("01010110523",$kontoer[1]->personnummer); 
        $this->assertEquals(10234.5 ,$kontoer[1]->saldo); 
        $this->assertEquals("Brukskonto",$kontoer[1]->type); 
        $this->assertEquals("NOK",$kontoer[1]->valuta);
        
        $this->assertEquals("105020123456", $kontoer[2]->kontonummer);
        $this->assertEquals("01010110523",$kontoer[2]->personnummer); 
        $this->assertEquals(100500 ,$kontoer[2]->saldo); 
        $this->assertEquals("Sparekonto",$kontoer[2]->type); 
        $this->assertEquals("NOK",$kontoer[2]->valuta);     

    }
    
    
    function test_hentSaldi_OK() 
    { 
        // arrange
        $bankLogikk=new bankLogikk(new DBStub());
        $personnummer = "01010110523";
        // act
        $saldoer[]= $bankLogikk->hentSaldi($personnummer);
        // assert
        $this->assertEquals("105010123456", $kontoer[0]->kontonummer);
        $this->assertEquals("01010110523",$kontoer[0]->personnummer); 
        $this->assertEquals(720 ,$kontoer[0]->saldo); 
        $this->assertEquals("Lønnskonto",$kontoer[0]->type); 
        $this->assertEquals("NOK",$kontoer[0]->valuta);       
                
        $this->assertEquals("22334412345", $kontoer[1]->kontonummer);
        $this->assertEquals("01010110523",$kontoer[1]->personnummer); 
        $this->assertEquals(10234.5 ,$kontoer[1]->saldo); 
        $this->assertEquals("Brukskonto",$kontoer[1]->type); 
        $this->assertEquals("NOK",$kontoer[1]->valuta);
        
        $this->assertEquals("105020123456", $kontoer[2]->kontonummer);
        $this->assertEquals("01010110523",$kontoer[2]->personnummer); 
        $this->assertEquals(100500 ,$kontoer[2]->saldo); 
        $this->assertEquals("Sparekonto",$kontoer[2]->type); 
        $this->assertEquals("NOK",$kontoer[2]->valuta);

    }
   
    
    
    function test_registrerBetaling_OK() //kontonummer, transaksjon
    { 
        $bankLogikk=new bankLogikk(new DBStub());
        $transaksjon= new transaksjon();
        $transaksjon->txtID = 1;
        $transaksjon->fraTilKontonummer = "20102012345";
        $transaksjon->beløp = -100.5;
        $transaksjon->dato = "2015-03-15";
        $transaksjon->melding = "Meny Storo";
        $transaksjon->kontonummer = "105010123456";
        $transaksjon->transaksjon = [1];
        // act
        $OK= $bankLogikk->registrerBetaling($transaksjon);
        // assert
        $this->assertEquals("OK",$OK);

    }
    
    function test_registrerBetaling_Kontonummer_Feil() 
    { 
        $transaksjon= new transaksjon();
        $transaksjon->txtID = 1;
        $transaksjon->fraTilKontonummer = "20102012345";
        $transaksjon->beløp = -100.5;
        $transaksjon->dato = "2015-03-15";
        $transaksjon->melding = "Meny Storo";
        $transaksjon->kontonummer = "111111111";
        $transaksjon->transaksjon = [1];
        // act
        $OK= $bankLogikk->registrerBetaling($transaksjon);
        // assert
        $this->assertEquals("Feil",$OK);
    }
    
    function test_hentBetaling_OK() 
    { 
        $bankLogikk=new bankLogikk(new DBStub());
        $personnummer = "01010110523";
        // act
        $transaksjoner[]= $bankLogikk->hentBetaling($personnummer);
        // assert
        
        $this->assertEquals(1, $transaksjoner[0]->txID);
        $this->assertEquals("20102012345", $transaksjoner[0]->fraTilKontonummer);
        $this->assertEquals(-100.5, $transaksjoner[0]->belop);
        $this->assertEquals("2015-03-15", $transaksjoner[0]->dato);
        $this->assertEquals("Meny Storo", $transaksjoner[0]->melding);
        $this->assertEquals("105010123456", $transaksjoner[0]->kontonummer);
        $this->assertEquals(0, $transaksjoner[0]->avventer);
        
        $this->assertEquals(2, $transaksjoner[1]->txID);
        $this->assertEquals("20102012345", $transaksjoner[1]->fraTilKontonummer);
        $this->assertEquals(400.4, $transaksjoner[1]->belop);
        $this->assertEquals("2015-03-20", $transaksjoner[1]->dato);
        $this->assertEquals("Innebtaling", $transaksjoner[1]->melding);
        $this->assertEquals("105010123456", $transaksjoner[1]->kontonummer);
        $this->assertEquals(0, $transaksjoner[1]->avventer);
        
        $this->assertEquals(3, $transaksjoner[2]->txID);
        $this->assertEquals("20102012345", $transaksjoner[2]->fraTilKontonummer);
        $this->assertEquals(-1400.7, $transaksjoner[2]->belop);
        $this->assertEquals("2015-03-13", $transaksjoner[2]->dato);
        $this->assertEquals("Husleie", $transaksjoner[2]->melding);
        $this->assertEquals("55551166677", $transaksjoner[2]->kontonummer);
        $this->assertEquals(1, $transaksjoner[2]->avventer);
        
        $this->assertEquals(4, $transaksjoner[3]->txID);
        $this->assertEquals("20102012347", $transaksjoner[3]->fraTilKontonummer);
        $this->assertEquals(-5000.5, $transaksjoner[3]->belop);
        $this->assertEquals("2015-03-30", $transaksjoner[3]->dato);
        $this->assertEquals("Skatt", $transaksjoner[3]->melding);
        $this->assertEquals("105010123456", $transaksjoner[3]->kontonummer);
        $this->assertEquals(0, $transaksjoner[3]->avventer);
        
        $this->assertEquals(5, $transaksjoner[4]->txID);
        $this->assertEquals("20102012345", $transaksjoner[4]->fraTilKontonummer);
        $this->assertEquals(345.56, $transaksjoner[4]->belop);
        $this->assertEquals("2015-03-13", $transaksjoner[4]->dato);
        $this->assertEquals("Test", $transaksjoner[4]->melding);
        $this->assertEquals("55551166677", $transaksjoner[4]->kontonummer);
        $this->assertEquals(0, $transaksjoner[4]->avventer);
        
        $this->assertEquals(6, $transaksjoner[5]->txID);
        $this->assertEquals("12312345", $transaksjoner[5]->fraTilKontonummer);
        $this->assertEquals(1234, $transaksjoner[5]->belop);
        $this->assertEquals("2012-12-12", $transaksjoner[5]->dato);
        $this->assertEquals("Melding", $transaksjoner[5]->melding);
        $this->assertEquals("234567", $transaksjoner[5]->kontonummer);
        $this->assertEquals(1, $transaksjoner[5]->avventer);
        
        $this->assertEquals(7, $transaksjoner[6]->txID);
        $this->assertEquals("345678908", $transaksjoner[6]->fraTilKontonummer);
        $this->assertEquals(3000, $transaksjoner[6]->belop);
        $this->assertEquals("2012-12-12", $transaksjoner[6]->dato);
        $this->assertEquals("", $transaksjoner[6]->melding);
        $this->assertEquals("105010123456", $transaksjoner[6]->kontonummer);
        $this->assertEquals(0, $transaksjoner[6]->avventer);
        
        $this->assertEquals(8, $transaksjoner[7]->txID);
        $this->assertEquals("234534678", $transaksjoner[7]->fraTilKontonummer);
        $this->assertEquals(15, $transaksjoner[7]->belop);
        $this->assertEquals("2012-12-12", $transaksjoner[7]->dato);
        $this->assertEquals("Hei", $transaksjoner[7]->melding);
        $this->assertEquals("105010123456", $transaksjoner[7]->kontonummer);
        $this->assertEquals(0, $transaksjoner[7]->avventer);
        
        $this->assertEquals(9, $transaksjoner[8]->txID);
        $this->assertEquals("1234254365", $transaksjoner[8]->fraTilKontonummer);
        $this->assertEquals(125, $transaksjoner[8]->belop);
        $this->assertEquals("2012-12-12", $transaksjoner[8]->dato);
        $this->assertEquals("Hopp", $transaksjoner[8]->melding);
        $this->assertEquals("105010123456", $transaksjoner[8]->kontonummer);
        $this->assertEquals(0, $transaksjoner[8]->avventer);
    }
            

    function test_utforBetaling_OK() 
    { 
        $bankLogikk=new bankLogikk(new DBStub());
        $txID= 1;
        // act
        $OK = $bankLogikk->utforBetaling($txID);
        // assert
        $this->assertEquals("OK", $OK);
    }
    
    function test_utforBetaling_FEIL() 
    { 
        $bankLogikk=new bankLogikk(new DBStub());
        $txID= -1;
        // act
        $OK = $bankLogikk->utforBetaling($txID);
        // assert
        $this->assertEquals("Feil", $OK);
    }
    
    function test_hentKundeInfo_Bank_OK()
    {
       // arrange
        $bankLogikk = new bankLogikk(new DBStub());
        $personnummer= "01010110523";
        //act
        $kunde = $bankLogikk->hentKundeInfo($personnummer);
       // assert
        $this->assertEquals("01010110523", $kunde->personnummer);
        $this->assertEquals("Lene",$kunde->fornavn); 
        $this->assertEquals("Jensen",$kunde->etternavn); 
        $this->assertEquals("Askerveien 22",$kunde->adresse); 
        $this->assertEquals("3270",$kunde->postnr); 
        $this->assertEquals("22224444",$kunde->telefonnr); 
        $this->assertEquals("Heihei",$kunde->passord); 
    }
    
    function test_hentKundeInfo_Bank_Feil()
    {
       // arrange
        $bankLogikk = new bankLogikk(new DBStub());
        $personnummer= "11111111111";
        //act
        $kunde = $bankLogikk->hentKundeInfo($personnummer);
       // assert
        $this->assertEquals("Feil", $kunde);
    }
    
        function test_endreKundeInfo_OK()
    {
        // arrange
        $bankLogikk = new bankLogikk(new DBStub());
        $kunde = new kunde();
        $kunde->personnummer = "01010110523";
        $kunde->fornavn = "Lene";
        $kunde->etternavn ="Jensen";
        $kunde->adresse = "Askerveien 22";
        $kunde->postnr = "3270";
        $kunde->telefonnr = "22224444";
        $kunde->passord = "HeiHei";
        // act
        $OK = $bankLogikk->endreKunde($kunde);
       // assert
        $this->assertEquals("OK",$OK); 
    }
    
    function test_endreKundeInfo_Feil()
    {
        // arrange
        $bankLogikk = new bankLogikk(new DBStub());
        $kunde = new kunde();
        $kunde->personnummer = "111111111";
        $kunde->fornavn = "Lene";
        $kunde->etternavn ="Jensen";
        $kunde->adresse = "Askerveien 22";
        $kunde->postnr = "3270";
        $kunde->telefonnr = "22224444";
        $kunde->passord = "HeiHei";
        // act
        $OK = $bankLogikk->endreKunde($kunde);
       // assert
        $this->assertEquals("Feil",$OK); 
    }   
}

?>