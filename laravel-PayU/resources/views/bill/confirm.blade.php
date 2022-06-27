@extends('theme.base')

@section('content')
$merchant_id = $_REQUEST['merchantId'];

echo $merchant_id;

@endsection