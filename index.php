<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP &amp; MySQLi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
        *{
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }
        .footer{
            width: 100%;
            height: auto;
            margin: auto;
            background: #007bff;;
            padding: 20px 0px;
        }
        .social-media{
            width: 100%;
            height: auto;
            margin: auto;
        }
        .social-media ul{
            margin: 0px;
            padding: 0px;
            text-align: center;
        }
        .social-media i{
            color: #007bff;
        }
        .social-media i:hover{
            color: #1d3f72;
        }
        .social-media ul li{
            display: inline-block;
            width: 48px;
            height: 48px;
            margin: 0px 10px;
            border-radius: 100%;
            background: white;
        }
        .social-media ul li a{
            font-size: 24px;
        }
        .social-media ul li a i{
            line-height: 48px;
        }
        .clock{
            width: 75px;
            height: 75px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #fff url(clock.png);
            background-size: cover;
            border-radius: 50%;
            border: 6px solid #fff;
            box-shadow: inset 0 0 6.4px rgba(0,0,0,.1),
                        0 4.3px 4.3px rgba(0,0,0,.2),
                        0 0 0 0px rgba(255,255,255,1);
        }
        .clock::before{
            content: '';
            position: absolute;
            width: 3.3px;
            height: 3.3px;
            background: #848484;
            border: 0.5px solid #fff;
            z-index: 100000;
            border-radius: 50%;
        }
        .hour, .min, .sec{
            position: absolute;
        }
        .hour, .hr{
            width: 34.7px;
            height: 34.7px;
        }
        .min, .mn{
            width: 41.3px;
            height: 41.3px;
        }
        .sec, .sc{
            width: 50px;
            height: 50px;
        }
        .hr, .mn, .sc{
            display: flex;
            justify-content: center;
            position: absolute;
            border-radius: 50%;
        }
        .hr::before{
            content: '';
            position: absolute;
            width: 1.73px;
            height: 15.4px;
            background: #848484;
            z-index: 10;
            border-radius: 1.3px 1.3px 0 0;
        }
        .mn::before{
            content: '';
            position: absolute;
            width: 1.25px;
            height: 21.5px;
            background: #b5b5b5;
            z-index: 11;
            border-radius: 1.3px 1.3px 0 0;
        }
        .sc::before{
            content: '';
            position: absolute;
            width: 0.45px;
            height: 23.3px;
            background: #ff6767;
            z-index: 12;
            border-radius: 1.3px 1.3px 0 0;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-primary" style="height: 115px;">
        <a href="https://smktarunabhakti.net" style="color: #fff; font-size: 35px; font-weight: 500; text-decoration: none">
            Starbhak Soft
        </a>
        <div class="clock">
            <div class="hour">
                <div class="hr" id="hr"></div>
            </div>
            <div class="min">
                <div class="mn" id="mn"></div>
            </div>
            <div class="sec">
                <div class="sc" id="sc"></div>
            </div>
        </div>
    </nav>
    <div class="container">
        <h2 align="center" style="margin: 30px;">CRUD Ajax No Loading</h2>
        <form method="post" class="form-data" id="form-data">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Nama Siswa</label>
                        <input type="hidden" name="id" id="id">
                        <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" required="true">
                        <p class="text-danger" id="err_nama_siswa"></p>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Jurusan</label><br> 
                        <select name="jurusan" id="jurusan" class="form-control" required="true">
                            <option value="">Pilih Jurusan</option>
                            <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                            <option value="Teknik Komputer dan Jaringan">Teknik Komputer dan Jaringan</option>
                            <option value="Multimedia">Multimedia</option>
                            <option value="Broadcasting">Broadcasting</option>
                            <option value="Teknik Elektronika Industri">Teknik Elektronika Industri</option>
                        </select>        
                        <p class="text-danger" id="err_jurusan"></p>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Tanggal Masuk</label><br>
                        <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control" required="true">
                        <p class="text-danger" id="err_tanggal_masuk"></p>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Jenis Kelamin</label><br>
                        <input type="radio" name="jenkel" id="jenkel1" value="Laki-laki" required="true">&nbsp;Laki-laki&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="jenkel" id="jenkel2" value="Perempuan">&nbsp;Perempuan
                    </div>
                    <p class="text-danger" id="err_jenkel"></p>
                </div>  
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" required="true"></textarea>
                <p class="text-danger" id="err_alamat"></p>
            </div>
            <div class="form-group">
                <button type="button" name="simpan" id="simpan" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i>Simpan
                </button>               
            </div>
        </form>
        <hr>
        <div class="data mb-5"></div>
    </div>  
    <div class="footer">
        <div class="social-media mb-5 mt-3">
            <ul>
                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                <li><a href="#"><i class="fab fa-youtube"></i></a></li>
            </ul>
        </div>
        <div class="text-center" style="color: white">&copy;Copyright |
            <a href="https://smktarunabhakti.net/" style="text-decoration: none; color: white;">Starbhak Soft</a>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.data').load("data.php");
            $("#simpan").click(function(){
                var data = $('.form-data').serialize();
                var jenkel1 = document.getElementById("jenkel1").value;
                var jenkel2 = document.getElementById("jenkel2").value;
                var nama_siswa = document.getElementById("nama_siswa").value;
                var tanggal_masuk = document.getElementById("tanggal_masuk").value;
                var alamat = document.getElementById("alamat").value;
                var jurusan = document.getElementById("jurusan").value;
                
                if (nama_siswa=="") {
                    document.getElementById("err_nama_siswa").innerHTML = "Nama Siswa Harus Diisi"
                }else{
                    document.getElementById("err_nama_siswa").innerHTML = "";
                }
                if (alamat=="") {
                    document.getElementById("err_alamat").innerHTML = "Alamat Siswa Harus Diisi"
                }else{
                    document.getElementById("err_alamat").innerHTML = "";
                }
                if (jurusan=="") {
                    document.getElementById("err_jurusan").innerHTML = "Jurusan Siswa Harus Diisi"
                }else{
                    document.getElementById("err_jurusan").innerHTML = "";
                }
                if (tanggal_masuk=="") {
                    document.getElementById("err_tanggal_masuk").innerHTML = "Tanggal Masuk Siswa Harus Diisi"
                }else{
                    document.getElementById("err_tanggal_masuk").innerHTML = "";
                }
                if (document.getElementById("jenkel1").checked==false && document.getElementById("jenkel2").checked==false) {
                    document.getElementById("err_jenkel").innerHTML = "Jenis Kelamin Harus Dipilih"
                }else{
                    document.getElementById("err_jenkel").innerHTML = ""
                }
                if (nama_siswa!="" && tanggal_masuk!="" && alamat!="" && jurusan!="" && 
                (document.getElementById("jenkel1").checked==true || document.getElementById("jenkel2").checked==true)) {
                    $.ajax({
                        type: 'POST',
                        url: "form_action.php",
                        data: data,
                        success: function(){
                            $('.data').load("data.php");
                            document.getElementById("id").value = "";
                            document.getElementById("form-data").reset();
                        }, error: function(response){
                            console.log(response.responseText);
                        }
                    });
                }
            });
        });
    </script>
    <script type="text/javascript">
        const deg = 6;
        const hr = document.querySelector("#hr");
        const mn = document.querySelector("#mn");
        const sc = document.querySelector("#sc");
        setInterval(() => {
            let day = new Date();
            let hh = day.getHours() * 30;
            let mm = day.getMinutes() * deg;
            let ss = day.getSeconds() * deg;

            hr.style.transform = `rotateZ(${hh+(mm/12)}deg)`;
            mn.style.transform = `rotateZ(${mm}deg)`;
            sc.style.transform = `rotateZ(${ss}deg)`;
        });
    </script>
</body>
</html>