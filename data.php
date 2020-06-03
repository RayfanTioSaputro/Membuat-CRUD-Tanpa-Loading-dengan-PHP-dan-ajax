<table id="example" class="table table-striped table-bordered" style="width: 100%">
    <thead>
        <tr>
            <td align="center">No</td>
            <td align="center">Nama Siswa</td>
            <td align="center">Alamat</td>
            <td align="center">Jurusan</td>
            <td align="center">Jenis Kelamin</td>
            <td align="center">Tanggal Masuk</td>
            <td align="center">Action</td>
        </tr>
    </thead>
    <tbody>
        <?php
            include 'koneksi.php';
            $no = 1;
            $query = "SELECT * FROM tbl_siswa ORDER BY id DESC";
            $prepare1 = $db1->prepare($query);
            $prepare1->execute();
            $res1 = $prepare1->get_result();

            if ($res1->num_rows > 0) {
                while ($row = $res1->fetch_assoc()) {
                    $id = $row['id'];
                    $nama_siswa = $row['nama_siswa'];
                    $alamat = $row['alamat'];
                    $jurusan = $row['jurusan'];
                    $jenis_kelamin = $row['jenis_kelamin'];
                    $tgl_masuk = $row['tgl_masuk'];
        ?>
            <tr>
                <td><?php echo $no++; ?>
                   <a href="" style="float: right" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-eye"></i></a>
                </td>
                <td><?php echo $nama_siswa; ?></td>
                <td><?php echo $alamat; ?></td>
                <td><?php echo $jurusan; ?></td>
                <td><?php echo $jenis_kelamin; ?></td>
                <td><?php echo $tgl_masuk; ?></td>
                <td align="center">
                    <button id="<?php echo $id; ?>" class="btn btn-success btn-sm edit_data">
                        <i class="fas fa-edit mr-1" style="font-size: 12px"></i>Edit
                    </button>
                    <button id="<?php echo $id; ?>" class="btn btn-danger btn-sm hapus_data">
                        <i class="fas fa-trash mr-1" style="font-size: 12px"></i>Hapus
                    </button>
                </td>
            </tr>        
        <?php } } else { ?>
            <tr>
                <td colspan="7">Tidak Ada Data Yang Ditemukan</td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">View Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <center><img src="avatar/avatar1.png" style="width: 50%;"></center>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample1" aria-expanded="false" aria-controls="multiCollapseExample1" style="margin: 0 auto;">
                    Read More
                </button>
            </div>
            <div>
                <div class="collapse multi-collapse" id="multiCollapseExample1">
                    <div class="card card-body">
                        Anim pariatur cliche reprehenderit, enim 
                        eiusmod high life accusamus terry richardson ad squid. 
                        Nihil anim keffiyeh helvetica, craft beer labore wes anderson 
                        cred nesciunt sapiente ea proident.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#example').DataTable();
    });

    function reset(){
        document.getElementById("err_nama_siswa").innerHTML = "";
        document.getElementById("err_alamat").innerHTML = "";
        document.getElementById("err_jurusan").innerHTML = "";
        document.getElementById("err_tanggal_masuk").innerHTML = "";
        document.getElementById("err_jenkel").innerHTML = "";
    }

    $(document).on('click', '.edit_data', function(){
        var id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: "get_data_all.php",
            data: {id:id},
            dataType: 'json',
            success: function(response){
                reset();
                document.getElementById("id").value = response.id;
                document.getElementById("nama_siswa").value = response.nama_siswa;
                document.getElementById("tanggal_masuk").value = response.tgl_masuk;
                document.getElementById("alamat").value = response.alamat;
                document.getElementById("jurusan").value = response.jurusan;
                if (response.jenis_kelamin=="Laki-laki") {
                    document.getElementById("jenkel1").checked = true;
                }else{
                    document.getElementById("jenkel2").checked = true;
                }
            }, error: function(response){
                console.log(response.responseText);
            }
        });
    });

    $(document).on('click', '.hapus_data', function(){
        var id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: "hapus_data.php",
            data: {id:id},
            success: function(){
                $('.data').load("data.php");
            }, error: function(response){
                console.log(response.responseText);
            }
        });
    });
    
</script>