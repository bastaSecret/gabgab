$(document).ready(function() {
    // Define your handlers
    var my_handlers = {
        // Fill cities based on the selected province
        fill_cities: function() {
            var province_code = $(this).val();
            var dropdown = $('#city');
            dropdown.empty();
            dropdown.append('<option selected="true" disabled>Choose city/municipality</option>');
            dropdown.prop('selectedIndex', 0);

            // Load city data
            var url = 'city.json';
            $.getJSON(url, function(data) {
                var result = data.filter(function(value) {
                    return value.province_code == province_code;
                });
                result.sort(function(a, b) {
                    return a.city_name.localeCompare(b.city_name);
                });
                $.each(result, function(key, entry) {
                    dropdown.append($('<option></option>').attr('value', entry.city_code).text(entry.city_name));
                });
            });
        },
        // Fill barangays based on the selected city
        fill_barangays: function() {
            var city_code = $(this).val();
            var dropdown = $('#baranagay'); // Corrected ID here
            dropdown.empty();
            dropdown.append('<option selected="true" disabled>Choose baranagay</option>');
            dropdown.prop('selectedIndex', 0);
        
            // Load barangay data
            var url = 'barangay.json';
            $.getJSON(url, function(data) {
                var result = data.filter(function(value) {
                    return value.city_code == city_code;
                });
                result.sort(function(a, b) {
                    return a.brgy_name.localeCompare(b.brgy_name);
                });
                $.each(result, function(key, entry) {
                    dropdown.append($('<option></option>').attr('value', entry.brgy_code).text(entry.brgy_name));
                });
            });
        },
        // Handle barangay selection change
        onchange_barangay: function() {
            var barangay_text = $(this).find("option:selected").text();
            $('#barangay-text').val(barangay_text);
        },
    };

    // Attach event listeners
    $('#province').on('change', my_handlers.fill_cities);
    $('#city').on('change', my_handlers.fill_barangays);
    $('#barangay').on('change', my_handlers.onchange_barangay);

    // Load provinces
    var dropdown = $('#province');
    dropdown.empty();
    dropdown.append('<option selected="true" disabled>Choose Province</option>');
    dropdown.prop('selectedIndex', 0);

    var url = 'province.json';
    $.getJSON(url, function(data) {
        $.each(data, function(key, entry) {
            dropdown.append($('<option></option>').attr('value', entry.province_code).text(entry.province_name));
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const contactNumberInput = document.getElementById('contact_number-text');
    contactNumberInput.addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '');
    });

    contactNumberInput.addEventListener('input', function() {
        const maxLength = 10; 
        if (this.value.length > maxLength) {
            this.value = this.value.slice(0, maxLength);
        }
    });
});