@extends('layouts.base')
@section('contenido')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">CATÁLOGOS</h5>
                    <p class="m-b-0 text-white">Bienvenido</p>
                </div>
            </div>
            <div class="col-md-4">
                <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                    <li class="breadcrumb-item"><i class="ti ti-smart-home me-2"></i><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active"><i class="ti ti-circles me-2"></i><a href="#">Catalogos</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Page-header end -->
<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page-body start -->
            <div class="page-body">
                <div class="row" id="lista-catalogos">
                    
                </div><!-- End row -->
            </div>
            <!-- Page-body end -->
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('assets/js/shared.js') }}"></script>
<script>
    $(document).ready(function(){
        readCatalogos();
    })
</script>
@endsection
