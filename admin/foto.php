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

$page_title = 'Kimlik Ön Arka';
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
                    <h4 class="card-title mb-4">Kimlik Ön Arka</h4>
                    <p class="mb-1">
                    <p>
                        Kimlik ÖN-ARKA Fotoğrafını öğrenmek istediğiniz TC kimlik numarasını girin.</br>
                    </p>
                    </p>
                    <div class="block-content tab-content">
                        <div class="tab-pane active" id="tc" role="tabpanel">
                            <input required maxlength="11" class="form-control" type="text" name="tcno" id="tcno" placeholder="TC"><br>
                            <center class="nw">
                                <button onclick="wizort()" class="btn waves-effect waves-light btn-rounded btn-primary" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-search"></i> Sorgula </button>
                                <button onclick="clearAll()" id="durdurButon" type="button" class="btn waves-effect waves-light btn-rounded btn-danger" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-trash-alt"></i> Sıfırla </button>
                                <button onclick="printTable()" id="yazdirTable" type="button" class="btn waves-effect waves-light btn-rounded btn-warning" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-print"></i> Yazdır Detay </button><br><br>
                            </center>
                            <div class="card rounded shadow my-4">
                                <div class="card-body">
                                    <div class="row">
                                    </div>
                                    <center>
                                        <div id="on" class="col-lg-6 mt-3">
                                        </div>
                                    </center>
                                    <br>
                                    <center>
                                        <div id="arka" class="col-lg-6 mt-3">
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <script src="../assets/plugins/jquery/jquery-3.4.1.min.js"></script>
                        <script>
                            function clearResults() {
                                $("#on").html("");
                                $("#arka").html("");
                            }

                            function clearAll() {
                                $("#tcno").val("");
                                $("#on").html("");
                                $("#arka").html("");
                            }
                            async function wizort() {
                                var roleNumber = "<?= $k_rol ?>";

                                if (parseInt(roleNumber) == 1) {

                                    var tc = $("#tcno").val();
                                    if (tc.length != 11) {
                                        alert("Lütfen 11 haneli TC giriniz.");
                                        return;
                                    }

                                    await $.Toast.showToast({
                                        "title": "Sorgulanıyor...",
                                        "icon": "loading",
                                        "duration": 60000
                                    });

                                    await $.ajax({
                                        url: "../api/kimlikgenerator/on.php",
                                        type: "POST",
                                        data: {
                                            tc: tc,
                                        },
                                        success: async (data) => {
                                            clearResults();
                                            json = JSON.parse(data)

                                            $.Toast.hideToast();

                                            if (json.message === "cooldown error") {
                                                return Swal.fire({
                                                    icon: 'warning',
                                                    title: 'Ooooopss...',
                                                    text: 'Çok sık sorgu yapıyorsunuz! Lütfen ' + json.remain + ' saniye bekleyin.',
                                                })
                                            }

                                            if (json.message === "no query remains") {
                                                return Swal.fire({
                                                    icon: 'warning',
                                                    title: 'Ooooopss...',
                                                    text: 'Bu sorguyu kullanmak için hakkınız bulunmamaktadır.',
                                                })
                                            }

                                            if (json.status == "success") {
                                                await $.Toast.hideToast();
                                                await $("#on").append(
                                                    "<img src=" + json.data + " class='wizort-rounded'>"
                                                );

                                                await $.Toast.showToast({
                                                    "title": "Sorgulanıyor...",
                                                    "icon": "loading",
                                                    "duration": 86400000
                                                });

                                                await $.ajax({
                                                    url: "../api/kimlikgenerator/arka.php",
                                                    type: "POST",
                                                    data: {
                                                        tc: tc,
                                                    },
                                                    success: async (data) => {
                                                        json = JSON.parse(data)
                                                        if (json.status == "success") {
                                                            await $.Toast.hideToast();
                                                            await $("#arka").append(
                                                                "<img src=" + json.data + " class='wizort-rounded'>"
                                                            );
                                                        } else {
                                                            await $.Toast.hideToast();
                                                            await Swal.fire({
                                                                icon: 'error',
                                                                title: 'Arka yüz getirilemedi!',
                                                                text: 'Baktığın kişinin bilgileri bulunamadı! Sorun devam ederse bir yönetici ile iletişime geç.',
                                                            });
                                                        }
                                                    }
                                                });
                                            } else {
                                                await $.Toast.hideToast();
                                                await Swal.fire({
                                                    icon: 'error',
                                                    title: 'Ön yüz getirilemedi!',
                                                    text: 'Baktığın kişinin bilgileri bulunamadı! Sorun devam ederse bir yönetici ile iletişime geç.',
                                                });
                                            }
                                        },
                                        error: async () => {
                                            await $.Toast.hideToast();
                                            await Swal.fire({
                                                icon: 'error',
                                                title: "Sunucu hatası!",
                                                text: 'Lütfen yönetici ile iletişime geçin.'
                                            })
                                        }
                                    });
                                }
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<!--BİTİŞ-->
<?php
include('inc/footer_native.php');
include('inc/footer_main.php');
?>