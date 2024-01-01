$('#tutupBtn').on('click', function () {
    $('#cardGreeting').addClass('animate__animated animate__fadeOut');
    setTimeout(function () {
        $('#cardGreeting').remove();
    }, 1000);
});

$('#pekerjaan').on('change', function () {
    if ($(this).val() == 'Lainnya') {
        $('#pekerjaanSpesifikSection').removeClass('animate__animated animate__fadeOut').addClass('animate__animated animate__fadeIn');
        $('#pekerjaanSpesifikSection').show();
        $('#pekerjaanSpesifik').focus();
    } else {
        $('#pekerjaanSpesifikSection').removeClass('animate__animated animate__fadeIn').addClass('animate__animated animate__fadeOut');
        setTimeout(function () {
            $('#pekerjaanSpesifikSection').hide();
        }, 1000);
    }
});

$('#bidangIndustri').on('change', function () {
    if ($(this).val() == 'Lainnya') {
        $('#bidangIndustriSpesifikSection').removeClass('animate__animated animate__fadeOut').addClass('animate__animated animate__fadeIn');
        $('#bidangIndustriSpesifikSection').show();
        $('#bidangIndustriSpesifik').focus();
    } else {
        $('#bidangIndustriSpesifikSection').removeClass('animate__animated animate__fadeIn').addClass('animate__animated animate__fadeOut');
        setTimeout(function () {
            $('#bidangIndustriSpesifikSection').hide();
        }, 1000);
    }
});

$('#penggunaExtension').on('change', function () {
    if ($(this).val() == 'Ya, Saya Pernah') {
        $('#penggunaExtensionTrue').removeClass('animate__animated animate__fadeOut').addClass('animate__animated animate__fadeIn');
        $('#penggunaExtensionTrue').show();
        $('#penggunaExtensionSpesifik').focus();
    } else {
        $('#penggunaExtensionTrue').removeClass('animate__animated animate__fadeIn').addClass('animate__animated animate__fadeOut');
        setTimeout(function () {
            $('#penggunaExtensionTrue').hide();
        }, 1000);

    }
});

$('#tcb1').on('click', function () {
    var y = $("#cb1").prop('checked');
    (y ? $('#cb1').attr('checked', false) : $('#cb1').attr('checked', true))
});
$('#tcb2').on('click', function () {
    var y = $("#cb2").prop('checked');
    (y ? $('#cb2').attr('checked', false) : $('#cb2').attr('checked', true))
});
$('#tcb3').on('click', function () {
    var y = $("#cb3").prop('checked');
    (y ? $('#cb3').attr('checked', false) : $('#cb3').attr('checked', true))
});
$('#tcb4').on('click', function () {
    var y = $("#cb4").prop('checked');
    (y ? $('#cb4').attr('checked', false) : $('#cb4').attr('checked', true))
});
$('#tcb5').on('click', function () {
    var y = $("#cb5").prop('checked');
    (y ? $('#cb5').attr('checked', false) : $('#cb5').attr('checked', true))
});
$('#tcb6').on('click', function () {
    var y = $("#cb6").prop('checked');
    (y ? $('#cb6').attr('checked', false) : $('#cb6').attr('checked', true))
});

$('#tcb11').on('click', function () {
    var y = $("#cb11").prop('checked');
    (y ? $('#cb11').attr('checked', false) : $('#cb11').attr('checked', true))
});
$('#tcb12').on('click', function () {
    var y = $("#cb12").prop('checked');
    (y ? $('#cb12').attr('checked', false) : $('#cb12').attr('checked', true))
});
$('#tcb13').on('click', function () {
    var y = $("#cb13").prop('checked');
    (y ? $('#cb13').attr('checked', false) : $('#cb13').attr('checked', true))
});
$('#tcb14').on('click', function () {
    var y = $("#cb14").prop('checked');
    (y ? $('#cb14').attr('checked', false) : $('#cb14').attr('checked', true))
});

$(document).ready(function () {

    $('#surveyForm').on('submit', function (e) {
        e.preventDefault();

        const nama = $('#nama').val();
        const email = $('#email').val();
        const jenisKelamin = $('#jenisKelamin').val();
        const usia = $('#usia').val();
        const pekerjaan = $('#pekerjaan').val();
        const pekerjaanSpesifik = $('#pekerjaanSpesifik').val();
        var pekerjaanTrue;
        if (pekerjaan == 'Lainnya') {
            pekerjaanTrue = pekerjaanSpesifik;
        } else {
            pekerjaanTrue = pekerjaan;
        }
        const bidangIndustri = $('#bidangIndustri').val();
        const bidangIndustriSpesifik = $('#bidangIndustriSpesifik').val();
        var bidangIndustriTrue;
        if (bidangIndustri == 'Lainnya') {
            bidangIndustriTrue = bidangIndustriSpesifik;
        } else {
            bidangIndustriTrue = bidangIndustri;
        }

        // VARIABLE TO VALIDATION
        const menggunakanEmail = $('#menggunakanEmail').val();
        const mengalami = $('#mengalami').val();
        const kesadaran = $('#kesadaran').val();
        const korban = $('#korban').val();
        const penggunaExtension = $('#penggunaExtension').val();
        const penggunaExtensionSpesifik = $('#penggunaExtensionSpesifik').val();
        const deteksiEmail = $('#deteksiEmail').val();
        const mempertimbangkan = $('#mempertimbangkan').val();
        var checkedValues = $(".fiturCheckbox:checked").map(function () {
            return $(this).val();
        }).get();
        const fiturUtama = checkedValues.join(", ");
        const seberapaNyaman = $('#seberapaNyaman').val();
        var checkedValues1 = $(".fiturCheckbox1:checked").map(function () {
            return $(this).val();
        }).get();
        const platformEmail = checkedValues1.join(", ");
        const LainnyaEmail = $('#LainnyaEmail').val();

        if (menggunakanEmail == 'null') {
            const toast = document.getElementById('toast-warningLengkapiForm')
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast);
            toastBootstrap.show();
            $('#menggunakanEmail').focus();
            return;
        }
        if (mengalami == 'null') {
            const toast = document.getElementById('toast-warningLengkapiForm')
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast);
            toastBootstrap.show();
            $('#mengalami').focus();
            return;
        }
        if (kesadaran == 'null') {
            const toast = document.getElementById('toast-warningLengkapiForm')
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast);
            toastBootstrap.show();
            $('#kesadaran').focus();
            return;
        }
        if (korban == 'null') {
            const toast = document.getElementById('toast-warningLengkapiForm')
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast);
            toastBootstrap.show();
            $('#korban').focus();
            return;
        }
        if (penggunaExtension == 'null') {
            const toast = document.getElementById('toast-warningLengkapiForm')
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast);
            toastBootstrap.show();
            $('#korban').focus();
            return;
        }
        if (penggunaExtension == 'Ya, Saya Pernah') {
            if (penggunaExtensionSpesifik == '') {
                const toast = document.getElementById('toast-warningLengkapiForm')
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast);
                toastBootstrap.show();
                $('#penggunaExtensionSpesifik').focus();
                return;
            }
        }
        if (deteksiEmail == 'null') {
            const toast = document.getElementById('toast-warningLengkapiForm')
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast);
            toastBootstrap.show();
            $('#deteksiEmail').focus();
            return;
        }
        if (mempertimbangkan == 'null') {
            const toast = document.getElementById('toast-warningLengkapiForm')
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast);
            toastBootstrap.show();
            $('#mempertimbangkan').focus();
            return;
        }

        if (fiturUtama == '') {
            const toast = document.getElementById('toast-warningLengkapiForm')
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast);
            toastBootstrap.show();
            $('#cb1').focus();
            return;
        }
        if (seberapaNyaman == '') {
            const toast = document.getElementById('toast-warningLengkapiForm')
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast);
            toastBootstrap.show();
            $('#seberapaNyaman').focus();
            return;
        }

        var platformEmailTrue;
        if (platformEmail == '') {
            if (LainnyaEmail == '') {
                const toast = document.getElementById('toast-warningLengkapiForm')
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast);
                toastBootstrap.show();
                $('#cb11').focus();
                return;
            } else {
                platformEmailTrue = LainnyaEmail;
            }
        } else {
            if (platformEmail != '' && LainnyaEmail != '') platformEmailTrue = platformEmail + ', ' + LainnyaEmail;
            if (platformEmail != '' && LainnyaEmail == '') platformEmailTrue = platformEmail;
        }

        $.ajax({
            url: window.location.origin + '/submit',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                nama: nama,
                email: email,
                jenis_kelamin: jenisKelamin,
                rentang_usia: usia,
                pekerjaan: pekerjaanTrue,
                bidang_industri: bidangIndustriTrue,
                menggunakan_email: menggunakanEmail,
                mengalami: mengalami,
                kesadaran: kesadaran,
                korban: korban,
                pengguna_extension: penggunaExtension,
                pengguna_extension_spesifik: penggunaExtensionSpesifik,
                deteksi_email: deteksiEmail,
                mempertimbangkan: mempertimbangkan,
                fitur_utama: fiturUtama,
                seberapa_nyaman: seberapaNyaman,
                platform_email: platformEmailTrue
            },
            beforeSend: function () {
                $('#btnSubmit').prop('disabled', true);
                $('#submitSpinner').show();
            },
            success: function (response) {
                const status = response.status;
                console.log(status);
                if (status == 'ok') {

                    $('#kustomisasiNama').html('');
                    $('#kustomisasiNama').html(response.nama);

                    $('#emailKustomisasi').val('');
                    $('#emailKustomisasi').val(response.email);

                    $('#respondenIdHidden').val('');
                    $('#respondenIdHidden').val(response.responden_id);

                    $('#submittedModal').removeClass('animate__fadeOut animate__faster').addClass('animate__fadeIn');
                    $('#submittedModal').modal('show');

                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Please contact the developer! \n" +
                            "Error code: " + response.code,
                        footer: '<a href="https://www.instagram.com/resaka.xmp" target="_blank">Go to dev social media</a>'
                    });
                }

            },
            complete: function () {
                $('#btnSubmit').prop('disabled', false);
                $('#submitSpinner').hide();
            }
        });
    });

    var emote = 1;
    $(document).on('click', '#emoteChoosed', function () {
        var emoteID = $(this).data('emote');
        if (emoteID == 1) {
            emote = 1;
            $('#kustomisasiEmote').html('');
            $('#kustomisasiEmote').html('😁');
        }
        if (emoteID == 2) {
            emote = 2;
            $('#kustomisasiEmote').html('');
            $('#kustomisasiEmote').html('🔥');
        }
        if (emoteID == 3) {
            emote = 3;
            $('#kustomisasiEmote').html('');
            $('#kustomisasiEmote').html('😎');
        }
        if (emoteID == 4) {
            emote = 4;
            $('#kustomisasiEmote').html('');
            $('#kustomisasiEmote').html('❤️');
        }
        if (emoteID == 5) {
            emote = 5;
            $('#kustomisasiEmote').html('');
            $('#kustomisasiEmote').html('🍌');
        }
        if (emoteID == 6) {
            emote = 6;
            $('#kustomisasiEmote').html('');
            $('#kustomisasiEmote').html('🗿');
        }
        if (emoteID == 7) {
            emote = 7;
            $('#kustomisasiEmote').html('');
            $('#kustomisasiEmote').html('🤌');
        }
        if (emoteID == 8) {
            emote = 8;
            $('#kustomisasiEmote').html('');
            $('#kustomisasiEmote').html('😱');
        }
    });

    $('#btnKustomisasi').on('click', function () {
        const responden_id = $('#respondenIdHidden').val();
        const emailK = $('#emailKustomisasi').val();
        const namaK = $('#kustomisasiNama').html();

        $.ajax({
            url: window.location.origin + '/sendEmail',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                responden_id: responden_id,
                email: emailK,
                nama: namaK
            },
            beforeSend: function () {
                $('#btnKustomisasi').prop('disabled', true);
                $('#submitKustomisasiSpinner').show();
            },
            success: function (response) {
                console.log(response.status);
            },
            complete: function () {
                $('#btnKustomisasi').prop('disabled', false);
                $('#submitKustomisasiSpinner').hide();
                $('#submittedModal').removeClass('animate__fadeIn').addClass('animate__fadeOut animate__faster');
                setTimeout(function () {
                    $('#submittedModal').modal('hide');
                }, 300);
            }
        });

    });

    $('#submittedModal').modal('show');

});
