<html style="height: 100%;">
<head>
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="<?= $site_url ?>assets/images/logo/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?= $page_name ?> | <?= $site_name ?></title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" name="viewport">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="<?= $site_url ?>new/assets/css/ready.css">
    <link rel="stylesheet" href="<?= $site_url ?>new/assets/css/demo.css">

    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Optional: Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


    <link type="text/css" rel="stylesheet" charset="UTF-8" href="https://www.gstatic.com/_/translate_http/_/ss/k=translate_http.tr.69JJaQ5G5xA.L.W.O/d=0/rs=AN8SPfpC36MIoWPngdVwZ4RUzeJYZaC7rg/m=el_main_css"><script type="text/javascript" async="" src="https://www.google-analytics.com/analytics.js"></script><script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-115538286-1"></script><script type="text/javascript" charset="UTF-8" src="https://translate.googleapis.com/_/translate_http/_/js/k=translate_http.tr.en_GB.c_zC7qUnTFY.O/d=1/exm=el_conf/ed=1/rs=AN8SPfoBlmfmYftMKBfrazMTdGZqwlOJOw/m=el_main"></script><link id="wabiCss" rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/yui/3.18.1/cssnormalize-context/cssnormalize-context-min.css" media="all">
    <link rel="stylesheet" href="<?= $site_url ?>new/assets/css/custom.css">
    <style>
        .body-class{
            position: relative; min-height: 100%; top: 0;
        }
    </style>
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="<?= $site_url ?>assets/images/logo/favicon.png">
    <link type="text/css" rel="stylesheet" charset="UTF-8" href="https://www.gstatic.com/_/translate_http/_/ss/k=translate_http.tr.26tY-h6gH9w.L.W.O/am=DAY/d=0/rs=AN8SPfrCcgxoBri2FVMQptvuOBiOsolgBw/m=el_main_css"><script type="text/javascript" charset="UTF-8" src="https://translate.googleapis.com/_/translate_http/_/js/k=translate_http.tr.en_GB.xaTVPpkBqPA.O/am=ACA/d=1/exm=el_conf/ed=1/rs=AN8SPfqoPObKIv4W0RXwipAV1lxx-XpKVg/m=el_main"></script>

</head>

<body class="body-class" style="position: relative; min-height: 100%; top: 0px;">


<div class="wrapper">
    <div class="main-header">
        <div class="logo-header">
            <a class="navbar-brand page-scroll sticky-logo" href="/">
                <img src="<?= $site_url ?>assets/images/logo/logo.png" class="site-logo" alt="">
            </a>
            <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
        </div>
        <nav class="navbar navbar-header navbar-expand-lg">
            <div class="container-fluid">

                <h4> <?=$page_name?></h4>
                <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">


                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="../user-avatar.png" alt="user-img" width="36" class="img-circle"><span></span> </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li>
                                <div class="user-box">
                                    <div class="u-img"><img src="../user-avatar.png" alt="user"></div>
                                    <div class="u-text">
                                        <h4>fad</h4>
                                        <p class="text-muted"><?=$user_email?></p>
                                        <a href="/?a=edit_account" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                                </div>
                            </li>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="?a=edit_account"><i class="ti-user"></i> My Profile</a>
                            <a class="dropdown-item" href="/?a=earnings">MY transactions</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/?a=logout"><i class="fa fa-power-off"></i> Logout</a>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="sidebar">
        <div class="scroll-wrapper scrollbar-inner sidebar-wrapper" style="position: relative;"><div class="scrollbar-inner sidebar-wrapper scroll-content scroll-scrollx_visible scroll-scrolly_visible" style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 800px;">
                <div class="user">
                    <div class="photo">
                        <img src="../user-avatar.png">
                    </div>
                    <div class="info">
                        <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									fad
                                    <span class="user-level">Partner</span>
									<span class="caret"></span>
								</span>
                        </a>
                        <div class="clearfix"></div>

                        <style>
                            .activeTop{
                                color:#0056b3 !important;
                                transition:all 350ms linear !important;
                            }
                            a .activeTop{
                                color:#0056b3 !important;
                                transition:all 350ms linear !important;
                            }
                            a .tophide:hover{
                                color:#0056b3 !important;
                                transition:all 350ms linear !important;
                            }
                            .tophide:hover{
                                color:#0056b3 !important;
                                transition:all 350ms linear !important;
                            }
                        </style>

                        <div class="in collapse show" id="collapseExample" aria-expanded="true" style="">
                            <ul class="nav">
                                <li>
                                    <a href="/?a=edit_account">
                                        <span class="link-collapse tophide ">Edit Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/?a=security">
                                        <span class="link-collapse tophide ">Security Setting</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/?a=referals">
                                        <span class="link-collapse tophide ">Downlinks</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nav">
                    <li class="nav-item ">
                        <a href="/?a=account">
                            <i class="la la-dashboard"></i>
                            <p>Dashboard</p>
                            <span class="badge badge-count"></span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="/depo/user/login.php">
                            <i class="la la-table"></i>
                            <p>Make Deposit</p>
                            <span class="badge badge-count"> </span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="/?a=deposit">
                            <i class="la la-table"></i>
                            <p>Investments</p>
                            <span class="badge badge-count"> </span>
                        </a>
                    </li>
                    <li class="nav-item <?php
                    $active_url = $_SERVER['REQUEST_URI'];
                    if (strpos($active_url, 'stock_investment')){ echo 'active';} ?>">
                        <a href="/stock_investment">
                            <i class="la la-table"></i>
                            <p>Stock Investments</p>
                            <span class="badge badge-count"> </span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="/?a=earnings">
                            <i class="la la-keyboard-o"></i>
                            <p>My Transactions</p>
                            <span class="badge badge-count"></span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="/?a=withdraw">
                            <i class="la la-th"></i>
                            <p>Withdrawal</p>
                            <span class="badge badge-count"></span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="/?a=referals">
                            <i class="la la-"></i>
                            <p>Referrers</p>
                            <span class="badge badge-success"></span>
                        </a>
                    </li>
                    <div id="google_translate_element"><div class="skiptranslate goog-te-gadget" dir="ltr" style=""><div id=":0.targetLanguage" style="display: inline;"><select class="goog-te-combo" aria-label="Language Translate Widget"><option value="">Select Language</option><option value="ab">Abkhaz</option><option value="ace">Acehnese</option><option value="ach">Acholi</option><option value="aa">Afar</option><option value="af">Afrikaans</option><option value="sq">Albanian</option><option value="alz">Alur</option><option value="am">Amharic</option><option value="ar">Arabic</option><option value="hy">Armenian</option><option value="as">Assamese</option><option value="av">Avar</option><option value="awa">Awadhi</option><option value="ay">Aymara</option><option value="az">Azerbaijani</option><option value="ban">Balinese</option><option value="bal">Baluchi</option><option value="bm">Bambara</option><option value="bci">Baoulé</option><option value="ba">Bashkir</option><option value="eu">Basque</option><option value="btx">Batak Karo</option><option value="bts">Batak Simalungun</option><option value="bbc">Batak Toba</option><option value="be">Belarusian</option><option value="bem">Bemba</option><option value="bn">Bengali</option><option value="bew">Betawi</option><option value="bho">Bhojpuri</option><option value="bik">Bikol</option><option value="bs">Bosnian</option><option value="br">Breton</option><option value="bg">Bulgarian</option><option value="bua">Buryat</option><option value="yue">Cantonese</option><option value="ca">Catalan</option><option value="ceb">Cebuano</option><option value="ch">Chamorro</option><option value="ce">Chechen</option><option value="ny">Chichewa</option><option value="zh-CN">Chinese (Simplified)</option><option value="zh-TW">Chinese (Traditional)</option><option value="chk">Chuukese</option><option value="cv">Chuvash</option><option value="co">Corsican</option><option value="crh">Crimean Tatar (Cyrillic)</option><option value="crh-Latn">Crimean Tatar (Latin)</option><option value="hr">Croatian</option><option value="cs">Czech</option><option value="da">Danish</option><option value="fa-AF">Dari</option><option value="dv">Dhivehi</option><option value="din">Dinka</option><option value="doi">Dogri</option><option value="dov">Dombe</option><option value="nl">Dutch</option><option value="dyu">Dyula</option><option value="dz">Dzongkha</option><option value="eo">Esperanto</option><option value="et">Estonian</option><option value="ee">Ewe</option><option value="fo">Faroese</option><option value="fj">Fijian</option><option value="tl">Filipino</option><option value="fi">Finnish</option><option value="fon">Fon</option><option value="fr">French</option><option value="fr-CA">French (Canada)</option><option value="fy">Frisian</option><option value="fur">Friulian</option><option value="ff">Fulani</option><option value="gaa">Ga</option><option value="gl">Galician</option><option value="ka">Georgian</option><option value="de">German</option><option value="el">Greek</option><option value="gn">Guarani</option><option value="gu">Gujarati</option><option value="ht">Haitian Creole</option><option value="cnh">Hakha Chin</option><option value="ha">Hausa</option><option value="haw">Hawaiian</option><option value="iw">Hebrew</option><option value="hil">Hiligaynon</option><option value="hi">Hindi</option><option value="hmn">Hmong</option><option value="hu">Hungarian</option><option value="hrx">Hunsrik</option><option value="iba">Iban</option><option value="is">Icelandic</option><option value="ig">Igbo</option><option value="ilo">Ilocano</option><option value="id">Indonesian</option><option value="iu-Latn">Inuktut (Latin)</option><option value="iu">Inuktut (Syllabics)</option><option value="ga">Irish Gaelic</option><option value="it">Italian</option><option value="jam">Jamaican Patois</option><option value="ja">Japanese</option><option value="jw">Javanese</option><option value="kac">Jingpo</option><option value="kl">Kalaallisut</option><option value="kn">Kannada</option><option value="kr">Kanuri</option><option value="pam">Kapampangan</option><option value="kk">Kazakh</option><option value="kha">Khasi</option><option value="km">Khmer</option><option value="cgg">Kiga</option><option value="kg">Kikongo</option><option value="rw">Kinyarwanda</option><option value="ktu">Kituba</option><option value="trp">Kokborok</option><option value="kv">Komi</option><option value="gom">Konkani</option><option value="ko">Korean</option><option value="kri">Krio</option><option value="ku">Kurdish (Kurmanji)</option><option value="ckb">Kurdish (Sorani)</option><option value="ky">Kyrgyz</option><option value="lo">Lao</option><option value="ltg">Latgalian</option><option value="la">Latin</option><option value="lv">Latvian</option><option value="lij">Ligurian</option><option value="li">Limburgish</option><option value="ln">Lingala</option><option value="lt">Lithuanian</option><option value="lmo">Lombard</option><option value="lg">Luganda</option><option value="luo">Luo</option><option value="lb">Luxembourgish</option><option value="mk">Macedonian</option><option value="mad">Madurese</option><option value="mai">Maithili</option><option value="mak">Makassar</option><option value="mg">Malagasy</option><option value="ms">Malay</option><option value="ms-Arab">Malay (Jawi)</option><option value="ml">Malayalam</option><option value="mt">Maltese</option><option value="mam">Mam</option><option value="gv">Manx</option><option value="mi">Maori</option><option value="mr">Marathi</option><option value="mh">Marshallese</option><option value="mwr">Marwadi</option><option value="mfe">Mauritian Creole</option><option value="chm">Meadow Mari</option><option value="mni-Mtei">Meiteilon (Manipuri)</option><option value="min">Minang</option><option value="lus">Mizo</option><option value="mn">Mongolian</option><option value="my">Myanmar (Burmese)</option><option value="bm-Nkoo">N'Ko</option><option value="nhe">Nahuatl (Eastern Huasteca)</option><option value="ndc-ZW">Ndau</option><option value="nr">Ndebele (South)</option><option value="new">Nepal Bhasa (Newari)</option><option value="ne">Nepali</option><option value="no">Norwegian</option><option value="nus">Nuer</option><option value="oc">Occitan</option><option value="or">Odia (Oriya)</option><option value="om">Oromo</option><option value="os">Ossetian</option><option value="pag">Pangasinan</option><option value="pap">Papiamento</option><option value="ps">Pashto</option><option value="fa">Persian</option><option value="pl">Polish</option><option value="pt">Portuguese (Brazil)</option><option value="pt-PT">Portuguese (Portugal)</option><option value="pa">Punjabi (Gurmukhi)</option><option value="pa-Arab">Punjabi (Shahmukhi)</option><option value="qu">Quechua</option><option value="kek">Qʼeqchiʼ</option><option value="rom">Romani</option><option value="ro">Romanian</option><option value="rn">Rundi</option><option value="ru">Russian</option><option value="se">Sami (North)</option><option value="sm">Samoan</option><option value="sg">Sango</option><option value="sa">Sanskrit</option><option value="sat-Latn">Santali (Latin)</option><option value="sat">Santali (Ol Chiki)</option><option value="gd">Scots Gaelic</option><option value="nso">Sepedi</option><option value="sr">Serbian</option><option value="st">Sesotho</option><option value="crs">Seychellois Creole</option><option value="shn">Shan</option><option value="sn">Shona</option><option value="scn">Sicilian</option><option value="szl">Silesian</option><option value="sd">Sindhi</option><option value="si">Sinhala</option><option value="sk">Slovak</option><option value="sl">Slovenian</option><option value="so">Somali</option><option value="es">Spanish</option><option value="su">Sundanese</option><option value="sus">Susu</option><option value="sw">Swahili</option><option value="ss">Swati</option><option value="sv">Swedish</option><option value="ty">Tahitian</option><option value="tg">Tajik</option><option value="ber-Latn">Tamazight</option><option value="ber">Tamazight (Tifinagh)</option><option value="ta">Tamil</option><option value="tt">Tatar</option><option value="te">Telugu</option><option value="tet">Tetum</option><option value="th">Thai</option><option value="bo">Tibetan</option><option value="ti">Tigrinya</option><option value="tiv">Tiv</option><option value="tpi">Tok Pisin</option><option value="to">Tongan</option><option value="lua">Tshiluba</option><option value="ts">Tsonga</option><option value="tn">Tswana</option><option value="tcy">Tulu</option><option value="tum">Tumbuka</option><option value="tr">Turkish</option><option value="tk">Turkmen</option><option value="tyv">Tuvan</option><option value="ak">Twi</option><option value="udm">Udmurt</option><option value="uk">Ukrainian</option><option value="ur">Urdu</option><option value="ug">Uyghur</option><option value="uz">Uzbek</option><option value="ve">Venda</option><option value="vec">Venetian</option><option value="vi">Vietnamese</option><option value="war">Waray</option><option value="cy">Welsh</option><option value="wo">Wolof</option><option value="xh">Xhosa</option><option value="sah">Yakut</option><option value="yi">Yiddish</option><option value="yo">Yoruba</option><option value="yua">Yucatec Maya</option><option value="zap">Zapotec</option><option value="zu">Zulu</option></select></div>&nbsp;&nbsp;Powered by <span style="white-space:nowrap"><a class="VIpgJd-ZVi9od-l4eHX-hSRGPd" href="https://translate.google.com" target="_blank"><img src="https://www.gstatic.com/images/branding/googlelogo/1x/googlelogo_color_42x16dp.png" width="37px" height="14px" style="padding-right: 3px" alt="Google Translate">Translate</a></span></div></div>

                </ul>
            </div><div class="scroll-element scroll-x scroll-scrollx_visible scroll-scrolly_visible"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar" style="width: 241px; left: 0px;"></div></div></div><div class="scroll-element scroll-y scroll-scrollx_visible scroll-scrolly_visible"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar" style="height: 660px; top: 0px;"></div></div></div></div>
    </div>
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
