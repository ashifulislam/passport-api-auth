<!DOCTYPE html>
<html>
<head>
     <title>Datatables AJAX pagination with Search and Sort in Laravel 8</title>

     <!-- Meta -->
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
     <meta charset="utf-8">

     <!-- Datatable CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"/>

     <!-- jQuery Library -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

     <!-- Datatable JS -->
     <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

</head>
<body>

    <table id='productTable' width='100%' border="1" style='border-collapse: collapse;'>
        <thead>
            <tr>
                 <td>S.no</td>
                 <td>Username</td>
                 <td>Name</td>
                 <!-- <td>Email</td> -->
            </tr>
         </thead>
     </table>

     <!-- Script -->
     <script type="text/javascript"> 
     $(document).ready(function()
     {

         // DataTable
        $('#productTable').DataTable({
             processing: true,
             serverSide: true,
             ajax: "{{route('getProducts')}}",
             columns: [
                 { data: 'id' },
                 { data: 'product_name' },
                 { data: 'product_desc' },
               
             ]
         });

      });
      </script>
</body>
</html>