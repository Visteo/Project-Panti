@extends('errors.layout')

@section('code', '429')
@section('icon', '⏳')
@section('title', 'Terlalu Banyak Permintaan')

@section(
    'message',
    'Terlalu banyak permintaan dalam waktu singkat. Silakan tunggu sebentar, kemudian coba kembali.'
)