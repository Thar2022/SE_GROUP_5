<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <div class="card">
         
        <!--ตารางอุปกรณ์ที่เสีย-->
        <div class="card-body">
            <h1 class = "text text-center">อุปกรณ์ที่ต้องซ่อม</h1>
                <div>
                    <table class="table table-bordered text-center">
                        <tr>
                            <th scope="col">เลข</th>
                            <th scope="col">อุปกรณ์</th>
                            <th scope="col">จำนวน</th>
                            <th scope="col">วันที่ซ่อมเสร็จ</th>
                            <th scope="col">แก้ไขวันที่</th>
                        </tr>
                        @php
                            $x = 0;
                        @endphp
                        @foreach ($waitequ as $item)
                            <tr>
                                <td>{{ $x += 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->amount }}</td>
                                <td>{{ $item->date_finish }}</td>
                                <td>
                                    <a href= "{{route('datefix',$item->id_BEList)}}" class= "btn btn-primary">แก้ไข</a>
                                 </td>
                            </tr>
                        @endforeach
                    </table>
                    <a href= "/waitrepair" class= "btn btn-primary">Back</a>
                </div>
        </div>