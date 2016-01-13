<?php include "fungsi/fungsi.php"; 
/* 
-- keterangan Masing Masing Fungsi yang dipake dari Library gmp --

gmp_div_qr = Bagi;
gmp_add    = Tambah;
gmp_mul    = Kali;
gmp_sub    = Kurang;
gmp_gcd    = Menghitung Nilai phi;
gmp_strval = Convert Nomer ke String;

*/

// Inisialisasi P = 113 & Q = 157 (Masing Masing adalah Bilangan Prima) <--- Lebih Besar Lebih Bagus
// Menghitung N = P*Q
$n = gmp_mul(113, 157);

echo "gmp mull :". $n;
$valn = gmp_strval($n);

// Menghitung Nilai M =(p-1)*(q-1)
$m = gmp_mul(gmp_sub(113, 1),gmp_sub(157, 1));
 
// Mencari E (Kunci Public --> (e,n))
// Inisialisasi E = 5
// Membuktikan E = FPB (Faktor Persekutuan Terbesar) dari E dan M = 1
for($e = 5; $e < 1000; $e++){  // Mencoba dengan Perulangan 1000 Kali 
    $fpb = gmp_gcd($e, $m);
    if(gmp_strval($fpb)=='1') // Jika Benar E adalah FPB dari E dan M = 1 <-- Hentikan Proses
    break;
}

// Menghitung D (Kunci Private --> (d,n))
// D = (($m * $i) + 1) / e = $key[1] <-- Perulangan Do While
$i=1;
 do {      
    $key = gmp_div_qr(gmp_add(gmp_mul($m,$i),1), $e);
    $i++;
    if($i==1000) // Dengan Perulangan 1000 Kali
        break;
} 
// Sampai $key[1]=0
while(gmp_strval($key[1])!='0');
// Hasil D = $key[0] 
$d = $key[0];
$vald =gmp_strval($d); 


// Jika Button Enkripsi ditekan
if ((isset($_POST['enkrip'])) && (!empty($_POST['plain']))){
$plain = $_POST['plain']; 
$hasilenkripsi = enkripsi($plain, $n, $e);
} else {
$hasilenkripsi = 'Ups, Sepertinya Plain Teks Masih Kosong';
}

// Jika Button Deskripsi ditekan
if ((isset($_POST['dekrip'])) && (!empty($_POST['chiper'])) && ($_POST['chiper'] != 'Ups, Sepertinya Plain Teks Masih Kosong')){
$chiper = $_POST['chiper'];
$hasildeskripsi = deskripsi($chiper, $d, $n);
} else {
$hasildeskripsi[0] = 'Null';
$hasildeskripsi[1] = 'Ups, Sebelumnya Anda Harus Melakukan Proses Enkripsi';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<title>Algorithma RSA PHP</title>
	<link rel="stylesheet" type="textcss" href="css/style.css">
	<link rel="icon" href="img/log.png">
</head>

<body>
<div id="tengah">
<form method="post">
<table>
	<tr>
	<td colspan="3"><div id="header">Kriptografi Algorithma Asimetris RSA dengan PHP</div></td>
	</tr>
	<tr>
	<td>Plain Teks =></td><td>Chipper Teks =></td><td>Plain Teks</td>
	</tr>
	<tr>
	<td><textarea name="plain" cols="30" rows="5" placeholder=" Teks Sebelum Enkripsi"></textarea></td>
	<td>
	<textarea name="chiper" cols="30" rows="5" placeholder=" Teks Hasil Enkripsi"><?php if (isset($_POST['enkrip'])){echo $hasilenkripsi; }?></textarea>
	</td>
	<td>
	<textarea name="hasilplain" cols="30" rows="5" placeholder=" Teks Hasil Deskripsi"><?php if (isset($_POST['dekrip'])){ echo $hasildeskripsi[1]; } ?></textarea>
	</td>
	</tr>
	<tr>
	<td>Public Key</td><td>Private Key</td><td>Waktu Eksekusi</td>
	</tr>
	<tr>
	<td><input type="text" name="keypublic" placeholder=" Kunci Public" Value="<?php if (isset($_POST['enkrip'])){ echo ' '.$e.' & '.$valn.' -> (e,n)';} ?>"></td>
	<td><input type="text" name="keyprivate" placeholder=" Kunci Private" Value="<?php if (isset($_POST['dekrip'])){ echo ' '.$vald.' & '.$valn.' -> (d,n)';} ?>"></td>
	<td><?php if (isset($_POST['dekrip'])){ echo $hasildeskripsi[0]; } ?></td>
	</tr>
	<tr>
	<td><input name="enkrip" type="submit" value="Enkripsi" class="tombol medium gray"></td>
	<td><input name="dekrip" type="submit" value="Dekripsi" class="tombol medium gray"></td>
	<td><input type="button" value="Clear" onClick="document.location.reload(true)" class="tombol medium gray"></td>
	</tr>
	<tr>
	<td colspan="3" align="center"><div id="footer">Keterangan : P = 113, Q = 157 & E = 5</div></td>
	</tr>
	<tr>
	<td colspan="3" align="center"><div id="footer">Created By. Ahmad Tauhid [0910530194] &copy; 2013-2014 STMIK Bumigora Mataram</div></td>
	</tr>
</table>
</form>
</div>
</body>
</html>
