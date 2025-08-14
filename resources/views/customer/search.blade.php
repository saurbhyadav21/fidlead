<!DOCTYPE html>
<html>
<head>
    <title>Fast Search</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .filter-row {
            margin-bottom: 15px;
        }
        .filter-row select, .filter-row input {
            padding: 5px;
            margin-right: 10px;
        }
    </style>
</head>
<body>

    <h2>Buyer/Seller Search</h2>

    <!-- Filter Row -->
    <div class="filter-row">
        <select id="dataType">
            <option value="buyer">Buyer</option>
            <option value="seller">Seller</option>
        </select>

        <select id="buyer_country">
            <option value="">-- Select Country --</option>
            @foreach($countries as $country)
                <option value="{{ $country->buyer_country }}">{{ $country->buyer_country }}</option>
            @endforeach
        </select>

        <select id="hs_code">
            <option value="">-- Select HS Code --</option>
            @foreach($hsCodes as $hs)
                <option value="{{ $hs->hs_02 }}">{{ $hs->hs_02 }}</option>
            @endforeach
        </select>

        <select id="business_category">
            <option value="">-- Select Business Category --</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->business_category }}">{{ $cat->business_category }}</option>
            @endforeach
        </select>

        <input type="text" id="search_text" placeholder="Search name/email...">

        <button id="filterBtn">Filter</button>
        <button id="resetBtn">Reset</button>
    </div>

    <!-- DataTable -->
    <table id="dataTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Buyer Name</th>
                <th>Country</th>
                <th>Email</th>
                <th>HS Code</th>
                <th>Business Category</th>
            </tr>
        </thead>
    </table>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('/customer/search') }}",
                    type: "POST",
                    data: function (d) {
                        d._token = $('meta[name="csrf-token"]').attr('content');
                        d.type = $('#dataType').val();
                        d.buyer_country = $('#buyer_country').val();
                        d.hs_code = $('#hs_code').val();
                        d.business_category = $('#business_category').val();
                        d.search_text = $('#search_text').val();
                    }
                },
                columns: [
                    { data: 'buyer_name', name: 'buyer_name' },
                    { data: 'buyer_country', name: 'buyer_country' },
                    { data: 'buyer_email_i', name: 'buyer_email_i' },
                    { data: 'hs_02', name: 'hs_02' },
                    { data: 'business_category', name: 'business_category' }
                ]
            });

            $('#filterBtn').click(function () {
                table.ajax.reload();
            });

            $('#resetBtn').click(function () {
                $('#buyer_country').val('');
                $('#hs_code').val('');
                $('#business_category').val('');
                $('#search_text').val('');
                table.ajax.reload();
            });
        });
    </script>

</body>
</html>
