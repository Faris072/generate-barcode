const searchParams = new URLSearchParams(window.location.search);
let id = searchParams.get('id');
console.log(id);

$(document).ready(function() {
    getData();
});
function getData(){
    $.ajax({
        type: "GET",
        url: urlApi+'view-barcode/'+id,
        headers: {Accept: "application/json"},
        success: function(data){
            console.log(data);
            $('#no-surat').val(data.no_surat);
            $('#nama-ttd').val(data.nama_ttd);
            $('#tanggal-ttd').val(data.tanggal_ttd);
            $('#email-no-hp').val(data.email_no_hp);
            $('#perihal').val(data.perihal);
            data?.file_upload ? $('.preview-file').removeClass('d-none') : '';
            $('#file-name').html(data?.file_upload[0]?.name);
            $('#file-size').html(data?.file_upload[0]?.size);
            $('#download-file').attr('href',data?.file_upload[0]?.path);
        },
        error: function(data){
            console.log(data);
        }
    });
}

