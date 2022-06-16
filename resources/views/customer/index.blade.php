@include('layouts.head')
@include('layouts.nav')
@include('layouts.side_bar')
<!DOCTYPE html>
<html>

<head>
    <title>Search and Sort with pagination</title>

    <!-- Meta -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">

    <!-- Datatable CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" />

    <!-- jQuery Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Datatable JS -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

</head>

<body>

    <table id='productTable' width='50%' border="1" style='border-collapse: collapse;'>
        <thead>
            <tr>
                <td>S.no</td>
                <td>Product Name</td>
                <td>Description</td>
                <td>Product Image</td>
                <td>Action</td>
            </tr>
        </thead>
    </table>

    <script type="text/javascript">
        $(document).ready(function() {

            // DataTable
            $('#productTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('getProducts') }}",
                columns: [{
                        data: 'id',
                       
                    },
                    {
                        data: 'product_name'
                    },
                    {
                        data: 'product_desc'
                    },
                    {
                        data: 'product_image',
                        "render": function(data, type, row, meta) {
                            return '<img src="/image/' + data + '" alt="' + data +
                                '"height="100" width="50"/>';
                        }

                    },
                    {
                        
                        "render": function() {
                            return '<a href="#"<td>Delete</td></a>|<a href="#"><td>Edit</td></a>';
                        }
                    }

                ]
            });
        });
    </script>
    @include('layouts.footer')
</body>

</html>
