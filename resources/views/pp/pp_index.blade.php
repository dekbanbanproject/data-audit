@extends('layouts.pp')
@section('title', 'PK-BACKOFFice || pp')
 
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
{{--           
                 
        <form class="custom-validation" action="{{ route('med.med_consave') }}" method="POST"
        id="insert_type" enctype="multipart/form-data">
        @csrf --}}
                    <div class="card">
                        <div class="card-body text-center shadow-lg"> 
                            <div class="row "> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <img src="{{ asset('assets/images/default-image.jpg') }}" id="add_upload_preview"
                                            alt="Image" class="img-thumbnail" width="450px" height="350px">
                                        <br>
                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="img">Upload</label>
                                            <input type="file" class="form-control" id="img" name="img"
                                                onchange="addarticle(this)">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row mt-3"> 
                                        <div class="col-md-2 text-end">
                                            <label for="medical_typecatname">ประเภทเครื่องมือ </label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <input id="medical_typecatname" type="text" class="form-control form-control-sm" name="medical_typecatname">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div> 
                            </div>
 
                        </div>
                        <div class="card-footer">
                            <div class="col-md-12 text-end">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa-solid fa-floppy-disk me-2"></i>
                                        บันทึกข้อมูล
                                    </button>
                                    {{-- <button type="button" id="Savebtn" class="btn btn-primary btn-sm">
                                        <i class="fa-solid fa-floppy-disk me-2"></i>
                                        บันทึกข้อมูล
                                    </button> --}}
                                    {{-- <a href="{{ url('medical/med_index') }}" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-xmark me-2"></i>
                                        ยกเลิก
                                    </a> --}}
                                </div>
    
                            </div>
                        </div>
                       
                    </div>
               
        {{-- </form>     --}}
                
            </div>
        </div>
        
@endsection
@section('footer')
<script>
    $(document).ready(function() {
        $('#example').DataTable();
        $('#example2').DataTable();
        $('#p4p_work_month').select2({
            placeholder:"--เลือก--",
            allowClear:true
        });
        $('#insert_type').on('submit',function(e){
                e.preventDefault();
            
                var form = this;
                //   alert('OJJJJOL');
                $.ajax({
                url:$(form).attr('action'),
                method:$(form).attr('method'),
                data:new FormData(form),
                processData:false,
                dataType:'json',
                contentType:false,
                beforeSend:function(){
                    $(form).find('span.error-text').text('');
                },
                success:function(data){
                    if (data.status == 0 ) {
                    
                    } else {          
                    Swal.fire({
                        title: 'บันทึกข้อมูลสำเร็จ',
                        text: "You Insert data success",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#06D177',
                        // cancelButtonColor: '#d33',
                        confirmButtonText: 'เรียบร้อย'
                    }).then((result) => {
                        if (result.isConfirmed) {         
                        window.location.reload(); 
                        // medical/med_index
                        // window.location="{{url('medical/med_index')}}"; 
                        }
                    })      
                    }
                }
                });
        });

        
    });
    
</script>

@endsection