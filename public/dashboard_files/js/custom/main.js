$(function () {
    'use strict';

    // Search operation
    $(document).ready(function () {
        $('#search_by').on('change', function () {
            var categoryId = $(this).val();
            $(this).closest('form').submit();
        });
    });
});
