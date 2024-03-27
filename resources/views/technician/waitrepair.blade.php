<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>รายงานการซ่อม</title>
</head>
<body>
    <h5>รายงานการซ่อม</h5>
      @foreach($waitrepair as $item)
      <div class="card text-bg-info mb-3" style="max-width: 680px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="1.jpg" class="img-fluid rounded-start" alt=" ">
          </div>
          <div class="col-md-8">
            <div class="card-body">
                <a>หมายเลขรายงานการซ่อม : {{$item->id_checkroom}}</a><br>
                <a>ชื่อห้อง : {{$item->name_room}}</a><br>
                <a>วันที่ตรวจตรวจ : {{$item->date_check}}</a><br>
                <a>เวลาที่ตรวจ : {{$item->time}}</a><br>
                <a>สถานะของห้อง :{{$item->status_check}}</a><br>
                <a>หมายเหตุ : {{$item->note}}</a><br>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{route('needRepair',$item->id_checkroom)}}" class="btn btn-primary">อุปกรณ์ที่ต้องซ่อม</a>
                    <a href="{{route('updatefinish',$item->id_checkroom)}}" class="btn btn-primary">ซ่อมสำเร็จ</a>
                </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
</body>
</html>