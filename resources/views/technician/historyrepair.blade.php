<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ประวัติการซ่อม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <h1 class = "text text-center">ประวัติการซ่อม</h1>
    <br>
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th scope="col">ลำดับ</th>
                <th scope="col">ชื่อห้อง</th>
                <th scope="col">ประเภทห้อง</th>
                <th scope="col">วันที่ซ่อมเสร็จ</th>
                <th scope="col">สถานะของห้อง</th>
                <th scope="col">รายละเอียด</th>
                <th scope="col">ลบ</th>
            </tr>
        </thead>
        @php
            $x = 0;
        @endphp
        <tbody>
            @foreach ($historyrepairs as $item)
                <tr>
                    <td>{{ $x += 1 }}</td>
                    <td>
                        {{ $item->name_room }}
                    </td>
                    <td>
                        {{ $item->type }}
                    </td>
                    <td>
                        {{ $item->date }}
                    </td>
                    <td>
                        {{ $item->status_repair }}
                    </td>
                    <td>
                        <a href= "{{route('detail',$item->id_checkroom)}}" class= "btn btn-primary">รายละเอียดเพิ่มเติม</a>
                     </td>
                    <td>
                        <a href = "{{route('deletehistoryrepair',$item->id_CBRoom)}}" class = "btn btn-danger" onclick="return confirm('คุณต้องการลบประวัติการซ่อมหรือไม่')">ลบ</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
