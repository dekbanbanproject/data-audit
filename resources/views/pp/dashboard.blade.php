@extends('layouts.pp')
@section('title', 'PK-BACKOFFice || dashboard')

@section('content')
<style>
    #button{
           display:block;
           margin:20px auto;
           padding:30px 30px;
           background-color:#eee;
           border:solid #ccc 1px;
           cursor: pointer;
           }
           #overlay{	
           position: fixed;
           top: 0;
           z-index: 100;
           width: 100%;
           height:100%;
           display: none;
           background: rgba(0,0,0,0.6);
           }
           .cv-spinner {
           height: 100%;
           display: flex;
           justify-content: center;
           align-items: center;  
           }
           .spinner {
           width: 250px;
           height: 250px;
           border: 5px #ddd solid;
           border-top: 10px #12c6fd solid;
           border-radius: 50%;
           animation: sp-anime 0.8s infinite linear;
           }
           @keyframes sp-anime {
           100% { 
               transform: rotate(360deg); 
           }
           }
           .is-hide{
           display:none;
           }
</style>
 
<div class="container-fluid">
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                       
                            <p class="text-truncate font-size-14 mb-2">เดือน 0000</p>
                     
                        
                        <h4 class="mb-2">000 Visit</h4>
                        <p class="text-muted mb-0"><span class="text-danger fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>20</span>บาท</p>
                    </div>
                    <div class="avatar-sm me-2">
                        <a href="">
                            <span class="avatar-title bg-light text-danger rounded-3">
                                <p style="font-size: 10px;">
                                <i class="fa-solid fa-stamp font-size-22 mt-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Test"> </i>  
                                <br>
                               2222
                            </p>
                                
                            </span> 
                            {{-- <p class="text-muted mb-0"><span class="bg-light text-danger fw-bold font-size-12 me-2 rounded-3"><i class="fa-solid fa-stamp font-size-20 me-1 align-middle"></i>{{ number_format($sumdebtor_, 2) }}</span></p> --}}
                            
                        </a>
                    </div>
                    <div class="avatar-sm me-2">
                        <span class="avatar-title bg-light text-primary rounded-3">
                            {{-- <i class="mdi mdi-currency-usd font-size-24"></i>   --}}
                            <i class="fa-solid fa-file-import font-size-24"></i>
                        </span> 
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-info rounded-3">
                            {{-- <i class="ri-user-3-line font-size-24"></i>  --}}
                            <i class="fa-brands fa-btc font-size-24"></i>
                        </span> 
                    </div>
                </div>                                            
            </div><!-- end cardbody -->
        </div> 
    </div> 
  
</div>
 

@endsection
@section('footer')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
            $('#example2').DataTable();

        });
    </script>

@endsection
