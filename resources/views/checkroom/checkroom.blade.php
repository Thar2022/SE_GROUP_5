@extends('layout.checkroomLayout')
@section('title')
    การจองทั้งหมด
@endsection
@section('content')
    <link href="{{ asset('css/checkroom/check.css') }}" rel="stylesheet">
    {{-- แบบย่อ  --}}
    @if (count($bookings) == 0)
        <h2 class="text-center mb-4">ยังไม่มีห้องให้ตรวจ</h2>
    @else
        @foreach ($bookings as $book)
            @php
                $dateString1 = $currentTime;
                $dateString2 = date(
                    'Y-m-d',
                    strtotime('-' . (string) $late_day_number . ' day', strtotime($book->date)),
                );
                $date1 = \Illuminate\Support\Carbon::parse($dateString1);
                $date2 = \Illuminate\Support\Carbon::parse($dateString2);
                $diffInDays = $date1->diffInDays($date2);
                $totalInDays = $future_day_number;
            @endphp
            @if ($date1 <= $date2)
                <div class="card mb-3   h-50 ">
                    <div class="row g-0">
                        <div class="col-md-4">

                            <img src="{{ asset('room/SR001.jpg') }}" alt="" class="card-img-top">
                        </div>
                        <div class="col-md-8">

                            <ul>
                                <li class="m-2">ห้องที่ตรวจ : {{ $book->name_room }}</li>
                                <li class="m-2">จำนวนที่นั่ง : {{ $book->seats }}</li>
                                <li class="m-2">วันที่จะเข้าใช้ :
                                    {{ $book->date }}</li>
                                <li class="m-2">กรุณาตรวจห้องภายในวันที่ :

                                    {{ date('Y-m-d', strtotime('-' . (string) $late_day_number . ' day', strtotime($book->date))) }}
                                </li>
                            </ul>

                            {{-- {{ date('Y-m-d', strtotime('-' . (string) $late_day_number . ' day', strtotime($book->date))) }} --}}

                            {{-- <div id="percent">
                                <div class="parent">
                                    <div class="box fifty-percent">50%</div>

                                </div>
                            </div>


                            <script>
                                document.getElementById('fifty-percent').style.width = $diffInDays;
                            </script> --}}

                            {{-- @php
                                $dateString1 = '2024-03-26';
                                $dateString2 = '2024-03-25';

                                $date1 = \Illuminate\Support\Carbon::parse($dateString1);
                                $date2 = \Illuminate\Support\Carbon::parse($dateString2);

                                if ($date2 > $date1) {
                                    // ถ้า $date2 มากกว่า $date1 ให้เปลี่ยนเครื่องหมายเป็นบวก
                                    echo 'HEADWE';
                                }
                                // $diffInDays = $date2->diffInDays($date1);
                            @endphp
                            --}}



                            <div id="buttonCheck">
                                <a href="{{ route('broken', $book->id_room) }}" class="btn btn-danger ms-5 ">เสีย</a>
                                <a href="{{ route('nobroken', $book->id_room) }}" class="btn btn-success ms-2">ไม่เสีย</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
        {{ $bookings->links() }}
    @endif



@endsection
