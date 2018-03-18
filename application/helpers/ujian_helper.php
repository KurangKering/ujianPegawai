<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
if ( ! function_exists('date_conversion'))
{
	function date_conversion($date){
		if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) 
		{
			$tanggal = DateTime::createFromFormat('Y-m-d',$date);
			return $tanggal->format("m/d/Y");
		} else 
		if (preg_match("/^(0[1-9]|1[0-2])\/(0[1-9]|[1-2][0-9]|3[0-1])\/[0-9]{4}$/",$date)) 
		{
			$tanggal = DateTime::createFromFormat('m/d/Y',$date);
			return $tanggal->format("Y-m-d");
		} else
		return false;
	}
}
if ( ! function_exists('is_connected'))
{
	function is_connected()
	{
		$connected = @fsockopen("www.google.com", 80); 
                                        //website, port  (try 80 or 443)
		if ($connected){
        $is_conn = true; //action when connected
        fclose($connected);
    }else{
        $is_conn = false; //action in connection failure
    }
    return $is_conn;
}
}

if (! function_exists('show_message')) {
	function show_message($tipe, $pesan)
	{
		if (!$pesan  || !$tipe ) {
			return null;
		}
		$sql = '
		console.log("cicak");
		toastr.options = {
			"closeButton": false,
			"debug": false,
			"newestOnTop": true,
			"progressBar": false,
			"positionClass": "toast-top-center",
			"preventDuplicates": true,
			"onclick": null,
			"showDuration": "0",
			"hideDuration": "0",
			"timeOut": "2500",
			"extendedTimeOut": "0",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		},
		toastr["'.$tipe.'"]("'.$pesan.'")
		';
		return $sql;
	}
}

if ( ! function_exists('tanggal_indo'))
{
	function tanggal_indo($tanggal, $cetak_hari = false)
	{
		$hari = array ( 1 =>    'Senin',
			'Selasa',
			'Rabu',
			'Kamis',
			'Jumat',
			'Sabtu',
			'Minggu'
			);
		
		$bulan = array (1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
			);
		$split 	  = explode('-', $tanggal);
		$tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
		
		if ($cetak_hari) {
			$num = date('N', strtotime($tanggal));
			return $hari[$num] . ', ' . $tgl_indo;
		}
		return $tgl_indo;
	}
}