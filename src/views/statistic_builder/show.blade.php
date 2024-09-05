@extends('crudbooster::admin_template')
@section('content')

@include('crudbooster::statistic_builder.index')

@php
$status = CRUDBooster::me();
@endphp

<style>
    .swal2-popup {
        width: 80vw;
        max-width: 600px;
        border-radius: 15px;
        font-size: 1.2rem;
    }

    .swal2-title {
        font-size: 2rem;
    }

    .swal2-html-container {
        font-size: 1.2rem;
    }

    .swal2-confirm {
        font-size: 1.2rem;
        padding: 8px 20px;
    }
</style>

<!-- Include SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- Add SweetAlert2 script -->
@if($status->has_seen_updates === 0)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: ' <i class="bi bi-tools" style="font-size: 18px;"></i> DEM System Updates',
            html: `
                    <h5 style="font-weight: 600; text-align: left; margin-bottom: 4px"><i class="bi bi-folder-fill"></i> Project Version Upgraded.</h5>
                        <p style="margin-bottom: 2px; text-align: left;text-indent: 33px;">- Laravel version updated to v.8</p>
                        <p style="margin-bottom: 2px; text-align: left;text-indent: 33px;">- PHP version updated to v.7.4</p>
                        <p style="margin-bottom: 2px; text-align: left;text-indent: 33px;">- Crudbooster version updated to v.^5.6/*</p>
                        <p style="margin-bottom: 2px; text-align: left;text-indent: 33px;">- Excel version to PHPSpreadsheet v.^1.29</p>

                    <h5 style="font-weight: 600; text-align: left; margin-bottom: 4px"><i class="bi bi-database-fill-gear"></i> Database changes/updates.</h5>
                        <p style="margin-bottom: 2px; text-align: left;text-indent: 33px;">- Change all Enum type to varchar 10</p>
                        <p style="margin-bottom: 2px; text-align: left;text-indent: 33px;">- Add column (has_seen_updates) in cms_users table for system updates notification.</p>

                    <h5 style="font-weight: 600; text-align: left; margin-bottom: 4px"><i class="bi bi-pc-display-horizontal"></i> UI Ehancement / <i class="bi bi-code-square"></i> Code Adjustment</h5>
                        <p style="margin-bottom: 2px; text-align: left;text-indent: 33px;">- Generally, UI enhancement applied to all parts(every module) of the system.</p>
                        <p style="margin-bottom: 2px; text-align: left;text-indent: 33px;">- Code adjustment for deprecated syntax and old method coding process.</p>

                    <h5 style="font-weight: 600; text-align: left; margin-bottom: 4px"><i class="bi bi-file-earmark-excel-fill"></i> Excel export/import & Other actions/functions in Warranty Slip Module</h5>
                        <p style="margin-bottom: 2px; text-align: left;text-indent: 33px;">- Export Orders fixed format/extentions issue & updated.</p>
                        <p style="margin-bottom: 2px; text-align: left;text-indent: 33px;">- Upload Orders Header (export template/import file) fixed & updated logic process</p>
                        <p style="margin-bottom: 2px; text-align: left;text-indent: 33px;">- Upload Orders Item (export template/import file) fixed & updated logic process</p>
                        <p style="margin-bottom: 2px; text-align: left;text-indent: 33px;">- Add, Edit, Deatils, Print Orders fixed issues & updates.</p>
                        <p style="margin-bottom: 2px; text-align: left;text-indent: 33px;">- Imported orders add logic to auto computed total quantity, price and subtotal.</p>

                    <h5 style="font-weight: 600; text-align: left; margin-bottom: 4px"><i class="bi bi-diagram-3-fill"></i> API Sync items in Products Module</h5>
                        <p style="margin-bottom: 2px; text-align: left;text-indent: 33px;">- Fixed & updated API sync for dem_item created.</p>
                        <p style="margin-bottom: 2px; text-align: left;text-indent: 33px;">- Fixed & updated API sync for dem_item updated.</p>
                `,
            icon: 'info',
            confirmButtonText: 'Got it!',
            allowOutsideClick: false,
            allowEscapeKey: false,
            backdrop: true,
        }).then((result) => {
            if (result.isConfirmed) {

                var hsu = 1;
                var user_id = '{{ CRUDBooster::myId() }}';

                $.ajax({
                    url: '/mark-update-as-seen',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        has_seen_updates: hsu,
                        cms_users_id: user_id,
                    },
                    success: function(response) {
                        Swal.fire({
                            title: "Thank You!",
                            html: `<p style="font-size: 120%; margin-bottom: 5px;">Awesome! Thanks for confirming </p> 
                                   <p style="font-size: 120%; margin-bottom: 5px;"> you’ve seen the new updates of </p>
                                   <p style="font-size: 120%; margin-bottom: 5px;">Digits ECOMM Merchandising (DEM System).</p><br><br>`,
                            icon: "success",
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // console.error('Error:', textStatus, errorThrown);
                    }
                });
            }
        });
    });
</script>
@endif

@endsection