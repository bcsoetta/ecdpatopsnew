<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        @media print {
            .pagebreak {
                page-break-before: always;
            }

            /* page-break-after works, as well */
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
    <?php
        $created = explode(' ', $header->created_at);
        $time = strtotime($created[0]);
        $created_date = date('d-m-Y', $time);
        $array_date = explode('-', $created_date);
        $new_date = $array_date[0] . ' ' . get_month($array_date[1]) . ' ' . $array_date[2];
        for ($i=1; $i<=3; $i++) {
        $print = array(
            '1' => 'Pihak yang menyerahkan jaminan',
            '2' => 'pengeluaran barang/disematkan pada berkas',
            '3' => 'Pejabat Bea dan Cukai/Bendahara Penerimaan'
        );
        ?>
    <table width="100%" style="border: 1px solid;">
        <tr>
            <td width="30%" style="border-right: 1px solid; font-size: 12px;"><b>KEMENTERIAN KEUANGAN RI</b><br />
                Direktorat Jenderal Bea dan Cukai <br />
                <table>
                    <tr>
                        <td>Nama Kantor</td>
                        <td>:</td>
                        <td>KPU Bea dan Cukai Tipe C Soekarno Hatta</td>
                    </tr>
                    <tr>
                        <td>Kode Kantor</td>
                        <td>:</td>
                        <td>050100</td>
                    </tr>
                </table>
            </td>
            <td width="40%" class="center" style="border-right: 1px solid; font-size:16px;">
                <b>BUKTI PENERIMAAN JAMINAN<br /> NOMOR :
                    <?= $warrant->doc_number; ?>
                </b>
            </td>
            <td width="30%" style="font-size: 12px;">
                <table>
                    <tr>
                        <td>Lembar ke-
                            <?=$i;?>
                        </td>
                        <td>:</td>
                        <td>untuk
                            <?=$print[$i];?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <table>
            <table class="my-table">
                <tr>
                    <td width="10%">Jenis Identitas</td>
                    <td width="5%">:</td>
                    <td width="20%"><input type="checkbox" onclick="return false;" <?=($header->identity_type == '1') ?
                        'checked' : ''; ?>> NPWP</td>
                    <td width="20%"><input type="checkbox" onclick="return false;" <?=($header->identity_type == '2') ?
                        'checked' : ''; ?>> KTP</td>
                    <td width="20%"><input type="checkbox" onclick="return false;" <?=($header->identity_type == '3') ?
                        'checked' : ''; ?>> Paspor</td>
                    <td width="25%">&nbsp;</td>
                </tr>

                <tr>
                    <td>Nomor</td>
                    <td>:</td>
                    <td colspan="4">
                        <?= $header->passport; ?>
                    </td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td colspan="4">
                        <?= $header->name; ?>
                    </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td colspan="4">
                        <?= $header->address; ?>
                    </td>
                </tr>
            </table>
            <table class="my-table">
                <tr>
                    <td width="10%">Bentuk Jaminan</td>
                    <td width="5%">:</td>
                    <td width="20%"><input type="checkbox" onclick="return false;" <?=($warrant->type == '1') ?
                        'checked' : ''; ?>> Tunai</td>
                    <td width="20%"><input type="checkbox" onclick="return false;" <?=($warrant->type == '2') ?
                        'checked' : ''; ?>> Bank</td>
                    <td width="20%"><input type="checkbox" onclick="return false;" <?=($warrant->type == '3') ?
                        'checked' : ''; ?>> <i>Customs Bond</i></td>
                    <td width="25%"><input type="checkbox" onclick="return false;" <?=($warrant->type == '4') ?
                        'checked' : ''; ?>> Lainnya</td>
                </tr>
                <tr>
                    <td>Nomor</td>
                    <td>:</td>
                    <td colspan="4">
                        <?= $warrant->doc_number;?>
                    </td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td colspan="4">
                        <?= $new_date; ?>
                    </td>
                </tr>
                <tr>
                    <td>Jumlah Jaminan</td>
                    <td>:</td>
                    <td colspan="4">Rp
                        <?= setIDR($warrant->nominal); ?>
                    </td>
                </tr>
                <tr>
                    <td>Dengan Huruf</td>
                    <td>:</td>
                    <td colspan="4">
                        <?= terbilang($warrant->nominal); ?> rupiah
                    </td>
                </tr>
            </table>
            <table class="my-table">
                <tr>
                    <td width="20%">Dokumen sumber penyerahan jaminan</td>
                    <td width="5%">:</td>
                    <td width="75%">
                        <?= $warrant->source; ?>
                    </td>
                </tr>
                <tr>
                    <td>Nomor</td>
                    <td>:</td>
                    <td>
                        <?= $warrant->source_number; ?>
                    </td>
                </tr>
                <?php
            $source_date = explode('-', $warrant->source_date);
            $sourceDate = $source_date[2] . ' ' . get_month($source_date[1]) . ' ' . $source_date[0];
            if (!empty($warrant->source_date)) {
                $sourceDate = '-';
            }
            ?>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td>
                        <?= $sourceDate; ?>
                    </td>
                </tr>
            </table>
            <table class="my-table">
                <tr>
                    <td width="30%">Catatan Pejabat Bea dan Cukai/<br /> Bendahara Penerimaan</td>
                    <td width="5%">:</td>
                    <td width="20%" style="border-right: 1px solid;"></td>
                    <td width="45%"></td>
                </tr>
                <tr>
                    <td width="30%">
                        - detail pungutan: <br />
                        <?php
                    echo 'Jenis Barang      :' . $bpj['desc'] . '<br />';
                    echo $bpj['code'] . '<br />';
                    echo 'BM : ' . $bpj['bmtax'] . ' %, ' . 'PPn : ' . $bpj['ppntax'] . ' %, ' . 'PPnbm : ' . $bpj['ppnbmtax'] . ' %, ' . 'PPh : ' . $bpj['pphtax'] . '%' . '<br />'; 
                    echo setIdr($bpj['bm']) . ' + ' . setIdr($bpj['ppn']) . ' + ' . setIdr($bpj['ppnbm']) . ' + ' . setIdr($bpj['pph']) . ' = Rp. ' . setIdr($bpj['total']);
                    ?>
                    </td>
                    <td width="5%"></td>
                    <td width="20%" style="border-right: 1px solid;"></td>
                    <td width="45%">Jakarta,
                        <?= $new_date; ?>
                    </td>
                </tr>
                <tr>
                    <td width="30%">- Tanggal jatuh tempo:
                        <?php echo date('d-m-Y', strtotime($header->inv_date_out));?>
                    </td>
                    <td width="5%">&nbsp;</td>
                    <td width="20%" style="border-right: 1px solid;"></td>
                    <td width="45%">&nbsp;</td>
                </tr>
                <tr>
                    <td width="30%">&nbsp;</td>
                    <td width="5%">&nbsp;</td>
                    <td width="20%" style="border-right: 1px solid;"></td>
                    <td width="45%">Catatan Pejabat Bea dan Cukai/<br /> Bendahara Penerimaan</td>
                </tr>
                <tr>
                    <td width="30%" colspan="3" style="border-top: 1px solid; border-right: 1px solid;">Yang Menyerahkan
                        Jaminan,</td>
                    <td width="45%">&nbsp;</td>
                </tr>
                <tr>
                    <td width="30%">&nbsp;</td>
                    <td width="5%">&nbsp;</td>
                    <td width="20%" style="border-right: 1px solid;"></td>
                    <td width="45%">&nbsp;</td>
                </tr>
                <tr>
                    <td width="30%">&nbsp;</td>
                    <td width="5%">&nbsp;</td>
                    <td width="20%" style="border-right: 1px solid;"></td>
                    <td width="45%">&nbsp;</td>
                </tr>
                <tr>
                    <td width="30%">&nbsp;</td>
                    <td width="5%">&nbsp;</td>
                    <td width="20%" style="border-right: 1px solid;"></td>
                    <td width="45%">&nbsp;</td>
                </tr>
                <tr>
                    <td width="30%">&nbsp;</td>
                    <td width="5%">&nbsp;</td>
                    <td width="20%" style="border-right: 1px solid;"></td>
                    <td width="45%">&nbsp;</td>
                </tr>
                <tr>
                    <td width="30%">&nbsp;</td>
                    <td width="5%">&nbsp;</td>
                    <td width="20%" style="border-right: 1px solid;"></td>
                    <td width="45%">
                        <span style="position: relative; top: 5px; color: #808080; class: burem">Ditandatangani secara elektronik</span>
                    </td>
                </tr>

                <tr>
                    <td width="30%">&nbsp;</td>
                    <td width="5%">&nbsp;</td>
                    <td width="20%" style="border-right: 1px solid;"></td>
                    <td width="45%">Nama
                        <?= $warrant->treasurer_name; ?>
                    </td>
                </tr>
                <tr>
                    <td width="30%">
                        &nbsp;
                    </td>
                    <td width="5%">&nbsp;</td>
                    <td width="20%" style="border-right: 1px solid;"></td>
                    <td width="45%">NIP
                                            </td>
                </tr>
            </table>
            <?php
        if ($i != 3) { ?>
            <div class="pagebreak"></div>
            <?php
        }
    } 
        ?>
</body>

</html>