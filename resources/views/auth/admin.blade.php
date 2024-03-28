@extends('layout.' . session('role_name'))
@section('title','edituser')
@section('content')
<?php $id = session('id_emp');
   echo $id;
?>
@endsection