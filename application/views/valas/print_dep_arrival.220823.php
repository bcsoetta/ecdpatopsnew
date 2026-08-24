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
            .justify {
                text-align: justify !important;
                display: block;
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

            .my-div-border {
                width: 98%;
                border: 1px solid;
                padding-top: 5px;
                padding-left: 5px;
                padding-bottom: 5px;
                padding-right: 0px;
            }

            .first-border {
                padding: 5px 10px 5px 10px;
                border: 1px solid;
            }

        </style>
    </head>
    <body>
    <?php
    $created = explode(' ', $personal->created_date);
    $time = strtotime($created[0]);
    $created_date = date('d/m/Y', $time);
    // echo date('d', $time); exit();
    ?>
    Nomor Dokumen: <?= $personal->doc_number; ?> <br />
    Tanggal Dokumen: <?= $created_date; ?>
    <table width= "100%">
            <!-- removed by instruction -->
            <!-- 
            <tr>
                <td>A. <br /> &nbsp;</td>
                <td style="font-size: 14px;">FORMULIR PEMBAWAAN UANG TUNAI DAN/ATAU INSTRUMEN PEMBAYARAN LAIN <br /> &nbsp;</td>
            </tr>
             -->
            <tr>
                <td>&nbsp;</td>
                <!-- part 1 -->
                <td class="center my-border" style="font-size: 12px;">
                    <b style="font-size: 16px;">
                        ADDITIONAL STATEMENT OF INTERNATIONAL TRANSPORTATION OF BEARER NEGOTIABLE INSTRUMENTS<br />
                        (PERNYATAAN TAMBAHAN ATAS PEMBAWAAN UANG TUNAI DAN/ATAU INSTRUMENT PEMBAYARAN LAIN)</b>
                    <br />
                    <br />
                    <br />
                    <b style="font-size: 14px;">PART 1 : PERSONAL DETAILS (Data Diri)</b><br />
                    <span class="justify">
                        FOR A PERSON DEPARTING OR ENTERING INDONESIA CUSTOMS TERRITORY, OR A PERSON SHIPPING, MAILING OR RECEIVING
                        CURRENCY BEARER NEGOTIABLE INSTRUMENTS.
                        <br />
                        (untuk penumpang yang keluar/masuk Daerah Pabean Indonesia, atau orang yang mengirim/menerima uang tunai/instrument
                        pembayaran lain melalui kargo komersial dan/atau jasa kiriman)
                        <!-- table for personal -->
                        <br /> &nbsp;
                        <table width= "100%">
                            <tr>
                                <td width="5%">1. </td>
                                <td width="95%">
                                    Full Name (Nama Lengkap)
                                    <br />
                                    <div class="my-div-border"><?= $personal->name; ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">2. </td>
                                <td width="95%">
                                    Nationality (Kebangsaan)
                                    <br />
                                    <div class="my-div-border"><?= $personal->nationality; ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">3. </td>
                                <td width="95%">
                                    Passport No./National Registration Identification Card No. (Nomor Paspor/Nomor KTP)
                                    <br />
                                    <div class="my-div-border"><?= $personal->identity_number; ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">4. </td>
                                <td width="95%">
                                    Date of Birth (Tanggal Lahir)
                                    <br />
                                    <div class="my-div-border"><?= $personal->date_of_birth; ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">5. </td>
                                <td width="95%">
                                    Residence Address (Alamat Tempat Tinggal)
                                    <br />
                                    <div class="my-div-border"><?= $personal->residence_address; ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">6. </td>
                                <td width="95%">
                                    Occupation (Pekerjaan)
                                    <br />
                                    <div class="my-div-border"><?= $personal->occupation; ?></div>
                                </td>
                            </tr>
                        </table>
                        <br />
                        IF ACTING FOR ANYONE ELSE (Jika membawa uang tunai milik orang lain) <br />
                        PERSONAL (Pribadi)
                        <table width= "100%">
                            <tr>
                                <td width="5%">7. </td>
                                <td width="95%">
                                    Full Name (Nama Lengkap)
                                    <br />
                                    <div class="my-div-border"><?= isset($others->name) ? $others->name : ''; ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">8. </td>
                                <td width="95%">
                                    Nationality (Kebangsaan)
                                    <br />
                                    <div class="my-div-border"><?= isset($others->nationality) ? $others->nationality : ''; ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">9. </td>
                                <td width="95%">
                                    Passport No./National Registration Identification Card No. (Nomor Paspor/Nomor KTP)
                                    <br />
                                    <div class="my-div-border"><?= isset($others->identity_number) ? $others->identity_number : ''; ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">10. </td>
                                <td width="95%">
                                    Date of Birth (Tanggal Lahir)
                                    <br />
                                    <div class="my-div-border"><?= isset($others->date_of_birth) ? $others->date_of_birth : ''; ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">11. </td>
                                <td width="95%">
                                    Residence Address (Alamat Tempat Tinggal)
                                    <br />
                                    <div class="my-div-border"><?= isset($others->residence_address) ? $others->residence_address : '' ; ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">12. </td>
                                <td width="95%">
                                    Occupation (Pekerjaan)
                                    <br />
                                    <div class="my-div-border"><?= isset($others->occupation) ? $others->occupation : ''; ?></div>
                                </td>
                            </tr>
                        </table>

                        <!-- corporate form -->
                        <br />
                        CORPORATE (Perusahaan)
                        <?php
                            $type = '0';
                            if (isset($corp->type)) {
                                $type = $corp->type;
                            }
                        ?>
                        <table width= "100%">
                            <tr>
                                <td width="5%">13. </td>
                                <td width="95%">
                                    Name of Corporate (Nama Perusahaan)
                                    <br />
                                    <div class="my-div-border"><?= isset($corp->name) ? $corp->name : ''; ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">14. </td>
                                <td width="95%">
                                    Address of Corporate (Alamat Perusahaan)
                                    <br />
                                    <div class="my-div-border"><?= isset($corp->address) ? $corp->address : ''; ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">15. </td>
                                <td width="95%">
                                    Type of Business Activity (Jenis Usaha)
                                    <br />
                                    <input type="checkbox" onclick="return false;" id="vehicle1" name="vehicle1" <?= ($type == '1') ? 'checked' : ''; ?>>
                                    <label for="vehicle1"> Banks (Bank)</label><br>
                                    <input type="checkbox" onclick="return false;" id="vehicle2" name="vehicle2" <?= ($type == '2') ? 'checked' : ''; ?>>
                                    <label for="vehicle2"> Money Changer (Usaha Penukaran Valas)</label><br>
                                    <input type="checkbox" onclick="return false;" id="vehicle3" name="vehicle3" <?= ($type == '3') ? 'checked' : ''; ?>>
                                    <label for="vehicle3"> Others (Lainnya)</label><br> 
                                </td>
                            </tr>
                        </table>
                    </span>
                </td>
            </tr>
        </table>
        
        <div class="pagebreak"></div>

        <table width= "100%">
            <tr>
                <td>&nbsp;</td>
                <td class="center my-border" style="font-size: 12px;">
                    <b style="font-size: 14px;">PART 2 : TRAVEL/MAILED/SHIPPED/ DETAILS (Data Perjalanan/Pengiriman)</b><br />
                    <span class="justify">
                        IF CASH OR BEARER NEGOTIABLE INSTRUMENTS IS ACCOMPANIED BY A PERSON<br />
                        (Jika uang tunai atau instrument pembayaran lain dibawa langsung)
                        <br /> &nbsp;
                        <table width= "100%">
                            <tr>
                                <td width="5%">16. </td>
                                <td width="95%">
                                    Flight/Ship/Vehicle No. and Name (Nomor dan nama penerbangan/kapal/kendaraan)
                                    <br />
                                    <div class="my-div-border"><?= $personal->flight_number; ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">17. </td>
                                <td width="95%">
                                    Last Port/Place (Pelabuhan/Tempat Asal)
                                    <br />
                                    <div class="my-div-border"><?= $personal->last_port; ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">18. </td>
                                <td width="95%">
                                    Next Port/Destination (Pelabuhan/Tempat Tujuan)
                                    <br />
                                    <div class="my-div-border"><?= $personal->next_port; ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">19. </td>
                                <td width="95%">
                                    Address in Indonesia
                                    <br />
                                    <div class="my-div-border"><?= $personal->address_in_indonesia; ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">20. </td>
                                <td width="95%">
                                    Purpose of Visit (Maksud Perjalanan)
                                    <br />
                                    <input type="checkbox" onclick="return false;" id="travel1" name="travel1" <?= ($personal->purpose_of_visit == '1') ? 'checked' : ''; ?>>
                                    <label for="travel1"> Business/Official (Bisnis/Dinas)</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="checkbox" onclick="return false;" id="travel2" name="travel2" <?= ($personal->purpose_of_visit == '3') ? 'checked' : ''; ?>>
                                    <label for="vehicle2"> Employment/Student (Bekerja/Belajar)</label><br>
                                    <input type="checkbox" onclick="return false;" id="travel3" name="travel3" <?= ($personal->purpose_of_visit == '2') ? 'checked' : ''; ?>>
                                    <label for="vehicle3"> Visiting/Holiday (Kunjungan/Liburan)</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="checkbox" onclick="return false;" id="travel4" name="travel4" <?= ($personal->purpose_of_visit == '4') ? 'checked' : ''; ?>>
                                    <label for="vehicle3"> Others (Lainnya)</label><br> 
                                </td>
                            </tr>
                        </table>

                        IF CASH OR BEARER NEGOTIABLE INSTRUMENTS WAS MAILED OR OTHERWISE SHIPPED<br />
                        (Jika uang tunai atau instrument pembayaran lain dikirim melalui jasa kiriman pos/jasa titipan/jasa kargo komersial)
                        <br /> &nbsp;
                        <table width= "100%">
                            <tr>
                                <td width="5%">21. </td>
                                <td width="95%">
                                    Date shipped (dd/mm/yyyy) (tanggal pengiriman)
                                    <br />
                                    <table>
                                        <tr>
                                            <td class="first-border">&nbsp;</td>
                                            <td class="first-border">&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td class="first-border">&nbsp;</td>
                                            <td class="first-border">&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td class="first-border">&nbsp;</td>
                                            <td class="first-border">&nbsp;</td>
                                            <td class="first-border">&nbsp;</td>
                                            <td class="first-border">&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">22. </td>
                                <td width="95%">
                                    Date received (dd/mm/yyyy) (tanggal diterima)
                                    <br />
                                    <table>
                                        <tr>
                                            <td class="first-border">&nbsp;</td>
                                            <td class="first-border">&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td class="first-border">&nbsp;</td>
                                            <td class="first-border">&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td class="first-border">&nbsp;</td>
                                            <td class="first-border">&nbsp;</td>
                                            <td class="first-border">&nbsp;</td>
                                            <td class="first-border">&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">23. </td>
                                <td width="95%">
                                    Method of shipment (e.g. mail, public carrier, etc) (metode pengiriman (contoh: mail, jasa kargo komersial, dll))
                                    <br />
                                    <div class="my-div-border">&nbsp;</div>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">24. </td>
                                <td width="95%">
                                    Name of carrier (nama jasa pengiriman)
                                    <br />
                                    <div class="my-div-border">&nbsp;</div>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">25. </td>
                                <td width="95%">
                                    Shipped to (name and address) (Tujuan pengiriman (nama dan alamat))
                                    <br />
                                    <div class="my-div-border">&nbsp;</div>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">26. </td>
                                <td width="95%">
                                    Received from (name and address) (Asal pengiriman (nama dan alamat))
                                    <br />
                                    <div class="my-div-border">&nbsp;</div>
                                </td>
                            </tr>
                        </table>
                    </span>
                </td>
            </tr>
        </table>
        <!-- end part 2 -->

        <div class="pagebreak"></div>

        <table width= "100%">
            <tr>
                <td>&nbsp;</td>
                <td class="center my-border" style="font-size: 12px;">
                    <b style="font-size: 14px;">PART 3 : DECLARATION (Pemberitahuan)</b><br />&nbsp;
                    <span class="justify">
                        <table width= "100%">
                            <tr>
                                <td width="5%">27. </td>
                                <td width="95%">
                                    Declaration (Pemberitahuan)
                                    <br />
                                    <input type="checkbox" onclick="return false;" id="decalaration_type" name="decalaration_type">
                                    <label for="decalaration_type"> Arrival (Kedatangan)</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="checkbox" onclick="return false;" id="decalaration_type2" name="decalaration_type2"checked>
                                    <label for="decalaration_type2"> Departure (Keberangkatan)</label>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">28. </td>
                                <td width="95%">
                                    Currency and monetary instrument information (informasi uang tunai dan instrument pembayaran lain)
                                    <br />
                                    <table width="100%" style="border: 1px solid; text-align: center;">
                                        <tr>
                                            <td width="5%" style="border-right: 1px solid;">No.</td>
                                            <td width="45" style="border-right: 1px solid;">Currency (Mata Uang)</td>
                                            <td width="50%">Amount (Jumlah)</td>
                                        </tr>
                                        <?php
                                        $no = 1;
                                        foreach ($arrival_cash as $val) { ?>
                                        <tr>
                                            <td width="5%" style="border-right: 1px solid; border-top: 1px solid;"><?= $no; ?></td>
                                            <td width="45" style="border-right: 1px solid; border-top: 1px solid;"><?= $val['currency']; ?></td>
                                            <td width="50%" style="border-top: 1px solid;"><?= setIDR($val['amount']); ?></td>
                                        </tr>
                                        <?php
                                        $no++;
                                        }
                                        ?>
                                    </table> <br />

                                    <table width="100%" style="border: 1px solid; text-align: center;">
                                        <tr>
                                            <td width="5%" style="border-right: 1px solid;">No.</td>
                                            <td width="45" style="border-right: 1px solid;">Currency (Mata Uang)</td>
                                            <td width="50%">Amount (Jumlah)</td>
                                        </tr>
                                        <?php
                                        $no = 1;
                                        foreach ($arrival_ipl as $val) { ?>
                                        <tr>
                                            <td width="5%" style="border-right: 1px solid; border-top: 1px solid;"><?= $no; ?></td>
                                            <td width="45" style="border-right: 1px solid; border-top: 1px solid;"><?= $val['type'] . ' ' . $val['currency']; ?></td>
                                            <td width="50%" style="border-top: 1px solid;"><?= setIDR($val['amount']); ?></td>
                                        </tr>
                                        <?php
                                        $no++;
                                        }
                                        ?>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </span>

                    <!-- part 4 -->
                    <br />
                    <br />
                    <br />
                    <b style="font-size: 14px;">PART 4 : SIGNATURE</b><br />
                    <span class="justify">
                        I have read the important notice and certify that the above declaration are true and complete.
                        This declaration is made pursuant to the provisions og the Customs Act 1995 and the Anti-Money Laundering
                        Act 2020 and Anti-Terrorism Financing Act 2013 and shall be appendix of customs declaration.<br />
                        Saya telah membaca dan menyatakan bahwa pemberitahuan di atas telah benar dan lengkap. Pemberitahuan ini dibuat
                        sesuai dengan Undang-undang Nomor 10 tahun 1995 tentang kepabeanan sebagaimana telah diubah dengan undang-undang nomor 17
                        tahun 2006 dan undang-undang nomor 8 tahun 2010 tentang pencegahan dan pemberantasan tindak pidana pencucian uang dan Undang-undang
                        nomor 9 tahun 2013 tentang pencegahan dan pemberantasan tindak pidana pendanaan Terorisme, serta akan menjadi lampiran dalam pemberitahuan
                        pabean.
                        <br /> &nbsp;
                        <table width= "100%">
                            <tr>
                                <td width="5%">30. </td>
                                <td width="95%">
                                    Signature (Tanda Tangan)
                                    <br />
                                    <div style="border: 1px solid; width: 30%; height: 75px;">&nbsp;</div>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">31. </td>
                                <td width="95%">
                                    Date (dd/mm/yyyy) (Tanggal/Bulan/Tahun)
                                    <?php
                                    // explode date to fill column below
                                    $date = str_split(date('d', $time));
                                    $month = str_split(date('m', $time));
                                    $year = str_split(date('Y', $time));
                                    ?>
                                    <br />
                                    <table>
                                        <tr>
                                            <td class="first-border"><?= $date[0]; ?></td>
                                            <td class="first-border"><?= $date[1]; ?></td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td class="first-border"><?= $month[0]; ?></td>
                                            <td class="first-border"><?= $month[1]; ?></td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td class="first-border"><?= $year[0]; ?></td>
                                            <td class="first-border"><?= $year[1]; ?></td>
                                            <td class="first-border"><?= $year[2]; ?></td>
                                            <td class="first-border"><?= $year[3]; ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </span>

                    <br />
                    <br />
                    <span class="justify">
                        <b>FOR OFFICIAL USE ONLY (Diisi oleh Pejabat Bea dan Cukai)</b>
                        <br /> &nbsp;
                        <table width="100%" style="border: 1px solid; text-align: center;">
                            <tr>
                                <td width="45" style="border-right: 1px solid;">COUNT VERIFIED<br />(Hitung Jumlah)</td>
                                <td width="55%">RESULT<br />(Hasil)</td>
                            </tr>
                            <tr>
                                <td width="45" style="border-right: 1px solid; border-top: 1px solid;">
                                    <input type="checkbox" onclick="return false;" id="check1" name="check1" <?= ($personal->is_count == '1') ? 'checked' : ''; ?> />
                                    <label for="check1"> Yes (Ya)</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="checkbox" onclick="return false;" id="check2" name="check2" <?= ($personal->is_count == '0') ? 'checked' : ''; ?> />
                                    <label for="check2"> No (Tidak)</label>
                                </td>
                                <td width="55%" style="border-top: 1px solid;">
                                    <input type="checkbox" onclick="return false;" id="check3" name="check3" <?= ($personal->is_result == '1') ? 'checked' : ''; ?> />
                                    <label for="check3"> True & Correct Declaration (Pemberitahuan Benar)</label><br />
                                    <input type="checkbox" onclick="return false;" id="check4" name="check4" <?= ($personal->is_result == '0') ? 'checked' : ''; ?> />
                                    <label for="check4"> False Declaration (Pemberitahuan Tidak Benar)</label>
                                </td>
                            </tr>
                            <tr>
                                <td width="45" style="border-right: 1px solid; border-top: 1px solid;">SUSPICIOUS CARRYING<br />(Pembawaan Mencurigakan)</td>
                                <td width="55%" style="text-align: left; border-top: 1px solid;">Inspector(Name and Employee ID Number)<br />Pemeriksa (Nama dan NIP)</td>
                            </tr>
                            <tr>
                                <td width="45" style="border-right: 1px solid;">
                                    <input type="checkbox" onclick="return false;" id="check1" name="check1" <?= ($personal->is_suspicious == '1') ? 'checked' : ''; ?>  />
                                    <label for="check1"> Yes (Ya)</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="checkbox" onclick="return false;" id="check2" name="check2" <?= ($personal->is_suspicious == '0') ? 'checked' : ''; ?> />
                                    <label for="check2"> No (Tidak)</label>
                                    
                                </td>
                                <td style="text-align: left;">
                                    <br />&nbsp;<br />&nbsp;
                                    <?php
                                    echo $personal->officer_name; ?> <br />
                                                                    </td>
                            </tr>
                        </table>
                    </span>
                </td>
            </tr>
        </table>
    </body>
</html>
