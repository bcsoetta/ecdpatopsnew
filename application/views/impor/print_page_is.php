<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            @media print {
                .pagebreak { page-break-before: always; } /* page-break-after works, as well */
            } 
            .center {
                text-align: center;
            }
            .right {
                text-align: right;
            }
            .left {
                text-align: right;
            }
            .space {
                border-left: 1px solid;
                border-right: 1px solid;
                border-bottom: 1px solid;
                height: 20px;
                width: 100%;
            }
            .my-table {
                border-left: 1px solid;
                border-right: 1px solid;
                border-bottom: 1px solid;
                width: 100%;
                font-size: 12px;
            }
            .my-border {
                border: 1px solid;
                padding: 5px 5px 5px 5px;
            }
            .verticalText {
                text-align: center;
                transform: rotate(270deg);
            }

	.burem {
	color: grey;
}

        </style>
    </head>
    <body>
        <table style="font-size: 14px; width: 100%;">
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; text-align: center;"><b>FORMULIR IMPOR SEMENTARA<br />
                    BARANG PRIBADI PENUMPANG DAN BARANG PRIBADI AWAK SARANA PENGANGKUT
                    </b>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <table class="my-table" style="border-top: 1px solid;">
                        <tr>
                            <td colspan="9" style="text-align: right">Halaman 1 dari ...</td>
                        </tr>
                    </table>
                    <table class="my-table">
                        <tr>
                            <td width="2%">A.</td>
                            <td width="48%" colspan="4" style="border-right: 1px solid;">DATA PEMBERITAHU</td>
                            <td width="2%">G.</td>
                            <td width="48%" colspan="3">KOLOM KHUSUS BEA DAN CUKAI</td>
                        </tr>
                        <tr>
                            <td width="2%">&nbsp;</td>
                            <td width="2%">1.</td>
                            <td width="18%">Nama Lengkap</td>
                            <td width="5%">:</td>
                            <td width="23%" style="border-right: 1px solid;"><?= $header->name;?></td>
                            <td width="2%">&nbsp;</td>
                            <td width="10%">Nomor</td>
                            <td width="2%">:</td>
                            <td width="36%"><?= $header->doc_number;?></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>2.</td>
                            <td>Alamat Lengkap</td>
                            <td>:</td>
                            <td style="border-right: 1px solid;"><?= $header->address;?></td>
                            <td>&nbsp;</td>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td><?= $header->doc_date;?></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>3.</td>
                            <td>Nomor Paspor</td>
                            <td>:</td>
                            <td style="border-right: 1px solid;"><?= $header->passport;?></td>
                            <td colspan="4">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="border-top: 1px solid;">B.</td>
                            <td style="border-top: 1px solid; border-right: 1px solid;" colspan="4">DATA SPONSOR</td>
                            <td style="border-top: 1px solid;">10.</td>
                            <td style="border-top: 1px solid;">Invoice No</td>
                            <td style="border-top: 1px solid;">:</td>
                            <td style="border-top: 1px solid;"> <?= $header->inv_number; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tgl. <?= date('d-m-Y', strtotime($header->inv_date)); ?></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>4.</td>
                            <td>Nama Lengkap</td>
                            <td>:</td>
                            <td style="border-right: 1px solid;"><?=$sponsor->name;?></td>
                            <td colspan="4">&nbsp;</td>
                        </tr>
                        <tr>
                            <td >&nbsp;</td>
                            <td >5.</td>
                            <td >Alamat di Indonesia</td>
                            <td >:</td>
                            <td style="border-right: 1px solid;"><?=$sponsor->address;?></td>
                            <td style="vertical-align: top; border-top: 1px solid;">11.</td>
                            <td style="border-top: 1px solid;">Nama Sarana Pengangkut & No. Voy/Flight</td>
                            <td style="border-top: 1px solid;">:</td>
                            <td style="border-top: 1px solid;" colspan="2"><?=$header->carrier_info;?></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>6.</td>
                            <td>Nomor Telepon</td>
                            <td>:</td>
                            <td style="border-right: 1px solid;"><?=$sponsor->phone;?></td>
                            <td style="vertical-align: top; border-top: 1px solid;">12.</td>
                            <td style="border-top: 1px solid;">Perkiraan Tanggal Keluar</td>
                            <td style="border-top: 1px solid;">:</td>
                            <td style="border-top: 1px solid;" colspan="2"><?= date('d-m-Y', strtotime($header->inv_date_out)); ?></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>7.</td>
                            <td>Nomor Identitas</td>
                            <td>:</td>
                            <td style="border-right: 1px solid;"><?=$sponsor->identity_number;?></td>
                            <td colspan="4">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="border-top: 1px solid;">C.</td>
                            <td style="border-top: 1px solid; border-right: 1px solid;" colspan="4">DATA PENGGUNAAN BARANG</td>
                            <td style="border-top: 1px solid;">13.</td>
                            <td style="border-top: 1px solid;">Pelabuhan Masuk</td>
                            <td style="border-top: 1px solid;">:</td>
                            <td style="border-top: 1px solid; text-align: center;"><?=$header->airport_in;?></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>8.</td>
                            <td>Lokasi Penggunaan</td>
                            <td>:</td>
                            <td style="border-right: 1px solid;"><?=$sponsor->location;?></td>
                            <td colspan="4">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>9.</td>
                            <td>Tujuan Penggunaan</td>
                            <td>:</td>
                            <td style="border-right: 1px solid;"><?=$sponsor->reason;?></td>
                            <td style="vertical-align: top; border-top: 1px solid;">14.</td>
                            <td style="border-top: 1px solid;">Pelabuhan Keluar</td>
                            <td style="border-top: 1px solid;">:</td>
                            <td style="border-top: 1px solid; text-align: center;"><?=$header->airport_in;?></td>
                        </tr>
                    </table>
                    <table class="my-table">
                        <tr>
                            <td width="2%">D.</td>
                            <td width="48%" colspan="4" style="border-right: 1px solid;">PENGEMBALIAN JAMINAN</td>
                            <td width="2%">16.</td>
                            <td width="48%" colspan="3">Rekening</td>
                        </tr>
                        <tr>
                            <td width="2%">&nbsp;</td>
                            <td width="2%">15.</td>
                            <td width="7%">Melalui : </td>
                            <td width="5%" class="center" style="border: 1px solid;"><?=$header->return_type;?></td>
                            <td width="34%" style="border-right: 1px solid;">1. Diambil Sendiri</td>
                            <td width="2%">&nbsp;</td>
                            <td width="10%">Nomor</td>
                            <td width="2%">:</td>
                            <td width="36%"><?=$account->number;?></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td style="border-right: 1px solid;">2. Sponsor</t>
                            <td>&nbsp;</td>
                            <td>Atas Nama</td>
                            <td>:</td>
                            <td><?=$account->name;?></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td style="border-right: 1px solid;">3. Transfer Rekening</td>
                            <td>&nbsp;</td>
                            <td>Bank</td>
                            <td>:</td>
                            <td><?=$account->bank;?></td>
                        </tr>
                    </table>
                    <table class="my-table">
                        <tr>
                            <td colspan="5" style="border-bottom: 1px solid;">E. DATA BARANG</td>
                        </tr>
                        <tr>
                            <td width="5%" style="border-right: 1px solid;">17. No</td>
                            <td width="45%" style="border-right: 1px solid;">18. Uraian Barang</td>
                            <td width="20%" style="border-right: 1px solid;">19. Spesifikasi / Identitas Barang</td>
                            <td width="20%" style="border-right: 1px solid;">20. Jumlah dan Jenis Satuan</td>
                            <td width="10%">21. Perkiraan Nilai Barang (CIF)</td>
                        </tr>
                        <?php
                        $created = explode(' ', $header->created_at);
                        $time = strtotime($created[0]);
                        $created_date = date('d-m-Y', $time);
                        $array_date = explode('-', $created_date);
                        $new_date = $array_date[0] . ' ' . get_month($array_date[1]) . ' ' . $array_date[2];

                        $num_items = count($items);
                        $next_page = false;
                        if ($num_items >= 2) $next_page = true;
                        $no_items = 1;
                        foreach ($items as $val) {
                            if ($num_items > 1) { ?>
                            <tr>    
                                <td colspan="5" class="center" style="border-top: 1px solid;"><?= $num_items . ' (' . terbilang($num_items) .')';?> jenis barang, lihat lembar lanjutan</td>
                            </tr>
                            </table>
                            <?php
                            } else { ?>
                                <tr>    
                                    <td class="center" style="border-right: 1px solid; border-top: 1px solid;"><?= $no_items; ?></td>
                                    <td class="center" style="border-right: 1px solid; border-top: 1px solid;"><?= $val['name']; ?></td>
                                    <td class="center" style="border-right: 1px solid; border-top: 1px solid;"><?= $val['description']; ?></td>
                                    <td class="center" style="border-right: 1px solid; border-top: 1px solid;"><?= $val['quantity'] . ' ' . $val['package']; ?></td>
                                    <td class="center" style="border-top: 1px solid;"><?= $val['fob']; ?></td>
                                </tr>
                                </table>
                                <table class="my-table">
                                    <tr>
                                        <td width="5%" style="vertical-align: top;" rowspan="4">F.</td>
                                        <td width="45%" class="center" rowspan="4" style="border-right: 1px solid;">Dengan ini saya menyatakan bertanggung jawab atas
                                            kebenaran hal-hal yang diberitahukan dalam dokumen ini <br />
                                            Jakarta, Tgl <?= $new_date; ?><br />
                                            Pemohon <br /><br />

                                            (<?= $header->name; ?>)
                                        </td>
                                        <td style="border-bottom: 1px solid;" width="10%">22. Valuta</td>
                                        <td style="border-bottom: 1px solid;" width="5%">:</td>
                                        <td style="border-bottom: 1px solid;" width="10%" style="border-right: 1px solid;"><?= $val['currency']; ?></td>
                                        <td style="border-bottom: 1px solid;" width="10%">23. NDPBM</td>
                                        <td style="border-bottom: 1px solid;" width="5%">:</td>
                                        <td style="border-bottom: 1px solid;" width="10%" style="border-right: 1px solid;"><?= $val['kurs']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 1px solid;" width="10%">24. FOB</td>
                                        <td style="border-bottom: 1px solid;" width="5%">:</td>
                                        <td style="border-bottom: 1px solid;" width="10%" style="border-right: 1px solid;"><?= $val['fob']; ?></td>
                                        <td style="border-bottom: 1px solid;" width="10%">25. Freight</td>
                                        <td style="border-bottom: 1px solid;" width="5%">:</td>
                                        <td style="border-bottom: 1px solid;" width="10%" style="border-right: 1px solid;"><?= $val['freight']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 1px solid;" width="10%">26. Asuransi</td>
                                        <td style="border-bottom: 1px solid;" width="5%">:</td>
                                        <td style="border-bottom: 1px solid;" width="10%" style="border-right: 1px solid;"><?= $val['insurance']; ?></td>
                                        <td style="border-bottom: 1px solid;" width="10%">27. CIF</td>
                                        <td style="border-bottom: 1px solid;" width="5%">:</td>
                                        <td style="border-bottom: 1px solid;" width="10%" style="border-right: 1px solid;"><?= $val['fob'] + $val['freight'] + $val['insurance'] ; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="10%">28. Rp</td>
                                        <td width="5%">:</td>
                                        <td width="35%" colspan="4"><?= $val['pabean_value']; ?></td>
                                    </tr>
                                </table>
                                <?php
                            }
                            break;
                        }
                        ?>
                    
                    <table class="my-table">
                        <tr>
                            <td colspan="6" style="border-bottom: 1px solid;">H. HASIL PEMERIKSAAN/PENETAPAN PEJABAT BEA DAN CUKAI PELABUHAN PEMASUKAN</td>
                        </tr>
                        <tr>
                            <td width="5%" style="border-bottom: 1px solid; border-right: 1px solid;">29. No</td>
                            <td width="45%" style="border-bottom: 1px solid; border-right: 1px solid;">30. Uraian barang secara lengkap meliputi jenis,jumlah, merek, tipe, ukuran, dan spesifikasi lainnya</td>
                            <td width="15%" style="border-bottom: 1px solid; border-right: 1px solid;">31. Nilai Pabean</td>
                            <td width="5%" style="border-bottom: 1px solid;">32.</td>
                            <td width="15%" style="border-bottom: 1px solid; border-right: 1px solid;">- Pos Tarif / HS <br /> - Tarif BM, Cukai, PPn, PPh, PPnBM</td>
                            <td width="15%" style="border-bottom: 1px solid;">33. Dalam Rupiah (Rp)</td>
                        </tr>
                        <?php
                        $no = 1;
                        $bottom = 'border-bottom:1px solid;';
                        foreach ($items as $index => $val) {
                        if ($num_items > 1) { ?>
                            <tr>    
                                <td colspan="6" class="center"><?= $num_items . ' (' . terbilang($num_items) .')';?> jenis barang, lihat lembar lanjutan</td>
                            </tr>
                            <?php
                        } else { 
                            if ($index == ($num_items - 1)) {
                                $bottom = '';
                            }
                        ?>
                            <tr>
                                <td style="border-right: 1px solid; <?=$bottom;?> text-align: center;" rowspan="5"><?= $no; ?></td>
                                <td style="border-right: 1px solid; <?=$bottom;?>" rowspan="5"><?= $val['desc']; ?></td>
                                <td style="border-right: 1px solid; <?=$bottom;?>" rowspan="5"><?= $val['pabean_value']; ?></td>
                                <td rowspan="5" style="<?=$bottom;?>"></td>
                                <td style="border-right: 1px solid; <?=$bottom;?>" rowspan="5"><?= $val['hs']; ?></td>
                                <td style="<?=$bottom;?>">33. BM : <?= $val['bmIdr']; ?></td>
                            </tr>
                            <tr>
                                <td style="<?=$bottom;?>">34. PPN : <?= $val['ppnIdr']; ?></td>
                            </tr>
                            <tr>
                                <td style="<?=$bottom;?>">35. PPnBM : <?= $val['ppnbmIdr']; ?></td>
                            </tr>
                            <tr>
                                <td style="<?=$bottom;?>">36. PPh : <?= $val['pphIdr']; ?></td>
                            </tr>
                            <tr>
                                <td style="<?=$bottom;?>">37. Total : <?= $val['total']; ?></td>
                            </tr>
                        <?php
                        }
                        $no++;
                        break; 
                        } ?>
                    </table>
                    <table class="my-table">
                        <tr>
                            <td style="border-right: 1px solid; width: 30%;">38. Bukti Penerimaan Jaminan (BPJ) No. : <?= $header->re_doc_number; ?></td>
                            <td style="border-right: 1px solid; width: 20%;">Tanggal : <?= $new_date; ?></td>
                            <td>39. Jangka Waktu Izin Impor Sementara : <?= $header->periode; ?> Hari</td>
                        </tr>
                    </table>
                    <table class="my-table">
                        <tr>
                            <td width="50%" style="border-right: 1px solid;">
                                Jakarta, Tgl <?= $new_date; ?><br />
                                Pejabat Bea dan Cukai
                                <br /><br /><br /><br />
<br /><br /><br /><br />
<span class="burem">Ditandatangani secara elektronik</span><br>
                                Nama&nbsp;&nbsp;&nbsp;: <?= $header->officer_name; ?><br />
                                                            </td>
                            <td width="50%" style="vertical-align: top;">I. CATATAN PEJABAT BEA DAN CUKAI</td>
                        </tr>
                    </table>
                    <table class="my-table">
                        <tr>
                            <td colspan="6" style="border-bottom: 1px solid;">J. UNTUK PEJABAT BEA DAN CUKAI PELABUHAN PENGELUARAN</td>
                        </tr>
                        <tr>
                            <td width="5%">40.</td>
                            <td width="10%">Kantor</td>
                            <td width="5%">:</td>
                            <td width="25%" style="border-right: 1px solid;">&nbsp;</td>
                            <td width="5%">K.</td>
                            <td width="45%">CATATAN PEJABAT BEA DAN CUKAI</td>
                        </tr>
                        <tr>
                            <td>41.</td>
                            <td>Nomor</td>
                            <td>:</td>
                            <td style="border-right: 1px solid;">&nbsp;</td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid;">42.</td>
                            <td style="border-bottom: 1px solid;">Tanggal</td>
                            <td style="border-bottom: 1px solid;">:</td>
                            <td style="border-bottom: 1px solid; border-right: 1px solid;" width="30%">&nbsp;</td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">Jakarta, Tgl <?= $new_date; ?></td>
                            <td style="border-right: 1px solid;">&nbsp;</td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">Pejabat Bea dan Cukai</td>
                            <td style="border-right: 1px solid;">&nbsp;</td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <td style="border-right: 1px solid;">&nbsp;</td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="border-right: 1px solid;">
				<br /><br /><br /><br /><br />
				<span class="burem">Ditandatangani secara elektronik</span><br>

				Nama&nbsp;&nbsp;&nbsp;:<?= $header->officer_name; ?></td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td style="border-right: 1px solid;">&nbsp;</td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <?php
            /**
             * if avail next page
             */
        if ($next_page) { ?>
        <div class="pagebreak"></div>
        <table style="font-size: 14px; width: 100%;">
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; text-align: center;"><b>LEMBAR LANJUTAN<br />
                    FORMULIR IMPOR SEMENTARA<br />
                    BARANG PRIBADI PENUMPANG DAN BARANG PRIBADI AWAK SARANA PENGANGKUT
                    </b>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <table class="my-table" style="border-top: 1px solid;">
                        <tr>
                            <td colspan="3" style="text-align: right">Halaman ... dari ...</td>
                        </tr>
                        <tr>
                            <td width="15%">Kantor Pabean Masuk</td>
                            <td width="5%">:</td>
                            <td width="80%"><?=$header->airport_in;?></td>
                        </tr>
                        <tr>
                            <td>Nomor</td>
                            <td>:</td>
                            <td><?=$header->doc_number;?></td>
                        </tr>
                    </table>

                    <table class="my-table">
                        <tr>
                            <td colspan="5" style="border-bottom: 1px solid;">E. DATA BARANG</td>
                        </tr>
                        <tr>
                            <td width="5%" style="border-right: 1px solid;">17. No</td>
                            <td width="25%" style="border-right: 1px solid;">18. Uraian Barang</td>
                            <td width="25%" style="border-right: 1px solid;">19. Spesifikasi / Identitas Barang</td>
                            <td width="25%" style="border-right: 1px solid;">20. Jumlah dan Jenis Satuan</td>
                            <td width="20%">21. Perkiraan Nilai Barang (CIF)</td>
                        </tr>
                    </table>
                        <?php
                        $no_items = 1;
                        foreach ($items as $val) { ?>
                        <table class="my-table">
                            <tr>    
                                <td width="5%" class="center" style="border-right: 1px solid;"><?= $no_items; ?></td>
                                <td width="25%" class="center" style="border-right: 1px solid;"><?= $val['name']; ?></td>
                                <td width="25%" class="center" style="border-right: 1px solid;"><?= $val['description']; ?></td>
                                <td width="25%" class="center" style="border-right: 1px solid;"><?= $val['quantity'] . ' ' . $val['package']; ?></td>
                                <td width="20%" class="center"><?= $val['fob']; ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="border-top: 1px solid; border-right: 1px solid;">&nbsp;</td>
                                <td style="border-top: 1px solid; border-right: 1px solid;">
                                    22. Valuta&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?= $val['currency']; ?>
                                </td>
                                <td style="border-top: 1px solid;">
                                    23. NDPBM&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?= $val['kurs']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="border-top: 1px solid; border-right: 1px solid;">&nbsp;</td>
                                <td style="border-top: 1px solid; border-right: 1px solid;">
                                    24. FOB&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?= $val['fob']; ?>
                                </td>
                                <td style="border-top: 1px solid;">
                                    25. Freight&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?= $val['freight']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="border-top: 1px solid; border-right: 1px solid;">&nbsp;</td>
                                <td style="border-top: 1px solid; border-right: 1px solid;">
                                    26. Asuransi&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?= $val['insurance']; ?>
                                </td>
                                <td style="border-top: 1px solid;">
                                    27. CIF&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?= $val['fob'] + $val['freight'] + $val['insurance']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="border-top: 1px solid; border-right: 1px solid;">&nbsp;</td>
                                <td colspan ="2" style="border-top: 1px solid;">
                                    28. Rp.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?= $val['pabean_value']; ?>
                                </td>
                            </tr>
                        </table>
                            
                        <?php $no_items++; } ?>
                        <table class="my-table">
                            <tr>
                                <td width="50%">&nbsp;</td>
                                <td width="50%" class="center">
                                        Dengan ini saya menyatakan bertanggung jawab atas
                                        kebenaran hal-hal yang diberitahukan dalam dokumen ini <br />
                                        Jakarta, Tgl <?= $new_date; ?><br />
                                        Pemohon <br /><br /><br /><br />

                                        (<?= $header->name; ?>)
                                </td>
                            </tr>
                        </table>

                    <table class="my-table">
                        <tr>
                            <td colspan="6" style="border-bottom: 1px solid;">H. HASIL PEMERIKSAAN/PENETAPAN PEJABAT BEA DAN CUKAI PELABUHAN PEMASUKAN</td>
                        </tr>
                        <tr>
                            <td width="5%" style="border-bottom: 1px solid; border-right: 1px solid;">29. No</td>
                            <td width="40%" style="border-bottom: 1px solid; border-right: 1px solid;">30. Uraian barang secara lengkap meliputi jenis,jumlah, merek, tipe, ukuran, dan spesifikasi lainnya</td>
                            <td width="15%" style="border-bottom: 1px solid; border-right: 1px solid;">31. Nilai Pabean</td>
                            <td width="5%" style="border-bottom: 1px solid;">32.</td>
                            <td width="15%" style="border-bottom: 1px solid; border-right: 1px solid;">- Pos Tarif / HS <br /> - Tarif BM, Cukai, PPn, PPh, PPnBM</td>
                            <td width="20%" style="border-bottom: 1px solid;">33. Dalam Rupiah (Rp)</td>
                        </tr>
                        <?php
                        $no = 1;
                        $bottom = 'border-bottom:1px solid;';
                        $total = 0;
                        foreach ($items as $index => $val) { 
                            if ($index == ($num_items - 1)) {
                                $bottom = '';
                            }
                        ?>
                            <tr>
                                <td style="border-right: 1px solid; <?=$bottom;?> text-align: center;" rowspan="5"><?= $no; ?></td>
                                <td style="border-right: 1px solid; <?=$bottom;?>" rowspan="5"><?= $val['desc']; ?></td>
                                <td style="border-right: 1px solid; <?=$bottom;?>" rowspan="5"><?= $val['pabean_value']; ?></td>
                                <td rowspan="5" style="<?=$bottom;?>"></td>
                                <td style="border-right: 1px solid; <?=$bottom;?>" rowspan="5"><?= $val['hs']; ?></td>
                                <td style="<?=$bottom;?>">33. BM : <?= $val['bmIdr']; ?></td>
                            </tr>
                            <tr>
                                <td style="<?=$bottom;?>">34. PPN : <?= $val['ppnIdr']; ?></td>
                            </tr>
                            <tr>
                                <td style="<?=$bottom;?>">35. PPnBM : <?= $val['ppnbmIdr']; ?></td>
                            </tr>
                            <tr>
                                <td style="<?=$bottom;?>">36. PPh : <?= $val['pphIdr']; ?></td>
                            </tr>
                            <tr>
                                <td style="<?=$bottom;?>">37. Total : <?= $val['total']; ?></td>
                            </tr>
                        <?php
                        $no++;
                        $total += str_replace('.', '', $val['total']);
                        }
                        ?>
                        <tr>
                            <td style="border-top: 1px solid; border-right: 1px solid;" colspan="5">Total</td>
                            <td style="border-top: 1px solid;"><?= setIdr($total); ?></td>
                        </tr>
                    </table>

                    <table class="my-table">
                        <tr>
                            <td width="50%">&nbsp;</td>
                            <td width="50%">
                                    Jakarta, Tanggal <?= $new_date; ?><br />
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pejabat Bea dan cukai<br /><br /><br /><br /><br /><br /
				<br /><br /><br /><br /><br />
				<span class="burem">Ditandatangani secara elektronik</span><br>

                                    Nama&nbsp;&nbsp;&nbsp;: <?= $header->officer_name; ?><br />
                                    </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <?php } ?>
        <!-- end next page -->
    </body>
</html>