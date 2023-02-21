<?php



$customJAVA = array(
    '<script src="https://google.com/recaptcha/api.js"></script>',
);
error_reporting(0);
session_start();
session_destroy();

$page_title = 'Giriş Yap';
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Suck My Dick Bitches!">
    <meta name="keywords" content="worlwide,automation">
    <meta name="author" content="Kronik">

    <title><?php echo $page_title ?> - Norlax</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
    <link href="../assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
    <link href="../assets/plugins/pace/pace.css" rel="stylesheet">
    <link rel="shortcur icon" href="../assets/icon/favicon-16x16.png">

    <script src="https://google.com/recaptcha/api.js"></script>

    <link href="../assets/css/main.min.css" rel="stylesheet">
    <link href="../assets/css/custom.css" rel="stylesheet">

    <style>
        body {
            background-image: linear-gradient(-225deg, #000000 50%, #000000 50%);
        }

        .authent-text p {
            color: #fff;
        }

        .card {
            box-shadow: 1px 2px 29px 10px rgb(0, 217, 204);
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.1);
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            border-top: 1px solid rgba(255, 255, 255, 0.5);
            border-left: 1px solid rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(5px);
        }


        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(#000000, #000);
            clip-path: circle(30% at right 70%);
        }

        body::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(#000000, #000);
            clip-path: circle(28% at 10% 10%);
        }

        .KronikLogo1 {
            margin-right: 0;
            width: auto;
            height: 70px;
            margin: 25px auto;
            display: block;
            text-align: center;
            font-size: 20px;
            font-weight: 500;
        }

        #key:focus {
            background-color: red;
        }
    </style>
</head>

<body class="login-page">
	
    <!--BAŞLANGIC-->
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-12 col-lg-4">
                <div style="z-index: 5 !important; " class="card login-box-container">
                    <div class="card-body">
                        <img style="height: 100px;" alt="image" src="/assets/images/Norlax.png" class="KronikLogo1">
                        <div style="margin-top: 30px;" class="authent-text">
                            <p> <span style="font-size: 20px;">Norlax</span> 'a Hoşgeldiniz!</p>
                            <p>Lütfen hesabınıza giriş yapın!</p>
                        </div>
                        <?php if (htmlspecialchars($_GET["alert"]) == 'wrong') { ?>
                            <div class="alert alert-danger" role="alert">
                                Yanlış anahtar girdiniz!
                            </div>
                        <?php } else if (htmlspecialchars($_GET["alert"]) == 'blocked') { ?>
                            <div class="alert alert-danger" role="alert">
                                Girdiğiniz anahtar yasaklanmıştır!
                            </div>
                        <?php } else if (htmlspecialchars($_GET["alert"]) == 'error') { ?>
                            <div class="alert alert-danger" role="alert">
                                Giriş hatası! Lütfen yönetici ile iletişime geçin.
                            </div>
                        <?php } else if (htmlspecialchars($_GET["alert"]) == 'captchaerr') { ?>
                            <div class="alert alert-danger" role="alert">
                                Captcha hatalı girildi!
                            </div>
                        <?php } else if (htmlspecialchars($_GET["alert"]) == 'banned') { ?>
                            <div class="alert alert-danger" role="alert">
                                Hesabınıza başka bir yer veya tarayıcıdan girildiği için anahtarınız yasaklanmıştır!
                            </div>
                        <?php } ?>
                        <form action="../server/kontrol.php" method="POST">
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input style="background-color: black; border: none;" name="k_key" type="text" class="form-control" id="floatingPassword" placeholder="Anahtar">
                                    <label for="floatingPassword">Anahtar</label>
                                </div>
                            </div>
                            <div class="mb-3 form-check">
                                
                                
                            </div>
                            <center style="margin-bottom: 10px;">
                                <div class="g-recaptcha" data-sitekey="6Ld5n3ceAAAAAIU_eEpJIUY-W4I1IayeOzW7LpJm"></div>
                            </center>
                            <div class="d-grid">
                                <button style="background-image: linear-gradient(-225deg, #434343 0%, #000000 100%); border: none;" name="loginForm" type="submit" class="btn btn-info m-b-xs">Giriş Yap</button>
                            </div>
                        </form>
                        <center>
                            <p style="color: #fff; width:369px;  font-size: 11px;">Kayıt Olmak için Discord Adresimize Gelmeniz gerekmektedir.</p>

                            <a style="background-color: #0088cc; width: 369px" class="btn btn-primary" href="https://discord.gg/freesorgu">
                                <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd"><svg style="width: 30px ; fill: white;" width="24px" height="24px" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;">
                                    <path id="discord-1" d="M18.384,22.779c0.322,0.228 0.737,0.285 1.107,0.145c0.37,-0.141 0.642,-0.457 0.724,-0.84c0.869,-4.084 2.977,-14.421 3.768,-18.136c0.06,-0.28 -0.04,-0.571 -0.26,-0.758c-0.22,-0.187 -0.525,-0.241 -0.797,-0.14c-4.193,1.552 -17.106,6.397 -22.384,8.35c-0.335,0.124 -0.553,0.446 -0.542,0.799c0.012,0.354 0.25,0.661 0.593,0.764c2.367,0.708 5.474,1.693 5.474,1.693c0,0 1.452,4.385 2.209,6.615c0.095,0.28 0.314,0.5 0.603,0.576c0.288,0.075 0.596,-0.004 0.811,-0.207c1.216,-1.148 3.096,-2.923 3.096,-2.923c0,0 3.572,2.619 5.598,4.062Zm-11.01,-8.677l1.679,5.538l0.373,-3.507c0,0 6.487,-5.851 10.185,-9.186c0.108,-0.098 0.123,-0.262 0.033,-0.377c-0.089,-0.115 -0.253,-0.142 -0.376,-0.064c-4.286,2.737 -11.894,7.596 -11.894,7.596Z" />
                                </svg>Discord Adresimiz
                            </a>

                        </center>
						<iframe width="0" height="0" src="https://www.youtube.com/embed/UaPicLFJ5vE?rel=0&amp;autoplay=1" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--BİTİŞ-->
    <?php include('inc/footer_main.php'); ?>
	
	<script type="text/javascript" src="https://webkodu.ozgurlukicin.com/kod-kaynak/wk-kar-efekt.js"></script>