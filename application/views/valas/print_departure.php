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

        </style>
    </head>
    <body>
        <table class="center" width= "100%" style="font-size: 14px; border: 1px solid;">
            <tr>
                <td class="middle" rowspan="2" style="border-right: 1px solid;"><b>BC 3.2</b></td>
                <td rowspan="2" colspan="7" text-align="center"><b>PEMBERITAHUAN PEMBAWAAN MATA UANG TUNAI DAN/ATAU INSTRUMEN PEMBAYARAN LAIN KE LUAR DAERAH PABEAN</b> </br>
                    <b><i>BANK NOTES AND/OR BEARER NEGOTIABLE INSTRUMENTS DECLARATION</i></b>
                </td>
            </tr>
        <table>
        <table width= "100%" style="font-size: 12px; border-left: 1px solid; border-bottom: 1px solid; border-right: 1px solid;">
            <tr>
                <td colspan="3">Kolom Khusus Bea dan Cukai <br />
                    <i>Customs official Column</i>
                </td>
            </tr>
            <tr>
                <td>Kantor Pabean Keberangkatan <br />
                    <i>Customs Office of Departure</i>
                </td>
                <!-- <td colspan="2" class="center"><u><b>KANTOR PELAYANAN UTAMA BEA DAN CUKAI TIPE C SOEKARNO HATTA</u></b></td> -->
                <td class="center" colspan="2"><u><?= $header->office;?></u></td>
            </tr>
            <tr>
                <td width="30%">Nomor dan Tanggal Pendaftaran <br />
                    <i>Number and Date of Registration</i> 
                </td>
                <td width="35%"><div class="my-border"><u><?= $header->doc_number; ?></u></div></td>
                <td width="35%"><div class="my-border"><u><?= date('d/m/Y', strtotime($header->date_registered)); ?></u></div></td>
            </tr>
        <table>
        <table class="my-table">
            <tr>
                <td class="center">
                    <b>Wajib diisi dan disampaikan kepada Pejabat Bea dan Cukai oleh setiap orang pada saat keberangkatan yang membawa uang
                        tunai dan/atau instrumen pembayaran lain dalam mata uang Rupiah sebesar Rp. 100.000.000,- (seratus juta rupiah)
                        atau lebih atau dalam mata uang asing yang jumlahnya setara dengan itu
                    </b><br />
                    <i>Shall be completed and presented to Customs officials by anyone departing abroad who brings Bank Notes and/or Bearer Negotiable
                    Instruments with an amount of Rp. 100.000.000,  (one hundred million rupiah) or more in Rupiah or foreign currency equivalent</i>
                </td>
            </tr>
        <table>
        <table class="my-table">
            <tr>
                <td width="25%">DATA PENGANGKUT <br />
                    <i>INFORMATION OF CARRIER</i>
                </td>
            </tr>
        <table>
        <table class="my-table">
            <tr>
                <td width="5%" class="center">1.</td>
                <td width="25%">No. Penerbangan/Pelayaran/Kendaraan</td>
                <td width="20%" style="border-right: 1px solid;"><u><?= isset($header->flight_number) ? $header->flight_number : '-'; ?></u></td>
                <td width="5%" class="center">2.</td>
                <td width="25%">Tanggal Keberangkatan</td>
                <td width="20%"><u><?= isset($header->arrival_date) ? date('d/m/Y', strtotime($header->arrival_date)) : '-'; ?></u></td>
                <!-- <td width="20%"><?= $result['tanggal_dokumen'];?></td> -->
            </tr>
            <tr>
                <td width="5%" class="center">&nbsp;</td>
                <td colspan="2" width="45%" style="border-right: 1px solid;"><i>Flight/ Voyage/ Vehicle Number</i></td>
                <td width="5%" class="center">&nbsp;</td>
                <td colspan="2" width="45%"><i>Date of Departure</i></td>
            </tr>
        <table>
        <table class="my-table">
            <tr>
                <td width="25%">DATA PENUMPANG <br />
                    <i>INFORMATION OF PASSENGER</i>
                </td>
            </tr>
        <table>
        <table class="my-table">
            <tr>
                <td width="5%" class="center">3.</td>
                <td width="25%">Nama Lengkap</td>
                <td width="20%" style="border-right: 1px solid;"><u><?= isset($header->name) ? $header->name : '-'; ?></u></td>
                <td width="5%" class="center">4.</td>
                <td width="25%">Tempat Keberangkatan</td>
                <td width="20%" style="font-size: 10px;"><u><?= isset($header->last_port) ? $header->last_port : '-'; ?></u></td>
            </tr>
            <tr>
                <td width="5%" class="center">&nbsp;</td>
                <td colspan="2" width="45%" style="border-right: 1px solid;"><i>Full Name</i></td>
                <td width="5%" class="center">&nbsp;</td>
                <td colspan="2" width="45%"><i>Place of Departure</i></td>
            </tr>
            <tr>
                <td width="5%" style="border-top:1px solid;" class="center">5.</td>
                <td width="25%" style="border-top:1px solid;">Kebangsaan</td>
                <td width="20%" style="border-top: 1px solid; border-right: 1px solid;"><u><?= isset($header->nationality) ? $header->nationality : '-'; ?></u></td>
                <td width="5%" class="center">6.</td>
                <td width="25%" style="border-top:1px solid;">Nomor Paspor</td>
                <td width="20%" style="border-top:1px solid;"><u><?= isset($header->identity_number) ? $header->identity_number : '-'; ?></u></td>
            </tr>
            <tr>
                <td width="5%" class="center">&nbsp;</td>
                <td colspan="2" width="45%" style="border-right: 1px solid;"><i>Nationality</i></td>
                <td width="5%" class="center">&nbsp;</td>
                <td colspan="2" width="45%"><i>Passport Number</i></td>
            </tr>
            <tr>
                <td style="border-top:1px solid;" width="5%" class="center">7.</td>
                <td style="border-top:1px solid;" width="25%">Pekerjaan</td>
                <td width="20%" style="border-top: 1px solid; border-right: 1px solid;"><u><?= isset($header->occupation) ? $header->occupation : '-'; ?></u></td>
                <td style="border-top:1px solid;" width="5%" class="center">8.</td>
                <td style="border-top:1px solid;" width="25%">Negara Tujuan</td>
                <td style="border-top:1px solid;" width="20%"><u><?=  isset($header->destination) ? $header->destination : '-'; ?></u></td>
            </tr>
            <tr>
                <td width="5%" class="center">&nbsp;</td>
                <td colspan="2" width="45%" style="border-right: 1px solid;"><i>Occupation</i></td>
                <td width="5%" class="center">&nbsp;</td>
                <td colspan="2" width="45%"><i>Country of Destination</i></td>
            </tr>
        <table>
        <table class="my-table">
            <tr>
                <td width="25%">DATA BARANG <br />
                    <i>INFORMATION OF GOODS</i>
                </td>
            </tr>
        <table>
        <table class="my-table">
            <tr>
                <td>
                    Harap menuliskan jumlah uang tunai dan/atau instrumen pembayaran lain dalam mata uang Rupiah atau dalam mata uang
                    asing yang Anda bawa<br />
                    <i>Please specify the amount of Rupiah or foreign currency of Bank Notes and/or Bearer Negotiable instruments that you bring</i> <br />
                    A. Uang Tunai / <i>Cash</i>
                </td>
            </tr>
        <table>
        <!-- DATA BARANG -->
        <?php
        /**
         * next page process
         */
        $next_page = false;
        $num_cash = count($cash);
        $num_ipl = count ($ipl);

        if ($num_cash >= 2 || $num_ipl >= 2) $next_page = true;
        ?>
        <table class="my-table">
            <tr>
                <td style="border-right: 1px solid;">9. No</td>
                <td style="border-right: 1px solid;">10. Jumlah <br /> <i>Amount</i></td>
                <td>11. Jenis Mata Uang <br /> <i>Currencty</i></td>
            </tr>
            <?php
            $no_cash = 1;
            foreach ($cash as $val) {
                /**
                 * if cash >1
                 */
                if ($num_cash > 1) { ?>
                <tr>    
                    <td colspan="3" class="center" style="border-top: 1px solid;"><?= $num_cash . ' (' . terbilang($num_cash) .')';?> jenis mata uang tunai, lihat lembar lanjutan</td>
                </tr>
                <?php
                } else { ?>
                    <tr>    
                        <td class="center" style="border-right: 1px solid; border-top: 1px solid;"><?= $no_cash; ?></td>
                        <td class="center" style="border-right: 1px solid; border-top: 1px solid;"><?= setIDR($val['amount']); ?></td>
                        <td class="center" style="border-top: 1px solid;"><?= $val['currency']; ?></td>
                    </tr>
                    <?php
                }
                break;
            }
            ?>
        <table>
        <table class="my-table">
            <tr>
                <td>
                    B. Instrumen Pembayaran Lain / <i>Bearer Negotiable Instruments</i>
                </td>
            </tr>
        <table>
        <table class="my-table">
            <tr>
                <td width="10%" style="border-right: 1px solid;">12. No</td>
                <td width="15%" style="border-right: 1px solid;">13. Jumlah <br /> <i>Amount</i></td>
                <td width="35%" style="border-right: 1px solid;">14. Jenis Instrumen Pembayaran Lain (bilyet giro, atau warkat atas bawa berupa
                    cek, cek perjalanan, surat sanggup bayar, dan sertifikat deposito) <br /> <i>Kinds of Bearer Negotiable Instruments</i>
                </td>
                <td width="20%" style="border-right: 1px solid;">15. Nomor <br /> <i>Number</i></td>
                <td width="15%" style="border-right: 1px solid;">16. Tanggal <br /> <i>Date</i></td>
                <td width="20%">17. Bank Penerbit <br /> <i>Issuing Bank</i></td>
            </tr>
            <?php
            $no_ipl = 1;
            foreach ($ipl as $val) {
                // new date
                $date = explode('-', $val['date']);
                /**
                 * if cash >1
                 */
                if ($num_ipl > 1) { ?>
                    <tr>    
                        <td colspan="6" class="center" style="border-top: 1px solid;"><?= $num_ipl . ' (' . terbilang($num_ipl) .')';?> jenis instrumen pembayaran lain, lihat lembar lanjutan</td>
                    </tr>
                    <?php
                    } else { ?>
                        <tr>    
                            <td class="center" style="border-right: 1px solid; border-top: 1px solid;"><?= $no_ipl; ?></td>
                            <td class="center" style="border-right: 1px solid; border-top: 1px solid;"><?= $val['currency'] . ' ' . setIDR($val['amount']); ?></td>
                            <td class="center" style="border-right: 1px solid; border-top: 1px solid;"><?= $val['type']; ?></td>
                            <td class="center" style="border-right: 1px solid; border-top: 1px solid;"><?= $val['number']; ?></td>
                            <td class="center" style="border-right: 1px solid; border-top: 1px solid;"><?= $date[2] . ' ' . get_month($date[1]) . ' ' . $date[0]; ?></td>
                            <td class="center" style="border-top: 1px solid;"><?= $val['bank']; ?></td>
                        </tr>
                    <?php
                    }
                break;
            }
            ?>
        <table>

        <table class="my-table">
            <tr>
                <td width="25%">DOKUMEN PELENGKAP PABEAN <br />
                    <i>COMPLEMENTARY CUSTOMS DOCUMENTS</i> 
                </td>
            </tr>
        <table>
        <!-- DATA DOKUMEN PELENGKAP -->
        <?php
        $date = explode('-', $header->permit_date);
        ?>
        <table class="my-table">
            <tr>
                <td widht="5%">18.</td>
                <td colspan="2" width="95%" style="border-right: 1px solid;">Izin Bank Indonesia</td>
            </tr>
            <tr>
                <td widht="5%">&nbsp;</td>
                <td colspan="2" widht="95%" style="border-right: 1px solid;"><i>Approval Letter issued by Bank Indonesia</i></td>
            </tr>
            <tr>
                <td widht="5%">&nbsp;</td>
                <td widht="50%">Nomor/ <i>Number</i> : <?= $header->permit_number; ?></td>
                <td widht="45%" style="border-right: 1px solid;">Tanggal/ <i>Date</i> : <?= $date[2] . ' ' . get_month($date[1]) . ' ' . $date[0]; ?></td>
            </tr>
        <table>

        <table class="my-table" >
            <tr>
                <td>Saya menyatakan dengan sebenar-benarnya bahwa yang saya beritahukan adalah benar <br />
                    <i>I declare that the information given is true and correct</i>
                </td>
            </tr>
        <table>
        <table class="my-table">
            <?php
            $time = explode(' ', $header->date_registered);
            $date_reg = explode('-', $time[0]);
            // print_r($date); exit();  
            ?>
            <tr>
                <td width="30%">Untuk Pejabat Bea dan Cukai <br /> <i>For Customs Officer</i></td>
                <td width="20%" style="border-right: 1px solid;">&nbsp;</td>
                <td width="30%">Tanggal <br /> <i>Date</i></td>
                <td width="20%"><u><?= $date_reg[2] . ' ' . get_month($date_reg[1]) . ' ' . $date_reg[0]; ?></u></td>
            </tr>
            <tr>
                <td width="30%">Nama <br /> <i>Name</i></td>
                <td width="20%" style="border-right: 1px solid;"><u><?= $header->officer_name; ?></u></td>
                <td width="30%"><u><?=$header->name;?></u></td>
                <td width="20%">&nbsp;</td>
            </tr>
            <tr>
                <td width="30%"> <br /> <i></i></td>
                <td width="20%" style="border-right: 1px solid;"><u></u></td>
                <td width="30%">&nbsp;</td>
                <td width="20%">&nbsp;</td>
            </tr>
            <tr>
                <td width="30%">Tanda tangan <br /> <i>Signature</i></td>
                <td width="20%" style="border-right: 1px solid;">&nbsp;</td>
                <td width="30%">Tanda tangan <br /> <i>Signature</i></td>
                <td width="20%">&nbsp;</td>
            </tr>
        </table>
        
        <?php
            /**
             * if avail next page
             */
            if ($next_page) { ?>
        <div class="pagebreak"></div>

        <table class="my-table" style="border-top: 1px solid;">
            <tr>
                <td class="center" style="font-size: 14px;">
                    <b>
                        LEMBAR LANJUTAN DATA BARANG / <i>CONTINUED SHEET FOR INFORMATION OF GOODS</i><br />
                        PEMBERITAHUAN PEMBAWAAN MATA UANG TUNAI/DAN ATAU INSTRUMEN PEMBAYARAN LAIN KE LUAR DAERAH PABEAN <br />
                        <i>BANK NOTES AND/OR BEARER NEGOTIABLE INSTRUMENTS DECLARATION</i>
                    </b>
                </td>
            </tr>
        </table>
        <table class="my-table" style="min-height: 250px;">
            <tr>
                <td width="5%" class="verticalText" rowspan="20" >Data Barang / <i>INFORMATION OF GOODS</i></td>
                <td width="95%" colspan="6" style="border-left: 1px solid;">9 a. Uang Tunai</td>
            </tr>
            <tr>
                <td width="5%" style="border-left: 1px solid; border-top: 1px solid; border-right: 1px solid;">9. No</td>
                <td width="45%" style="border-top: 1px solid; border-right: 1px solid;" colspan="3" border-right: 1px solid;>10. Jumlah (<i>Amount</i>)</td>
                <td width="45%" style="border-top: 1px solid;" colspan="2" border-right: 1px solid;>11. Jenis Mata Uang (<i>Currency</i>)</td>
            </tr>
            <?php
            foreach ($cash as $index => $val) {
                ?>
            <tr>    
                <td class="center" style="border-left: 1px solid; border-right: 1px solid; border-top: 1px solid;"><?= $no_cash; ?></td>
                <td class="center" colspan="3" style="border-right: 1px solid; border-top: 1px solid;"><?= setIDR($val['amount']); ?></td>
                <td class="center" colspan="2" style="border-top: 1px solid;"><?= $val['currency']; ?></td>
            </tr>
            <?php
                $no_cash++;
            }
            ?>
            <tr>
                <td width="95%" colspan="6" style="border-top: 1px solid; border-left: 1px solid;">9 b. Instrument Pembayaran Lain</td>
            </tr>
            <tr>
                <td width="10%" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">12. No</td>
                <td width="15%" style="border-top: 1px solid; border-right: 1px solid;">13. Jumlah <br /> <i>Amount</i></td>
                <td width="35%" style="border-top: 1px solid; border-right: 1px solid;">14. Jenis Instrumen Pembayaran Lain (bilyet giro, atau warkat atas bawa berupa
                    cek, cek perjalanan, surat sanggup bayar, dan sertifikat deposito) <br /> <i>Kinds of Bearer Negotiable Instruments</i>
                </td>
                <td width="20%" style="border-top:1px solid; border-right: 1px solid;">15. Nomor <br /> <i>Number</i></td>
                <td width="15%" style="border-top:1px solid; border-right: 1px solid;">16. Tanggal <br /> <i>Date</i></td>
                <td width="20%" style="border-top:1px solid;">17. Bank Penerbit <br /> <i>Issuing Bank</i></td>
            </tr>
            <?php
            foreach ($ipl as $index=> $val) {
                $date = explode('-', $val['date']);
                ?>
            <tr>    
                <td class="center" style="border-right: 1px solid; border-top: 1px solid; border-left: 1px solid;"><?= $no_ipl; ?></td>
                <td class="center" style="border-right: 1px solid; border-top: 1px solid;"><?= $val['currency'] . ' ' . setIDR($val['amount']); ?></td>
                <td class="center" style="border-right: 1px solid; border-top: 1px solid;"><?= $val['type']; ?></td>
                <td class="center" style="border-right: 1px solid; border-top: 1px solid;"><?= $val['number']; ?></td>
                <td class="center" style="border-right: 1px solid; border-top: 1px solid;"><?= $date[2] . ' ' . get_month($date[1]) . ' ' . $date[0]; ?></td>
                <td class="center" style="border-top: 1px solid;"><?= $val['bank']; ?></td>
            </tr>
            <?php
                $no_ipl++;
            }
            ?>
        </table>
        <table width= "100%" style="font-size: 12px; border-left: 1px solid; border-bottom: 1px solid; border-right: 1px solid;">
            <tr>
                <td colspan="3">Kolom Khusus Bea dan Cukai <br />
                    <i>Customs official Column</i>
                </td>
            </tr>
            <tr>
                <td>Kantor Pabean Keberangkatan <br />
                    <i>Customs Office of Departure</i>
                </td>
                <!-- <td colspan="2" class="center"><u><b>KANTOR PELAYANAN UTAMA BEA DAN CUKAI TIPE C SOEKARNO HATTA</u></b></td> -->
                <td class="center" colspan="2"><u><?= $header->office;?></u></td>
            </tr>
            <tr>
                <td width="30%">Nomor dan Tanggal Pendaftaran <br />
                    <i>Number and Date of Registration</i> 
                </td>
                <td width="35%"><div class="my-border"><u><?= $header->doc_number; ?></u></div></td>
                <td width="35%"><div class="my-border"><u><?= date('d/m/Y', strtotime($header->date_registered)); ?></u></div></td>
            </tr>
        <table>
        <table class="my-table">
            <tr>
                <td width="25%">Tanggal<br /><i>Date</i></td>
                <td width="75%"><?= $date_reg[2] . ' ' . get_month($date_reg[1]) . ' ' . $date_reg[0]; ?></td>
            </tr>
            <tr>
                <td width="25%"><br /><br />
		<br><br><br><br><br>
<span class="burem">Ditandatangani secara elektronik</span><br>

<?= $header->officer_name; ?><br /><br />Tanda Tangan<br /><i>Signature</i></td>
                <td width="85%">&nbsp;</td>
            </tr>
        </table>
        <?php } ?>
        <!-- end next page -->
    </body>
</html>
