<?php
include_once "../server/rolecontrol.php";
$customCSS = array(
    '<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">',
    '<link href="../assets/plugins/DataTables/style.css" rel="stylesheet">'
);
$customJAVA = array(
    '<script src="../assets/plugins/DataTables/datatables.min.js"></script>',
    '<script src="../assets/plugins/printer/main.js"></script>',
    '<script src="../assets/js/pages/datatables.js"></script>',
    '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.all.min.js"></script>'

);

$page_title = 'TC GSM Plus';
include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');

error_reporting(0);

?>
<!--<div class="page-content">-->
<!--BAŞLANGIC-->
<div class="row">
    <div class="col-xl-12 col-md-6">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">TC GSM Plus</h4>
                    <p class="mb-1">
                    <p>
                        Birden fazla telefon numarasını öğrenmek istediğiniz TC kimlik numarasını girin.</br>
                    </p>
                    </p>
                    <div class="block-content tab-content">
                        <div class="tab-pane active" id="tc" role="tabpanel">
                            <input required maxlength="11" class="form-control" type="text" name="tcno" id="tcno" placeholder="TC"><br>
                            <center class="nw">
                                <button onclick="checkNumber()" id="sorgula" name="yolla" class="btn waves-effect waves-light btn-rounded btn-primary" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-search"></i> Sorgula </button>
                                <button onclick="clearResults()" id="durdurButon" type="button" class="btn waves-effect waves-light btn-rounded btn-danger" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-trash-alt"></i> Sıfırla </button>
                                <button onclick="printTable()" id="yazdirTable" type="button" class="btn waves-effect waves-light btn-rounded btn-warning" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-print"></i> Yazdır Detay </button><br><br>
                            </center>
                            <div class="table-responsive">

                                <table id="zero-conf" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Ad</th>
                                            <th>Soyad</th>
                                            <th>Numara 1</th>
                                            <th>Numara 2</th>
                                            <th>Numara 3</th>
                                            <th>Numara 4</th>
                                        </tr>
                                    </thead>
                                    <tbody id="jojjoojj">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function clearResults() {
                $("#jojjoojj").html('<tr class="odd"><td valign="top" colspan="21" class="dataTables_empty">No data available in table</td></tr>');
                $("#tcno").val("");
            }

            function checkNumber() {
                /*return Swal.fire({
                    icon: "warning",
                    title: "Oooooopss...",
                    text: "Bu çözüm şu an bakımdadır!"
                });*/

                var roleNumber = "<?= $k_rol ?>";

                if (parseInt(roleNumber) == 1 || parseInt(roleNumber) == 2) {
                    var tc = $("#tcno").val();
                    $.Toast.showToast({
                        "title": "Sorgulanıyor...",
                        "icon": "loading",
                        "duration": 86400000
                    });
                    $.ajax({
                        url: "../api/gsmtc/api.php",
                        type: "POST",
                        data: {
                            tc: tc,
                            method: "gsmplus"
                        },
                        success: (res) => {
                            var json = res;

                            $.Toast.hideToast();

                            if (json.message === "cooldown error") {
                                return Swal.fire({
                                    icon: 'warning',
                                    title: 'Ooooopss...',
                                    text: 'Çok sık sorgu yapıyorsunuz! Lütfen ' + json.remain + ' saniye bekleyin.',
                                })
                            }

                            if (json.success === "true") {
                                $.Toast.hideToast();
                                var ad = json.data.ad;
                                var soyad = json.data.soyad;
                                var telefon1 = json.data.telefon1;
                                var telefon2 = json.data.telefon2;
                                var telefon3 = json.data.telefon3;
                                var telefon4 = json.data.telefon4;

                                if (telefon1.length < 1) {
                                    telefon1 = "Bulunamadı";
                                }
                                if (telefon2.length < 1) {
                                    telefon2 = "Bulunamadı";
                                }
                                if (telefon3.length < 1) {
                                    telefon3 = "Bulunamadı";
                                }
                                if (telefon4.length < 1) {
                                    telefon4 = "Bulunamadı";
                                }

                                $("#jojjoojj").html(
                                    "<tr>" +
                                    "<th>" +
                                    ad +
                                    "</th>" +
                                    "<th>" +
                                    soyad +
                                    "</th>" +
                                    "<th>" +
                                    telefon1 +
                                    "</th>" +
                                    "<th>" +
                                    telefon2 +
                                    "</th>" +
                                    "<th>" +
                                    telefon3 +
                                    "</th>" +
                                    "<th>" +
                                    telefon4 +
                                    "</th>" +
                                    "</tr>"
                                )
                            } else {
                                $.Toast.hideToast();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Bulunamadı!',
                                    text: 'Girdiğiniz TC kimlik numarası ile eşleşen bir bilgi bulunamadı.',
                                })
                            }
                        },
                        error: () => {
                            $.Toast.hideToast();
                            Swal.fire({
                                icon: 'error',
                                title: "Sunucu hatası!",
                                text: 'Lütfen yönetici ile iletişime geçin.'
                            })
                        }
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Bu çözümü kullanman için yeterli yetkin bulunmuyor!',
                    })
                }
            }
        </script>


    </div>
    <!--BİTİŞ-->
    <?php
    include('inc/footer_native.php');
    include('inc/footer_main.php');
    ?>