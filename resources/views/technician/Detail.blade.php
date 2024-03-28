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
        <div class="card-header">
            รายละเอียดเพิ่มเติม
        </div>
         <!--ข้อมูลของห้อง-->
        <div class="card border-info mb-3" style="max-width: 680px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="1.jpg" class="img-fluid rounded-start" alt=" ">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <a>หมายเลขรายงานการซ่อม : {{ $item->id_checkroom }}</a><br>
                        <a>ชื่อห้อง : {{ $item->name_room }}</a><br>
                        @php 
                        $convert = date('d-m-Y',strtotime($item->date_check));
                        echo"<a>วันที่ตรวจตรวจ :"; echo $convert; echo "</a><br>" ;
                        @endphp
                        <a>เวลาที่ตรวจ : {{ $item->time }}</a><br>
                        <a>สถานะของห้อง :{{ $item->status_check }}</a><br>
                        <a>หมายเหตุ : {{ $item->note }}</a><br>
                    </div>
                </div>
            </div>
        </div>
        </div>
         
        <!--ตารางอุปกรณ์ที่เสีย-->
        <div class="card-body">
            <blockquote class="blockquote mb-0">
                <div>
                    <table class="table table-bordered border-primary">
                        <tr>
                            <th scope="col">อุปกรณ์ที่เสีย</th>
                        </tr>
                        <tr>
                            <th scope="col">เลข</th>
                            <th scope="col">อุปกรณ์</th>
                            <th scope="col">จำนวน</th>
                        </tr>
                        @php
                            $x = 0;
                        @endphp
                        @foreach ($detail as $item)
                            <tr>
                                <td>{{ $x += 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->amount }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </blockquote>
        </div>

        <!--ประมาณเวลา-->
        
        <form class="needs-validation" novalidate=""action="{{route('estimate')}}" method="POST">
            @csrf
            <div class="col-md-6">
                <label for="date_start" class="form-label">ประมาณวันที่</label>
                <input type="date" id="date" name="date" value="" min="{{$item->date_check}}" max="" />
                <input type="hidden" id="id_checkroom" name="id_checkroom" value="{{$item->id_checkroom}}" />
                 
                @error('date')
                <div class="my-2">
                    <span class="text text-danger">{{$message}}</span>
                </div>
                @enderror
                @error('pro-start')
                    <div class="my-2"> 
                        <span class="text text-danger">{{$message}}</span>
                    </div>
                @enderror
            </div>
            <button class="w-50 btn btn-primary btn-lg" type="submit">ยืนยัน</button>
        </form>
        <div>
        </div>
        
        </form>
    
    </div>

</body>

</html>
