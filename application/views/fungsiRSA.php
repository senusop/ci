<?php 
/* 
-- keterangan Masing Masing Fungsi yang dipake dari Library gmp & PHP --

gmp_mod    = Sisa Hasil Bagi;
gmp_pow    = Raise number into power;
ord        = Mengembalikan Nilai Karakter Ke ASCII;
strlen     = Dapatkan Panjang String;
gmp_strval = Convert Nomer ke String;
chr        = Mengembalikan ke Nilai Karakter;
explode    = Memecah String;

*/

// Proses Enkripsi
function enkripsi($plain, $n, $e){
//Pesan dikodekan menjadi kode ASCII, Kemudian di Enkripsi Per Karakter
	$hasil='';
    for($i=0; $i<strlen($plain); ++$i){
        //Rumus Enkripsi ---> ChiperTeks = <pesan>^<e>mod<n>
        $hasil.=gmp_strval(gmp_mod(gmp_pow(ord($plain[$i]),$e),$n));
        //Antar Tiap Karakter dipisahkan dengan "+"
        if($i!=strlen($plain)-1){
            $hasil.=" ";
        }
    }
	
return $hasil;
}

// Proses Dekripsi
function deskripsi($chiper, $d, $n){
    $time_start = microtime(true);
    //Pesan Enkripsi dipecah menjadi array dengan batasan "+"
	$hasildekrip = '';
	$hasil = '';
    $dekrip=explode(" ", $chiper);
	
    foreach($dekrip as $nilai){
	//Rumus Deskripsi ---> PlainTeks = <enkripsi>^<d>mod<n>
	$gm1 = gmp_pow($nilai,gmp_strval($d));
	$gm2 = gmp_mod($gm1,$n);
	$gm3 = gmp_strval($gm2);
    $hasildekrip.=chr($gm3); 
    } 
   	$time_end = microtime(true);
	// Waktu Eksekusi
	$time = $time_end - $time_start;
	$hasil = array($time, $hasildekrip);
	
return $hasil;
}

?>