<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>แก้ไขวันที่</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1>แก้ไขวันที่</h1>
    <form method="POST" action="{{route('updatedate',$datefix->id_BEList,$datefix->id_checkroom)}}">
        @csrf
        <div class="form-group">
            <label for="date_finish">เลือกวันที่ซ่อมเสร็จ</label>
            <input type="date" name="date_finish">
        </div>
        @error('date_finish')
            <div class="my-2">
                <span class="text-danger">{{$message}}</span>
            </div>
        @enderror
        <input type="submit" value="บันทึก" class="btn btn-primary">
        <a href= "{{route('back',$datefix->id_checkroom)}}" class= "btn btn-primary">Back</a>
    </form>
</body>
</html>