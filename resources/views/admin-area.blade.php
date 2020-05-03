@extends('master')
@section('page_title', 'admin')
@section('content')
    <h4>ADD NEW DOCUMENT</h4>
    <?php
        if (isset ($_GET['upload_state']))
        {
            if($_GET['upload_state']==1){
                echo ("<h4 class='alert alert-success col-md-5'>file uploaded successfully</h4>");
            }
            else {
                if (isset ($_GET['err']))
                {
                    $err = $_GET['err'];
                    switch($err)
                    {
                        case "1": echo ("<h4 class='alert alert-warning'>access denied please login first</h4>");break;
                        case "2": echo ("<h4 class='alert alert-warning'>target directory does not exist and can not be created</h4>");break;
                        case "3": echo ("<h4 class='alert alert-warning'>file already exists</h4>");break;
                        case "4": echo ("<h4 class='alert alert-warning'>file is too large</h4>");break;
                        case "5": echo ("<h4 class='alert alert-warning'>file extension not allowed</h4>");break;
                        case "6": echo ("<h4 class='alert alert-warning'>file copy failed</h4>");break;
                    }
                }
            }
        }
    ?>    
    <form id="frm_upload" action="{{$root_url}}/api/upload" enctype="multipart/form-data" method='post'>
        <div class="custom-file  col-md-4">
            <input type="file" class="custom-file-input" id="fileToUpload" name="fileToUpload">
            <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
        <input class="btn btn-success" type="submit" value="UPLOAD">
        <input type="hidden" name="callback" value="{{$root_url}}/admin-area">
    </form>
    <?php
        // $recs = DB::table('tbl_users')->get();
        $records = 
            DB::table('tbl_files')
                ->select(
                    'file_id', 
                    'file_org_name', 
                    'file_show',
                    'file_gdp_create',
                    'file_gdp_publish',
                    'file_gdp_expires',
                    'file_tag',
                    'file_title',
                    'file_desc'
                )
                ->get();
    ?>

    @component('cmp-files',['records'=>$records, 'calendar'=>$calendar])
        @slot('id')
            cmp_files
        @endslot
        @slot('title')
            FILES
        @endslot
    @endcomponent

    @component('cmp-calendar',['calendar'=>$calendar, 'base_gdp'=>737541])
        @slot('id')
            cmp_d1
        @endslot
    @endcomponent

    @component('cmp-calendar',['calendar'=>$calendar, 'base_gdp'=>737571])
        @slot('id')
            cmp_d2
        @endslot
   @endcomponent

    <script>
        // mention the name of the file on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@stop

@section('footer')
@stop
