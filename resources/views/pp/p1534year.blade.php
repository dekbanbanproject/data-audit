@extends('layouts.pp')
@section('title', 'PK-BACKOFFice || 15-34ปี')

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

    <div class="card shadow-lg">
        <div class="card-header">
            <form action="{{ route('p.ppfifyear') }}" method="POST">
                @csrf
            <div class="row">               
                <div class="col"></div>
                <div class="col-md-1 text-end">วันที่</div>
                <div class="col-md-6 text-center">
                    <div class="input-daterange input-group" id="datepicker1" data-date-format="dd M, yyyy"
                        data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                        <input type="text" class="form-control" name="startdate" id="datepicker"
                            placeholder="Start Date" data-date-container='#datepicker1'
                            data-provide="datepicker" data-date-autoclose="true" data-date-language="th-th"
                            value="{{ $start }}" />
                        <input type="text" class="form-control" name="enddate" placeholder="End Date"
                            id="datepicker2" data-date-container='#datepicker1' data-provide="datepicker"
                            data-date-autoclose="true" data-date-language="th-th" value="{{ $end }}" />
                        <button type="submit" class="btn btn-info">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            ค้นหา
                        </button>
                    </div>
                </div>
                <div class="col"></div>
                </form>
            </div>
        </div>
        <div class="card-body shadow-lg">
            {{-- <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white"><button type="button" class="btn btn-outline-info">15-34 ปี</button></h2> --}}
            <div class="row">
                <div class="col-md-4">
                    <h4 class="card-title">Detail </h4>
                    <p class="card-title-desc">รายละเอียด 15-34 ปี</p>
                </div>
                <div class="col"></div>
                <div class="col-md-2 text-end">
                    {{-- <button class="btn btn-secondary" id="Changbillitems"><i class="fa-solid fa-wand-magic-sparkles me-3"></i>ปรับ bilitems</button>  --}}                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                   
                    <div class="table-responsive">
                        <table id="example" class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">ลำดับ</th>
                                    <th width="15%" class="text-center">cid</th>
                                    <th width="10%" class="text-center">hn</th>
                                    <th class="text-center">ชื่อ-นามสกุล</th>
                                    <th width="5%" class="text-center">อายุ</th>
                                    <th width="5%" class="text-center">pttype</th>
                                    <th width="10%" class="text-center">pttype_name</th>
                                    <th width="5%" class="text-center">ที่อยู่</th>
                                    <th width="5%" class="text-center">หมู่</th>
                                    <th width="10%" class="text-center">บ้าน</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($pp_data as $item)
                                    <tr>
                                        <td class="text-center">{{ $i++ }}</td>
                                        <td width="10%">{{ $item->cid }}</td>
                                        <td width="10%">{{ $item->hn }}</td>
                                        <td class="p-2">{{ $item->ptname }}</td>
                                        <td width="5%">{{ $item->age }}</td>
                                        <td width="5%">{{ $item->pttype }}</td>
                                        <td width="15%">{{ $item->pttype_name }}</td>
                                        <td width="5%">{{ $item->address }}</td>
                                        <td width="5%">{{ $item->moo }}</td>
                                        <td width="10%">{{ $item->village_name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer"></div>
    </div>
  
</div>
 

@endsection
@section('footer')
    <script>
        $(document).ready(function() {
            $('#datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('#datepicker2').datepicker({
            format: 'yyyy-mm-dd'
        });

            $('#example').DataTable();
            $('#example2').DataTable();

        });
    </script>

@endsection
