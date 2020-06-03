@extends('backend.layout')

@section('content')
<section class="content-header">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Blogs</h3>

            <div style="text-align: right;margin-right:10px;">
                <a href="{{route('blog.create')}}"><button class="btn btn-success">Yeni</button></a>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Açıqlama</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="sortable">
                    @foreach($data['blog'] as $blog)
                    <tr id="item-{{$blog->id}}">
                        <td class="sortable">{{$blog->blog_title}}</td>
                        <td width="5">
                            <a href="{{route('blog.edit',$blog->id)}}"><i style="font-size: 20px"
                                    class="fa fa-pencil-square"></i></a>
                        </td>
                        <td width="5">
                            <a href="javascript:void(0)"><i style="font-size: 20px" id="{{$blog->id}}"
                                    class="fa fa-trash-o"></i></a>
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
                    url: "{{route('blog.sortable')}}",
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
            $.ajax({
                type:'DELETE',
                url: 'blog/'+destroy_id,
                success:function(msg){
                    if(msg){
                        $('#item-'+destroy_id).remove();
                        alertify.success('Silmə Əməliyyatı Uğurlu');
                    }else{
                        alertify.error('Uğursuz Əməliyyat');
                    }
                }
                
            });
            
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