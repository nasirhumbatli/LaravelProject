@extends('backend.layout')

@section('content')
<section class="content-header">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Settings</h3>
        </div>
        <div class="box-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Açıqlama</th>
                        <th>Məzmun</th>
                        <th>Açar Sözlər</th>
                        <th>Tip</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="sortable">
                    @foreach($data['adminSettings'] as $adminSettings)
                    <tr id="item-{{$adminSettings->id}}">
                        <td>{{$adminSettings->id}}</td>
                        <td class="sortable">{{$adminSettings->settings_description}}</td>
                        <td>
                            @if($adminSettings->settings_type=='file')
                            <img width="100" src="/images/settings/{{$adminSettings->settings_value}}" alt="">
                            @else
                            {{strip_tags($adminSettings->settings_value)}}
                            @endif
                        </td>
                        <td>{{$adminSettings->settings_key}}</td>
                        <td>{{$adminSettings->settings_type}}</td>
                        <td width="5">
                            <a href="{{route('settings.edit',['id'=>$adminSettings->id])}}"><i style="font-size: 20px"
                                    class="fa fa-pencil-square"></i></a>
                        </td>
                        <td width="5">
                            @if($adminSettings->settings_delete)
                            <a href="javascript:void(0)"><i style="font-size: 20px" id="{{$adminSettings->id}}"
                                    class="fa fa-trash-o"></i></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(function(){ 
        $.ajaxSetup({
            headers:{
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#sortable").sortable({
            revert: true,
            handle: ".sortable",
            stop:function(event,ui){
                var data = $(this).sortable('serialize');
                $.ajax({
                    type: 'POST',
                    data: data,
                    url: "{{route('settings.sortable')}}",
                    success: function(msg){
                        if(msg){
                            alertify.success("Emeliyyat Ugurlu");
                        }else {
                            alertify.error("Ugursuz Emeliyyat");
                        }
                    }
                });
            }
        });
        $('#sortable').disableSelection();
    });

    $('.fa-trash-o').click(function(){
        destroy_id = $(this).attr('id');
        
        alertify.confirm('Silmə Əməliyyatını Təsdiqləyin','Bu Əməliyyat Geri Qaytarıla Bilməz.',
        function(){
            location.href = "/manage/settings/delete/" + destroy_id;
        },
        function(){
            alertify.error("Silmə Əməliyyatı Ləğv Edildi.");
        }
        );
    });
</script>
@endsection


@section('css')@endsection
@section('js')@endsection