@extends('layouts.app')

@section('title')
    Daftar Pengeluaran
@endsection

@section('breadcrumb')
    @parent
    <li>pengeluaran</li>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah</a>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="30">NO</th>
                            <th>Tanggal</th>
                            <th>Jenis Pengeluaran</th>
                            <th>Nominal</th>
                            <th width="100">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('pengeluaran.form')
@endsection

@section('script')
<script type="text/javascript">
    var table, save_method;
    $(function(){
        //menampilkan data dengan plugin datatables
        table = $('.table').DataTable({
            "processing" : true,
            "ajax" : {
                "url" : "{{ route('pengeluaran.data') }}",
                "type" : "GET"
            }
        });

        $('#modal-form form').on('submit', function(e){
            if(!e.isDefaultPrevented()){
                var id =$('#id').val();
                if(save_method == "add"){
                    url = "{{ route('pengeluaran.store') }}";
                }else{
                    url = "pengeluaran/"+id;
                }

                $.ajax({
                    url : url,
                    type : "POST",
                    data : $('#modal-form form').serialize(),
                    dataType : 'JSON',
                    success : function(data){
                        if(data.msg == "error"){
                            alert("kode pengeluaran sudah digunakan");
                        }else{
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                        }
                    },
                    error : function(){
                        alert("tidak dapat menyimpann data");
                    }
                });
                return false;
            }
        });
    });

    function addForm(){
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modal-form').modal('show');
        $('#modal-form form')[0].reset();
        $('.modal-title').text('Tambah pengeluaran');
        $('.modal-button').text('Simpan');
        $('#kode').attr('readonly', false);
    }

    function editForm(id){
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#modal-form form') [0].reset();
        $.ajax({
            url : "pengeluaran/"+id+"/edit",
            type : "GET",
            dataType : "JSON",
            success : function(data){
                $('#modal-form').modal('show');
                $('.modal-title').text('Edit pengeluaran');
                $('.modal-button').text('Update');

                $('#id').val(data.id_pengeluaran);
                $('#jenis').val(data.jenis_pengeluaran);
                $('#nominal').val(data.nominal);
            },
            error : function(){
                alert("Tidak Dapat Menampilkan Data!");
            }
        });
    }

    function deleteData(id){
        if(confirm("Apakah yakin Data Akan Di hapus?")){
            $.ajax({
                url : "pengeluaran/"+id,
                type : "POST",
                data : {
                    '_method' : 'DELETE',
                    '_token' : $('meta[name=csrf-token]').attr('content')
                },
                success : function(result){
                    table.ajax.reload();
                },
                error : function(){
                    alert("tidak dapat menghapus data");
                }
            });
        }
    }
</script>

@endsection