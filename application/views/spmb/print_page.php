<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
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

        </style>
    </head>
    <body>
        <!-- header -->
        <!-- 
        <table width= "100%" style="font-size: 12px;">
            <tr>
                <td width="75%"></td>
                <td width="25%">
                    LAMPIRAN <br />
                    PERATURAN DIREKTUR JENDERAL BEA DAN CUKAI <br />
                    NOMOR PER- &nbsp;&nbsp;&nbsp;&nbsp; /BC/ <?= date('Y');?> <br />
                    TENTANG <br />
                    PEMBERITAHUAN PABEAN EKSPOR
                </td>
            </tr>
        <table>
        -->
        <table class="center" width= "100%" style="font-size: 14px; border: 1px solid;">
            <tr>
                <td class="middle" rowspan="2" style="border-right: 1px solid;"><b>BC 3.4</b></td>
                <td rowspan="2" colspan="7" text-align="center"><b>PEMBERITAHUAN PEMBAWAAN BARANG UNTUK DIBAWA KEMBALI</b> </br>
                    <b><i>DECLARATION OF RETURNABLE GOODS</i></b>
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
                    Customs Office of Departure
                </td>
                <td colspan="2" class="center"><u><b>KANTOR PELAYANAN UTAMA BEA DAN CUKAI TIPE C SOEKARNO HATTA</u></b></td>
                <!-- <td class="center"><u><?= $result['kantor_pabean_keberangkatan'];?></u></td> -->
            </tr>
            <tr>
                <td>Kantor Pabean Kedatangan <br />
                    <i>Customs Office of Arrival</i>
                </td>
                <td colspan="2" class="center"><u><b>KANTOR PELAYANAN UTAMA BEA DAN CUKAI TIPE C SOEKARNO HATTA</u></b></td>
                <!-- <td width="50%" ><u><?= $result['kantor_pabean_kedatangan'];?></u></td> -->
            </tr>
            <tr>
                <td width="30%">Nomor dan Tanggal Pendaftaran <br />
                    <i>Number and Date of Registration</i> 
                </td>
                <td width="35%"><div class="my-border"><u><?= $result['nomor_dokumen'];?></u></div></td>
                <td width="35%"><div class="my-border"><u><?= $result['tanggal_dokumen'];?></u></div></td>
            </tr>
        <table>
        <div class="space"></div>
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
                <td width="20%" style="border-right: 1px solid;"><u><?= $result['nomor_penerbangan'];?></u></td>
                <td width="5%" class="center">2.</td>
                <td width="25%">Tanggal Keberangkatan</td>
                <td width="20%"><u><?= date('Y-m-d'); ?></u></td>
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
                    INFORMATION OF PASSENGER
                </td>
            </tr>
        <table>
        <table class="my-table">
            <tr>
                <td width="5%" class="center">3.</td>
                <td width="25%">Nama Lengkap</td>
                <td width="20%" style="border-right: 1px solid;"><u><?= $result['nama'];?></u></td>
                <td width="5%" class="center">4.</td>
                <td width="25%">Tempat Keberangkatan</td>
                <td width="20%"><u>CENGKARENG - INDONESIA</u></td>
                <!-- <td width="20%"><?= $result['tanggal_dokumen'];?></td> -->
            </tr>
            <tr>
                <td width="5%" class="center">&nbsp;</td>
                <td colspan="2" width="45%" style="border-right: 1px solid;">Full Name</td>
                <td width="5%" class="center">&nbsp;</td>
                <td colspan="2" width="45%"><i>Place of Departure</i></td>
            </tr>
            <tr>
                <td width="5%" class="center">5.</td>
                <td width="25%">Kebangsaan</td>
                <td width="20%" style="border-right: 1px solid;"><u><?= $result['nationality'];?></u></td>
                <td width="5%" class="center">6.</td>
                <td width="25%">Nomor Paspor</td>
                <td width="20%"><u><?= $result['nomor_paspor'];?></u></td>
            </tr>
            <tr>
                <td width="5%" class="center">&nbsp;</td>
                <td colspan="2" width="45%" style="border-right: 1px solid;"><i>Nationality</i></td>
                <td width="5%" class="center">&nbsp;</td>
                <td colspan="2" width="45%"><i>Passport Number</i></td>
            </tr>
            <tr>
                <td width="5%" class="center">7.</td>
                <td width="25%">Pekerjaan</td>
                <td width="20%" style="border-right: 1px solid;"><u><?=$result['occupation'];?></u></td>
                <td width="5%" class="center">8.</td>
                <td width="25%">Negara Tujuan</td>
                <td width="20%"><u><?= $result['country_arrival'];?></u></td>
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
        <!-- DATA BARANG -->
        <table class="my-table">
            <tr>
                <td class="center" style="border-right: 1px solid;">No</td>
                <td class="center" style="border-right: 1px solid;">Uraian Jenis Barang, Merek, Tipe, Ukuran, Spesifikasi Lain, Kode Barang <br />
                    <i>Description of Goods, Marks, Type, Size, Other Specification, Item Code</i>
                </td>
                <td class="center" style="border-right: 1px solid;">Jumlah dan Jenis Kemasan <br /> <i>Number and Type of Packages</i></td>
                <td class="center" style="border-right: 1px solid;">Banyak Barang <br /> <i>Amount of Goods</i></td>
                <td class="center" style="border-right: 1px solid;">Berat Bruto <br /> <i>Gross Weight</i></td>
                <td class="center" style="border-right: 1px solid;">Harga Satuan <br /> <i>Unit Price</i></td>
                <td class="center" style="border-right: 1px solid;">Jumlah Harga <br /> <i>Total Price</i></td>
                <td class="center">Keterangan <br /> <i>Explanation</i></td>
            </tr>
            <?php
            $no = 1;
            foreach ($result['items'] as $val) {
                ?>
            <tr>    
                <td class="center" style="border-right: 1px solid; border-top: 1px solid;"><?= $no; ?></td>
                <td class="center" style="border-right: 1px solid; border-top: 1px solid;"><?= $val['item_name']; ?></td>
                <td class="center" style="border-right: 1px solid; border-top: 1px solid;"><?= $val['package'] . ', ' . $val['package_type']; ?></td>
                <td class="center" style="border-right: 1px solid; border-top: 1px solid;"><?= $val['qty'] . ' ' . $val['qty_type']; ?></td>
                <td class="center" style="border-right: 1px solid; border-top: 1px solid;"><?= $val['bruto']; ?></td>
                <td class="center" style="border-right: 1px solid; border-top: 1px solid;"><?= $val['price']; ?></td>
                <td class="center" style="border-right: 1px solid; border-top: 1px solid;"><?= $val['currency'] . ' ' . $val['qty'] * $val['price']; ?></td>
                <td class="center" style="border-top: 1px solid;"><?= $val['note']; ?></td>
            </tr>
            <?php
                $no++;
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
        <table class="my-table">
            <tr>
                <td class="center" style="border-right: 1px solid;">No</td>
                <td class="center" style="border-right: 1px solid;">Jenis Dokumen <br />
                    <i>Document Type</i>
                </td>
                <td class="center" style="border-right: 1px solid;">Nomor <br /> <i>Number</i></td>
                <td class="center">Tanggal <br /> <i>Date</i></td>
            </tr>
            <?php
            $no = 1;
            foreach ($result['docs'] as $val) {
                ?>
            <tr>    
                <td class="center" style="border-right: 1px solid; border-top: 1px solid;"><?= $no; ?></td>
                <td class="center" style="border-right: 1px solid; border-top: 1px solid;"><?= $val['doc_type']; ?></td>
                <td class="center" style="border-right: 1px solid; border-top: 1px solid;"><?= $val['doc_number']; ?></td>
                <td class="center" style="border-top: 1px solid;"><?= $val['doc_date']; ?></td>
            </tr>
            <?php
                $no++;
            }
            ?>
        <table>
        <table class="my-table">
            <tr>
                <td width="25%">MAKSUD PEMBAWAAN <br />
                    <i>PURPOSE OF CARRYING GOODS</i>
                </td>
            </tr>
            <tr>
                <td style="border-top: 1px solid; padding: 5px 5px 5px 5px;"><?= $result['reason']; ?></td>
            </tr>
        <table>
        <table class="my-table" style="padding: 5px 5px 5px 5px;">
            <tr>
                <td>Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal yang diberitahukan dalam pemberitahuan ini <br />
                    <i>I hereby declare that the information given is true and correct</i>
                </td>
            </tr>
        <table>
        <table class="my-table">
            <tr>
                <td width="30%">Untuk Pejabat Bea dan Cukai <br /> For Customs Officer</td>
                <td width="20%" style="border-right: 1px solid;">&nbsp;</td>
                <td width="30%">Tanggal <br /> <i>Date</i></td>
                <td width="20%"><u><?= $result['tanggal_dokumen'];?></u></td>
            </tr>
            <?php
            $input_by = $result['input_by'];
            $new_string = explode('-', $input_by);
            $name = $new_string[0];
            $nip = $new_string[1];
            ?>
            <tr>
                <td width="30%">Nama <br /> <i>Name</i></td>
                <td width="20%" style="border-right: 1px solid; vertical-align: bottom; text-align: left;"> <span style="position: relative; left: -15px;"><u><?= $name; ?></u></span>
                <td width="30%"><u><?=$result['nama'];?></u></td>
                <td width="20%">&nbsp;</td>
            </tr>
            <tr>
		<!-- disini awalnya diisi NIP <br /> NIP -->
                <td width="30%"> <br /> </td>
                <td width="20%" style="border-right: 1px solid; vertical-align: bottom; text-align: left;"> <span style="position: relative; left: -15px;"><u>
                    
			<!-- hapus comentnya <?= $nip; ?>-->
			
			</u></span>
                <td width="30%">&nbsp;</td>
                <td width="20%">&nbsp;</td>
            </tr>
            <tr>
                <td width="30%">&nbsp;</td>
                <td width="20%" style="border-right: 1px solid;"></td>
                <td width="30%">&nbsp;</td>
                <td width="20%">&nbsp;</td>
            </tr>
            <tr>
                <td width="30%">&nbsp;</td>
                <td width="20%" style="border-right: 1px solid;"></td>
                <td width="30%">&nbsp;</td>
                <td width="20%">&nbsp;</td>
            </tr>
            <tr>
                <td width="30%">&nbsp;</td>
                <td width="20%" style="border-right: 1px solid;"></td>
                <td width="30%">&nbsp;</td>
                <td width="20%">&nbsp;</td>
            </tr>
            <tr>
                <td width="30%">&nbsp;</td>
                <td width="20%" style="border-right: 1px solid;"></td>
                <td width="30%">&nbsp;</td>
                <td width="20%">&nbsp;</td>
            </tr>
            <tr>
                <td width="30%" style="vertical-align: bottom;">Tanda tangan <br /> <i>Signature</i></td>
                <td width="20%" style="border-right: 1px solid; color: grey; vertical-align: bottom; text-align: left;"> <span style="position: relative; left: -15px;white-space: nowrap;">Ditandatangani secara elektronik</span>
                </td>
                <td width="30%" style="vertical-align: bottom;">Tanda tangan <br /> <i>Signature</i></td>
                <td width="20%" style="vertical-align: bottom;">&nbsp;</td>
            </tr>
        </table>
    </body>
</html>

