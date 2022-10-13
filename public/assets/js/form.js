let dropzone = '';

$(document).ready(function(){
    $('#tanggal-ttd').datepicker({
        format: 'dd-mm-yyyy',
        setDate: new Date(),
        autoclose: true
    })

    $('#btn-download').hide();
    // initDz();
    dropzone.autoDiscover = false;
});

function generate(){
    let file = document.querySelector('#upload-file').files[0];
    let data = {
        no_surat: $('#no-surat').val(),
        nama_ttd: $('#nama-ttd').val(),
        tanggal_ttd: $('#tanggal-ttd').val(),
        email_no_hp: $('#email-no-hp').val(),
        perihal: $('#perihal').val(),
        file: file
    }

    let formData = new FormData();
    formData.append('no_surat', data?.no_surat);
    formData.append('nama_ttd', data?.nama_ttd);
    formData.append('tanggal_ttd', data?.tanggal_ttd);
    formData.append('email_no_hp', data?.email_no_hp);
    formData.append('perihal', data?.perihal);
    formData.append('file', file);

    $.ajax({
        url: urlApi+'generate',
        type: 'POST',
        data: formData,
        processData: false,//untuk mengirim file dari formData()
        contentType: false,//sama
        enctype: 'multipart/form-data',
        headers: {
            Accept: 'application/json',
        },
        success: function(data){
            console.log(data);
            $('#btn-download').show(500).attr('href',data?.data?.barcode?.asset);
        },
        error: function(xhr){
            console.log(xhr);
        }
    });
}

function initDz(){
    dropzone = new Dropzone('.dropzone',{
        url: urlApi+`upload`,
        dictCancelUpload: "Cancel",
        parallelUploads: 100,
        uploadMultiple: true,
        addRemoveLinks: true,
        acceptedFiles: ".jpg,.jpeg,.pdf,",
        autoProcessQueue: false,
        paramName: "attachments",
        init: function () {te
            this.on("error", function (file, response) {
                ewpLoadingHide();
                let msg = '';
                for(let val in response?.data){
                    msg += `<span class="text-muted">${response?.data[val]}.</span><br>`;
                }
                if (!file.accepted) {
                    this.removeFile(file);
                    Swal.fire(
                        "Pemberitahuan",
                        "Silahkan periksa file Anda lagi",
                        "warning"
                    );
                } else if (file.status == "error") {
                    this.removeFile(file);
                    Swal.fire({title: "Oppss..",html: msg, icon: "error"});
                }
            });
            this.on("resetFiles", function (file) {
                this.removeAllFiles();
            });
        },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            Authorization: "Bearer " + localStorage.getItem("eperdin_token"),
        },
    });
}

$(document).on('change','#upload-file', function(){
    if($('#upload-file').val() == ''){
        $('.preview-file').addClass('d-none');
    }
    else{
        $('.preview-file').removeClass('d-none');
        let file = this.files[0];
        if(file.type == 'application/pdf'){
            $('.preview-file img').attr('src', assetUrl+'images/pdf.svg');
            $('#file-name').html(file.name);
            $('#file-size').html((file.size/1000000).toFixed(2)+'MB');
            $('#file-type').html(file.type);
        }
        else{
            console.log(assetUrl)
            let reader = new FileReader();
            reader.onload = function(event){
                $('.preview-file img').attr('src', event.target.result);
            }
            reader.readAsDataURL(file);
        }
    }
});

$(document).on('click','#btn-submit',function(){
    generate();
});
