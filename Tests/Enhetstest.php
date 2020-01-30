<?php
include_once '../BLL/adminLogikk.php';
include_once '../BLL/bankLogikk.php';
include_once '../DAL/bankDatabaseStub.php';
include_once '../DAL/adminDatabaseStub.php';

class KundeTest extends PHPUnit\Framework\TestCase
{ 
    function test_hentAlleKunder()
    {   
        // arrange
        $adminLogikk=new adminLogikk(new AdminDBStub());
        // act
        $kunder= $adminLogikk->hentAlleKunder();
        // assert
        $this->assertEquals("01010110523", $kunder[0]->Personnummer);
        $this->assertEquals("Lene",$kunder[0]->Fornavn); 
        $this->assertEquals("Jensen",$kunder[0]->Etternavn); 
        $this->assertEquals("Askerveien 22",$kunder[0]->Adresse); 
        $this->assertEquals("3270",$kunder[0]->Postnr); 
        $this->assertEquals("22224444",$kunder[0]->Telefonnr); 
        $this->assertEquals("HeiHei",$kunder[0]->Passord); 
        
        $this->assertEquals("12345678901", $kunder[1]->Personnummer);
        $this->assertEquals("Per",$kunder[1]->Fornavn); 
        $this->assertEquals("Hansen",$kunder[1]->Etternavn); 
        $this->assertEquals("Osloveien 82",$kunder[1]->Adresse); 
        $this->assertEquals("1234",$kunder[1]->Postnr); 
        $this->assertEquals("12345678",$kunder[1]->Telefonnr); 
        $this->assertEquals("HeiHei",$kunder[1]->Passord);    
    }
    
    function test_hentAlleKontoer()
    {   
        // arrange
        $adminLogikk=new adminLogikk(new AdminDBStub());
        // act
        $kontoListe= $adminLogikk->hentAlleKonti();
        // assert
        $this->assertEquals("105010123456",$kontoListe[0]->Kontonummer); 
        $this->assertEquals("01010110523",$kontoListe[0]->Personnummer); 
        $this->assertEquals("720",$kontoListe[0]->Saldo); 
        $this->assertEquals("Lonnskonto",$kontoListe[0]->Type); //Må man ha o for ø?
        $this->assertEquals("NOK",$kontoListe[0]->Valuta); 
        
        $this->assertEquals("22334412345",$kontoListe[1]->Kontonummer); 
        $this->assertEquals("01010110523",$kontoListe[1]->Personnummer); 
        $this->assertEquals("10234.5",$kontoListe[1]->Saldo); 
        $this->assertEquals("Brukskonto",$kontoListe[1]->Type); 
        $this->assertEquals("NOK",$kontoListe[1]->Valuta); 
        
        $this->assertEquals("105020123456",$kontoListe[2]->Kontonummer); 
        $this->assertEquals("01010110523",$kontoListe[2]->Personnummer); 
        $this->assertEquals("100500",$kontoListe[2]->Saldo); 
        $this->assertEquals("Sparekonto",$kontoListe[2]->Type); 
        $this->assertEquals("NOK",$kontoListe[2]->Valuta);    
    }
    
    function test_registerKunde_OK()
    {
        // arrange
        $adminLogikk=new adminLogikk(new AdminDBStub());
        $kunde = new kunde();
        $kunde->Personnummer = "01010110523"; 
        $kunde->Fornavn = "Lene";
        $kunde->Etternavn ="Jensen";
        $kunde->Adresse = "Askerveien 22";
        $kunde->Postnr = "3270";
        $kunde->Telefonnr = "22224444";
        $kunde->Passord = "HeiHei";
        // act
        $OK= $adminLogikk->registrerKunde($kunde);
        // assert
        $this->assertEquals("OK",$OK); 
    }
    
    function test_registrerKunde_DB_Feil()
    {
        // arrange
        $adminLogikk=new adminLogikk(new AdminDBStub());
        $kunde = new kunde();
        $kunde->Personnummer = "111111111"; 
        $kunde->Fornavn = "Lene";
        $kunde->Etternavn ="Jensen";
        $kunde->Adresse = "Askerveien 22";
        $kunde->Postnr = "3270";
        $kunde->Telefonnr = "22224444";
        $kunde->Passord = "HeiHei";
        // act
        $OK= $adminLogikk->registrerKunde($kunde);
        // assert
        $this->assertEquals("Feil",$OK); 
    }
    
    function test_endreKundeInfo_Admin_OK()
    {
       // arrange
        $adminLogikk = new adminLogikk(new AdminDBStub());
        $kunde = new kunde();
        $kunde->Personnummer = "01010110523";
        $kunde->Fornavn = "Lene";
        $kunde->Etternavn ="Jensen";
        $kunde->Adresse = "Askerveien 22";
        $kunde->Postnr = "3270";
        $kunde->Telefonnr = "22224444";
        $kunde->Passord = "HeiHei";
        // act
        $OK = $adminLogikk->endreKundeInfo($kunde);
       // assert
        $this->assertEquals("OK",$OK); 
    }
    
    function test_endreKundeInfo_Admin_Feil()
    {
        // arrange
        $adminLogikk = new adminLogikk(new AdminDBStub());
        $kunde = new kunde();
        $kunde->Personnummer = "11111111111";
        $kunde->Fornavn = "Lene";
        $kunde->Etternavn ="Jensen";
        $kunde->Adresse = "Askerveien 22";
        $kunde->Postnr = "3270";
        $kunde->Telefonnr = "22224444";
        $kunde->Passord = "HeiHei";
        // act
        $OK = $adminLogikk->endreKundeInfo($kunde);
       // assert
        $this->assertEquals("Feil",$OK); 
    }
    
    function test_slettKunde_OK()
    {
        // arrange
        $adminLogikk = new adminLogikk(new AdminDBStub());
        $personnummer= "01010110523";
        // act
        $OK = $adminLogikk->slettKunde($personnummer);
       // assert
        $this->assertEquals("OK",$OK); 
    }
    
    function test_slettKunde_Feil()
    {
        // arrange
        $adminLogikk = new adminLogikk(new AdminDBStub());
        $personnummer= "11111111111";
        // act
        $OK = $adminLogikk->slettKunde($personnummer);
       // assert
        $this->assertEquals("Feil",$OK); 
    }
    
    function test_registrerKonto_OK()
    { 
        // arrange
        $adminLogikk=new adminLogikk(new AdminDBStub());
        $konto1 = new konto();
        $konto1->Kontonummer = "105010123456";
        $konto1->Personnummer = "01010110523";
        $konto1->Saldo = "720";
        $konto1->Type = "Lønnskonto";
        $konto1->Valuta = "NOK"; 
        // act
        $OK= $adminLogikk->registrerKonto($konto1);
        // assert
        $this->assertEquals("OK",$OK);   
    }
    
    function test_registrerKonto_feil()
    {
        // arrange
        $adminLogikk=new adminLogikk(new AdminDBStub());
        $konto1 = new konto();
        $konto1->Kontonummer = "-1";
        $konto1->Personnummer = "105010123456";
        $konto1->Saldo = "720";
        $konto1->Type = "Lønnskonto";
        $konto1->Valuta = "NOK";
        // act
        $OK= $adminLogikk->registrerKonto($konto1);
        // assert
        $this->assertEquals("Feil",$OK); 
    }
    
    function test_slettKonto_OK()
    {
        // arrange
        $adminLogikk = new adminLogikk(new AdminDBStub());
        $kontonummer= "105010123456";
        // act
        $OK = $adminLogikk->slettKonto($kontonummer);
       // assert
        $this->assertEquals("OK",$OK); 
    }
    
    function test_slettKonto_Feil()
    {
        // arrange
        $adminLogikk = new adminLogikk(new AdminDBStub());
        $kontonummer= "-1";
        // act
        $OK = $adminLogikk->slettKonto($kontonummer);
       // assert
        $this->assertEquals("Feil",$OK); 
    }
    
    function test_endreKonto_OK()
    {       
        // arrange
        $adminLogikk = new adminLogikk(new AdminDBStub());
        $konto1 = new konto();
        $konto1->Kontonummer = "105010123456";
        $konto1->Personnummer = "01010110523";
        $konto1->Saldo = "720";
        $konto1->Type = "Lønnskonto";
        $konto1->Valuta = "NOK";
        // act
        $OK = $adminLogikk->endreKonto($konto1);
       // assert
        $this->assertEquals("OK",$OK);        
    }
    
    function test_endreKonto_Feil()
    {
        // arrange
        $adminLogikk = new adminLogikk(new AdminDBStub());
        $konto1 = new konto();
        $konto1->Kontonummer = "-1";
        $konto1->Personnummer = "01010110523";
        $konto1->Saldo = "720";
        $konto1->Type = "Lønnskonto";
        $konto1->Valuta = "NOK";    
        // act
        $OK = $adminLogikk->endreKonto($konto1);
       // assert
        $this->assertEquals("Feil",$OK); 
    }
    
    function hentAlleKonti_OK()
    {
        $adminLogikk=new adminLogikk(new AdminDBStub());
        // act
        $kontoer[]= $adminLogikk->hentAlleKonti();
        // assert
        $this->assertEquals("105010123456", $kontoer[0]->Kontonummer);
        $this->assertEquals("01010110523",$kontoer[0]->Personnummer); 
        $this->assertEquals(720 ,$kontoer[0]->Saldo); 
        $this->assertEquals("Lønnskonto",$kontoer[0]->Type); 
        $this->assertEquals("NOK",$kontoer[0]->Valuta); 
        
        $this->assertEquals("22334412345", $kontoer[1]->Kontonummer);
        $this->assertEquals("01010110523",$kontoer[1]->Personnummer); 
        $this->assertEquals(10234.5 ,$kontoer[1]->Saldo); 
        $this->assertEquals("Brukskonto",$kontoer[1]->Type); 
        $this->assertEquals("NOK",$kontoer[1]->Valuta);
        
        $this->assertEquals("105020123456", $kontoer[2]->Kontonummer);
        $this->assertEquals("01010110523",$kontoer[2]->Personnummer); 
        $this->assertEquals(100500 ,$kontoer[2]->Saldo); 
        $this->assertEquals("Sparekonto",$kontoer[2]->Type); 
        $this->assertEquals("NOK",$kontoer[2]->Valuta);    
    }
    
    function test_sjekkLoggInn_Feil_Personnummer_ForFå(){
        
        $bankLogikk = new bankLogikk(new DBStub());
        $personnummer = "1";
        $passord = "HeiHei";
        
        $OK = $bankLogikk->sjekkLoggInn($personnummer, $passord);
        
        $this->assertEquals("Feil i personnummer", $OK);
    }
    
    function test_sjekkLoggInn_Feil_Personnummer_ForMange(){
        
        $bankLogikk = new bankLogikk(new DBStub());
        $personnummer = "1111111111111111111";
        $passord = "HeiHei";
        
        $OK = $bankLogikk->sjekkLoggInn($personnummer, $passord);
        
        $this->assertEquals("Feil i personnummer", $OK);
    }
    
    function test_sjekkLoggInn_RegEx_Feil_Personnummer() 
    { 
        // arrange
        $bankLogikk=new bankLogikk(new DBStub());
        // act
        $personnummer= "11111111111";
        $passord= "HeiHei";
        $OK = $bankLogikk->sjekkLoggInn($personnummer, $passord);
       // assert
        $this->assertEquals("Feil",$OK); 
    }
    
    function test_sjekkLoggInn_RegEx_Feil_Passord()
    { 
        // arrange
        $bankLogikk=new bankLogikk(new DBStub());
        // act
        $personnummer= "01010110523";
        $passord= "HaloHalo";
        $OK = $bankLogikk->sjekkLoggInn($personnummer, $passord);
       // assert
        $this->assertEquals("Feil",$OK); 
    }
    
    function test_sjekkLoggInn_Feil_Passord_ForFå(){
        
        $bankLogikk = new bankLogikk(new DBStub());
        $personnummer = "01010110523";
        $passord = "1";
        
        $OK = $bankLogikk->sjekkLoggInn($personnummer, $passord);
        
        $this->assertEquals("Feil i passord", $OK);
    }
    
    function test_sjekkLoggInn_Feil_Passord_ForMange(){
        
        $bankLogikk = new bankLogikk(new DBStub());
        $personnummer = "01010110523";
        $passord = "12345678910123456789101234567891012345678910";
        
        $OK = $bankLogikk->sjekkLoggInn($personnummer, $passord);
        
        $this->assertEquals("Feil i passord", $OK);
    }
    
    function test_sjekkLoggInn_Feil()
    {
        //arrange 
        $bankLogikk = new bankLogikk (new DBStub());
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
        $bankLogikk = new bankLogikk (new DBStub());
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
        $kontoer= $bankLogikk->hentKonti($personnummer);
        // assert
        $this->assertEquals("105010123456", $kontoer[0]->Kontonummer);
        $this->assertEquals("01010110523",$kontoer[0]->Personnummer); 
        $this->assertEquals(720 ,$kontoer[0]->Saldo); 
        $this->assertEquals("Lønnskonto",$kontoer[0]->Type); 
        $this->assertEquals("NOK",$kontoer[0]->Valuta);       
                
        $this->assertEquals("22334412345", $kontoer[1]->Kontonummer);
        $this->assertEquals("01010110523",$kontoer[1]->Personnummer); 
        $this->assertEquals(10234.5 ,$kontoer[1]->Saldo); 
        $this->assertEquals("Brukskonto",$kontoer[1]->Type); 
        $this->assertEquals("NOK",$kontoer[1]->Valuta);
        
        $this->assertEquals("105020123456", $kontoer[2]->Kontonummer);
        $this->assertEquals("01010110523",$kontoer[2]->Personnummer); 
        $this->assertEquals(100500 ,$kontoer[2]->Saldo); 
        $this->assertEquals("Sparekonto",$kontoer[2]->Type); 
        $this->assertEquals("NOK",$kontoer[2]->Valuta);     
    }
    
    function test_hentKonti_Feil()
    {
        // arrange
        $bankLogikk=new bankLogikk(new DBStub());
        $personnummer = "11111111111";
        // act
        $OK = $bankLogikk->hentKonti($personnummer);
        // assert   
        $this->assertEquals("Feil", $OK);
    }
    
    function test_hentSaldi_OK() 
    { 
        // arrange
        $bankLogikk=new bankLogikk(new DBStub());
        $personnummer = "01010110523";
        // act
        $saldoer= $bankLogikk->hentSaldi($personnummer);
        // assert
        $this->assertEquals("01010110523",$saldoer[0]->Personnummer); 
        $this->assertEquals(720 ,$saldoer[0]->Saldo);     
                
        $this->assertEquals("01010110523",$saldoer[1]->Personnummer); 
        $this->assertEquals(10234.5 ,$saldoer[1]->Saldo); 

        $this->assertEquals("01010110523",$saldoer[2]->Personnummer); 
        $this->assertEquals(100500 ,$saldoer[2]->Saldo); 
    }
    
    function test_hentSaldi_Feil() 
    {
        // arrange
        $bankLogikk=new bankLogikk(new DBStub());
        $personnummer = "11111111111";
        // act
        $OK= $bankLogikk->hentSaldi($personnummer);
        // assert
        $this->assertEquals("Feil", $OK);
    }

    function test_registrerBetaling_OK()
    { 
        $bankLogikk=new bankLogikk(new DBStub());
        $transaksjon= new transaksjon();
        $transaksjon->TxID = 1;
        $transaksjon->FraTilKontonummer = "20102012345";
        $transaksjon->Beløp = -100.5;
        $transaksjon->Dato = "2015-03-15";
        $transaksjon->Melding = "Meny Storo";
        $kontoNr= "105010123456";
        $transaksjon->Avventer = 0;
        // act
        $OK= $bankLogikk->registrerBetaling($kontoNr, $transaksjon);
        // assert
        $this->assertEquals("OK",$OK);
    }
    
    function test_registrerBetaling_Kontonummer_Feil() 
    { 
        $bankLogikk=new bankLogikk(new DBStub());
        $transaksjon= new transaksjon();
        $transaksjon->TxID = 1;
        $transaksjon->FraTilKontonummer = "20102012345";
        $transaksjon->Beløp = -100.5;
        $transaksjon->Dato = "2015-03-15";
        $transaksjon->Melding = "Meny Storo";
        $kontoNr= "11111111111";
        $transaksjon->Avventer = 0;
        // act
        $OK= $bankLogikk->registrerBetaling($kontoNr, $transaksjon);
        // assert
        $this->assertEquals("Feil",$OK);
    }
    
    function test_hentBetaling_OK() 
    { 
        $bankLogikk=new bankLogikk(new DBStub());
        $personnummer = "01010110523";
        // act
        $transaksjoner= $bankLogikk->hentBetalinger($personnummer);
        // assert
        $this->assertEquals("20102012345", $transaksjoner[0]->FraTilKontonummer);
        $this->assertEquals(-100.5, $transaksjoner[0]->Belop);
        $this->assertEquals("2015-03-15", $transaksjoner[0]->Dato);
        $this->assertEquals("Meny Storo", $transaksjoner[0]->Melding);
        $this->assertEquals(0, $transaksjoner[0]->Avventer);
 
        $this->assertEquals("20102012345", $transaksjoner[1]->FraTilKontonummer);
        $this->assertEquals(400.4, $transaksjoner[1]->Belop);
        $this->assertEquals("2015-03-20", $transaksjoner[1]->Dato);
        $this->assertEquals("Innebtaling", $transaksjoner[1]->Melding);
        $this->assertEquals(0, $transaksjoner[1]->Avventer);
        
        $this->assertEquals("20102012345", $transaksjoner[2]->FraTilKontonummer);
        $this->assertEquals(-1400.7, $transaksjoner[2]->Belop);
        $this->assertEquals("2015-03-13", $transaksjoner[2]->Dato);
        $this->assertEquals("Husleie", $transaksjoner[2]->Melding);
        $this->assertEquals(1, $transaksjoner[2]->Avventer);
        
        $this->assertEquals("20102012347", $transaksjoner[3]->FraTilKontonummer);
        $this->assertEquals(-5000.5, $transaksjoner[3]->Belop);
        $this->assertEquals("2015-03-30", $transaksjoner[3]->Dato);
        $this->assertEquals("Skatt", $transaksjoner[3]->Melding);
        $this->assertEquals(0, $transaksjoner[3]->Avventer);
        
        $this->assertEquals("20102012345", $transaksjoner[4]->FraTilKontonummer);
        $this->assertEquals(345.56, $transaksjoner[4]->Belop);
        $this->assertEquals("2015-03-13", $transaksjoner[4]->Dato);
        $this->assertEquals("Test", $transaksjoner[4]->Melding);
        $this->assertEquals(0, $transaksjoner[4]->Avventer);
        
        $this->assertEquals("12312345", $transaksjoner[5]->FraTilKontonummer);
        $this->assertEquals(1234, $transaksjoner[5]->Belop);
        $this->assertEquals("2012-12-12", $transaksjoner[5]->Dato);
        $this->assertEquals("Melding", $transaksjoner[5]->Melding);
        $this->assertEquals(1, $transaksjoner[5]->Avventer);
        
        $this->assertEquals("345678908", $transaksjoner[6]->FraTilKontonummer);
        $this->assertEquals(3000, $transaksjoner[6]->Belop);
        $this->assertEquals("2012-12-12", $transaksjoner[6]->Dato);
        $this->assertEquals("", $transaksjoner[6]->Melding);
        $this->assertEquals(0, $transaksjoner[6]->Avventer);
        
        $this->assertEquals("234534678", $transaksjoner[7]->FraTilKontonummer);
        $this->assertEquals(15, $transaksjoner[7]->Belop);
        $this->assertEquals("2012-12-12", $transaksjoner[7]->Dato);
        $this->assertEquals("Hei", $transaksjoner[7]->Melding);
        $this->assertEquals(0, $transaksjoner[7]->Avventer);
        
        $this->assertEquals("1234254365", $transaksjoner[8]->FraTilKontonummer);
        $this->assertEquals(125, $transaksjoner[8]->Belop);
        $this->assertEquals("2012-12-12", $transaksjoner[8]->Dato);
        $this->assertEquals("Hopp", $transaksjoner[8]->Melding);
        $this->assertEquals(0, $transaksjoner[8]->Avventer);
    }
            
    function test_hentBetaling_Feil() 
    {
        $bankLogikk=new bankLogikk(new DBStub());
        $personnummer = "11111111111";
        // act
        $OK= $bankLogikk->hentBetalinger($personnummer);
        // assert
        $this->assertEquals("Feil", $OK);
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
        $this->assertEquals("01010110523", $kunde->Personnummer);
        $this->assertEquals("Lene",$kunde->Fornavn); 
        $this->assertEquals("Jensen",$kunde->Etternavn); 
        $this->assertEquals("Askerveien 22",$kunde->Adresse); 
        $this->assertEquals("3270",$kunde->Postnr); 
        $this->assertEquals("22224444",$kunde->Telefonnr); 
        $this->assertEquals("HeiHei",$kunde->Passord); 
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
        $kunde->Personnummer = "01010110523";
        $kunde->Fornavn = "Lene";
        $kunde->Etternavn ="Jensen";
        $kunde->Adresse = "Askerveien 22";
        $kunde->Postnr = "3270";
        $kunde->Telefonnr = "22224444";
        $kunde->Passord = "HeiHei";
        // act
        $OK = $bankLogikk->endreKundeInfo($kunde);
       // assert
        $this->assertEquals("OK",$OK); 
    }
    
    function test_endreKundeInfo_Feil()
    {
        // arrange
        $bankLogikk = new bankLogikk(new DBStub());
        $kunde = new kunde();
        $kunde->Personnummer = "-1";
        $kunde->Fornavn = "Lene";
        $kunde->Etternavn ="Jensen";
        $kunde->Adresse = "Askerveien 22";
        $kunde->Postnr = "3270";
        $kunde->Telefonnr = "22224444";
        $kunde->Passord = "HeiHei";
        // act
        $OK = $bankLogikk->endreKundeInfo($kunde);
       // assert
        $this->assertEquals("Feil",$OK); 
    }   
}

?>