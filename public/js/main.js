// function getCache(parameter, callback) {
//     $.ajax({
//         url: window.location.origin + '/cache',
//         type: 'GET',
//         data: {
//             parameter: parameter
//         },
//         success: function (response) {
//             callback(response);
//         }
//     });
// }

// getCache('isSubmitted', function (result) {
// });

function getEmote(emoteID) {
    var trueEmote;
    if (emoteID == 1) {
        trueEmote = '😁';
    }
    if (emoteID == 2) {
        trueEmote = '🔥';
    }
    if (emoteID == 3) {
        trueEmote = '😎';
    }
    if (emoteID == 4) {
        trueEmote = '❤️';
    }
    if (emoteID == 5) {
        trueEmote = '🍌';
    }
    if (emoteID == 6) {
        trueEmote = '🗿';
    }
    if (emoteID == 7) {
        trueEmote = '🤌';
    }
    if (emoteID == 8) {
        trueEmote = '😱';
    }
    return trueEmote;
}

function showSurvey() {
    // getCache('isSubmitted', function (isSubmitted) {

    console.log('c: ' + localStorage.getItem('surveys_isSubmitted'));
    if (localStorage.getItem('surveys_isSubmitted') == 1) {
        // getCache('responden_id', function (responden_id) {
        $.ajax({
            url: window.location.origin + '/getResponden',
            type: 'GET',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: localStorage.getItem('surveys_responden_id')
            },
            beforeSend: function () {
                $('#showSurvey').hide();
                $('#surveyDone').removeClass('animate__animated animate__fadeOut animate__faster').addClass('animate__animated animate__fadeIn');
                $('#surveyDone').show();
            },
            success: function (response) {
                $('#kustomisasiNama1').empty();
                $('#kustomisasiEmote1').empty();

                $('#kustomisasiNama1').html(response.data.nama);
                $('#kustomisasiEmote1').html(getEmote(response.data.emote));

                $('#emailSuccessCard').hide();
                $('#emailFailedCard').hide();

                // getCache('failedEmail', function (failedEmail) {
                if (localStorage.getItem('surveys_failedEmail') != '' && localStorage.getItem('surveys_failedEmail') != null) {
                    $('#emailNotReadOnly').val('');
                    $('#emailNotReadOnly').val(localStorage.getItem('surveys_failedEmail'));
                    $('#emailFailedCard').show();
                }

                if (localStorage.getItem('surveys_kustomisasi_email') != '' && localStorage.getItem('surveys_kustomisasi_email') != null) {
                    $('#emailReadOnly').val('');
                    $('#emailReadOnly').val(localStorage.getItem('surveys_kustomisasi_email'));
                    $('#emailSuccessCard').show();
                }
                // });

            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error:', textStatus, errorThrown);
            }
        });
        // });
    } else {
        $('#surveyDone').hide();
        $('#showSurvey').removeClass('animate__animated animate__fadeOut animate__faster').addClass('animate__animated animate__fadeIn');
        $('#showSurvey').show();
    }

    // });

}
showSurvey();

function respondenLoop() {

    $.ajax({
        url: window.location.origin + '/getRespondens',
        type: 'GET',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            const status = response.status;
            const datas = response.data;
            const count = response.count;
            console.log('responden: ' + status);
            $('#respondenLoop').empty();
            if (count == 0) {
                var emoteTrue = getEmote(2);
                $('#respondenLoop').append('<tr>\
                <td> <i class="fa-solid fa-user"></i> </td>\
                <td class="text-center"> Belum ada responden, jadilah yang pertama! </td>\
                <td> '+ emoteTrue + ' </td>\
                 </tr>');
            } else {
                $.each(datas, function (index, item) {
                    var emoteTrue = getEmote(item.emote);
                    $('#respondenLoop').append('<tr>\
                    <td> <i class="fa-solid fa-user"></i> </td>\
                    <td> '+ item.nama + ' </td>\
                    <td> '+ emoteTrue + ' </td>\
                </tr>');
                });
            }
        }
    });

}
respondenLoop();

$('#formResentEmail').on('submit', function (e) {
    // getCache('responden_id', function (responden_id) {
    //     $('#respondenIdHidden').val('');
    //     $('#respondenIdHidden').val(responden_id);
    // });
    // getCache('failedEmail', function (failedEmail) {
    //     $('#failedEmailHidden').val('');
    //     $('#failedEmailHidden').val(failedEmail);
    // });
    e.preventDefault();
    $.ajax({
        url: window.location.origin + '/sendEmail',
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            responden_id: localStorage.getItem('surveys_responden_id'),
            email: $('#emailNotReadOnly').val(),
            nama: $('#kustomisasiNama1').html(),
            emote: localStorage.getItem('surveys_responden_emote')

        },
        beforeSend: function () {
            $('#resentEmailBtn').prop('disabled', true);
            $('#resentEmailSpinner').show();
        },
        success: function (response) {
            const status = response.status;
            const email = response.email;
            console.log(status + '-' + email);

            // if (status == 'ok') {

            if (email == 'email success') {
                localStorage.removeItem('surveys_failedEmail');
                localStorage.setItem('surveys_kustomisasi_email', $('#emailNotReadOnly').val());
            } else if (email == 'email not success') {
                localStorage.removeItem('surveys_kustomisasi_email');
                localStorage.setItem('surveys_failedEmail', $('#emailNotReadOnly').val());
                console.log('Item Set: failedEmail');
            } else {
                localStorage.removeItem('surveys_failedEmail');
                localStorage.removeItem('surveys_kustomisasi_email');
            }

            const toast = document.getElementById('toast-successSelesai');
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast);
            toastBootstrap.show();
            // } else {
            //     Swal.fire({
            //         icon: "error",
            //         title: "Error",
            //         text: "Please contact the developer! \n" +
            //             "Ajax handling Error, this can't be done ",
            //         footer: '<a href="https://www.instagram.com/resaka.xmp" target="_blank">Go to dev social media</a>'
            //     });
            // }

        },
        complete: function () {
            $('#resentEmailBtn').prop('disabled', false);
            $('#resentEmailSpinner').hide();
            showSurvey();
            respondenLoop();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please contact the developer! \n" +
                    "Error code: " + textStatus, errorThrown,
                footer: '<a href="https://www.instagram.com/resaka.xmp" target="_blank">Go to dev social media</a>'
            });
        }
    });
});

$('#fillSurveyAgainBtn').on('click', function () {
    // $.get({
    //     url: window.location.origin + '/fillAgain',
    //     success: function (response) {
    //         if (response.status == 'ok') {

    //         } else {
    //             Swal.fire({
    //                 icon: "error",
    //                 title: "Error",
    //                 text: "Please contact the developer! \n" +
    //                     "Error code: " + response.status,
    //                 footer: '<a href="https://www.instagram.com/resaka.xmp" target="_blank">Go to dev social media</a>'
    //             });
    //         }
    //     }
    // })
    localStorage.removeItem('surveys_isSubmitted');
    localStorage.removeItem('surveys_responden_id');
    localStorage.removeItem('surveys_failedEmail');
    localStorage.removeItem('surveys_kustomisasi_email');
    localStorage.removeItem('surveys_responden_emote');
    console.log('cleared');
    $('#resetSurveyBtn').click();
    showSurvey();
});

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

$(document).on('click', '#tcb1', function () {
    var y = $("#cb1").prop('checked');
    (y ? $('#cb1').attr('checked', false) : $('#cb1').attr('checked', true))
});
$(document).on('click', '#tcb2', function () {
    var y = $("#cb2").prop('checked');
    (y ? $('#cb2').attr('checked', false) : $('#cb2').attr('checked', true))
});
$(document).on('click', '#tcb3', function () {
    var y = $("#cb3").prop('checked');
    (y ? $('#cb3').attr('checked', false) : $('#cb3').attr('checked', true))
});
$(document).on('click', '#tcb4', function () {
    var y = $("#cb4").prop('checked');
    (y ? $('#cb4').attr('checked', false) : $('#cb4').attr('checked', true))
});
$(document).on('click', '#tcb5', function () {
    var y = $("#cb5").prop('checked');
    (y ? $('#cb5').attr('checked', false) : $('#cb5').attr('checked', true))
});
$(document).on('click', '#tcb6', function () {
    var y = $("#cb6").prop('checked');
    (y ? $('#cb6').attr('checked', false) : $('#cb6').attr('checked', true))
});

$(document).on('click', '#tcb11', function () {
    var y = $("#cb11").prop('checked');
    (y ? $('#cb11').attr('checked', false) : $('#cb11').attr('checked', true))
});
$(document).on('click', '#tcb12', function () {
    var y = $("#cb12").prop('checked');
    (y ? $('#cb12').attr('checked', false) : $('#cb12').attr('checked', true))
});
$(document).on('click', '#tcb13', function () {
    var y = $("#cb13").prop('checked');
    (y ? $('#cb13').attr('checked', false) : $('#cb13').attr('checked', true))
});
$(document).on('click', '#tcb14', function () {
    var y = $("#cb14").prop('checked');
    (y ? $('#cb14').attr('checked', false) : $('#cb14').attr('checked', true))
});

$(document).ready(function () {

    function resetSurvey() {
        $('#cbForm1').empty();
        $('#cbForm1').html('<input type="checkbox" id="cb1" class="fiturCheckbox mt-4" name="fitur"\
        value="Scan Email Otomatis">\
    <span style="cursor: pointer;" id="tcb1">Aplikasi dapat secara otomatis mengenali\
        dan\
        menyaring email\
        yang\
        mencurigakan tanpa perlu campur tangan Anda.</span> <br>\
\
    <input type="checkbox" id="cb2" class="fiturCheckbox mt-3" name="fitur"\
        value="Peringatan Langsung">\
    <span style="cursor: pointer;" id="tcb2">Anda akan langsung diberi tahu ketika\
        ada email\
        yang dianggap mencurigakan.</span> <br>\
\
    <input type="checkbox" id="cb3" class="fiturCheckbox mt-3" name="fitur"\
        value="Integrasi Mudah">\
    <span style="cursor: pointer;" id="tcb3">Aplikasi dapat terhubung dengan mudah ke\
        platform email yang Anda gunakan.</span> <br>\
\
    <input type="checkbox" id="cb4" class="fiturCheckbox mt-3" name="fitur"\
        value="Analisis Tautan dan Lampiran">\
    <span style="cursor: pointer;" id="tcb4">Aplikasi menganalisis link dan file\
        terlampir untuk memastikan keamanan.</span> <br>\
\
    <input type="checkbox" id="cb5" class="fiturCheckbox mt-3" name="fitur"\
        value="Pembaruan Berkala">\
    <span style="cursor: pointer;" id="tcb5">Aplikasi secara rutin diperbarui dengan\
        fitur-fitur keamanan terbaru.</span> <br>\
\
    <input type="checkbox" id="cb6" class="fiturCheckbox mt-3" name="fitur"\
        value="Panduan Keamanan">\
    <span style="cursor: pointer;" id="tcb6">Aplikasi menyediakan tips keamanan email\
        yang praktis.</span> <br>')
        $('#cbForm2').empty();
        $('#cbForm2').html('<input type="checkbox" id="cb11" class="fiturCheckbox1 mt-4" value="RoundCube">\
        <span style="cursor: pointer;" id="tcb11">RoundCube (Web Mail)</span> <br>\
\
        <input type="checkbox" id="cb12" class="fiturCheckbox1 mt-3" value="Gmail">\
        <span style="cursor: pointer;" id="tcb12">Gmail (Google Mail)</span> <br>\
\
        <input type="checkbox" id="cb13" class="fiturCheckbox1 mt-3"\
            value="Yahoo Mail">\
        <span style="cursor: pointer;" id="tcb13">Yahoo Mail</span> <br>\
        <input type="checkbox" id="cb14" class="fiturCheckbox1 mt-3"\
            value="Apple Mail">\
        <span style="cursor: pointer;" id="tcb14">Apple Mail</span> <br>\
\
        <label for="LainnyaEmail" class="mt-3">Lainnya (Spesifikan)</label>\
        <input type="text" class="form-control" id="LainnyaEmail" name="LainnyaEmail">')
    }

    $('#resetSurveyBtn').on('click', function () {
        $("#surveyForm")[0].reset();
        resetSurvey();
    });


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

        //NEW
        const latbel1 = $('#latbel1').val();
        const latbel2 = $('#latbel2').val();
        const latbel3 = $('#latbel3').val();

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

        // NEW
        if (latbel1 == 'null') {
            const toast = document.getElementById('toast-warningLengkapiForm')
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast);
            toastBootstrap.show();
            $('#latbel1').focus();
            return;
        }

        if (latbel2 == 'null') {
            const toast = document.getElementById('toast-warningLengkapiForm')
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast);
            toastBootstrap.show();
            $('#latbel2').focus();
            return;
        }

        if (latbel3 == 'null') {
            const toast = document.getElementById('toast-warningLengkapiForm')
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast);
            toastBootstrap.show();
            $('#latbel3').focus();
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
                platform_email: platformEmailTrue,
                latbel1: latbel1,
                latbel2: latbel2,
                latbel3: latbel3
            },
            beforeSend: function () {
                $('#btnSubmit').prop('disabled', true);
                $('#submitSpinner').show();
            },
            success: function (response) {
                const status = response.status;
                console.log(status);
                if (status == 'ok') {

                    localStorage.setItem('surveys_isSubmitted', '1');
                    localStorage.setItem('surveys_responden_id', response.responden_id);

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
                nama: namaK,
                emote: emote
            },
            beforeSend: function () {
                $('#btnKustomisasi').prop('disabled', true);
                $('#submitKustomisasiSpinner').show();
            },
            success: function (response) {
                const status = response.status;
                const email = response.email;
                console.log(status + '-' + email);

                // if (status == 'ok') {

                if (email == 'email success') {
                    localStorage.removeItem('surveys_failedEmail');
                    localStorage.setItem('surveys_kustomisasi_email', emailK);
                } else if (email == 'email not success') {
                    localStorage.removeItem('surveys_kustomisasi_email');
                    localStorage.setItem('surveys_failedEmail', emailK);
                    localStorage.setItem('surveys_responden_emote', emote);
                    console.log('Item Set: failedEmail');
                } else {
                    localStorage.removeItem('surveys_failedEmail');
                    localStorage.removeItem('surveys_kustomisasi_email');
                    localStorage.removeItem('surveys_responden_emote');
                }

                const toast = document.getElementById('toast-successSelesai');
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast);
                toastBootstrap.show();

                // $('#kustomisasiNama1').empty();
                // $('#kustomisasiEmote1').empty();

                // $('#kustomisasiNama1').html(namaK);
                // $('#kustomisasiEmote1').html(getEmote(emote));

                // if (emailFailed != '') {
                //     $('#emailFailedCard').show();
                // } else {
                //     $('#emailFailedCard').hide();
                // }

                // $('#showSurvey').hide();
                // $('#surveyDone').removeClass('animate__animated animate__fadeOut animate__faster').addClass('animate__animated animate__fadeIn');
                // setTimeout(function () {
                //     $('#surveyDone').show();
                // }, 300);

                showSurvey();
                respondenLoop();

                // window.location.href = '/';

                // } else {
                //     Swal.fire({
                //         icon: "error",
                //         title: "Error",
                //         text: "Please contact the developer! \n" +
                //             "Ajax handling Error, this can't be done ",
                //         footer: '<a href="https://www.instagram.com/resaka.xmp" target="_blank">Go to dev social media</a>'
                //     });
                // }

            },
            complete: function () {
                $('#btnKustomisasi').prop('disabled', false);
                $('#submitKustomisasiSpinner').hide();
                $('#submittedModal').removeClass('animate__fadeIn').addClass('animate__fadeOut animate__faster');
                setTimeout(function () {
                    $('#submittedModal').modal('hide');
                }, 300);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Please contact the developer! \n" +
                        "Error code: " + textStatus, errorThrown,
                    footer: '<a href="https://www.instagram.com/resaka.xmp" target="_blank">Go to dev social media</a>'
                });
            }
        });

        // $.ajax({
        //     url: window.location.origin + '/getResponden',
        //     type: 'GET',
        //     data: {
        //         _token: $('meta[name="csrf-token"]').attr('content'),
        //         id: responden_id
        //     },
        //     beforeSend: function () {
        //         $('#showSurvey').hide();
        //         $('#surveyDone').removeClass('animate__animated animate__fadeOut animate__faster').addClass('animate__animated animate__fadeIn');
        //         $('#surveyDone').show();
        //     },
        //     complete: function (response) {
        //         console.log(response);
        //         $('#kustomisasiNama1').empty();
        //         $('#kustomisasiEmote1').empty();

        //         $('#kustomisasiNama1').html(response.data.nama);
        //         $('#kustomisasiEmote1').html(getEmote(response.data.emote));

        //         if (emailFailed != '') {
        //             $('#emailFailedCard').show();
        //         } else {
        //             $('#emailFailedCard').hide();
        //         }

        //     }
        // });

    });

    // $('#submittedModal').modal('show');

});
