$(document).ready(function(){
    var data = window.provincesData;

    function handleProvinceChange(provinceSelector, districtSelector, wardSelector) {
        $(provinceSelector).on('change', function() {
            var cityName = $(this).val();
            var districts = [];

            $.each(data, function(index, city) {
                if (city.name == cityName) {
                    districts = city.districts;
                }
            });

            $(districtSelector).empty().append('<option value="">Chọn Quận/ Huyện</option>');
            $(wardSelector).empty().append('<option value="">Chọn Phường/ Xã</option>').prop('disabled', true);

            if (cityName) {
                $.each(districts, function(index, district) {
                    $(districtSelector).append('<option value="'+district.name+'">'+district.name+'</option>');
                });
                $(districtSelector).prop('disabled', false);
            } else {
                $(districtSelector).prop('disabled', true);
            }
        });
    }

    function handleDistrictChange(districtSelector, wardSelector) {
        $(districtSelector).on('change', function() {
            var districtName = $(this).val();
            var wards = [];

            $.each(data, function(index, city) {
                $.each(city.districts, function(dIndex, district) {
                    if (district.name == districtName) {
                        wards = district.wards;
                    }
                });
            });

            $(wardSelector).empty().append('<option value="">Chọn Phường/ Xã</option>');

            if (districtName) {
                $.each(wards, function(index, ward) {
                    $(wardSelector).append('<option value="'+ward.name+'">'+ward.name+'</option>');
                });
                $(wardSelector).prop('disabled', false);
            } else {
                $(wardSelector).prop('disabled', true); 
            }
        });
    }

    handleProvinceChange('#provinces_name_1', '#districts_name_1', '#wards_name_1');
    handleProvinceChange('#provinces_name_2', '#districts_name_2', '#wards_name_2');
    handleDistrictChange('#districts_name_1', '#wards_name_1');
    handleDistrictChange('#districts_name_2', '#wards_name_2');
});
