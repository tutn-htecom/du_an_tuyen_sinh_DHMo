function $post(url, data, method, redirect){         
    $.ajax({
        url: url,
        type: method,
        data: data,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
        success: function (res) {                                    
            if (res && res.code === 200) {
                $.notify(res.message, "success");                 
                localStorage.setItem('crm.auth', res.data)                
                window.location.replace(redirect);
            } else {                
                $.notify(res.message, "error");
            }
        },
        error: function (error) {
            if(error.status === 422) {
                showErrMessage(error.responseJSON.data);        
            }
        },
    });
}
function error(class_name, id_name, err_msg, str) {
    if(str.length <= 0) {                
        $(class_name).attr('id', id_name);
        $(class_name).html(err_msg);
    } else {        
        $(class_name).removeAttr('id', id_name);
        $(class_name).html('');
    } 
}
function $get(url, method, redirect){  
    let response = null;   
    $.ajax({
        url: url,
        type: method,
        success: function (res) {
            if (res && res.code === 200) {
                $.notify(res.message, "success");
                location.reload();
            } else {
                $.notify(res.message, "error");
            }
        },
        error: function (error) {
            if (error.message) {
                $.notify(res.message, "error");
            }
        },
    });
    return response;
}

// Loading
$(document).ajaxStart(function() {
    $('#loading').addClass('loading');
    $('#loading-content').addClass('loading-content');
});

$(document).ajaxStop(function() {
    $('#loading').removeClass('loading');
    $('#loading-content').removeClass('loading-content');
});

function showErrMessage(result){
    if(result.email) {
        $.notify(result.email, "error");
    }  
    if(result.email) {
        $.notify(result.password[0], "error");
    }  
}

// format date to dd/mm/yyyy \\
function formatdate(e){
    let date = new Date(e);

    let day = String(date.getDate()).padStart(2, '0');
    let month = String(date.getMonth() + 1).padStart(2, '0');
    let year = date.getFullYear();
    let formattedDate = day + "/" + month + "/" + year;

    return formattedDate;
}

// handle error when submit form \\
function handleError(field, wrapper, errors) {
    if (errors != null) {
        $(field).addClass('border-error');
        $(wrapper + ' .error-input').html(errors.join(', '));
        $(wrapper + ' .error-input').addClass('show-error');
    }
}

// change subject when select block_adminssions \\
$('#block_adminssions').change(function() {
    var selectedOption = $(this).find('option:selected');
    
    var monsText = selectedOption.data('mons');
    
    if (monsText) {
        var monsArray = monsText.split(', ');
        $('.subject').each(function(index) {
            $(this).text(monsArray[index] || '');
        });
    } else {
        $('.subject').text('');
    }
});

function calculateAverage() {
    let total = 0;
    let count = 0;
    
    $('input[id^="score-"]').each(function() {
        let value = parseFloat($(this).val()) || 0;
        total += value;
        count++;
    });
    
    let average = count > 0 ? (total / count).toFixed(2) : '0.00';
    
    $('.total-score').text(average);
}
$('input[id^="score-"]').on('input', calculateAverage);