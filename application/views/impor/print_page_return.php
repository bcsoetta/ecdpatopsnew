<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            @media print {
                .pagebreak { page-break-before: always; } /* page-break-after works, as well */
            } 
            .full-width {
                width: 100%;
            }
            .text-center {
                text-align: center;
            }
            .med-font-size {
                font-size: 12px;
            }
            .text-justify {
                text-align: justify;
            }
            .dashed-border {
                border: 1px dashed;
                margin-top: 10px;
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body>
        <?php
        $array_date = explode('-', $header['re_date']);
        if (empty($header['re_date'])) {
            $array_date = explode('-', date('Y-m-d'));
        }
        $new_date = $array_date[2] . ' ' . get_month($array_date[1]) . ' ' . $array_date[0];
        for ($i=0; $i<2; $i++) { ?>
        <div class="full-width text-center med-font-size">
            <b>
                DIREKTORAT JENDERAL BEA DAN CUKAI<br />
                KANTOR PELAYANAN UTAMA BEA DAN CUKAI TIPE C SOEKARNO HATTA
            </b><br />
            KAWASAN GUDANG BANDARA SOEKARNO-HATTA, KOTAK POS 1023,CENGKARENG 19111<br />
            TELEPON: 1500225; FAKSIMILE: 5502105
        </div>
        <br /><br />
        <div class="full-width text-center med-font-size">
            <b><u>TANDA TERIMA PENGEMBALIAN JAMINAN / BARANG TITIPAN</u></b>
        </div>
        <p class="med-font-size">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pada hari ini tanggal <?= $array_date[2]; ?> bulan <?= get_month($array_date[1]); ?> tahun <?= $array_date[0]; ?>
            telah diterima kembali jaminan / barang titipan dengan rincian:
        </p>
        <table class="full-width med-font-size">
            <tr>
                <td width="5%">&nbsp;</td>
                <td width="5%">1.</td>
                <td width="20%">Nomor BPJ/ST</td>
                <td width="5%">:</td>
                <td width="70%"><?= $header['re_doc_number']; ?></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>2.</td>
                <td>Nama</td>
                <td>:</td>
                <td><?= $header['name']; ?></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>3.</td>
                <td>Nomor Paspor</td>
                <td>:</td>
                <td><?= $header['passport']; ?></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>4.</td>
                <td>Jumlah Jaminan</td>
                <td>:</td>
                <td>Rp. <?= setIDR($header['nominal']); ?></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>5.</td>
                <td>Jenis Barang</td>
                <td>:</td>
                <td><?= $items['name']; ?></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>6.</td>
                <td>Jumlah Barang</td>
                <td>:</td>
                <td><?= $items['bruto']; ?> KG</td>
            </tr>
        </table>
        <br />
        <table class="full-width med-font-size">
            <tr>
                <td width="10%">&nbsp;</td>
                <td width="45%" colspan="2">Cengkareng, <?= $new_date; ?></td>
            </tr>
            <tr>
                <td width="10%">&nbsp;</td>
                <td width="45%">Yang Menerima,</td>
                <td width="45%">Yang Menyerahkan,</td>
            </tr>
            <tr>
                <td width="10%">&nbsp;</td>
                <td width="45%" colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td width="10%">&nbsp;</td>
                <td width="45%" colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td width="10%">&nbsp;</td>
                <td width="45%" colspan="2">&nbsp;</td>

            </tr>

	   <tr>
                <td width="10%">&nbsp;</td>
                <td width="45%" colspan="2">&nbsp;</td>

            </tr>
	    <tr>
                <td width="10%">&nbsp;</td>
                <td width="45%" colspan="2">&nbsp;</td>

            </tr>

	    <tr>
                <td width="10%">&nbsp;</td>
                <td width="45%"></td>
                <td width="45%"><i style="color: gray;">Ditandatangani secara elektronik</td>
            </tr>
            <tr>
                <td width="10%">&nbsp;</td>
                <td width="45%"><?= $header['re_name']; ?></td>
                <td width="45%"><?= $_SESSION['users']['name']; ?></td>
            </tr>
        </table>
        <div class="full-width dashed-border"></div>
        <?php } ?>
    </body>
</html>