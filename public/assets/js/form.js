// let dropzone = '';

$(document).ready(function(){
    $('#tanggal-ttd').datepicker({
        format: 'dd-mm-yyyy',
        setDate: new Date(),
        autoclose: true
    })

    $('#btn-download').hide();
});

function generate(){
    let data = {
        no_surat: $('#no-surat').val(),
        nama_ttd: $('#nama-ttd').val(),
        tanggal_ttd: $('#tanggal-ttd').val(),
        email_no_hp: $('#email-no-hp').val(),
        perihal: $('#perihal').val(),
    }

    $.ajax({
        url: urlApi+'generate',
        type: 'POST',
        data: data,
        headers: {
            Accept: 'application/json',
        },
        success: function(data){
            console.log(data);
            $('#btn-download').show(500).attr('href',data?.data?.files?.asset);
        },
        error: function(xhr){
            console.log(xhr);
        }
    });
}

// function initDz(){
//     dropzone = new Dropzone('.dropzone',{
//         url: urlApi+`upload`,
//         dictCancelUpload: "Cancel",
//         parallelUploads: 100,
//         uploadMultiple: true,
//         addRemoveLinks: true,
//         acceptedFiles: ".jpg,.jpeg,.pdf,",
//         autoProcessQueue: false,
//         paramName: "attachments",
//         init: function () {te
//             this.on("error", function (file, response) {
//                 ewpLoadingHide();
//                 let msg = '';
//                 for(let val in response?.data){
//                     msg += `<span class="text-muted">${response?.data[val]}.</span><br>`;
//                 }
//                 if (!file.accepted) {
//                     this.removeFile(file);
//                     Swal.fire(
//                         "Pemberitahuan",
//                         "Silahkan periksa file Anda lagi",
//                         "warning"
//                     );
//                 } else if (file.status == "error") {
//                     this.removeFile(file);
//                     Swal.fire({title: "Oppss..",html: msg, icon: "error"});
//                     $("#modal-add").modal("hide");
//                 }
//             });
//             this.on("resetFiles", function (file) {
//                 this.removeAllFiles();
//             });
//         },
//         headers: {
//             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//             Authorization: "Bearer " + localStorage.getItem("eperdin_token"),
//         },
//     });
// }

$(document).on('click','#btn-submit',function(){
    generate();
});
