$(document).ready(function() {
    const baseUrl = "http://localhost";
    const registerLeadApi = "/api/leads/register-profile";
    const uploadAvatar = "/api/leads/upload-avatar/";
    const infomationProfile = "/api/leads/information-profile/";
    const contactsApi = "/api/leads/contacts/";
    const familyApi = "/api/leads/family/";
    const scoreApi = "/api/leads/score/";

    var idLead = "";
    var imgUrl = "";

    // --- Show and hide Admission method --- \\
    $('#school-scoreboard-content').hide();
    
    $('input[name="admission-method"]').change(function() {
        if ($('#radio-2').is(':checked')) {
            $('#school-records-content').show();
            $('#school-scoreboard-content').hide();
        } else if ($('#radio-3').is(':checked')) {
            $('#school-scoreboard-content').show();
            $('#school-records-content').hide();
        }
    });

    $('#placeOfBirth').select2(); // --- Change select to search select --- \\

    // --- remove error effect when click input --- \\
    $('#email-wrapper').on('click', function() {
        $(this).find('.error-input').removeClass('show-error').html('');
        $(this).find('#email').removeClass('border-error');
    });

    $('#fullname-wrapper').on('click', function() {
        $(this).find('.error-input').removeClass('show-error').html('');
        $(this).find('#fullname').removeClass('border-error');
    });

    $('#dateOfBirth-wrapper').on('click', function() {
        $(this).find('.error-input').removeClass('show-error').html('');
        $(this).find('#dateOfBirth').removeClass('border-error');
    });

    $('#gender-wrapper').on('click', function() {
        $(this).find('.error-input').removeClass('show-error').html('');
        $(this).find('#gender').removeClass('border-error');
    });

    $('#phone-wrapper').on('click', function() {
        $(this).find('.error-input').removeClass('show-error').html('');
        $(this).find('#phone').removeClass('border-error');
    });

    $('#identificationCard-wrapper').on('click', function() {
        $(this).find('.error-input').removeClass('show-error').html('');
        $(this).find('#identificationCard').removeClass('border-error');
    });

    $('#placeOfBirth-wrapper').on('click', function() {
        $(this).find('.error-input').removeClass('show-error').html('');
        $(this).find('.select2-selection').removeClass('border-error');
    });

    $('#placeOfWorkLearn-wrapper').on('click', function() {
        $(this).find('.error-input').removeClass('show-error').html('');
        $(this).find('#placeOfWorkLearn').removeClass('border-error');
    });

    $('#source-wrapper').on('click', function() {
        $(this).find('.error-input').removeClass('show-error').html('');
        $(this).find('#source').removeClass('border-error');
    });

    $('#marjor-wrapper').on('click', function() {
        $(this).find('.error-input').removeClass('show-error').html('');
        $(this).find('#marjor').removeClass('border-error');
    });

    $('.avatar-wrapper #avatar-upload').on('click', function(){
        $('.avatar-wrapper .error-input').removeClass('show-error').html('');
        $('.avatar-wrapper #avatar-preview').removeClass('border-error');
    });

    $('#date_of_birth_f2_wrapper').on('click', function() {
        $(this).find('.error-input').removeClass('show-error').html('');
        $(this).find('#date_of_birth_f2').removeClass('border-error');
    });

    $('#place_of_birth_f2_wrapper').on('click', function() {
        $(this).find('.error-input').removeClass('show-error').html('');
        $(this).find('#place_of_birth_f2').removeClass('border-error');
    });

    $('#nations_name_wrapper').on('click', function() {
        $(this).find('.error-input').removeClass('show-error').html('');
        $(this).find('#nations_name').removeClass('border-error');
    });

    $('#ethnics_name_wrapper').on('click', function() {
        $(this).find('.error-input').removeClass('show-error').html('');
        $(this).find('#ethnics_name').removeClass('border-error');
    });

    $('#identification_card_f2_wrapper').on('click', function() {
        $(this).find('.error-input').removeClass('show-error').html('');
        $(this).find('#identification_card_f2').removeClass('border-error');
    });

    $('#date_identification_card_wrapper').on('click', function() {
        $(this).find('.error-input').removeClass('show-error').html('');
        $(this).find('#date_identification_card').removeClass('border-error');
    });

    $('#place_identification_card_wrapper').on('click', function() {
        $(this).find('.error-input').removeClass('show-error').html('');
        $(this).find('#place_identification_card').removeClass('border-error');
    });

    // form 5 \\
    $('#provinces_name_f5_1_wrapper').on('click', function() {
        $(this).find('.error-input').removeClass('show-error').html('');
        $(this).find('#provinces_name_f5_1').removeClass('border-error');
    });

    $('#school_name_1_wrapper').on('click', function() {
        $(this).find('.error-input').removeClass('show-error').html('');
        $(this).find('#school_name_1').removeClass('border-error');
    });

    $('#marjor_f5_1_wrapper').on('click', function() {
        $(this).find('.error-input').removeClass('show-error').html('');
        $(this).find('#marjor_f5_1').removeClass('border-error');
    });

    $('#block_adminssions_wrapper').on('click', function() {
        $(this).find('.error-input').removeClass('show-error').html('');
        $(this).find('#block_adminssions').removeClass('border-error');
    });

    $('#provinces_name_f5_2_wrapper').on('click', function() {
        $(this).find('.error-input').removeClass('show-error').html('');
        $(this).find('#provinces_name_f5_2').removeClass('border-error');
    });

    $('#school_name_2_wrapper').on('click', function() {
        $(this).find('.error-input').removeClass('show-error').html('');
        $(this).find('#school_name_2').removeClass('border-error');
    });

    $('#marjor_f5_2_wrapper').on('click', function() {
        $(this).find('.error-input').removeClass('show-error').html('');
        $(this).find('#marjor_f5_2').removeClass('border-error');
    });

    $('#average_score_wrapper').on('click', function() {
        $(this).find('.error-input').removeClass('show-error').html('');
        $(this).find('#average_score').removeClass('border-error');
    });

    $('#score-1').on('click', function() {
        $('#score-error-1').removeClass('show-error');
    });
    $('#score-2').on('click', function() {
        $('#score-error-2').removeClass('show-error');
    });
    $('#score-3').on('click', function() {
        $('#score-error-3').removeClass('show-error');
    });

    function parseFormData(data) {
        let dataObj = {};
        data.split('&').forEach(function(part) {
            let item = part.split('=');
            dataObj[decodeURIComponent(item[0])] = decodeURIComponent(item[1]);
        });
    
        delete dataObj['_token'];
    
        if (dataObj['gender']) {
            dataObj['gender'] = parseInt(dataObj['gender'], 10);
        }
        if (dataObj['sources_id']) {
            dataObj['sources_id'] = parseInt(dataObj['sources_id'], 10);
        }
        if (dataObj['marjors_id']) {
            dataObj['marjors_id'] = parseInt(dataObj['marjors_id'], 10);
        }
        if (dataObj['date_of_birth']) {
            dataObj['date_of_birth'] = formatdate(dataObj['date_of_birth']);
        }
    
        let jsonData = JSON.stringify(dataObj);
        return jsonData;
    }

    // var form2 = $("#myForm2").html();
    // $("#myForm2").html("");

    // --- handle submit form 1 --- \\
    $(document).on('submit', '#myForm1', function(e) {
        e.preventDefault();
        $('.screen-loading').show();

        let dataForm = $(this).serialize();
        const jsonData = parseFormData(dataForm);

        $.ajax({
            url: baseUrl + registerLeadApi,
            method: 'POST',
            data: jsonData,
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                let data = response.data;

                if(data){
                    if(response.code == 422){
                        if(data.email != null){
                            $('#email').addClass('border-error');
                            $('#email-wrapper .error-input').html(data.email.join(', '));
                            $('#email-wrapper .error-input').addClass('show-error');
                        }
                        if(data.full_name != null){
                            $('#fullname').addClass('border-error');
                            $('#fullname-wrapper .error-input').html(data.full_name.join(', '));
                            $('#fullname-wrapper .error-input').addClass('show-error');
                        }
                        if(data.date_of_birth != null){
                            $('#dateOfBirth').addClass('border-error');
                            $('#dateOfBirth-wrapper .error-input').html(data.date_of_birth.join(', '));
                            $('#dateOfBirth-wrapper .error-input').addClass('show-error');
                        }
                        if(data.gender != null){
                            $('#gender').addClass('border-error');
                            $('#gender-wrapper .error-input').html(data.gender.join(', '));
                            $('#gender-wrapper .error-input').addClass('show-error');
                        }
                        if(data.phone != null){
                            $('#phone').addClass('border-error');
                            $('#phone-wrapper .error-input').html(data.phone.join(', '));
                            $('#phone-wrapper .error-input').addClass('show-error');
                        }
                        if(data.identification_card != null){
                            $('#identificationCard').addClass('border-error');
                            $('#identificationCard-wrapper .error-input').html(data.identification_card.join(', '));
                            $('#identificationCard-wrapper .error-input').addClass('show-error');
                        }
                        if(data.place_of_birth != null){
                            $('#placeOfBirth-wrapper .select2-selection').addClass('border-error');
                            $('#placeOfBirth-wrapper .error-input').html(data.place_of_birth.join(', '));
                            $('#placeOfBirth-wrapper .error-input').addClass('show-error');
                        }
                        if(data.place_of_wrk_lrn != null){
                            $('#placeOfWorkLearn').addClass('border-error');
                            $('#placeOfWorkLearn-wrapper .error-input').html(data.place_of_wrk_lrn.join(', '));
                            $('#placeOfWorkLearn-wrapper .error-input').addClass('show-error');
                        }
                        if(data.sources_id != null){
                            $('#source').addClass('border-error');
                            $('#source-wrapper .error-input').html(data.sources_id.join(', '));
                            $('#source-wrapper .error-input').addClass('show-error');
                        }
                        if(data.marjors_id != null){
                            $('#marjor').addClass('border-error');
                            $('#marjor-wrapper .error-input').html(data.marjors_id.join(', '));
                            $('#marjor-wrapper .error-input').addClass('show-error');
                        }
    
                        $('.screen-loading').hide();
                    }
    
                    if(response.code == 200){
                        idLead = response.data.id
                        $('.screen-loading').hide();
                        $('#myForm1').hide();
                        $('#myForm2').show();
                        $('#banner-welcome').hide();
                        $('#banner-lead').show();
                        $('#tab-step-1').removeClass('active-tab');
                        $('#tab-step-2').addClass('active-tab');
                    }
                }
            },
            error: function (xhr, status, error) {
                $('.screen-loading').hide();
                alert('Có lỗi xảy ra: ' + xhr.responseText);
            }
        });
    });

    // --- handle submit form 2 --- \\
    $(document).on('change', '#avatar-upload', function(e){
        var file = e.target.files[0];
        let api = baseUrl + uploadAvatar + idLead;

        $(".avatar-wrapper").find(".error-input").html("Đang tải ảnh lên, vui lòng chờ chút").show();

        if (file) {
            var formData = new FormData();
            formData.append('image', file);
            
            $.ajax({ 
                url: api,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.code === 200) { 
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#avatar-preview').attr('src', e.target.result);
                        };
                        reader.readAsDataURL(file); 
    
                        imgUrl = response.data.image_url;

                        $(".avatar-wrapper").find(".error-input").html("Tải lên thành công");
                        setTimeout(function() {
                            $(".avatar-wrapper").find(".error-input").hide();
                        }, 4000);
                    } else {
                        alert('Có lỗi xảy ra: ' + (response.data.image[0] || 'Không rõ lỗi'));
                    }
                },
                error: function(xhr, status, error) {
                    alert('Có lỗi xảy ra: ' + (xhr.responseText || error));
                }
            });
        } else {
            alert('Vui lòng chọn một tệp để tải lên.');
        }
    });

    $(document).on('submit', '#myForm2', function(e){
        e.preventDefault();
        $('.screen-loading').show();
        // const api = baseUrl + infomationProfile + idLead;
        const api = baseUrl + infomationProfile + "15";

        let date_of_birth = formatdate($("#date_of_birth_f2").val());
        let place_of_birth = $("#place_of_birth_f2").val();
        let nations_name = $("#nations_name").val();
        let ethnics_name = $("#ethnics_name").val();
        let identification_card = $("#identification_card_f2").val();
        let date_identification_card = formatdate($("#date_identification_card").val());
        let place_identification_card = $("#place_identification_card").val();
        let date_of_join_youth_union = $("#date_of_join_youth_union").val() ? formatdate($("#date_of_join_youth_union").val()) : "";
        let date_of_join_communist_party = $("#date_of_join_communist_party").val() ? formatdate($("#date_of_join_communist_party").val()) : "";
        let email = $("#email_f2").val();
        let company_name = $("#company_name").val();
        let company_address = $("#company_address").val();

        let type_id_1 = $("#type_id_1").val();
        let year_of_degree_1 = $("#year_of_degree_1").val();
        let date_of_degree_1 = $("#date_of_degree_1").val() ? formatdate($("#date_of_degree_1").val()) : "";
        let serial_number_degree_1 = $("#serial_number_degree_1").val();
        let place_of_degree_1 = $("#place_of_degree_1").val();

        let type_id_2 = $('input[name="type_id_2"]:checked').val();
        let year_of_degree_2 = $("#year_of_degree_2").val();
        let date_of_degree_2 = $("#date_of_degree_2").val() ? formatdate($("#date_of_degree_2").val()) : "";
        let serial_number_degree_2 = $("#serial_number_degree_2").val();
        let place_of_degree_2 = $("#place_of_degree_2").val();

        data = {
            avatar: imgUrl,
            date_of_birth: date_of_birth,
            place_of_birth: place_of_birth,
            nations_name: nations_name,
            ethnics_name: ethnics_name,
            identification_card: identification_card,
            date_identification_card: date_identification_card,
            place_identification_card: place_identification_card,
            date_of_join_youth_union: date_of_join_youth_union,
            date_of_join_communist_party: date_of_join_communist_party,
            email: email,
            company_name: company_name,
            company_address: company_address,
            degree_informations: [
                {
                    title: "Trình độ văn hóa",
                    students_id: "",
                    type_id: type_id_1,
                    year_of_degree: year_of_degree_1,
                    date_of_degree: date_of_degree_1,
                    serial_number_degree: serial_number_degree_1,
                    place_of_degree: place_of_degree_1,
                },
                {
                    title: "Trình độ chuyên môn",
                    students_id: "",
                    type_id: type_id_2,
                    year_of_degree: year_of_degree_2,
                    date_of_degree: date_of_degree_2,
                    serial_number_degree: serial_number_degree_2,
                    place_of_degree: place_of_degree_2,
                }
            ]
        }
        let convertData = JSON.stringify(data);

        $.ajax({
            url: api,
            type: 'POST',
            data: convertData,
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                let data = response.data;

                if(response.code == 422){
                    handleError('.avatar-wrapper #avatar-preview', '.avatar-wrapper', data.avatar);
                    handleError('#date_of_birth_f2', '#date_of_birth_f2_wrapper', data.date_of_birth);
                    handleError('#place_of_birth_f2', '#place_of_birth_f2_wrapper', data.place_of_birth);
                    handleError('#nations_name', '#nations_name_wrapper', data.nations_name);
                    handleError('#ethnics_name', '#ethnics_name_wrapper', data.ethnics_name);
                    handleError('#identification_card_f2', '#identification_card_f2_wrapper', data.identification_card);
                    handleError('#date_identification_card', '#date_identification_card_wrapper', data.date_identification_card);
                    handleError('#place_identification_card', '#place_identification_card_wrapper', data.place_identification_card);
                    
                    $('.screen-loading').hide();
                }

                if(response.code == 200){
                    $('.screen-loading').hide();
                    $('#myForm2').hide();
                    $('#myForm3').show();
                    $('#tab-step-2').removeClass('active-tab');
                    $('#tab-step-3').addClass('active-tab');
                }
            },
            error: function(xhr, status, error) {
                $('.screen-loading').hide();
                alert('Có lỗi xảy ra: ' + (xhr.responseText || error));
            }
        })
        
    })
    
    $('#prevStep2').on('click', function() {
        $('#myForm2').hide();
        $('#myForm1').show();
        $('#tab-step-2').removeClass('active-tab');
        $('#tab-step-1').addClass('active-tab');
        $('#banner-welcome').show();
        $('#banner-lead').hide();
    });

    // --- handle submit form 3 --- \\
    $(document).on('submit', '#myForm3', function(e){
        e.preventDefault();
        $('.screen-loading').show();

        // const api = baseUrl + contactsApi + idLead;
        const api = baseUrl + contactsApi + "15";

        let provinces_name_1 = $("#provinces_name_1").val();
        let districts_name_1 = $("#districts_name_1").val();
        let wards_name_1 = $("#wards_name_1").val();
        let address_1 = $("#address_1").val();

        let provinces_name_2 = $("#provinces_name_2").val();
        let districts_name_2 = $("#districts_name_2").val();
        let wards_name_2 = $("#wards_name_2").val();
        let address_2 = $("#address_2").val();

        data = {
            title_hktt : "HKTT",            
            provinces_name_hktt : provinces_name_1,
            districts_name_hktt : districts_name_1,
            wards_name_hktt : wards_name_1,
            address_hktt : address_1,
            title_dcll: "DCLL",            
            provinces_name_dcll : provinces_name_2,
            districts_name_dcll : districts_name_2,
            wards_name_dcll : wards_name_2,
            address_dcll : address_2 
        }
        let convertData = JSON.stringify(data);

        $.ajax({
            url: api,
            type: 'POST',
            data: convertData,
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
                let data = response.data;

                if(response.code == 422){
                    $('.screen-loading').hide();

                    handleError('#provinces_name_1', '#provinces_name_1_wrapper', data.provinces_name_hktt);
                    handleError('#districts_name_1', '#districts_name_1_wrapper', data.districts_name_hktt);
                    handleError('#wards_name_1', '#wards_name_1_wrapper', data.wards_name_hktt);
                    handleError('#address_1', '#address_1_wrapper', data.address_hktt);

                    handleError('#provinces_name_2', '#provinces_name_2_wrapper', data.provinces_name_dcll);
                    handleError('#districts_name_2', '#districts_name_2_wrapper', data.districts_name_dcll);
                    handleError('#wards_name_2', '#wards_name_2_wrapper', data.wards_name_dcll);
                    handleError('#address_2', '#address_2_wrapper', data.address_dcll);
                } else {
                    $('.screen-loading').hide();
                    $('#myForm3').hide();
                    $('#myForm4').show();
                    $('#tab-step-3').removeClass('active-tab');
                    $('#tab-step-4').addClass('active-tab');
                }
            },
            error: function(xhr, status, error){}
        })
        
    })

    // --- handle submit form 4 --- \\
    $(document).on('submit', '#myForm4', function(e){
        e.preventDefault();
        $('.screen-loading').show();

        // const api = baseUrl + familyApi + idLead;
        const api = baseUrl + familyApi + "15";

        let full_name_father = $('#father_full_name').val();
        let phone_number_father = $('#father_phone').val();
        let year_of_birth_father = parseInt($('#father_yearOfBirth').val());
        let jobs_father = $('#father_job').val();
        let edutcation_id_father = parseInt($('#father_education').val());

        let full_name_mother = $('#mother_full_name').val();
        let phone_number_mother = $('#mother_phone').val();
        let year_of_birth_mother = parseInt($('#mother_yearOfBirth').val());
        let jobs_mother = $('#mother_job').val();
        let edutcation_id_mother = parseInt($('#mother_education').val());

        let full_name_wife = $('#name_wifeOrHusband').val();
        let phone_number_wife = $('#phone_wifeOrHusband').val();
        let year_of_birth_wife = parseInt($('#yearOfBirth_wifeOrHusband').val());
        let jobs_wife = $('#job_wifeOrHusband').val();
        let edutcation_id_wife = parseInt($('#wifeOrHusband_education').val());

        data = {
            title_father : "Cha",            
            full_name_father : full_name_father,
            phone_number_father : phone_number_father,
            year_of_birth_father: year_of_birth_father,
            jobs_father : jobs_father,
            edutcation_id_father : edutcation_id_father,
            title_mother : "Mẹ",            
            full_name_mother : full_name_mother,
            phone_number_mother : phone_number_mother,
            year_of_birth_mother: year_of_birth_mother,
            jobs_mother : jobs_mother,
            edutcation_id_mother : edutcation_id_mother,
            title_wife : "Vợ",            
            full_name_wife : full_name_wife,
            phone_number_wife : phone_number_wife,
            year_of_birth_wife: year_of_birth_wife,
            jobs_wife : jobs_wife,
            edutcation_id_wife : edutcation_id_wife
        }
        let convertData = JSON.stringify(data);

        $.ajax({
            url: api,
            type: 'POST',
            data: convertData,
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
                let data = response.data;

                if(response.code === 422){
                    $('.screen-loading').hide();

                    handleError('#father_full_name', '#father_full_name_wrapper', data.full_name_father);
                    handleError('#father_phone', '#father_phone_wrapper', data.phone_number_father);

                    handleError('#mother_full_name', '#mother_full_name_wrapper', data.full_name_mother);
                    handleError('#mother_phone', '#mother_phone_wrapper', data.phone_number_mother);

                    handleError('#name_wifeOrHusband', '#name_wifeOrHusband_wrapper', data.full_name_wife);
                    handleError('#phone_wifeOrHusband', '#phone_wifeOrHusband_wrapper', data.phone_number_wife);
                } else {
                    $('.screen-loading').hide();
                    $('#myForm4').hide();
                    $('#myForm5').show();
                    $('#tab-step-4').removeClass('active-tab');
                    $('#tab-step-5').addClass('active-tab');
                }
            },
            error: function(xhr, status, error){}
        })

    })

    // --- handle submit form 5 --- \\
    $(document).on('submit', '#myForm5', function(e){
        e.preventDefault();
        $('.screen-loading').show();

        // const api = baseUrl + contactsApi + idLead;
        const api = baseUrl + scoreApi + "15";

        let form_adminssions_id = parseInt($('input[name="admission-system"]:checked').val());
        let method_adminssions_id = parseInt($('input[name="admission-method"]:checked').val());

        let province_name_1 = $('#provinces_name_f5_1').val();
        let school_name_1 = $('#school_name_1').val();
        let marjors_id_1 = parseInt($('#marjor_f5_1').val());
        let block_adminssions_id = parseInt($('#block_adminssions').val());
        let score1 = parseFloat($('#score-1').val());
        let score2 = parseFloat($('#score-2').val());
        let score3 = parseFloat($('#score-3').val());

        let province_name_2 = $('#provinces_name_f5_2').val();
        let school_name_2 = $('#school_name_2').val();
        let marjors_id_2 = parseInt($('#marjor_f5_2').val());
        let averageScore = parseFloat($('#average-score').val());
        
        if(method_adminssions_id == 1){
            data = {
                form_adminssions_id : form_adminssions_id, 
                method_adminssions_id : method_adminssions_id,// 1: xét học bạ, 2: xét bảng điểm
                province_name : province_name_1,
                school_name : school_name_1,
                marjors_id : marjors_id_1,
                score_avg : "",
                block_adminssions_id : block_adminssions_id,
                score1 : score1,
                score2 : score2,
                score3 : score3    
            };
        } else {
            data = {
                form_adminssions_id : form_adminssions_id, 
                method_adminssions_id : method_adminssions_id,// 1: xét học bạ, 2: xét bảng điểm
                province_name : province_name_2,
                school_name : school_name_2,
                marjors_id : marjors_id_2,
                score_avg : averageScore,
            };
        }
        let convertData = JSON.stringify(data);

        $.ajax({
            url: api,
            type: 'POST',
            data: convertData,
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
                let data = response.data;

                if(response.code == 422){
                    if(method_adminssions_id == 1){
                        handleError('#provinces_name_f5_1', '#provinces_name_f5_1_wrapper', data.province_name);
                        handleError('#school_name_1', '#school_name_1_wrapper', data.school_name);
                        handleError('#marjor_f5_1', '#marjor_f5_1_wrapper', data.marjors_id);
                        handleError('#block_adminssions', '#block_adminssions_wrapper', data.block_adminssions_id);

                        if(data.score1 != null){
                            $('#score-error-1').addClass('show-error').html(data.score1)
                        }
                        if(data.score2 != null){
                            $('#score-error-2').addClass('show-error').html(data.score2)
                        }
                        if(data.score3 != null){
                            $('#score-error-3').addClass('show-error').html(data.score3)
                        }
                        $('.screen-loading').hide();
                    } else {
                        handleError('#provinces_name_f5_2', '#provinces_name_f5_2_wrapper', data.province_name);
                        handleError('#school_name_2', '#school_name_2_wrapper', data.school_name);
                        handleError('#marjor_f5_2', '#marjor_f5_2_wrapper', data.marjors_id);
                        handleError('#average_score', '#average_score_wrapper', data.score_avg);
                        $('.screen-loading').hide();
                    }
                } else {
                    $('.screen-loading').hide();
                    $('#myForm5').hide();
                    $('#myForm6').show();
                    $('#tab-step-5').removeClass('active-tab');
                    $('#tab-step-6').addClass('active-tab');
                }
            },
            error: function(xhr, status, error){}
        })
    })

    
});