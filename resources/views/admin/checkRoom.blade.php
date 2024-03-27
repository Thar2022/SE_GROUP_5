@extends('layout.adminLayout')

@section('title')
จัดการการตรวจห้อง
@endsection



@section('content')
<table class="table table-bordered">
    <tr>
        <th>sd</th>
    </tr>
    @foreach ($detailCheckroom as $item)
    <tr>
        <td>{{ $item->id_checkroom }}</td>
    </tr>

    @endforeach
</table>
@endsection