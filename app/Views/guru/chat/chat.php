<?= $this->extend('guru/v_guru'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Chatting</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Chatting</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                Chattingan dengan, Admin
            </div>

            <div class="card-body">

                <form id="KirimPesan">
                    <div class="form-group">
                        <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Tuliskan Pesan Anda" name="isi" required rows="3"></textarea>
                    </div>
                    <input type="hidden" id="id_pembimbing" name="id_pembimbing" value="<?= $_SESSION['id_pembimbing']; ?>">
                    <div class="row">
                        <div class="col">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="lampiran">
                                <label class="custom-file-label" for="customFile">Upload File</label>
                            </div>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary submit" type="submit" style="float:right;">Kirim</button>
                            <a href="#" id="reload" type="button" class="btn btn-success submit" style="float:right; margin-right:5px;"><i class="fas fa-sync-alt"></i></a>
                            <button class="btn btn-primary loading" type="button" disabled style="float:right;">
                                Loading ...
                            </button>
                        </div>
                    </div>

                </form>

                <div class="d-flex justify-content-center mt-5">
                    <div class="spinner-border text-primary loading" style="width: 3rem; height: 3rem;" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

                <ul class="list-group list-group-flush mt-4 submit">
                </ul>

            </div>
            <div class="card-footer">
            </div>
        </div>

    </div>
</section>
</div>

<script>
$('document').ready(function(){
    $(function () {
        bsCustomFileInput.init();
    });
    
    $('#reload').click(function(e){
        LoadChat();
    });

    const LoadChat = function(){
        
        $('.loading').hide();

        $.ajax({

            url : '<?= base_url('admin/loadchat'); ?>',
            type : 'POST',
            data: {'id_pembimbing':$('#id_pembimbing').val()},
            beforeSend : function(){
                $('.loading').show();
                $('.submit').hide();
            },
            complete : function(){
                $('.loading').hide();
                $('.submit').show();
            },
            success : function(val){
                html = '';
                $('.list-group').empty();
                var data = JSON.parse(val);
                
                for(let i = 0; i<data.length; i++){

                    if(data[i].pengirim == "admin"){

                        html += '<li class="list-group-item h6 text-primary"><i class="fas fa-user-tie"></i> ADMIN, <small class="text-muted">Dikirim '+data[i].tgl+'</small></li>';
                        html += '<li class="list-group-item mb-3">';
                        html += data[i].isi;

                        if(data[i].lampiran != "kosong"){

                            html += '<p class="mt-2">';
                            html += '<b>Lampiran File :</b> <br>';
                            html += '<a href=<?= base_url('assets/chat') ?>/'+data[i].lampiran+'>'+data[i].lampiran+'</a>';
                            html += '</p>';

                        }

                        html += '</li>';

                    }else{

                        html += '<li class="list-group-item h6 text-success"><i class="fas fa-user-tie"></i> '+data[i].nama_pembimbing+', <small class="text-muted">Dikirim '+data[i].tgl+'</small></li>';
                        html += '<li class="list-group-item mb-3">';
                        html += data[i].isi;

                        if(data[i].lampiran != "kosong"){

                            html += '<p class="mt-2">';
                            html += '<b>Lampiran File :</b> <br>';
                            html += '<a href=<?= base_url('assets/chat') ?>/'+data[i].lampiran+'>'+data[i].lampiran+'</a>';
                            html += '</p>';

                        }

                        html += '</li>';

                    }
                }
                
                $('.list-group').append(html);


            },
            error : function(error){
                
                swal('SERVER ERROR, COBA LAGI LAIN WAKTU');

            }
        });

    }

    LoadChat();

    $('#KirimPesan').submit(function(e){

        e.preventDefault();

        $.ajax({
            url: '<?= base_url('guru/kirimchat'); ?>',
            data : new FormData(this),
            dataType : 'JSON',
            contentType : false,
            cache : false,
            processData : false,
            type : 'POST',
            beforeSend : function(){
                $('.loading').show();
                $('.submit').hide();
            },
            complete : function(){
                $('.loading').hide();
                $('.submit').show();
            },
            success : function(data){
                LoadChat();
                console.log(data);
                $('#KirimPesan').trigger("reset");
            },
            error : function(error){

                swal('SERVER ERROR, KIRIM PESAN GAGAL');

            }
        });

    });


    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    
});
</script>

<?= $this->endSection('content'); ?>