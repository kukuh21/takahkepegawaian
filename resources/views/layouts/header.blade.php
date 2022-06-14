<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="{{ config('app.meta') }}" name="description">
  <meta content="{{ config('app.meta') }}" name="keywords">
  <title>{{ config('app.app_name') }} | {{ config('app.instansi') }}  </title>
  <!-- Favicons -->
  <link href="{{ asset('logo-tabalong.png') }}" rel="icon">
  <link href="{{ asset('logo-tabalong.png') }}" rel="apple-touch-icon">
  @include('layouts.css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>

  <style>
    .Custom_Cancel > .sa-button-container > .cancel {
      background-color: #fff;
      border-color: #333;
    }
    .Custom_Cancel > .sa-button-container > .cancel:hover {
      background-color: rgb(241, 241, 241);
      border-color: rgb(241, 241, 241);
    }
  </style>
</head>

